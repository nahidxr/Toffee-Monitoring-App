@extends('admin.layouts.app')
@section('page_title')
<div class="row mb-2">
  <div class="col-sm-6">
    <h1>Channel Status</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item active"></li>
    </ol>
  </div>
</div>
@endsection

@section('content')
<div class="card">
  <div class="card-body">
  <table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Logo</th>
            <th>Channel Name</th>
            <th>Service Name</th>
            <th>Channel status</th>
        </tr>
    </thead>
    <tbody>
        @php
        $counter = 1; // Initialize the counter variable
        @endphp
        @foreach ($channels as $channel)
        <tr>
            <td>{{ $counter++ }}</td>
            <td><img src="{{ url('upload/images/'.$channel->profile_image) }}" alt="Image" class="img-fluid" width="35" height="25"></td>
            <td>{{ $channel->channel_name }}</td>
            <td>{{ \App\Enums\Service::getDescription($channel->service_name) }}</td>
            <td class="status">
                @if($channel->overall_channel_status === 'valid')
                <span style="color: green;"><i class="fas fa-check-circle"></i> Status: Active</span>
                @else
                <span style="color: red;"><i class="fas fa-times-circle"></i> Status: Inactive</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

  </div>
</div>

<script>


 // Trigger video playback initialization when the page loads
 window.addEventListener('load', function() {
    initializeVideoPlayback();
  });
</script>
 
@endsection