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
			<legend><h3 align="center">Estadística de Usuarios por Tipo de Capacitados, Departamento y Municipio</h3></legend>
			<hr/>
			<table border="0">
				<tr>
					<td style="text-align: left; font-weight: bold; widtd: 100px;">Departamento:</td>
					<td style="widtd: 250px;"><DEPARTAMENTO></td>
					<td style="text-align: left; font-weight: bold; widtd: 100px;">Municipio:</td>
					<td style="widtd: 250px;"><MUNICIPIO></td>
				</tr>
				<tr>
					<td style="text-align: left; font-weight: bold; widtd: 100px;">Tipo de Capacitado:</td>
					<td style="widtd: 250px;"><TIPO_CAPACITADO></td>
					<td style="text-align: left; font-weight: bold; widtd: 100px;">Periodo:</td>
					<td style="widtd: 250px;"><PERIODO></td>
				</tr>
			</table>
			<br/><br/>
			<table border="1">
				<thead>
					<tr>
						<td style="text-align: center; font-weight: bold;">#</td>
						<td style="text-align: center; font-weight: bold;">Centro Educativo</td>
						<td style="text-align: center; font-weight: bold;">Capacitados</td>
						<td style="text-align: center; font-weight: bold;">Certificados</td>
					</tr>
				</thead>
				<tbody>
					<USUARIOS_DEPARTAMENTO_MUNICIPIO>
				</tbody>
			</table>
		</fieldset>
		<fieldset>
			<legend><h4>Listado de Usuarios por Centro Educativo</h4></legend>
			<hr/>
			<table border="1">
				<thead>
					<tr>
						<td style="text-align: center; font-weight: bold;">#</td>
						<td style="text-align: center; font-weight: bold;">Centro Educativo</td>
						<td style="text-align: center; font-weight: bold;">Nombre</td>
						<td style="text-align: center; font-weight: bold;">Tipo de Capacitado</td>
						<td style="text-align: center; font-weight: bold;">Modalidad Capacitación</td>
					</tr>
				</thead>
				<tbody>
					<USUARIOS_CENTRO_EDUCATIVO>
				</tbody>
			</table>
		</fieldset>
	</body>
</html>