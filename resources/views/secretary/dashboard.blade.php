@extends('layouts.app')
@section('title', 'Secretaria')
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
                            <div class="text-dark fw-bold h5 mb-0"><span>{{$appointment}}</span></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-user-injured fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    @endsection
    @push('js')
    @endpush
