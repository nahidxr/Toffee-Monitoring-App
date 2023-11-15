@extends('admin.layouts.app')

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
          <h4 class="card-title">Channel Dashboard</h4>
        </div>
        <div class="card-body">
          <div>
            {{-- <div class="btn-group w-100 mb-2">
              <a class="btn btn-info active" href="javascript:void(0)" data-filter="all"> All items </a>
              <a class="btn btn-info" href="javascript:void(0)" data-filter="1"> Category 1 (WHITE) </a>
              <a class="btn btn-info" href="javascript:void(0)" data-filter="2"> Category 2 (BLACK) </a>
              <a class="btn btn-info" href="javascript:void(0)" data-filter="3"> Category 3 (COLORED) </a>
              <a class="btn btn-info" href="javascript:void(0)" data-filter="4"> Category 4 (COLORED, BLACK) </a>
            </div> --}}
            {{-- <div class="mb-2">
              <a class="btn btn-secondary" href="javascript:void(0)" data-shuffle=""> Shuffle items </a>
              <div class="float-right">
                <select class="custom-select" style="width: auto;" data-sortorder="">
                  <option value="index"> Sort by Position </option>
                  <option value="sortData"> Sort by Custom Data </option>
                </select>
                <div class="btn-group">
                  <a class="btn btn-default" href="javascript:void(0)" data-sortasc=""> Ascending </a>
                  <a class="btn btn-default" href="javascript:void(0)" data-sortdesc=""> Descending </a>
                </div>
              </div>
            </div> --}}


          </div>
         <div>
            <div class="filter-container p-0 row" style="padding: 3px; position: relative; width: 100%; display: flex; flex-wrap: wrap; height: auto;">
            
            
{{--                             
              <div class="filtr-item col-sm-2" data-category="2, 4" data-sort="black sample" style="opacity: 1; transform: scale(1) translate3d(684px, 0px, 0px); backface-visibility: hidden; perspective: 1000px; transform-style: preserve-3d; position: absolute; width: 167.5px; transition: all 0.5s ease-out 0ms, width 1ms ease 0s;">
                <a href="https://via.placeholder.com/1200/000000.png?text=8" data-toggle="lightbox" data-title="sample 8 - black">
                  <img src="https://via.placeholder.com/300/000000?text=8" class="img-fluid mb-2" alt="black sample">
                </a>
              </div>
              <div class="filtr-item col-sm-2" data-category="2, 4" data-sort="red sample" style="opacity: 1; transform: scale(1) translate3d(513px, 0px, 0px); backface-visibility: hidden; perspective: 1000px; transform-style: preserve-3d; position: absolute; width: 167.5px; transition: all 0.5s ease-out 0ms, width 1ms ease 0s;">
                <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=9" data-toggle="lightbox" data-title="sample 9 - red">
                  <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=9" class="img-fluid mb-2" alt="red sample">
                </a>
              </div>
              <div class="filtr-item col-sm-2" data-category="2, 4" data-sort="black sample" style="opacity: 1; transform: scale(1) translate3d(0px, 0px, 0px); backface-visibility: hidden; perspective: 1000px; transform-style: preserve-3d; position: absolute; width: 167.5px; transition: all 0.5s ease-out 0ms, width 1ms ease 0s;">
                <a href="https://via.placeholder.com/1200/000000.png?text=12" data-toggle="lightbox" data-title="sample 12 - black">
                  <img src="https://via.placeholder.com/300/000000?text=12" class="img-fluid mb-2" alt="black sample">
                </a>
              </div>
              <div class="filtr-item col-sm-2" data-category="2, 4" data-sort="black sample" style="opacity: 1; transform: scale(1) translate3d(0px, 0px, 0px); backface-visibility: hidden; perspective: 1000px; transform-style: preserve-3d; position: absolute; width: 167.5px; transition: all 0.5s ease-out 0ms, width 1ms ease 0s;">
                <a href="https://via.placeholder.com/1200/000000.png?text=12" data-toggle="lightbox" data-title="sample 12 - black">
                  <img src="https://via.placeholder.com/300/000000?text=12" class="img-fluid mb-2" alt="black sample">
                </a>
              </div>
              <div class="filtr-item col-sm-2" data-category="2, 4" data-sort="black sample" style="opacity: 1; transform: scale(1) translate3d(0px, 0px, 0px); backface-visibility: hidden; perspective: 1000px; transform-style: preserve-3d; position: absolute; width: 167.5px; transition: all 0.5s ease-out 0ms, width 1ms ease 0s;">
                <a href="https://via.placeholder.com/1200/000000.png?text=12" data-toggle="lightbox" data-title="sample 12 - black">
                  <img src="https://via.placeholder.com/300/000000?text=12" class="img-fluid mb-2" alt="black sample">
                </a>
              </div> --}}


              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#" id="playButton">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px; margin-top: 10px;">
                  </a>
                  <div class="status-indicator"></div>
                </div>
              </div>  
              <!--  video player div -->
              <div id="rmp" style="display: none;">
              </div>
              
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;margin-bottom: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;margin-bottom: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;margin-bottom: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;margin-bottom: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>
              <div class="col-md-2 col-sm-4 col-6">
                <div class="col-content">
                  <a href="#">
                    <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" class="brand-image  elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 100px; width: 100px;margin-top: 10px;">
                  </a>
                </div>
              </div>

              
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

