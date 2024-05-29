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
        <div id="details" class="clearfix">
            <div id="client">
                <div class="to">ADMINISTRADOR:</div>
                <h2 class="name">{{ Auth::user()->surnames }}, {{ Auth::user()->names }}</h2>
                <div class="address">{{ Auth::user()->phone }}</div>
                <div class="email"><a href="mailto: {{ Auth::user()->email }}">{{ Auth::user()->email }}</a></div>
            </div>
            <div id="invoice">
                <h1>USUARIOS</h1>
                <div class="date">Fecha: <?php echo date('Y-m-d'); ?></div>
                <div class="date">Horarios: 7.00 A 19.00 HORAS</div>
            </div>
        </div>
        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th class="no">#</th>
                    <th class="desc">USUARIO</th>
                    <th class="unit">DNI</th>
                    <th class="qty">CELULAR</th>
                    <th class="total">EMAIL</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                    <tr>
                        <td class="no">{{ $index + 1 }}</td>
                        <td class="desc">{{ $user->surnames }}, {{ $user->names }}</td>
                        <td class="unit">{{ $user->dni }}</td>
                        <td class="qty">{{ $user->phone }}</td>
                        <td class="total">{{ $user->email }}</td>
                    </tr>
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
