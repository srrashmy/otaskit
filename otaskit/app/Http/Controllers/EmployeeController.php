<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Http\Controllers\DB;

class EmployeeController extends Controller
{

    public function index()
    {
        $employees = Employee::latest()->paginate(5);
  
        return view('employees.index',compact('employees'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'department' => 'required',

        ]);
  
        employee::create($request->all());
   
        return redirect()->route('employees.index')
                        ->with('success','employee created successfully.');
    }
   
    /**
     * Display the specified resource.
     *
     * @param  \App\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(employee $employee)
    {
        return view('employees.show',compact('employee'));
    }
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(employee $employee)
    {
        $departments = array('Sales', 'Marketing', 'IT');
        $empStatus   = array('Active', 'Inactive');
        return view('employees.edit',compact('employee', 'departments', 'empStatus'));
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, employee $employee)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'department' => 'required',
        ]);
  
        $employee->update($request->all());
  
        return redirect()->route('employees.index')
                        ->with('success','employee updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(employee $employee)
    {
        $employee->delete();
  
        return redirect()->route('employees.index')
                        ->with('success','employee deleted successfully');
    }    
}
