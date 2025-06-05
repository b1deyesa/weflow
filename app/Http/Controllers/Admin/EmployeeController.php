<?php

namespace App\Http\Controllers\Admin;

use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {              
        $employees = Employee::where('status', true)->get();
        $cart['day'] = collect(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'])->mapWithKeys(fn($d, $i) => [$d => $employees->filter(fn($e) => in_array($i + 1, array_keys((array) json_decode($e->working_days, true))))->count()])->toJson();
        $cart['position'] = Employee::where('status', true)->whereNotNull('position')->groupBy('position')->pluck(DB::raw('count(*)'), 'position')->toJson();
        $cart['total'] = Employee::count();
        $cart['active'] = Employee::where('status', true)->count();
    
        return view('admin.employee.index', [
            'employees' => Employee::orderBy('code', 'asc')->get(),
            'cart' => $cart,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $code = 'EMP' . str_pad((Employee::max('id') ?? 0) + 1, 3, '0', STR_PAD_LEFT);
        
        return view('admin.employee.create', [
            'code' => $code
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required',
            'join_date' => 'required',
            'working_days' => 'required'
        ]);
        
        if ($request->photo) {
            $file = $request->file('photo');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('Employee', $filename, 'public');
        }
        
        Employee::create([
            'code' => $request->code,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'position' => $request->position,
            'join_date' => $request->join_date,
            'working_days' => json_encode($request->working_days),
            'status' => $request->status === 'on',
            'photo' => $filename ?? null
        ]);
        
        return redirect(route('admin.employee.index'))->with('success','Success add data');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view('admin.employee.edit', [
            'employee' => $employee
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:employees,email,'. $employee->id,
            'phone' => 'required',
            'join_date' => 'required',
            'working_days' => 'required'
        ]);
        
        $employee->update([
            'code' => $request->code,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'position' => $request->position,
            'join_date' => $request->join_date,
            'working_days' => $request->working_days,
            'status' => $request->status === 'on',
        ]);
        
        if ($request->photo) {
            $file = $request->file('photo');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('Employee', $filename, 'public');
            $employee->update([
                'photo' => $filename ?? null
            ]);
        }
        
        return redirect(route('admin.employee.index'))->with('success','Success update data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
