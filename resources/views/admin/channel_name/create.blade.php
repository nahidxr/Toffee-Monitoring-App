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

      <li class="breadcrumb-item active">Channel Name</li>
    </ol>
  </div>
</div>
@endsection

@section('content')
<div class="card"> 
    <div class="card-header">
      <h3 class="card-title">Add Channel Name</h3>
    </div>
    <div class="card-body">
        <form action="{{ url('/channel_name') }}" method="POST">
            @csrf
            <div class="card-body">
              {{-- <div class="form-group">
                <label for="exampleInputEmail1">Main Category</label>
                <select name="main_category_id"  class="form-control">
                    @foreach ($main_category as $key => $item)
                        <option value="{{ $key }}" {{ old('main_category_id')==strval($key) ? 'selected':''}}>{{ $item  }}</option>
                    @endforeach
                </select>
              </div>
              @error('name')
              <p class="text-danger">{{ $message }}</p> --}}
       
              <div class="form-group">
                <label for="exampleInputEmail1">Channel Name</label>
                <input type="text" class="form-control" name="name" id="cName" value="{{ old('name') }}" placeholder="Enter Channel Name">
              </div>
              @error('name')
              <p class="text-danger">{{ $message }}</p>
          @enderror
            </div>
         
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Create</button>
            </div>
          </form>
    </div>
   
    
  </div>
@endsection