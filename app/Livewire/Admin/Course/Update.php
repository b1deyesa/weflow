<?php

namespace App\Livewire\Admin\Course;

use App\Models\Course;
use App\Models\Employee;
use Livewire\Component;

class Update extends Component
{
    public Course $course;
    public $employees = [];
    public $employee_id = [];
    public $code;
    public $name;
    public $description;
    public $price;
    public $days = [];
    public $time_start;
    public $time_end;
    public $date_start;
    public $date_end;
    public $status;
    
    public function mount()
    {
        $this->code = $this->course->code;
        $this->name = $this->course->name;
        $this->description = $this->course->description;
        $this->price = $this->course->price;
        $this->time_start = $this->course->time_start;
        $this->time_end = $this->course->time_end;
        $this->date_start = $this->course->date_start;
        $this->date_end = $this->course->date_end;
        $this->status = $this->course->status ? true : false;
        
        foreach (json_decode($this->course->days, true) as $key => $day) {
            $this->days[$key] = $day;
        }
        $this->updatedDays();
        $this->employee_id = $this->course->employees->pluck('id')->mapWithKeys(fn($id) => [$id => true])->toArray();
    }
    
    public function updatedDays()
    {
        $this->days = array_filter($this->days);
        $this->employee_id = [];
        $days = array_keys($this->days);
        $this->employees = Employee::all()
            ->filter(function ($e) use ($days) {
                $workingKeys = array_keys((array) json_decode($e->working_days, true));
                return count(array_intersect($workingKeys, $days)) > 0;
            });
    }
    
    public function updatedEmployeeId()
    {
        $this->employee_id = array_filter($this->employee_id);
    }
    
    public function update()
    {   
        $this->days = array_filter($this->days);
        
        $this->validate([
            'employee_id' => 'required',
            'code' => 'required',
            'name' => 'required',
            'price' => 'required',
            'days' => 'required',
            'time_start' => 'required',
            'date_start' => 'required',
            'time_end' => 'required',
            'date_end' => 'required'
        ], [
            'employee_id.required' => 'Please select employee'
        ]);
        
        $this->course->update([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'days' => json_encode($this->days),
            'time_start' => $this->time_start,
            'time_end' => $this->time_end,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'status' => $this->status
        ]);
        
        $this->course->employees()->sync(array_keys($this->employee_id));
        
        return redirect(route('admin.course.index'))->with('success','Success add course');
    }
    
    public function render()
    {
        return view('livewire.admin.course.update', [
            'course' => $this->course
        ]);
    }
}
