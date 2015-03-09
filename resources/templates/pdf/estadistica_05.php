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
			<legend><h3 align="center">Estadística de Usuarios por Tipo de Capacitados y Fecha a Nivel Nacional</h3></legend>
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
						<td></td>
						<td colspan="2" style="text-align: center; font-weight: bold;">Modalidad de Capacitaci&oacute;n</td>
					</tr>
					<tr>
						<td rowspan="2" style="text-align: center; font-weight: bold;">Tipo de Capacitado</td>
						<td style="text-align: center; font-weight: bold;">Tutorizados</td>
						<td style="text-align: center; font-weight: bold;">Autoformaci&oacute;n</td>
					</tr>
				</thead>
				<tbody>
					<MODALIDADES_CAPACITADOS>
				</tbody>
			</table>
		</fieldset>
	</body>
</html>