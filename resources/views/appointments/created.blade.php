@extends('Layouts.app')
@section('title', 'Crear Cita')
@push('css')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
@endpush
@section('content')
    <div class="row mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Formulario de Registro de Citas</p>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="mdi mdi-alert-circle"></i> {{ implode(' ', $errors->all()) }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                        <form method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mt-2">
                                    <div class="input-group">
                                        <label class="input-group-text" for="id_area">Paciente</label>
                                        <select name="id_patient" id="id_patient" title="Seleccione..."
                                            data-style="btn-secondary" data-live-search="true" data-size="3"
                                            class="form-control selectpicker">
                                            @foreach ($patients as $patient)
                                                <option value="{{ $patient->id }}" {{old('id_patient') == $patient->id ? 'selected':''}}>
                                                    {{ $patient->surnames }},
                                                    {{ $patient->names }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <div class="input-group">
                                        <label class="input-group-text" for="id_area">Doctor y Especialidad</label>
                                        <select name="id_quota" id="id_quota" data-style="btn-secondary"
                                            data-live-search="true" data-size="3" class="form-control selectpicker">
                                            <option value="" disabled selected>Seleccionar</option>
                                            @foreach ($quotas as $quota)
                                                <optgroup
                                                    label="{{ $quota->user->surnames }}, {{ $quota->user->names }} -> cupos: {{ $quota->cupo_doctor }}">
                                                    @foreach ($quotas as $specialization)
                                                        @if ($specialization->id_specialization == $quota->id_specialization)
                                                            <option value="{{ $specialization->id }}"
                                                                {{ old('id_quota') == $specialization->id ? 'selected' : '' }}
                                                                {{ $specialization->cupo_doctor == 0 ? 'disabled' : '' }}>
                                                                {{ $specialization->specialization->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--Fecha-->
                                <div class="col-md-6 mt-3">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Fecha de atención</span>
                                        <input type="date" name="date" id="date" class="form-control boder-success"
                                            value="{{ old('date') }}">
                                    </div>
                                </div>
                                <!--hora-->
                                <div class="col-md-6 mt-3">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Hora de atención</span>
                                        <input type="time" name="time" id="time" class="form-control boder-success"
                                            value="{{ old('time') }}">
                                    </div>
                                </div>
                                <div class="col-md-12 text-center mt-2">
                                    <button type="submit" class="btn btn-primary me-2"
                                        style="background-color: #00476D !important;">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
@endpush
