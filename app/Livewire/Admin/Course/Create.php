<?php

namespace App\Livewire\Admin\Course;

use App\Models\Course;
use Livewire\Component;
use App\Models\Employee;

class Create extends Component
{
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
        $this->code = 'COU' . str_pad((Course::max('id') ?? 0) + 1, 3, '0', STR_PAD_LEFT);
        $this->date_start = now()->startOfMonth()->toDateString();
        $this->date_end = now()->endOfMonth()->toDateString();
        $this->status = true;
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
    
    public function store()
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
        
        $course = Course::create([
            'code' => $this->code,
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
        
        $course->employees()->attach(array_keys($this->employee_id));
        
        return redirect(route('admin.course.index'))->with('success','Success add course');
    }
    
    public function render()
    {
        return view('livewire.admin.course.create');
    }
}
