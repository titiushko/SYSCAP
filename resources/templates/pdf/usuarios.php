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
		<h1 align="center">Reporte de Usuarios</h1>
		<fieldset>
			<legend><h3>Información General</h3></legend>
			<hr/>
			<table border="0">
				<tr>
					<td style="text-align: left; font-weight: bold; widtd: 100px;">Nombres:</td>
					<td style="widtd: 250px;"><NOMBRES_USUARIO></td>
					<td style="text-align: left; font-weight: bold; widtd: 100px;">Apellidos:</td>
					<td style="widtd: 250px;"><APELLIDO1_USUARIO></td>
				</tr>
				<tr><td colspan="4">&nbsp;</td></tr>
				<tr>
					<td style="text-align: left; font-weight: bold; widtd: 100px;">DUI:</td>
					<td style="widtd: 250px;"><DUI_USUARIO></td>
					<td style="text-align: left; font-weight: bold; widtd: 100px;">Correo Electrónico:</td>
					<td style="widtd: 250px;"><CORREO_USUARIO></td>
				</tr>
				<tr><td colspan="4">&nbsp;</td></tr>
				<tr>
					<td style="text-align: left; font-weight: bold; widtd: 100px;">Profesión:</td>
					<td style="widtd: 250px;"><PROFESION_USUARIO></td>
					<td style="text-align: left; font-weight: bold; widtd: 100px;">Centro Educativo:</td>
					<td style="widtd: 250px;"><CENTRO_EDUCATIVO_USUARIO></td>
				</tr>
				<tr><td colspan="4">&nbsp;</td></tr>
				<tr>
					<td style="text-align: left; font-weight: bold; widtd: 100px;">Dirección:</td>
					<td colspan="3" style="widtd: 250px;"><DIRECCION_USUARIO></td>
				</tr>
			</table>
		</fieldset>
		<br/>
		<fieldset>
			<legend><h3>Información de Usuario</h3></legend>
			<hr/>
			<table border="0">
				<tr>
					<td style="text-align: left; font-weight: bold; widtd: 100px;">Nombre de Usuario:</td>
					<td style="widtd: 250px;"><NOMBRE_USUARIO></td>
					<td style="text-align: left; font-weight: bold; widtd: 100px;">Tipo de Usuario:</td>
					<td style="widtd: 250px;"><TIPO_USUARIO></td>
				</tr>
			</table>
		</fieldset>
		<br/>
		<fieldset>
			<legend><h3>Información de Cursos</h3></legend>
			<hr/>
			<table border="0">
				<tr>
					<td style="text-align: left; font-weight: bold; widtd: 200px;">Modalidad de Capacitación:</td>
					<td style="widtd: 250px;"><MODALIDAD_USUARIO></td>
				</tr>
			</table>
			<br/>
			<h4>Certificaciones Obtenidas</h4>
			<table border="1">
				<tdead>
					<tr>
						<td style="text-align: center; font-weight: bold;">#</td>
						<td style="text-align: center; font-weight: bold;">Nombre de la Certificación</td>
					</tr>
				</tdead>
				<tbody>
					<CERTIFICACIONES_USUARIO>
				</tbody>
			</table>
			<br/>
			<h4>Cursos Recibidos y Calificaciones Obtenidas</h4>
			<table border="1">
				<tdead>
					<tr>
						<td style="text-align: center; font-weight: bold;">#</td>
						<td style="text-align: center; font-weight: bold;">Nombre del Curso</td>
						<td style="text-align: center; font-weight: bold;">Calificación</td>
					</tr>
				</tdead>
				<tbody>
					<CURSOS_USUARIO>
				</tbody>
			</table>
		</fieldset>
	</body>
</html>