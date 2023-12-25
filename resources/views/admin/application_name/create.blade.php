@extends('admin.layouts.app')

@section('page_title')
<div class="row mb-2">
  <div class="col-sm-6">
    <h1>Channel Name</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="{{ url('#') }}">Dashboard</a></li>
      {{-- <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li> --}}

      <li class="breadcrumb-item active">Application Name</li>
    </ol>
  </div>
</div>
@endsection

@section('content')
<div class="card"> 
    <div class="card-header">
      <h3 class="card-title">Add Application Name</h3>
    </div>
    <div class="card-body">
        <form action="{{ url('/app_name') }}" method="POST">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Application Name</label>
                <input type="text" class="form-control" name="name" id="aName" value="{{ old('name') }}" placeholder="Enter Channel Name">
              </div>
              @error('name')
              <p class="text-danger">{{ $message }}</p>
          @enderror

           {{-- Application name status --}}
           <div class="form-group">
                <label  for="channel">Status</label>
                    <select name="status" class="form-control">
                        <option value="">Select Status</option>
                        @foreach ($app_status as $x=>$status)
                        <option value="{{ $x }}" {{ old('status')==$x ? 'selected' : ''}}>{{ $status }}
                        </option>
                        @endforeach
                    </select>
              </div>
            </div>
         
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Create</button>
            </div>
          </form>
    </div>
   
    
  </div>
@endsection