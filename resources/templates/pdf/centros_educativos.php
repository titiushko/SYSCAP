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
		<h1 align="center">Reporte de Centros Educativos</h1>
		<fieldset>
			<legend><h3>Información General</h3></legend>
			<hr/>
			<table border="0">
				<tr>
					<td style="text-align: left; font-weight: bold; widtd: 100px;">Nombre:</td>
					<td style="widtd: 250px;"><NOMBRE_CENTRO_EDUCATIVO></td>
					<td style="text-align: left; font-weight: bold; widtd: 100px;">Código:</td>
					<td style="widtd: 250px;"><CODIGO_CENTRO_EDUCATIVO></td>
				</tr>
				<tr>
					<td style="text-align: left; font-weight: bold; widtd: 100px;">Departamento:</td>
					<td style="widtd: 250px;"><DEPARTAMENTO_CENTRO_EDUCATIVO></td>
					<td style="text-align: left; font-weight: bold; widtd: 100px;">Municipio:</td>
					<td style="widtd: 250px;"><MUNICIPIO_CENTRO_EDUCATIVO></td>
				</tr>
			</table>
		</fieldset>
		<fieldset>
			<legend><h3>Certificaciones</h3></legend>
			<hr/>
			<table border="0">
				<tr>
					<td style="width: 275px;" valign="top">
						<h4 align="center">Docentes Capacitados</h4>
						<table border="1">
							<thead>
								<tr>
									<td style="text-align: center; font-weight: bold; width: 25px;">#</td>
									<td style="text-align: center; font-weight: bold; width: 250px;">Nombre</td>
								</tr>
							</thead>
							<tbody>
								<DOCENTES_CAPACITADOS_CENTRO_EDUCATIVO>
							</tbody>
						</table>
					</td>
					<td style="width: 20px;">&nbsp;</td>
					<td style="width: 400px;" valign="top">
						<h4 align="center">Docentes Certificados</h4>
						<table border="1">
							<thead>
								<tr>
									<td style="text-align: center; font-weight: bold; width: 25px;">#</td>
									<td style="text-align: center; font-weight: bold; width: 155px;">Nombre</td>
									<td style="text-align: center; font-weight: bold; width: 220px;">Certificaci&oacute;n</td>
								</tr>
							</thead>
							<tbody>
								<DOCENTES_CERTIFICADOS_CENTRO_EDUCATIVO>
							</tbody>
						</table>
					</td>
				</tr>
			</table>
		</fieldset>
	</body>
</html>