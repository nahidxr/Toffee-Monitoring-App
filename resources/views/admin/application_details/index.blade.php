@php
    $userType = auth()->user()->user_type ?? null; // Get the user's type or default to null
@endphp

@extends('admin.layouts.app')

@section('page_title')
<div class="row mb-0">
  <div class="col-sm-6">
    <h1>Channel Profile List</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item active">Channel Profile</li>
    </ol>
  </div>
</div>
@endsection

@section('content')
<div class="mb-3">
  <div class="col-md-12 text-right mt-3">
    <form action="{{ url('/app_details') }}" method="GET" class="form-inline">
      <div class="input-group">
        <input type="text" id="searchInput" class="form-control" placeholder="Search Channel">
      </div>
    </form>
  </div>
</div>

<div class="card">
  @if($userType === 'admin')
  <div class="card-header">
    <h3 class="card-title"></h3>
    <div class="card-tools">
      <a class="btn btn-success" href="{{ url('/app_details/create') }}">Add New Node</a>
    </div>
  </div>
  @endif

  <!-- Flash messages -->
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
          <th>Application Node Name</th>
          <th>Ip Address</th>
          <th>Location</th>
          <th>Connection Type</th>
          <th>Owner</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @php $serialNumber = 1; @endphp
        @foreach ($appDetails_list as $item)
        <tr class="channel-row">
          <td>{{ $serialNumber++ }}</td>
          <td>{{ $item->applicationName->name }}</td>
          <td>{{ $item->ip }}</td>
          <td>{{ \App\Enums\Location::getDescription($item->location) }}</td>
          <td>{{ $item->connection_type }}</td>
          <td>{{ $item->owner }}</td>
          <td>
            @if ($item->status == 0)
            <button type="submit" class="btn btn-warning btn-sm">Deactivate</button>
            @elseif ($item->status == 1)
            <button type="submit" class="btn btn-success btn-sm">Activate</button>
            @endif
          </td>
          <td>
            <div class="btn-group" role="group">
              <a href="{{ url("/app_details/$item->id/edit") }}" class="btn btn-primary btn-sm">Update</a>
              <form action="{{ url("/app_details/$item->id") }}" method="POST" onsubmit="return confirm('Do you really want to delete this category?');">
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
