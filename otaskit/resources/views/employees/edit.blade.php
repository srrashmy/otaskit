@extends('employees.layout')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit employee</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('employees.index') }}"> Back</a>
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
  
    <form action="{{ route('employees.update',$employee->id) }}" method="POST">
        @csrf
        @method('PUT')
   
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $employee->name }}" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="text" name="email" value="{{ $employee->email }}" class="form-control" placeholder="Email">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Mobile No:</strong>
                    <input type="text" name="mobile" value="{{ $employee->mobile }}" class="form-control" placeholder="Mobile No">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Department:</strong>
                    @php
                        $selected = "";
                        $empDept     = $employee->department;
                    @endphp
                    <select name="department" id= "department" class="form-control">
                        @php
                            foreach ($departments as $dept) {
                                if  ($dept == $empDept) {
                                    $selected = "selected";
                                }
                            @endphp
                            <option value="{{ $dept}}" {{$selected}}>{{$dept}}</option>
                            @php 
                                $selected = ""; 
                            }
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status:</strong>
                    @php
                        $selected = "";
                        $emplStatus     = $employee->status;
                    @endphp
                    <select name="status" id= "status" class="form-control">
                        @php
                            foreach ($empStatus as $st) {
                                if  ($st == $emplStatus) {
                                    $selected = "selected";
                                }
                            @endphp
                            <option value="{{ $st}}" {{$selected}}>{{$st}}</option>
                            @php 
                                $selected = ""; 
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