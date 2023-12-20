<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

      <!-- <li class="nav-item">
        <a href="{{ url('/dashboard') }}" class="nav-link">
          <i class="fas fa-folder"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/channel_checking') }}" class="nav-link">
          <i class="fas fa-folder"></i>
          <p>
            Channel Checking
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/channel_name') }}" class="nav-link">
          <i class="fas fa-folder"></i>
          <p>
            Programe Name
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/channel_profile') }}" class="nav-link">
          <i class="fas fa-folder"></i>
          <p>
            Channel Profile
          </p>
        </a>
      </li> -->
      {{-- <li class="nav-item">
        <a href="{{ url('/test') }}" class="nav-link">
          <i class="fas fa-folder"></i>
          <p>
            Chennel Status
          </p>
        </a>
      </li> --}}

      
    @if(auth()->user()->user_type === 'admin')
    <!-- <li class="nav-item">
        <a href="{{ url('/dashboard') }}" class="nav-link">
            <i class="fas fa-folder"></i>
            <p>Dashboard</p>
        </a>
    </li> -->
    <li class="nav-item">
        <a href="{{ url('/dashboard') }}" class="nav-link">
            <i class="fas fa-folder"></i>
            <p>Channel Playing</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('/channel_checking') }}" class="nav-link">
            <i class="fas fa-folder"></i>
            <p>Channel Checking</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('/channel_name') }}" class="nav-link">
            <i class="fas fa-folder"></i>
            <p>Programe Name</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('/channel_profile') }}" class="nav-link">
            <i class="fas fa-folder"></i>
            <p>Channel Profile</p>
        </a>
    </li>
@else
    <!-- <li class="nav-item">
        <a href="{{ url('/dashboard') }}" class="nav-link">
            <i class="fas fa-folder"></i>
            <p>Dashboard</p>
        </a>
    </li> -->
    <li class="nav-item">
        <a href="{{ url('/dashboard') }}" class="nav-link">
            <i class="fas fa-folder"></i>
            <p>Channel Playing</p>
        </a>
    </li>
    
    <li class="nav-item">
        <a href="{{ url('/channel_checking') }}" class="nav-link">
            <i class="fas fa-folder"></i>
            <p>Channel Checking</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('/channel_profile') }}" class="nav-link">
            <i class="fas fa-folder"></i>
            <p>Channel Profile</p>
        </a>
    </li>
@endif





    </ul>
  </nav> 