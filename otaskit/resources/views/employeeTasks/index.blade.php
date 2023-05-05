@extends('employeeTasks.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h4>Task Assignment</h4>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('employeeTasks.create') }}"> Assign Task</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Task Status</th>
            <th>Assigned to</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($employee_tasks as $task)
        <tr>
            <td>{{ $task->title }}</td>
            <td>{{ $task->description }}</td>
            <td>{{ $task->status }}</td>
            <td>{{ $task->name }}</td>
            <td>
                <form action="{{ route('employeeTasks.destroy',$task->id) }}" method="POST">
   
                    <!--a class="btn btn-info" href="{{ route('tasks.show',$task->id) }}">Show</a-->
    
                    <a class="btn btn-primary" href="{{ route('employeeTasks.edit',$task->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
      
@endsection