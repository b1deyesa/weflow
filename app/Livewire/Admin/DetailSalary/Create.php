<?php

namespace App\Livewire\Admin\DetailSalary;

use App\Models\DetailSalary;
use App\Models\Employee;
use App\Models\Salary;
use Livewire\Component;

class Create extends Component
{
    public $employees;
    public $employee;
    public $salary;
    public $basic_salary;
    public $edit_basic_salary;
    public $payroll_date;
    public $period_start;
    public $period_end;
    public $allowance;
    public $bonus;
    public $deducation;
    public $net_salary;
    public $payment_status;
    public $note;
    
    public function mount()
    {
        $this->employees = Salary::with('employee')->orderBy('employee_id')->get()->pluck('employee')->mapWithKeys(fn($e) => [$e->id => "$e->name - $e->code"])->toJson();
        $this->payroll_date = now()->toDateString();
        $this->period_start = now()->startOfMonth()->toDateString();
        $this->period_end = now()->endOfMonth()->toDateString();
        $this->payment_status = true;
    }
    
    public function updatedEmployee($id)
    {
        $this->salary = Employee::find($id)?->salaries->first();
        $this->basic_salary = $this->salary?->basic_salary;
        $this->edit_basic_salary = $this->basic_salary;
        
        $this->sum();
    }
    
    public function updateBasicSalary()
    {
        $this->validate([
            'edit_basic_salary' => 'required'
        ]);
        
        Employee::find($this->employee)->salaries->first()?->update([
            'basic_salary' => $this->edit_basic_salary
        ]);
        
        $this->basic_salary = Employee::find($this->employee)->salaries->first()?->basic_salary;
        $this->dispatch('updated-basic-salary');
        $this->sum();
    }
    
    public function sum()
    {
        $this->net_salary = (float)$this->basic_salary + (float)$this->allowance + (float)$this->bonus + (float)$this->deducation;
    }
    
    public function updatedAllowance()
    {
        $this->sum();
    }
    
    public function updatedBonus()
    {
        $this->sum();
    }
    
    public function updatedDeducation()
    {
        $this->sum();
    }
    
    public function store()
    {
        $this->validate([
            'employee' => 'required',
            'payroll_date' => 'required',
            'period_start' => 'required',
            'period_end' => 'required',
            'net_salary' => 'required',
        ]);
        
        DetailSalary::create([
            'salary_id' => $this->salary->id,
            'payroll_date' => $this->payroll_date,
            'period_start' => $this->period_start,
            'period_end' => $this->period_end,
            'allowance' => $this->allowance,
            'bonus' => $this->bonus,
            'deducation' => $this->deducation,
            'net_salary' => $this->net_salary,
            'payment_status' => $this->payment_status,
            'note' => $this->note
        ]);
        
        return redirect(route('admin.salary.index'))->with('success','Success store salary');
    }
    
    public function render()
    {
        return view('livewire.admin.detail-salary.create');
    }
}
