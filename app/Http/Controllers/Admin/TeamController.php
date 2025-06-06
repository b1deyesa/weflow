<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use App\Models\Course;
use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.team.index', [
            'teams' => Team::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.team.create', [
            'customers' => Customer::with('teams')->where('status', true)->doesntHave('teams')->get()->sortBy(fn($c) => optional($c->teams->first())->name)->values(),
            'employees' => Employee::pluck('name','id')->toJson(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:teams,name'
        ]);
        
        if ($request->photo) {
            $file = $request->file('photo');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('Team', $filename, 'public');
        }
        
        $team = Team::create([
            'name' => $request->name,
            'logo' => $filename ?? null
        ]);
        
        $customers = is_array($request->customer_id) ? array_keys($request->customer_id) : [];
        $team->customers()->sync($customers);

        $employees = $request->employee_id ? $request->employee_id : [];
        $team->employees()->sync($employees);
        
        return redirect(route('admin.team.index'))->with('success','Success add team');
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        return view('admin.team.edit', [
            'team' => $team,
            'customers' => Customer::with('teams')->get()->sortByDesc(fn($c) => optional($c->teams->first())->name)->values(),
            'employees' => Employee::pluck('name','id')->toJson()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => 'required|unique:teams,name,'. $team->id
        ]);
        
        if ($request->photo) {
            $file = $request->file('photo');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('Team', $filename, 'public');
            $team->update([
                'logo' => $filename ?? null
            ]);
        }
        
        $team->update([
            'name' => $request->name,
        ]);
        
        
        $customers = $request->customer_id ? array_keys($request->customer_id) : [];
        $team->customers()->sync($customers);

        $employees = $request->employee_id ? $request->employee_id : [];
        $team->employees()->sync($employees);
        
        return redirect(route('admin.team.index'))->with('success','Success update team');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        //
    }
}