{{-- script --}}
<!-- Include Radiant Media Player JavaScript library -->
<script src="https://cdn.radiantmediatechs.com/rmp/9.6.4/js/rmp-hlsjs.min.js"></script>
<!-- Add a div container with a unique id - video and UI elements will be appended to this container -->
<script>
  document.getElementById('playButton').addEventListener('click', function() {
    // Show the video player div
    document.getElementById('rmp').style.display = 'block';
  });
</script>

<!-- Set up player configuration options -->

<script>


  // First we must provide a streaming source to the player - in this case an HLS feed
  const src = {
   //hls: 'https://live-cdn.tsports.com/channel-01/index.m3u8'
   //hls: 'http://34.104.36.159/2002/manifest.m3u8'
    hls: 'https://bldcmstag-cdn.toffeelive.com/cdn/live/boishakhi/playlist.m3u8'
    // hls: 'https://mcdn-test.toffeelive.com/cdn/live/sony_sab_hd/playlist.m3u8'

    // You may provide different source types - the player will automatically pick the best option
    // You may provide different source types - the player will automatically pick the best option
  
  };
  // Then we set our player settings
  const settings = {
  licenseKey: 'ZW5ieGlkcGtna0AxNjQwODAz',
  src: src,
  width: 400,
  height: 360,
  // Let us select a skin
  skin: 's1',
  forceHlsJSOnIpadOS: true,
      forceHlsJSOnMacOSSafari: true,
  ajaxWithCredentials: true, // hls crenditials
  hlsJSFetchXhrWithCredentials: true, // hls crenditials
  crossorigin: 'anonymous', /// crossorigin hls crenditials
  // Let us add a poster frame to our player
    contentMetadata: {
      poster: [
        'feature_image_880420001595835330.png'
      ]
    },
    // hlsJSXhrSetup: xhrSetup
    // hlsJSCustomConfig: hlsJSCustomConfig
  };
  // Reference to our container div 
  const elementID = 'rmp';
  // Create an object based on RadiantMP constructor
  const rmp = new RadiantMP(elementID);
  // Initialization ... and done!
  rmp.init(settings);
</script>
<script type="text/javascript">
  document.cookie = "Edge-Cache-Cookie=URLPrefix=aHR0cHM6Ly9ibGRjbXN0YWctY2RuLnRvZmZlZWxpdmUuY29tLw:Expires=1688641821:KeyName=stag_0123:Signature=hU31xuEI5t6zLwa_it7HfsI0tghqiZ6OXeMqK3qrXiXjOMZjd1J17jWVehbsyNeEBqcITP5clzRoatxeyMiLAw; Path=/; Domain=.toffeelive.com; Expires=Fri 29 Dec 2023 20:22:48 GMT; SameSite=None; Secure;";
  </script>


  
@endsection

