<!DOCTYPE html>
<html>
<head>
	<title>Reporte de Usuarios</title>
	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<!-- <link rel="stylesheet" href="sass/main.css" media="screen" charset="utf-8"/> -->
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta http-equiv="content-type" content="text-html; charset=utf-8">
	<link rel="stylesheet" href="{{asset('assets/css/Report.css')}}">
</head>
<body>
	<header class="clearfix">
		<div class="container">
			<figure>
				<img class="logo" src="{{asset('assets/img/hospital-building.png')}}" alt="" srcset="">
			</figure>
			<div class="company-info">
				<h2 class="title">CENTRO DE SALUD DE SANTA ROSA DE OCOCA</h2>
				<span>Avenida Av. Francisc Irazola S/N S/N Av. Francisc Irazola S/N Santa Rosa De Ocopa Concepcion Junin</span>
				<span class="line"></span>
				<a class="phone" href="tel:602-519-0450">945171492</a>
				<span class="line"></span>
				<a class="email" href="mailto:company@example.com">postasantarosa@example.com</a>
			</div>
		</div>
	</header>
	<section>
		<div class="details clearfix">
			<div class="client left">
				<p>Administrador:</p>
				<p class="name">{{Auth::user()->surnames}}, {{Auth::user()->names}}</p>
				<p>
					{{Auth::user()->phone}}
				</p>
				<a href="mailto:john@example.com">{{Auth::user()->email}}</a>
			</div>
			<div class="data right">
				<div class="title">RECISA</div>
				<div class="date">
					Fecha: {{ date('d/m/Y') }}
				</div>
			</div>
		</div>
		<div class="container">
			<div class="table-wrapper">
				<table>
					<tbody class="head">
						<tr>
							<th class="no"></th>
							<th class="desc"><div>Usuario</div></th>
							<th class="qty"><div>DNI</div></th>
							<th class="unit"><div>Celular</div></th>
							<th class="total"><div>Email</div></th>
						</tr>
					</tbody>
					<tbody class="body">
                        @foreach($users as $value=>$user) 
                            <tr>
                                <td class="no">{{$value + 1}}</td>
                                <td class="desc">{{$user->surnames}}, {{$user->names}}</td>
                                <td class="qty">{{$user->dni}}</td>
                                <td class="unit">{{$user->phone}}</td>
                                <td class="total">{{$user->email}}</td>
                            </tr>
                        @endforeach
					</tbody>
				</table>
			</div>
		</div>
	</section>
	<footer>
		<br>
		<div class="container">
			<div class="thanks">Vuelva pronto.</div>
			<div class="notice">
				<div>NOTICIA:</div>
				<div>RECORDAR A LOS DOCTORES REPORTAR SUS CITAS CULMINADAS.</div>
			</div>
			<div class="end">VALIDAR EL REPORTE PARA SU REGISTRO Y ALAMCENAMIENTO.</div>
		</div>
	</footer>

</body>

</html>
