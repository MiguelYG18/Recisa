@extends('layouts.app')
@section('title', 'Doctor')
    @push('css')
    @endpush
    @section('content')
    <div class="row">
        @foreach ($assignments as $assignment)
            <div class="col-md-6 col-xl-4 mb-4">
                <div class="card shadow border-start-primary py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-primary fw-bold text-xs mb-1">
                                    <span style="font-size: 20px;">CITAS - {{$assignment->specialization->name}}</span>
                                </div>
                                <div class="text-dark fw-bold h5 mb-0"><span>{{ $assignment->appointment_pending_count }}</span></div>
                            </div>
                            <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4 mb-4">
                <div class="card shadow border-start-primary py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-primary fw-bold text-xs mb-1">
                                    <span style="font-size: 20px;">CUPOS - {{$assignment->specialization->name}}</span>
                                </div>
                                <div class="text-dark fw-bold h5 mb-0"><span>{{ $assignment->cupo_doctor}}</span></div>
                            </div>
                            <div class="col-auto"><i class="fas fa-ticket-alt fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>              
        @endforeach
        @foreach ($atendidos as $atendido)
            @php
                $maxquatity= (($atendido->appointment_pending_count + $atendido->appointment_cancel_count) / ($atendido->cupo_doctor + $atendido->appointment_count))*100;
            @endphp
            <div class="col-md-6 col-xl-4 mb-4">
                <div class="card shadow border-start-info py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-info fw-bold text-xs mb-1"><span style="font-size: 20px;">ATENDIDOS - {{$atendido->specialization->name}}</span></div>
                                <div class="row g-0 align-items-center">
                                    <div class="col-auto">
                                        <div class="text-dark fw-bold h5 mb-0 me-3"><span>{{$atendido->appointment_pending_count}}</span></div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-info" 
                                                aria-valuenow="<?php echo $maxquatity; ?>" aria-valuemin="0" 
                                                aria-valuemax="100" style="width: <?php echo $maxquatity; ?>%;">
                                                <span class="visually"><?php echo round($maxquatity); ?>%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @endsection
    @push('js')
    @endpush
