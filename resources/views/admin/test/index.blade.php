@extends('admin.layouts.app')

@section('page_title')
<div class="row mb-2">
  <div class="col-sm-6">
    <h1>Channel Status Check</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
    </ol>
  </div>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Channel List</h3>
        <div class="card-tools">
          <a  class="btn btn-success" href="{{ url('/test') }}">Refresh Status</a>
        </div>
      </div>
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>Channel Logo</th>
            {{-- <th>Channel Name</th> --}}
            <th>Channel link</th>
            <th>Channel status</th>
          </tr>
        </thead>
        <tbody>
          @php
          $counter = 1; // Initialize the counter variable
          @endphp
            @foreach ($status_codes as $status)
            <tr>
              <td>{{ $counter++ }}</td>
                <td><img src="{{ url('upload/images/'.$status['image']) }}" alt="Image" class="img-fluid"></td>
                {{-- <td>{{ $item->cname->name }}</td> --}}
                <td>{{ $status['profile_link'] }}</td>
                @if($status['status_code'] === 200)
                <td>
                    <span style="color: green;"><i class="fas fa-check-circle"></i> HTTP Status Code: 200</span>
                </td>
              @else
                <td>
                    <span style="color: red;"><i class="fas fa-times-circle"></i> HTTP Status Code: {{ $status['status_code'] }}</span>
                </td>
             @endif
            
              </tr>
            @endforeach 
        </tbody>
      </table>
    </div>
    
  </div>
 
@endsection