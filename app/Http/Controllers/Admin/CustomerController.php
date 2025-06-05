<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payment;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.customer.index', [
            'customers' => Customer::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $code = 'CUS' . str_pad((Customer::max('id') ?? 0) + 1, 3, '0', STR_PAD_LEFT);
        
        return view('admin.customer.create', [
            'code' => $code,
            'courses' => Course::all()
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
            'email' => 'required|email|unique:customers',
            'phone' => 'required'
        ]);
        
        $customer = Customer::create([
            'code' => $request->code,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status === 'on',
            'note' => $request->note
        ]);
        
        if ($request->course_id) {
            $customer->courses()->attach(array_keys($request->course_id));
            
            foreach (array_keys($request->course_id) as $id) {
                Payment::create([
                    'customer_id' => $customer->id,
                    'course_id' => $id,
                ]);
            }
        }
        
        return redirect(route('admin.customer.index'))->with('success','Success add customer');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {      
        return view('admin.customer.edit', [
            'customer' => $customer,
            'courses' => Course::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:customers,email,'. $customer->id,
            'phone' => 'required'
        ]);
        
        $customer->update([
            'code' => $request->code,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status === 'on',
            'note' => $request->note
        ]);
        
        if ($request->course_id) {
            $customer->courses()->sync(array_keys($request->course_id));
        }
        
        return redirect(route('admin.customer.index'))->with('success','Success update customer');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
