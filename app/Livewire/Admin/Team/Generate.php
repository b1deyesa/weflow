<?php

namespace App\Livewire\Admin\Team;

use App\Models\Team;
use App\Models\Course;
use Livewire\Component;
use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class Generate extends Component
{
    public $teamSize;
    
    public function mount()
    {
        $this->teamSize = session('teamSize', 5);
    }
    
    public function close()
    {
        $this->dispatch('reload-page');
    }
    
    public function roll()
    {       
        $teamSize = $this->teamSize;
        session(['teamSize' => $this->teamSize]);

        DB::table('customer_team')->delete();
        DB::table('employee_team')->delete();
        Team::query()->delete();

        $usedCustomerIds = [];
        $teamCount = 1;

        $courses = Course::where('status', true)->get();

        foreach ($courses as $course) {
            $customers = Customer::whereHas('courses', function ($q) use ($course) {
                    $q->where('courses.id', $course->id);
                })
                ->where('status', true)
                ->whereNotIn('id', $usedCustomerIds)
                ->inRandomOrder()
                ->get();

            $chunks = $customers->chunk($teamSize);

            foreach ($chunks as $chunk) {
                if ($chunk->count() < $teamSize) {
                    continue;
                }

                $team = Team::create(['name' => 'Team ' . $teamCount++]);
                $team->customers()->attach($chunk->pluck('id'));
                $usedCustomerIds = array_merge($usedCustomerIds, $chunk->pluck('id')->toArray());

                $customerIds = $chunk->pluck('id');
                $courseIds = DB::table('course_customer')->whereIn('customer_id', $customerIds)->pluck('course_id');
                $employee = DB::table('course_employee')->whereIn('course_id', $courseIds)->pluck('employee_id')->unique()->shuffle()->first();

                if (!$employee) {
                    $employee = Employee::inRandomOrder()->first()?->id;
                }

                if ($employee) {
                    $team->employees()->attach($employee);
                }
            }
        }

        $remainingCustomers = Customer::where('status', true)
            ->whereNotIn('id', $usedCustomerIds)
            ->inRandomOrder()
            ->get();

        $chunks = $remainingCustomers->chunk($teamSize);

        foreach ($chunks as $chunk) {
            $team = Team::create(['name' => 'Team ' . $teamCount++]);
            $team->customers()->attach($chunk->pluck('id'));
            $usedCustomerIds = array_merge($usedCustomerIds, $chunk->pluck('id')->toArray());

            $customerIds = $chunk->pluck('id');
            $courseIds = DB::table('course_customer')->whereIn('customer_id', $customerIds)->pluck('course_id');
            $employee = DB::table('course_employee')->whereIn('course_id', $courseIds)->pluck('employee_id')->unique()->shuffle()->first();

            if (!$employee) {
                $employee = Employee::inRandomOrder()->first()?->id;
            }

            if ($employee) {
                $team->employees()->attach($employee);
            }
        }

        $allEmployeeIds = Employee::pluck('id')->toArray();
        $employeeTeamCounts = DB::table('employee_team')
            ->select('employee_id', DB::raw('count(team_id) as total'))
            ->groupBy('employee_id')
            ->pluck('total', 'employee_id')
            ->toArray();

        $unusedEmployeeIds = array_diff($allEmployeeIds, array_keys($employeeTeamCounts));
        $overAssignedEmployees = array_filter($employeeTeamCounts, fn($count) => $count > 1);

        foreach ($unusedEmployeeIds as $unusedEmployeeId) {
            $teamToReassign = null;
            $employeeToReduce = null;

            foreach ($overAssignedEmployees as $empId => $count) {
                $teams = DB::table('employee_team')->where('employee_id', $empId)->pluck('team_id');
                if ($teams->count() > 1) {
                    $teamToReassign = $teams->first();
                    $employeeToReduce = $empId;
                    break;
                }
            }

            if ($teamToReassign && $employeeToReduce) {
                DB::table('employee_team')->where('employee_id', $employeeToReduce)->where('team_id', $teamToReassign)->delete();

                DB::table('employee_team')->insert([
                    'employee_id' => $unusedEmployeeId,
                    'team_id' => $teamToReassign,
                ]);

                $employeeTeamCounts[$employeeToReduce]--;
                $employeeTeamCounts[$unusedEmployeeId] = 1;

                if ($employeeTeamCounts[$employeeToReduce] <= 1) {
                    unset($overAssignedEmployees[$employeeToReduce]);
                }
            }
        }

        return redirect()->route('admin.team.index')->with('success', 'Tim dan pelatih berhasil digenerate dan semua pelatih terpakai.');
    }
    
    public function render()
    {
        return view('livewire.admin.team.generate');
    }
}
