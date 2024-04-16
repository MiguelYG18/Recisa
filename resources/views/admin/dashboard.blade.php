@extends('layouts.app')
@section('title', 'Administrador')
    @push('css')
    @endpush
    @section('content')
    <div class="row">
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-start-primary py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-primary fw-bold text-xs mb-1">
                                <span style="font-size: 20px;">DOCTORES</span>
                            </div>
                            <div class="text-dark fw-bold h5 mb-0"><span>{{$doctor}}</span></div>
                        </div>
                        <div class="col-auto"><i class="fa fa-user-md fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-start-success py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span style="font-size: 20px;">PACIENTES</span></div>
                            <div class="text-dark fw-bold h5 mb-0"><span>125</span></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-user-injured fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-start-info py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-info fw-bold text-xs mb-1"><span style="font-size: 20px;">RESERVAS</span></div>
                            <div class="row g-0 align-items-center">
                                <div class="col-auto">
                                    <div class="text-dark fw-bold h5 mb-0 me-3"><span>23</span></div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-info" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"><span class="visually-hidden">50%</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-start-warning py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-warning fw-bold text-xs mb-1" style="font-size: 20px;"><span>SESIÓN</span></div>
                            <div class="text-dark fw-bold h5 mb-0"><span>18</span></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-ticket-alt fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    @endsection
    @push('js')
    @endpush
