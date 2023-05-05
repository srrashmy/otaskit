<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\EmployeeTask;
use App\Models\Task;
use App\Models\Employee;

class EmployeeTaskController extends Controller
{
    public function index()
    {
        //$employee_tasks = EmployeeTask::latest()->paginate(5);

        $employee_tasks = DB::table('employee_tasks')
                          ->join('employees', 'employee_tasks.employee_id', '=', 'employees.id')
                          ->join('tasks', 'employee_tasks.task_id', '=', 'tasks.id')
                          ->select('employee_tasks.*', 'employees.name', 'tasks.title', 'tasks.description', 'tasks.status' )
                          ->get();
  
        return view('employeeTasks.index',compact('employee_tasks'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tasks     = Task::all();
        $employees = Employee::all();

        return view('employeeTasks.create', compact('tasks', 'employees'));
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
            'employee_id' => 'required',
            'task_id' => 'required',
        ]);
  
        EmployeeTask::create($request->all());

        DB::table('tasks')
                ->where('id', $request->get('task_id'))
                ->update(['status' => 'Assigned']);  

        return redirect()->route('employeeTasks.index')
                        ->with('success','task created successfully.');
    }
   
    /**
     * Display the specified resource.
     *
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(employeeTask $task)
    {
        return view('employeeTasks.show',compact('task'));
    }
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(employeeTask $emptask)
    {
//print_r($emptask); 
//exit;       
        $tasks = DB::table('tasks')->get();
        $emps = DB::table('employees')->get();
        $status = array('Unassigned', 'Assigned', 'In Progress', 'Done');
        return view('employeeTasks.edit',compact('emptask', 'tasks', 'emps', 'status'));
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, employeeTask $task)
    {
        $request->validate([
            'employee_id' => 'required',
            'task_id' => 'required',
        ]);
  
        $task->update($request->all());
  
        return redirect()->route('employeeTasks.index')
                        ->with('success','task updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(employeeTask $task, $id)
    {

                DB::table('employee_tasks')
                ->where('id', $id)
                ->delete();  

        //$task->delete();
        return redirect()->route('employeeTasks.index')
                        ->with('success','task deleted successfully');
    }
}
