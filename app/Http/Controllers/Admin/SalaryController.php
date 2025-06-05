<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailSalary;
use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.salary.index', [
            'salaries' => Salary::orderBy('employee_id')->get(),
            'detail_salaries' => DetailSalary::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.salary.create', [
            'employee' => Employee::where('status', true)->whereDoesntHave('salaries')->get()->mapWithKeys(fn($e) => [$e->id => "$e->code - $e->name"])->toJson()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required',
            'basic_salary' => 'required'
        ]);
        
        Salary::create([
            'employee_id' => $request->employee_id,
            'basic_salary' => $request->basic_salary
        ]);
        
        return redirect(route('admin.salary.index'))->with('success','Success add employee salary');
    }

    /**
     * Display the specified resource.
     */
    public function show(Salary $salary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salary $salary)
    {
        return view('admin.salary.edit', [
            'salary' => $salary
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Salary $salary)
    {
        $request->validate([
            'basic_salary' => 'required'
        ]);
        
        $salary->update([
            'basic_salary' => $request->basic_salary
        ]);
        
        return redirect(route('admin.salary.index'))->with('success','Success update employee salary');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salary $salary)
    {
        //
    }
}
