@extends('admin.layouts.app')

@section('page_title')
<div class="row mb-2">
  <div class="col-sm-6">
    <h1>Channel Profile</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
      <li class="breadcrumb-item active">Channel Profile</li>
    </ol>
  </div>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Channel List</h3>
      <div class="card-tools">
        {{-- <a  class="btn btn-success" href="{{ url('#') }}">Add New Channel</a> --}}
        <a  class="btn btn-success" href="{{ url('/channel_profile/create') }}">Add New Profile</a>
      </div>
    </div>
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Channel Logo</th>
            <th>Channel Name</th>
            <th>Profile Name</th>
            <th>Channel link</th>
            <th>Channel status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($cprofile_list as $item)
            <tr>
                <td><img src="{{ url('upload/images/'.$item->image) }}" alt="Image" class="img-fluid"></td>
                <td>{{ $item->cname->name }}</td>
                <td>{{ $item->Profile_name }}</td>
                <td>{{ $item->Profile_link }}</td>
                <td>{{ $item->status }}</td>
                <td>
                  <div class="btn-group" role="group">
                    {{-- <a href="{{ url("/channel_name/$item->id/edit") }}" class="btn btn-primary btn-sm">Update</a>    
                    <form action="{{ url("/channel_name/$item->id") }}" method="POST" onsubmit="return confirm('Do you really want to delete this category?');">
                       --}}
                       <a href="{{ url("#") }}" class="btn btn-primary btn-sm">Update</a>    
                       <form action="{{ url("/channel_profile/$item->id") }}" method="POST" onsubmit="return confirm('Do you really want to delete this category?');">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Delete" class="btn btn-danger btn-sm ml-1">
                    </form>
                  </div>
                </td>
              </tr>
            @endforeach 
        </tbody>
      </table>
    </div>
   
    
  </div>
@endsection