<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="robots" content="no-cache" />
		<meta name="description" content="Sistema Informatico para apoyar el Control y Administracion de Capacitaciones - SYSCAP" />
		<meta name="keywords" content="mined, grado digital, capacitaciones, syscap" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="widtd=device-widtd, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>SYSCAP</title>
	</head>
	<body style="font-size: 12px;">
		<ENCABEZADO_REPORTE>
		<h1 align="center">Reporte de Consulta Estadítica</h1>
		<fieldset>
			<legend><h2 align="center">Estadística de Usuarios a Nivel Nacional</h2></legend>
			<hr/>
			<table border="0">
				<tr>
					<td style="text-align: left; font-weight: bold; widtd: 60px;">Tipo de Capacitado:</td><td style="widtd: 60px;"><TIPO_CAPACITADO></td>
					<td style="text-align: left; font-weight: bold; widtd: 100px;">Periodo:</td><td style="widtd: 250px;"><PERIODO></td>
				</tr>
			</table>
			<br/><br/>
			<table border="1">
				<thead>
					<tr>
						<td style="text-align: center; font-weight: bold;">#</td>
						<td style="text-align: center; font-weight: bold;">Departamento</td>
						<td style="text-align: center; font-weight: bold;">Municipio</td>
						<td style="text-align: center; font-weight: bold;">Tutorizados</td>
						<td style="text-align: center; font-weight: bold;">Autoformación</td>
					</tr>
				</thead>
				<tbody>
					<USUARIOS_NIVEL_NACIONAL>
				</tbody>
			</table>
			<SIN_DEPARTAMENTO_MUNICIPIO>
		</fieldset>
	</body>
</html>