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
		<title><?= utf8(@$centro_educativo[0]->nombre_centro_educativo); ?></title>
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
	<body onload="window.print();">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<?= encabezado_reporte(); ?>
					<?= heading('Reporte de Centro Educativo', 1, 'class="text-center"'); ?>
					<?= form_fieldset(heading('Informaci&oacute;n General', 3)); ?>
						<table align="center" border="0" width="100%">
							<tr>
								<th class="column-title">Nombres:</th><td class="column-value"><?= utf8(@$centro_educativo[0]->nombre_centro_educativo); ?></td>
								<td class="column-nbs"><?= nbs(); ?></td>
								<th class="column-title">C&oacute;digo:</th><td class="column-value"><?= utf8(@$centro_educativo[0]->codigo_centro_educativo); ?></td>
							</tr>
							<tr><td colspan="5"><?= nbs(); ?></td></tr>
							<tr>
								<th class="column-title">Departamento:</th><td class="column-value"><?= utf8(@$nombre_departamento); ?></td>
								<td class="column-nbs"><?= nbs(); ?></td>
								<th class="column-title">Municipio:</th><td class="column-value"><?= utf8(@$nombre_municipio); ?></td>
							</tr>
						</table>
					  <?= form_fieldset_close(); ?>
				</div>
			</div>
			<div class="row"><div class="col-lg-12"><?= nbs(); ?></div></div>
			<div class="row">
				<div class="col-lg-12">
					<?= form_fieldset(heading('Certificaciones', 3)); ?>
						<table align="center" border="0" width="100%">
							<tr>
								<td align="center" valign="top">
									<?= heading('Docentes Capacitados', 4); ?>
									<table align="center" border="1" class="cursos">
										<thead>
											<tr>
												<th>#</th>
												<th>Nombre</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$docentes_capacitados = 1;
											foreach($lista_docentes_capacitados as $docente_capacitado){
											?>
											<tr>
												<td><?= $docentes_capacitados; ?></td>
												<td><?= utf8($docente_capacitado->nombre_completo_usuario); ?></td>
											</tr>
											<?php
												$docentes_capacitados++;
											}
											?>
										</tbody>
									</table>
								</td>
								<td class="column-nbs"><?= nbs(); ?></td>
								<td align="center" valign="top">
									<?= heading('Docentes Certificados', 4); ?>
									<table align="center" border="1" class="cursos">
										<thead>
											<tr>
												<th>#</th>
												<th>Nombre</th>
												<th>Certificaci&oacute;n</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$docentes_certificados = 1;
											foreach($lista_docentes_certificados as $docente_certificado){
											?>
											<tr>
												<td><?= $docentes_certificados; ?></td>
												<td><?= utf8($docente_certificado->nombre_completo_usuario); ?></td>
												<td><?= utf8($docente_certificado->certificacion_usuario); ?></td>
											</tr>
											<?php
												$docentes_certificados++;
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