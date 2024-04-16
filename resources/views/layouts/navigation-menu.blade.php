<nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" style="--bs-primary: #00486E;--bs-primary-rgb: 0,72,110;background: #00486E;">
    <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#" style="background: #00486E;">
            <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-hospital"></i></div>
            <div class="sidebar-brand-text mx-3"><span style="font-size: 14px;">posta médica</span></div>
        </a>
        <hr class="sidebar-divider my-0">
        <ul class="navbar-nav text-light" id="accordionSidebar">
            @if (Auth::user()->user_level == 1)
                <li class="nav-item">
                    <a class="nav-link @if (Request::segment(2)=='dashboard') active @endif" href="{{url('admin/dashboard')}}" style="text-align: center;font-size: 15px;">
                        <i class="fas fa-tachometer-alt" style="font-size: 20px;"></i>
                        <span style="font-size: 15px;">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item" style="font-size: 14PX;">
                    <a class="nav-link @if (Request::segment(2)=='admin') active @endif" href="{{url('/admin/admin/list')}}" style="font-size: 14PX;text-align: center;">
                        <i class="fas fa-user" style="font-size: 20px;"></i>
                        <span style="font-size: 15px;">Usuario</span>
                    </a>
                </li>
                <li class="nav-item" style="font-size: 14PX;">
                    <a class="nav-link @if (Request::segment(2)=='rol') active @endif" href="{{url('/admin/rol/list')}}" style="font-size: 14PX;text-align: center;">
                        <i class="fa fa-users" style="font-size: 20px;"></i>
                        <span style="font-size: 15px;">Roles</span>
                    </a>
                </li>
                <li class="nav-item" style="font-size: 14PX;">
                    <a class="nav-link @if (Request::segment(2)=='specialization') active @endif" href="{{url('/admin/specialization')}}" style="font-size: 14PX;text-align: center;">
                        <i class="fa fa-hospital" style="font-size: 20px;"></i>
                        <span style="font-size: 15px;">Rama</span>
                    </a>
                </li>                
            @elseif (Auth::user()->user_level == 2)
                <li class="nav-item">
                    <a class="nav-link @if (Request::segment(2)=='dashboard') active @endif" href="{{url('secretary/dashboard')}}" style="text-align: center;font-size: 15px;">
                        <i class="fas fa-tachometer-alt" style="font-size: 20px;"></i>
                        <span style="font-size: 15px;">Dashboard</span>
                    </a>
                </li>
            @elseif (Auth::user()->user_level == 3)
                <li class="nav-item">
                    <a class="nav-link @if (Request::segment(2)=='dashboard') active @endif" href="{{url('doctor/dashboard')}}" style="text-align: center;font-size: 15px;">
                        <i class="fas fa-tachometer-alt" style="font-size: 20px;"></i>
                        <span style="font-size: 15px;">Dashboard</span>
                    </a>
                </li>    
            @endif
        </ul>
        <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
    </div>
</nav>