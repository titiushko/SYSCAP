<?= doctype('html5'); ?>
<html lang="en">
	<head>
		<?php
		$metainformaciones = array(
			array('name'	=>	'robots', 'content'				=>	'no-cache'),
			array('name'	=>	'description', 'content'		=>	'Sistema Informático para apoyar el Control y Administración de Capacitaciones - SYSCAP'),
			array('name'	=>	'keywords', 'content'			=>	'mined, grado digital, capacitaciones, syscap'),
			array('name'	=>	'X-UA-Compatible', 'content'	=>	'IE=edge', 'type' => 'equiv'),
			array('name'	=>	'viewport', 'content'			=>	'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'),
			array('name'	=>	'Content-type', 'content'		=>	'text/html; charset=utf-8', 'type' => 'equiv'),
			//array('name'	=>	'Content-type', 'content'		=>	'text/html; charset=ISO-8859-1', 'type' => 'equiv')
		);
		echo meta($metainformaciones);
		?>
		<title><?= htmlentities(@$usuario[0]->nombres_usuario.' '.@$usuario[0]->apellido1_usuario, ENT_COMPAT, 'UTF-8'); ?></title>
		<?= link_tag('resources/plugins/bootstrap/css/bootstrap.min.css'); ?>
		<?= link_tag('resources/plugins/font-awesome/css/font-awesome.min.css'); ?>
		<?= link_tag('resources/css/estilo.css'); ?>
		<?= link_tag('resources/img/syscap.ico', 'shortcut icon', 'image/ico'); ?>
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script type="text/javascript" src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script type="text/javascript" src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body onload="window.print(); window.close();">
	<!--<body>-->
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<?= encabezado_reporte(); ?>
					<?= heading('Reporte de Usuarios', 1, 'class="text-center"'); ?>
					<?= form_fieldset(heading('Información General', 3)); ?>
						<table align="center" border="0" width="100%">
							<tr>
								<th class="column-title">Nombres:</th><td class="column-value"><?= htmlentities(@$usuario[0]->nombres_usuario, ENT_COMPAT, 'UTF-8'); ?></td>
								<td class="column-nbs"><?= nbs(); ?></td>
								<th class="column-title">Apellidos:</th><td class="column-value"><?= htmlentities(@$usuario[0]->apellido1_usuario, ENT_COMPAT, 'UTF-8'); ?></td>
							</tr>
							<tr><td colspan="5"><?= nbs(); ?></td></tr>
							<tr>
								<th class="column-title">DUI:</th><td class="column-value"><?= @$usuario[0]->dui_usuario; ?></td>
								<td class="column-nbs"><?= nbs(); ?></td>
								<th class="column-title">Correo Electrónico:</th><td class="column-value"><?= @$usuario[0]->correo_electronico_usuario; ?></td>
							</tr>
							<tr><td colspan="5"><?= nbs(); ?></td></tr>
							<tr>
								<th class="column-title">Profesión:</th><td class="column-value"><?= htmlentities(@$nombre_profesion, ENT_COMPAT, 'UTF-8'); ?></td>
								<td class="column-nbs"><?= nbs(); ?></td>
								<th class="column-title">Centro Educativo:</th><td class="column-value"><?= htmlentities(@$nombre_centro_educativo, ENT_COMPAT, 'UTF-8'); ?></td>
							</tr>
							<tr><td colspan="5"><?= nbs(); ?></td></tr>
							<tr>
								<th class="column-title">Dirección:</th><td colspan="4" class="column-value"><?= htmlentities(@$usuario[0]->direccion_usuario, ENT_COMPAT, 'UTF-8'); ?></td>
							</tr>
						</table>
					<?= form_fieldset_close(); ?>
				</div>
			</div>
			<div class="row"><div class="col-lg-12"><?= nbs(); ?></div></div>
			<div class="row">
				<div class="col-lg-12">
					<?= form_fieldset(heading('Información de Usuario', 3)); ?>
						<table align="center" border="0" width="100%">
							<tr>
								<th class="column-title">Nombre de Usuario:</th><td class="column-value"><?= @$usuario[0]->nombre_usuario; ?></td>
								<td class="column-nbs"><?= nbs(); ?></td>
								<th class="column-title">Tipo de Usuario:</th><td class="column-value"><?= htmlentities(@$nombre_tipo_usuario, ENT_COMPAT, 'UTF-8'); ?></td>
							</tr>
						</table>
					<?= form_fieldset_close(); ?>
				</div>
			</div>
			<div class="row"><div class="col-lg-12"><?= nbs(); ?></div></div>
			<div class="row">
				<div class="col-lg-12">
					<?= form_fieldset(heading('Información de Cursos', 3)); ?>
						<table align="center" border="0">
							<tr>
								<th class="column-modality">Modalidad de Capacitación:</th><td class="column-value"><?= htmlentities(@$usuario[0]->modalidad_usuario, ENT_COMPAT, 'UTF-8'); ?></td>
							</tr>
						</table>
						<table align="center" border="0" width="100%">
							<tr>
								<td align="center" valign="top">
									<?= heading('Certificaciones Obtenidas', 4); ?>
									<table align="center" border="1" class="cursos">
										<thead>
											<tr>
												<th>#</th>
												<th>Nombre de la Certificación</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$certificaciones = 1;
											foreach($lista_certificaciones_usuario as $certificacion){
											?>
											<tr>
												<td><?= $certificaciones; ?></td>
												<td><?= htmlentities($certificacion->nombre, ENT_COMPAT, 'UTF-8'); ?></td>
											</tr>
											<?php
												$certificaciones++;
											}
											?>
										</tbody>
									</table>
								</td>
								<td class="column-nbs"><?= nbs(); ?></td>
								<td align="center" valign="top">
									<?= heading('Cursos Recibidos y Calificaciones Obtenidas', 4); ?>
									<table align="center" border="1" class="cursos">
										<thead>
											<tr>
												<th>#</th>
												<th>Nombre del Curso</th>
												<th>Calificación</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$cursos = 1;
											foreach($lista_calificaciones_usuario as $curso){
											?>
											<tr>
												<td><?= $cursos; ?></td>
												<td><?= htmlentities($curso->nombre, ENT_COMPAT, 'UTF-8'); ?></td>
												<td><?= $curso->nota; ?></td>
											</tr>
											<?php
												$cursos++;
											}
											?>
										</tbody>
									</table>
								</td>
							</tr>
						</table>
					<?= form_fieldset_close(); ?>
				</div>
			</div>
		</div>
	</body>
</html>