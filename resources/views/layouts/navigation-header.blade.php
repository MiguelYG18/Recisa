<nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
    <div class="container-fluid">
        <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
                <button class="btn btn-primary py-0" type="button" style="background: #135578 !important;height: 54px;">
                    <i class="far fa-calendar-alt"></i>
                </button>
                <label class="form-label input-group-text" style="height: 54px; width:187px" id="fecha_hora"></label>
                    <script>
                        function updateTime() {
                        var now = new Date();
                        var formattedTime = now.getFullYear() + '-' + (now.getMonth() + 1).toString().padStart(2, '0') + '-' + now.getDate().toString().padStart(2, '0') + ' ' + now.getHours().toString().padStart(2, '0') + ':' + now.getMinutes().toString().padStart(2, '0') + ':' + now.getSeconds().toString().padStart(2, '0');
                        document.getElementById('fecha_hora').textContent = formattedTime;
                        }

                        setInterval(updateTime, 1000); 
                        updateTime(); 
                    </script>
            </div>
        </form>
        <ul class="navbar-nav flex-nowrap ms-auto">
            @if (Auth::user()->user_level == 1)
                <li class="nav-item dropdown no-arrow mx-1">
                    <div class="nav-item dropdown no-arrow">
                        <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                            <span class="badge bg-danger badge-counter">{{$vacio}}</span>
                            <i class="fas fa-bell fa-fw"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                            <h6 class="dropdown-header">Alertas</h6>
                            @foreach ($specializations as $specialization)
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="me-3">
                                        <div class="bg-primary icon-circle text-center">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div><span class="small text-gray-500"></span>
                                        <p>{{$specialization->name}} tiene {{$specialization->quantity_voucher}} cupos</p>
                                    </div>
                                </a>
                            @endforeach
                            <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown no-arrow mx-1">
                    <div class="nav-item dropdown no-arrow">
                        <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                            <span class="badge bg-danger badge-counter">{{$cupo}}</span>
                            <i class="fas fa-envelope fa-fw"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                            <h6 class="dropdown-header">Doctores sin cupos</h6>
                            @foreach ($doctors as $doctor)
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image me-3">
                                        <img class="rounded-circle" src="{{url('public/storage/perfiles/' . $doctor->image)}}">
                                        @switch($doctor->user_status)
                                            @case(0)
                                                <div class="bg-warning status-indicator"></div>
                                                @break
                                            @case(1)
                                                <div class="bg-success status-indicator"></div>
                                                @break
                                            @default
                                        @endswitch
                                    </div>
                                    <div class="fw-bold">
                                        <div class="text-truncate">
                                            <span>{{$doctor->specialization_name}}</span>
                                            <span>{{$doctor->user_name}}</span>
                                        </div>
                                        <p class="small text-gray-500 mb-0">Cantidades de cupos {{$doctor->cupo_doctor}}</p>
                                    </div>
                                </a>                                    
                            @endforeach
                            <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                        </div>
                    </div>
                    <div class="shadow dropdown-list dropdown-menu dropdown-menu-end" aria-labelledby="alertsDropdown"></div>
                </li>                
            @endif
            <div class="d-none d-sm-block topbar-divider"></div>
            <li class="nav-item dropdown no-arrow">
                <div class="nav-item dropdown no-arrow">
                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                        <span class="d-none d-lg-inline me-2 text-gray-600 small">{{Auth::user()->names}}</span> 
                        @if(Auth::user()->image == null)
                            <img class="border rounded-circle img-profile" src="https://i.postimg.cc/hjSBbZX4/doctor.png">
                        @else
                            <img class="border rounded-circle img-profile" src="{{url('public/storage/perfiles/' . Auth::user()->image)}}">
                        @endif
                    </a>
                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                        @switch(Auth::user()->user_level)
                            @case(1)                           
                                <a class="dropdown-item" href="{{url('admin/perfil')}}"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400">
                                    </i>&nbsp;Perfil
                                </a>
                                @break
                            @case(2)
                                <a class="dropdown-item" href="{{url('secretary/perfil')}}"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400">
                                    </i>&nbsp;Perfil
                                </a>
                                @break
                            @case(3)
                                <a class="dropdown-item" href="{{url('doctor/perfil')}}"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400">
                                    </i>&nbsp;Perfil
                                </a>                              
                            @break
                            @default
                        @endswitch
                        <a class="dropdown-item" href="#"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400">
                            </i>&nbsp;Activity log
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{url('logout')}}">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout
                        </a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>