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
            <th>Application Node Name</th>
            <th>Application Name</th>
            <th>IP Address</th>
            <th>Location</th>
            <th>Status</th>
            <th>Report Date</th>
            <th>Report Time</th>
            <th>Type</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($applicationDetails as $index => $item)
            @foreach($item->applicationNames as $appName)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->node_name }}</td>
                    <td>{{ $appName->name }}</td>
                    <td>{{ $item->ip }}</td>
                    <td>{{ $item->location }}</td>
                    <td>{{ $item->status }}</td>
                    <td><!-- Report Date Column --></td>
                    <td><!-- Report Time Column --></td>
                    <td><!-- Type Column --></td>
                    <td><!-- Action Column --></td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>


   </div>
</div> 
@endsection