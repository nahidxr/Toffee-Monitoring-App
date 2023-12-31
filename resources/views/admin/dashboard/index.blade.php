@extends('admin.layouts.app')
@section('page_title')

<div class="row" style=" margin-top: 9px">
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
    <a href="#" class="small-box-footer"><i class="fas"></i></a>
        <div class="inner">
        <h4 style="color: #fff; font-weight: bold;">Channel Status</h4>
            <p>

                Total: {{ $total_profiles }} <br>
                Inactive : {{ $inactive_channels}} <br>
                Not Functional : {{ $inactiveChannelsCount }} <br>
                
            </p>
        </div>
        <div class="icon">
            <i class="ion ion-bag"></i>
        </div>
        <a href="#" class="small-box-footer"><i class="fas"></i></a>
    </div>
</div>



  <!-- <div class="col-lg-3 col-6">

  <div class="small-box bg-success">
  <a href="#" class="small-box-footer"><i class="fas"></i></a>
      <div class="inner">
        <h3>53</h3>

        <p>Demo Active Channel</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <a href="#" class="small-box-footer"><i class="fas"></i></a>
    </div>
  </div> -->


<!-- 
  <div class="col-lg-3 col-6">
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>65</h3>

        <p>Demo InActive Channel</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
    </div>
  </div>


  <div class="col-lg-3 col-6">

    <div class="small-box bg-warning">
      <div class="inner">
        <h3>44</h3>

        <p>Demo</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
    </div>
  </div> -->

  <!-- ./col -->
</div>

<script>
    // Reload the page every minute (60,000 milliseconds)
    setInterval(function() {
        location.reload();
    }, 60000);
</script>

@endsection