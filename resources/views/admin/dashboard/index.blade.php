@extends('admin.layouts.app')
@section('page_title')
<div class="row mb-2">
  <div class="col-sm-6">
    <h1>Channel List</h1>
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
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>Channel Logo</th>
            <th>Channel Name</th>
            <th>Channel status</th>
          </tr>
        </thead>
        <tbody>
          @php
          $counter = 1; // Initialize the counter variable
          @endphp
            @foreach ($cprofile_list as $item)
            <tr>
              <td>{{ $counter++ }}</td>
                <td><img src="{{ url('upload/images/'.$item->image) }}" alt="Image" class="img-fluid"width="70" height="70"></td>
                <td>{{ $item->cname->name }}</td>
                {{-- <td>{{ App\Enums\ChannelStatus::getDescription($item->status) }}</td> --}}
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
               
              </tr>
            @endforeach 
        </tbody>
      </table>
    </div>
    
  </div>
 
@endsection