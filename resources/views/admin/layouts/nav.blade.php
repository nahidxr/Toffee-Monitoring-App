<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

      
    @if(auth()->user()->user_type === 'admin')
  
    <li class="nav-item">
        <a href="{{ url('/dashboard') }}" class="nav-link">
            <i class="fas fa-folder"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('/channel_playing') }}" class="nav-link">
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
    <!-- add application node -->
    <li class="nav-item">
    <a href="#" class="nav-link toggle-settings">
        <i class="fas fa-cog"></i>
        <p>Settings</p>
    </a>
    <ul class="nav nav-second-level collapse settings-options">
        <li class="nav-item">
            <a href="{{ url('/app_name') }}" class="nav-link">
                <i class="fas fa-folder"></i>
                <p>Application Name</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('/app_details') }}" class="nav-link">
                <i class="fas fa-folder"></i>
                <p>Application Node</p>
            </a>
        </li>
        <!-- Add more list items as needed -->
    </ul>
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
            <p>Dashboard</p>
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

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $(".settings-options").hide();

    $(".toggle-settings").click(function(e) {
        e.preventDefault();
        $(this).next(".settings-options").slideToggle();
    });
});
</script>

