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
                  <th>Application Node Name </th>
                  <th>Application Name</th>
                  <th>IP Address</th>
                  <th>Location</th>
                  <th>Remarks</th>
                  <th>Status</th>
                  <th>Report Date</th>
                  <th>Report Time </th>
                  <th>Type</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td>dd</td>
                  <td>d</td>
                  <td>d</td>
                  <td>d</td>
                  <td>d</td>
                  <td>d</td>
                  <td>d</td>
                  <td>d</td>
                  <td>d</td>
                  <td>d</td>
              </tr>
          </tbody>
      </table>
   </div>
</div> 
@endsection