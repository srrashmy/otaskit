@extends('employeeTasks.layout')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Task Assignment</h2>
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
  
    <form action="{{ route('employeeTasks.update', $emptask->task_id) }}" method="POST">
        @csrf
        @method('PUT')
   
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Task:</strong>
                    @php
                        $selected = "";
                        $empTask     = $emptask->task_id;
                    @endphp
                    <select name="task_id" id= "task_id" class="form-control">
                        @php
                            foreach ($tasks as $task) {
                                if  ($task->id == $empTask) {
                                    $selected = "selected";
                                }
                            @endphp
                            <option value="{{ $task->id }}" {{$selected}}>{{$task->title}}</option>
                            @php 
                                $selected = ""; 
                            }
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <textarea name="description" class="form-control" placeholder="Task Description"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
   
    </form>
@endsection