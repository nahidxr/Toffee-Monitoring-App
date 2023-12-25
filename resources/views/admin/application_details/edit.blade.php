@extends('admin.layouts.app')

@section('page_title')
<div class="row mb-2">
  <div class="col-sm-6">
    <h1>Channel Profile</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="{{ url('#') }}">Dashboard</a></li>
      {{-- <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li> --}}

      <li class="breadcrumb-item active">Node Information</li>
    </ol>
  </div>
</div>
@endsection

@section('content')
<div class="card"> 
    <div class="card-header">
      <h3 class="card-title">Update Node information</h3>
    </div>
    <div class="card-body">
        <form action="{{ url("/app_details/$app_details_list->id") }}" method="POST">
            @method("put")
            @csrf
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif

          @if (session('message'))
              <div class="alert alert-success">
                  {{ session('message') }}
              </div>
          @endif
            <div class="card-body"> 

            <div class="form-group">
                <label for="name"> Node Name</label>
                <input type="text" class="form-control" name="node_name" id="node_name" value="{{ $app_details_list->node_name }}" placeholder="Enter Node Name">
              </div>
              <div class="form-group">
                <label for="ip">IP Adress</label>
                <input type="text" class="form-control" name="ip" id="ip" value="{{ $app_details_list->ip }}" placeholder="Enter IP">
              </div>

              <div class="form-group">
                <label  for="location">Select Location</label>
                    <select name="location" class="form-control">
                        <option value="">Select a location</option>
                        @foreach ($location_list as $x=>$location)
                        <option value="{{ $x }}" {{ $app_details_list->location==$x ? 'selected' : ''}}>{{ $location }}
                        </option>
                        @endforeach
                    </select>
              </div>


              <div class="form-group">
                <label for="connection_type">Connection Type</label>
                <input type="text" class="form-control" name="connection_type" id="connection_type" value="{{ $app_details_list->connection_type }}" placeholder="Enter connection type">
              </div>
              <div class="form-group">
                <label for="owner">Owner</label>
                <input type="text" class="form-control" name="owner" id="owner" value="{{ $app_details_list->owner }}" placeholder="Enter owner">
              </div>

              {{-- service name --}}
              <div class="form-group">
                <label  for="category">App Name List</label>
                    <select name="app_name_id" class="form-control">
                        <option value="">Select a Application</option>
                        @foreach ($app_list as $item)
                        <option value="{{ $item->id }}" {{ old('app_name_id')==$item->id ? 'selected' : ''}}>{{ $item->name }}
                        </option>
                        @endforeach
                    </select>
              </div>

              {{-- channel status --}}

              <div class="form-group">
                <label  for="status">Channe Status</label>
                    <select name="status" class="form-control">
                        <option value="">Select a Staus</option>
                        @foreach ($app_details as $x=>$status)
                        <option value="{{ $x }}" {{ old('status')==$x ? 'selected' : ''}}>{{ $status }}
                        </option>
                        @endforeach
                    </select>
              </div>
                   
              
         
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </form>
    </div>
   
    
  </div>
{{-- script --}}

<script>
  $(document).ready(function () {
      $('#image').change(function (e) {

          var reader = new FileReader();
          reader.onload = function (e) {
              $('#showImage').attr('src', e.target.result);

          }

          reader.readAsDataURL(e.target.files['0']);

      });



  });

</script>


@endsection