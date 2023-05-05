@extends('tasks.layout')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Assign Task</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('employeeTasks.index') }}"> Back</a>
        </div>
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="{{ route('employeeTasks.store') }}" method="POST">
    @csrf
  
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Task:</strong>
                    <select name="task_id" id= "task_id" class="form-control">
                        @php
                            foreach ($tasks as $task) {
                        @endphp
                            <option value="{{ $task->id}}">{{$task->title}}</option>
                        @php 
                            }
                        @endphp
                    </select>
            </div>
        </div>        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Employee:</strong>
                <select name="employee_id" id= "employee_id" class="form-control">
                @php
                    foreach ($employees as $employee) {
                @endphp
                    <option value="{{ $employee->id}}">{{$employee->name}}</option>
                @php 
                    }
                @endphp
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
   
</form>
@endsection