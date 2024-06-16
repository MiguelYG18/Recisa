<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>RECISA | Reportes Usuarios</title>
    <link rel="stylesheet" href="{{ asset('assets/css/Report.css') }}" media="all" />
    <link rel="icon" href="{{ asset('assets/img/escudo.png') }}">
</head>

<body>
    <header class="clearfix">
        <div id="company">
            <h2 class="name">RECISA</h2>
            <div>Av. Francisc Irazola S/N Santa Rosa De Ocopa Concepcion Junin. </div>
            <div>945171492</div>
            <div><a href="mailto:recisa@gmail.com">recisa@gmail.com</a></div>
        </div>
        <div id="logo">
            <img src="{{ asset('assets/img/hospital-building.png') }}" width="70px" height="70px">
        </div>
    </header>
    <main>
        @foreach ($patientDoctor as $specialization)
            <div id="details" class="clearfix">
                <div id="client">
                    <div class="to">DOCTOR:</div>
                    <h2 class="name">{{ $specialization->user->surnames }}, {{ $specialization->user->names }}</h2>
                    <div class="address">{{ $specialization->specialization->name }}</div>
                    <div class="email"><a href="mailto:{{ $specialization->user->email }}">{{ $specialization->user->email }}</a>
                    </div>
                </div>
                <div id="invoice">
                    <h1>Pacientes de Doctor</h1>
                    <div class="date">Fecha: <?php echo date('Y-m-d'); ?></div>
                    <div class="date">Horarios: 7.00 A 19.00 HORAS</div>
                </div>
            </div>
        @endforeach
        <table>
            <thead>
                <tr style="border: 2px solid; border-color: #acacb1da;">
                    <th style="border: 2px solid; text-align: center; border-color: #acacb1da;">#</th>
                    <th style="border: 2px solid; text-align: center; border-color: #acacb1da;">DNI</th>
                    <th style="border: 2px solid; text-align: center; border-color: #acacb1da;">PACIENTE</th>
                    <th style="border: 2px solid; text-align: center; border-color: #acacb1da;">NUMERO HISTORIAL</th>
                    <th style="border: 2px solid; text-align: center; border-color: #acacb1da;">TELEFONO</th>
                    <th style="border: 2px solid; text-align: center; border-color: #acacb1da;">HORA</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($patientDoctor as $specialization)
                    @if ($specialization->appointment->isNotEmpty())
                        @foreach ($specialization->appointment as $index => $appointments)
                            @switch($appointments->status)
                                @case(0)
                                    <tr>
                                        <td style="border: 2px solid; text-align: center; border-color: #acacb1da;">
                                            {{ $index + 1 }}
                                        </td>
                                        <td style="border: 2px solid; text-align: center; border-color: #acacb1da;">
                                            {{ $appointments->patient->dni }}
                                        </td>
                                        <td style="border: 2px solid; text-align: center; border-color: #acacb1da;">
                                            {{ $appointments->patient->names }}, {{ $appointments->patient->surnames }}
                                        </td>
                                        <td style="border: 2px solid; text-align: center; border-color: #acacb1da;">
                                            {{ $appointments->patient->history_number }}
                                        </td>
                                        <td style="border: 2px solid; text-align: center; border-color: #acacb1da;">
                                            {{ $appointments->patient->phone }}
                                        </td>
                                        <td style="border: 2px solid; text-align: center; border-color: #acacb1da;">
                                            {{ $appointments->time }}
                                        </td>
                                    </tr>
                                    @break
                                @default
                            @endswitch
                        @endforeach
                    @endif
                @endforeach
            </tbody>
        </table>
        <br><br><br>
        <div id="notices">
            <div>NOTA:</div>
            <div class="notice">RECORDAR A LOS DOCTORES REPORTAR SUS CITAS DIARIAS.</div>
        </div>
    </main>
    <footer>

    </footer>
</body>

</html>
