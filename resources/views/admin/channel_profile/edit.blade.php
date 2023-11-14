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
      <h3 class="card-title">Update Channel Profile</h3>
    </div>
    <div class="card-body">
        <form action="{{ url('/channel_profile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label  for="category">Channel Name List</label>
                    <select name="channel_name_id" class="form-control">
                        <option value="">Select a Channel</option>
        
                        @foreach ($channel_name_list as $item)
                        <option value="{{ $item->id }}" {{ $channel_profile_list->channel_name_id==$item->id ? 'selected' : ''}}>{{ $item->name }}
                        </option>
                        @endforeach
                    </select>
              </div>


              {{-- <div class="form-group">
                <label for="exampleInputEmail1">Channel Name</label>
                <input type="text" class="form-control" name="cname" id="cName" value="{{ old('name') }}" placeholder="Enter Channel Name">
              </div>
              @error('name')
              <p class="text-danger">{{ $message }}</p>
              @enderror --}}

              <div class="form-group">
                <label for="exampleInputEmail1">Profile Name</label>
                <input type="text" class="form-control" name="pname" id="pName" value="{{ $channel_profile_list->Profile_name }}" placeholder="Enter Profile Name">
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Profile Link</label>
                <input type="text" class="form-control" name="plink" id="plink" value="{{ $channel_profile_list->Profile_link }}" placeholder="Enter Profile Link">
              </div>
              {{-- channel status --}}

              <div class="form-group">
                <label  for="channel">Channe Status</label>
                    <select name="status" class="form-control">
                        <option value="">Select a Channel</option>
        
                        @foreach ($channel_status as $x=>$status)
                        <option value="{{ $x }}" {{ $channel_profile_list->status==$x ? 'selected' : ''}}>{{ $status }}
                        </option>
                        @endforeach
                    </select>
              </div>



              {{-- <div class="form-group">
                <label for="exampleInputEmail1">Profile Status</label>
                <input type="text" class="form-control" name="pstatus" id="pstatus" value="{{ old('name') }}" placeholder="Enter Channel Status">
              </div> --}}

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
                        {{-- src="{{  url("#") }}" --}}
                        alt="" style="hight:100px;width:100px;border:1px solid #000000;">
                </div>

            </div>


                {{-- Image Upload section End --}}




              @error('name')
              <p class="text-danger">{{ $message }}</p>
          @enderror
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