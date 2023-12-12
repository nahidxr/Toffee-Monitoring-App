@extends('admin.layouts.app')


@section('page_title')
<div class="row mb-2">
  <div class="col-sm-6">
    <h1>Channel Name List</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="{{ url('#') }}">Dashboard</a></li>
      {{-- <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li> --}}
      <li class="breadcrumb-item active">Programme Name</li>
    </ol>
  </div>
</div>
@endsection
@section('content')
  <div class="mb-3">
  <div class="col-md-12 text-right mt-3">
      <form action="{{ url('/channel_name') }}" method="GET" class="form-inline">
          <div class="input-group">
              <input type="text" id="searchInput" class="form-control" placeholder="Search Channel">
          </div>
      </form>
</div>
</div>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h3 class="card-title"></h3>
            </div>
            <div class="col-md-6 text-right">
                <div class="card-tools">
                    <a class="btn btn-success" href="{{ url('/channel_name/create') }}">Add New Channel</a>
                </div>
            </div>
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
        <table id="channelTable" class="table table-bordered">
            <thead>
                <tr>
                    <th >Channel Name</th>
                    <th class="d-flex justify-content-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cName_list as $item)
                <tr class="channel-row">
                    <td>{{ $item->name }}</td>
                    <td class="d-flex justify-content-center">
                        <div class="btn-group" role="group">
                            <a href="{{ url("/channel_name/$item->id/edit") }}" class="btn btn-primary btn-sm">Update</a>
                            <form action="{{ url("/channel_name/$item->id") }}" method="POST" onsubmit="return confirm('Do you really want to delete this category?');">
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










