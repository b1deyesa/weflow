<?php

namespace App\Http\Controllers\Admin;

use App\Models\Employee;
use App\Models\DetailSalary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Salary;

class DetailSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.detail-salary.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DetailSalary $detailSalary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailSalary $detailSalary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetailSalary $detailSalary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailSalary $detailSalary)
    {
        //
    }
}
