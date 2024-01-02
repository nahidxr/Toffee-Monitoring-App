@extends('admin.layouts.app')

@section('page_title')
<div class="row mb-2">
  <div class="col-sm-6">
    <h1>Application Status</h1>
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
            <th>Host Name</th>
            <th>OS</th>
            <th>Location</th>
            <th>Type</th>
            <th>Status</th>
            <th>CPU (%)</th>
            <th>Last Rebooted</th>
            <th>Uptime</th>
        </tr>
    </thead>
    <tbody>
        @php
            $count = 0;
        @endphp
        @foreach($device_list as $item)
            <tr>
                <td>{{ ++$count }}</td>
                <td>{{ $item->hostname }}</td>
                <td>{{ $item->os }}</td>
                <td>{{ $item->location }}</td>
                <td>{{ $item->type }}</td>
                <td>
                    @if($item->status == 1)
                        <button class="btn btn-success">Device Up</button>
                    @elseif($item->status == 0)
                        <button class="btn btn-danger">Device Down</button>
                    @endif
                </td>
                <th>{{ $item->ss_cpu_raw_system_perc }}</th>
                <td>{{ $item->last_rebooted }}</td>
                <td>{{ $item->uptime }}</td>
           
            </tr>
        @endforeach
    </tbody>
</table>



   </div>
</div> 
@endsection