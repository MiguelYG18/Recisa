<aside id="sidebar" style="height: auto; min-height: 100vh;">
    <div class="d-flex">
        <button class="toggle-btn" type="button">
            <i class="fa-solid fa-hospital"></i>
        </button>
        <div class="sidebar-logo">
            <a href="">RECISA</a>
        </div>
    </div>
    <ul class="sidebar-nav">
        @switch(Auth::user()->user_level)
            @case(1)
                <li class="sidebar-item">
                    <a href="{{url('admin/dashboard')}}" class="sidebar-link">
                        <i class="fa-solid fa-home"></i>
                        <span>Perfil</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth1" aria-expanded="false" aria-controls="auth1">
                        <i class="fa-solid fa-user-doctor"></i>
                        <span>Gestión de Personal</span>
                    </a>
                    <ul id="auth1" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item1">
                            <a href="{{url('admin/admin/add')}}" class="sidebar-link">Registrar Personal</a>
                        </li>
                        <li class="sidebar-item1">
                            <a href="{{url('admin/admin/list')}}" class="sidebar-link">Listar Personal</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth2" aria-expanded="false" aria-controls="auth2">
                        <i class="fa-solid fa-user-group"></i>
                        <span>Gestión Roles</span>
                    </a>
                    <ul id="auth2" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item2">
                            <a href="{{url('admin/rol/add')}}" class="sidebar-link">Registrar Rol</a>
                        </li>
                        <li class="sidebar-item2">
                            <a href="{{url('admin/rol/list')}}" class="sidebar-link">Listar Rol</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth3" aria-expanded="false" aria-controls="auth3">
                        <i class="fa-solid fa-chalkboard-user"></i>
                        <span>Gestión Especialidad</span>
                    </a>
                    <ul id="auth3" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item2">
                            <a href="{{url('admin/specialization')}}" class="sidebar-link">Registrar Especialidad</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth4" aria-expanded="false" aria-controls="auth4">
                        <i class="fa-solid fa-file-lines"></i>
                        <span>Gestión Asignaciones</span>
                    </a>
                    <ul id="auth4" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item2">
                            <a href="{{url('admin/assignment')}}" class="sidebar-link">Asignar Especialidades</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth5" aria-expanded="false" aria-controls="auth5">
                        <i class="fa-solid fa-hospital-user"></i>
                        <span>Gestión de Pacientes</span>
                    </a>
                    <ul id="auth5" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item2">
                            <a href="{{url('admin/patient/add')}}"  class="sidebar-link">Registrar Paciente</a>
                        </li>
                        <li class="sidebar-item2">
                            <a href="{{url('admin/patient/list')}}" class="sidebar-link">Listar Pacientes</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth4" aria-expanded="false" aria-controls="auth4">
                        <i class="fa-solid fa-list-check"></i>
                        <span>Gestión de citas</span>
                    </a>
                    <ul id="auth4" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item2">
                            <a href="#" class="sidebar-link">Registrar Cita</a>
                        </li>
                        <li class="sidebar-item2">
                            <a href="#" class="sidebar-link">Listar Citas</a>
                        </li>
                    </ul>
                </li>
                @break
            @case(2)
                <li class="sidebar-item">
                    <a href="{{url('secretary/dashboard')}}" class="sidebar-link">
                        <i class="fa-solid fa-house"></i>
                        <span>Perfil</span>
                    </a>
                </li>             
                <li class="nav-item">
                    <a class="nav-link @if (Request::segment(2)=='dashboard') active @endif" href="{{url('secretary/dashboard')}}" style="text-align: center;font-size: 15px;">
                        <i class="fas fa-tachometer-alt" style="font-size: 20px;"></i>
                        <span style="font-size: 15px;">Dashboard</span>
                    </a>
                </li>
                @break
            @case(3)
                <li class="sidebar-item">
                    <a href="{{url('doctor/dashboard')}}" class="sidebar-link">
                        <i class="fa-solid fa-user"></i>
                        <span>Perfil</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{url('doctor/specialization/list')}}" class="sidebar-link">
                        <i class="fa-solid fa-chalkboard-user"></i>
                        <span>Especialidades</span>
                    </a>
                </li>
                @break    
            @default
        @endswitch
        <br><br><br><br>
        <div class="d-flex">
            <button class="toggle-btn" type="button">
                <i class="fa-solid fa-arrows-left-right-to-line" style="color: #afafb4b7;"></i>
            </button>
        </div> 
    </ul>
    <div class="sidebar-footer">
        <a href="{{url('logout')}}" class="sidebar-link">
            <i class="lni lni-exit"></i>
            <span>Logout</span>
        </a>
    </div>
</aside> 