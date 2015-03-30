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
			<legend><h2 align="center">Estadística de Usuarios por Tipo de Capacitados y Centro Educativo</h2></legend>
			<hr/>
			<table border="0">
				<tr>
					<td style="text-align: left; font-weight: bold; widtd: 60px;">Tipo de Capacitado:</td><td style="widtd: 60px;"><TIPO_CAPACITADO></td>
					<td style="text-align: left; font-weight: bold; widtd: 60px;">Centro Educativo:</td><td style="widtd: 300px;"><CENTRO_EDUCATIVO></td>
				</tr>
			</table>
			<br/><br/>
			<table border="1">
				<thead>
					<tr>
						<td style="text-align: center; font-weight: bold;">Modalidad de Capacitaci&oacute;n</td>
						<td style="text-align: center; font-weight: bold;">Cantidades</td>
					</tr>
				</thead>
				<tbody>
					<TIPOS_CAPACITADOS_CENTRO_EDUCATIVO>
				</tbody>
			</table>
		</fieldset>
	</body>
</html>