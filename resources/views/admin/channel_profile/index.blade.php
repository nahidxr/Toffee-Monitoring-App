@extends('admin.layouts.app')
@section('page_title')
<div class="row mb-0">
  <div class="col-sm-6">
    <h1>Channel Profile List</h1>
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
<div class="mb-3">
  <div class="col-md-12 text-right mt-3">
    <form action="{{ url('/channel_profile') }}" method="GET" class="form-inline">
        <div class="input-group">
            <input type="text" id="searchInput" class="form-control" placeholder="Search Channel">
        </div>
    </form>
</div>
</div>
<div class="card">
    <div class="card-header">
      <h3 class="card-title"></h3>
      <div class="card-tools">
        <a class="btn btn-success" href="{{ url('/channel_profile/create') }}">Add New Profile</a>
      </div>
    </div>
        
<!-- Place this code where you want to display flash messages -->
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>Logo</th>
            <th>Channel Name</th>
            <th>FLV Name</th>
            <th>URL</th>
            <th>Service Name</th>
            <th>Transcode Info</th>
            <th>Link Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @php
          $counter = 1; // Initialize the counter variable
          @endphp
            @foreach ($cprofile_list as $item)
            <tr class="channel-row">
              <td>{{ $counter++ }}</td>
                <td><img src="{{ url('upload/images/'.$item->image) }}" alt="Image" class="img-fluid" width="50" height="40"></td>
                <td>{{ $item->cname->name }}</td>
                <td>{{ $item->Profile_name }}</td>
                {{-- <td>{{ $item->Profile_link }}</td> --}}
                <td>
                  <a href="{{ $item->Profile_link }}">
                      Channel Link <i class="fas fa-external-link-alt"></i>
                  </a>
              </td>
                <td>{{ \App\Enums\Service::getDescription($item->service_name) }}</td>
                {{-- <td>{{ $item->transcoder_info }}</td>--}}
                <td>
                  <a href="{{ $item->transcoder_info }}">
                      Transcoder Link <i class="fas fa-external-link-alt"></i>
                  </a>
              </td>
                @if($item->status === \App\Enums\ChannelStatus::Active)
                <td>
                  <span style="color: green;"><i class="fas fa-check-circle"></i> {{ \App\Enums\ChannelStatus::getDescription($item->status) }}</span>
                </td>
                @elseif($item->status === \App\Enums\ChannelStatus::Inactive)
                <td>
                  <span style="color: red;"><i class="fas fa-times-circle"></i> {{ \App\Enums\ChannelStatus::getDescription($item->status) }}</span>
                </td>
                @else
                <td>{{ \App\Enums\ChannelStatus::getDescription($item->status) }}</td>
               @endif
              

                <td>
                  <div class="btn-group" role="group">
                    <a href="{{ url("/channel_profile/$item->id/edit") }}" class="btn btn-primary btn-sm">Update</a>    
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
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {
      $('#searchInput').on('keyup', function () {
          let searchText = $(this).val().toLowerCase();
          $('.channel-row').each(function () {
              let cellText = $(this).text().toLowerCase();
              if (cellText.indexOf(searchText) === -1) {
                  $(this).hide();
              } else {
                  $(this).show();
              }
          });
      });
  });
</script>
@endsection
