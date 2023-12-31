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

      <li class="breadcrumb-item active">Channel Profile</li>
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
        <form action="{{ url('/channel_profile') }}" method="POST" enctype="multipart/form-data">
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
                <label  for="category">Channel Name List</label>
                    <select name="channel_name_id" class="form-control">
                        <option value="">Select a Channel</option>
                        @foreach ($channel_list as $item)
                        <option value="{{ $item->id }}" {{ old('channel_name_id')==$item->id ? 'selected' : ''}}>{{ $item->name }}
                        </option>
                        @endforeach
                    </select>
              </div>
           
              <div class="form-group">
                <label for="exampleInputEmail1">FLV Name</label>
                <input type="text" class="form-control" name="pname" id="pName" value="{{ old('name') }}" placeholder="Enter FLV Name">
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">URL</label>
                <input type="text" class="form-control" name="plink" id="plink" value="{{ old('name') }}" placeholder="Enter Profile Link">
              </div>

              {{-- service name --}}
              <div class="form-group">
                <label  for="channel">Service Name</label>
                    <select name="service_name" class="form-control">
                        <option value="">Select a Service</option>
                        @foreach ($service_name as $x=>$service)
                        <option value="{{ $x }}" {{ old('service')==$x ? 'selected' : ''}}>{{ $service }}
                        </option>
                        @endforeach
                    </select>
              </div>

              {{-- transcode Info --}}
              <!-- <div class="form-group">
                <label for="exampleInputEmail1">Transcoder Info</label>
                <input type="text" class="form-control" name="transcoder_info" id="transcoder" value="{{ old('transcoder_info') }}" placeholder="Enter Transcoder Info">
              </div> -->
              <div class="form-group">
                <label for="transcoderInfo">Transcoder Info</label>
                <input type="text" class="form-control" name="transcoder_info[]" id="transcoder" value="{{ old('transcoder_info') }}" placeholder="Enter Transcoder Info">
              </div>
              {{-- channel status --}}

              <div class="form-group">
                <label  for="channel">Channe Status</label>
                    <select name="status" class="form-control">
                        <option value="">Select a Channel</option>
                        @foreach ($channel_status as $x=>$status)
                        <option value="{{ $x }}" {{ old('status')==$x ? 'selected' : ''}}>{{ $status }}
                        </option>
                        @endforeach
                    </select>
              </div>
              {{-- Image Upload section Start --}}

              <div class="form-group">
                <h5> Image <span class="text-danger">*</span></h5>
                <div class="controls">
                    <input type="file" name="image" class="form-control" id="image">
                </div>

            </div>
            <div class="form-group">
                <div class="controls">
                    <img id="showImage"
                        src="{{ (!empty($channel_profile_list->image))? url('upload/images/'.$channel_profile_list->image):url('upload/no_image.png') }}"
                        alt="" style="hight:125px;width:125px;border:1px solid #000000;">
                </div>

            </div>
                {{-- Image Upload section End --}}
         
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Create</button>
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