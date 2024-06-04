<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>RECISA | Reporte Paciente</title>
    <link rel="stylesheet" href="{{ asset('assets/css/Report.css') }}" media="all" />
    <link rel="icon" href="{{ asset('assets/img/escudo.png') }}">
</head>

<body>
    <header class="clearfix">
        <div id="company">
            <h2 class="name">RECISA</h2>
            <div>Av. Francisc Irazola S/N Santa Rosa De Ocopa Concepcion Junin.</div>
            <div>945171492</div>
            <div><a href="mailto:recisa@gmail.com">recisa@gmail.com</a></div>
        </div>
		<div id="logo">
            <img src="{{ asset('assets/img/hospital-building.png') }}" width="70px" height="70px">
        </div>
    </header>
    <main>
        <div id="details" class="clearfix">
            <div id="client">
                <div class="to">PACIENTE:</div>
                <h2 class="name">{{$patient->surnames}}, {{$patient->names}}</h2>
                <div class="address">DNI: {{$patient->dni}}</div>
                <div class="address">Nº HISTORIAL: {{$patient->history_number}}</div>
                <div class="address">CELULAR: {{$patient->phone}}</div>
            </div>
            <div id="invoice">
                <h1>CITAS</h1>
                <div class="date">Fecha y Hora: {{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}</div>
                <div class="date">Horarios: 7.00 A 19.00 HORAS</div>
            </div>
        </div>
        <table>
            <thead>
                <tr style="border: 2px solid; border-color: #acacb1da;">
                    <th style="border: 2px solid; text-align: center; border-color: #acacb1da;">#</th>
                    <th style="border: 2px solid; text-align: center; border-color: #acacb1da;">DOCTOR</th>
                    <th style="border: 2px solid; text-align: center; border-color: #acacb1da;">ESPECIALIDAD</th>
                    <th style="border: 2px solid; text-align: center; border-color: #acacb1da;">FECHA</th>
                    <th style="border: 2px solid; text-align: center; border-color: #acacb1da;">HORA</th>
                    <th style="border: 2px solid; text-align: center; border-color: #acacb1da;">ESTADO</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($patient->appointments as $index => $appointment)
                    <tr>
                        <th style="border: 2px solid; text-align: center; border-color: #acacb1da;">{{ $index + 1 }}</th>
                        <th style="border: 2px solid; text-align: center; border-color: #acacb1da;">{{ $appointment->doctor->user->surnames}}, {{$appointment->doctor->user->names}}</th>
                        <th style="border: 2px solid; text-align: center; border-color: #acacb1da;">{{ $appointment->doctor->specialization->name}}</th>
                        <th style="border: 2px solid; text-align: center; border-color: #acacb1da;">{{ $appointment->date }}</th>
                        <th style="border: 2px solid; text-align: center; border-color: #acacb1da;">{{ $appointment->time }}</th>
                        <th style="border: 2px solid; text-align: center; border-color: #acacb1da;">
                            @switch($appointment->status)
                                @case(0)
                                    Por atender
                                    @break
                                @case(1)
                                    Atendido
                                    @break
                                @case(2)
                                    No atendido
                                    @break
                                @default
                            @endswitch
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
		<br><br><br>
        <div id="notices">
            <div>NOTA:</div>
            <div class="notice">REPORTE DIARIO DE PACIENTES.</div>
        </div>
    </main>
    <footer>

    </footer>
</body>

</html>
