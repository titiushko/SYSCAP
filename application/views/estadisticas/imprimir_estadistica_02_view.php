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
		<title><?= utf8(@$nombre_departamento).' '.@$periodo; ?></title>
		<?= link_tag('resources/plugins/bootstrap/css/bootstrap.min.css'); ?>
		<?= link_tag('resources/plugins/morris/css/morris.css'); ?>
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
					<?= heading('Reporte de Consulta Estad&iacute;stica', 1, 'class="text-center"'); ?>
					<?= form_fieldset(heading('Estad&iacute;stica de Usuarios por Departamento y Rango de Fechas', 3, 'class="text-center"')); ?>
						<table align="center" border="0" width="100%">
							<tr>
								<th class="column-title">Departamento:</th><td class="column-value"><?= utf8(@$nombre_departamento); ?></td>
								<td class="column-nbs"><?= nbs(); ?></td>
								<th class="column-title">Periodo:</th><td class="column-value"><?= @$periodo; ?></td>
							</tr>
						</table>
					<?= form_fieldset_close(); ?>
				</div>
			</div>
			<div class="row"><div class="col-lg-12"><?= nbs(); ?></div></div>
			<div class="row">
				<div class="col-lg-6">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Municipio</th>
								<th>Capacitados</th>
								<th>Certificados</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$cantidades = 1;
							foreach($cantidad_usuarios_municipio as $cantidad_municipio){
								if($cantidad_municipio->nombre_municipio != 'TOTAL'){
							?>
							<tr>
								<td><?= $cantidades; ?></td>
								<td><?= utf8($cantidad_municipio->nombre_municipio); ?></td>
								<td><?= $cantidad_municipio->capacitados; ?></td>
								<td><?= $cantidad_municipio->certificados; ?></td>
							</tr>
							<?php
								}
								else{
							?>
							<tr>
								<td style="opacity: 0.0;"><?= $cantidades; ?></td>
								<td><?= bold(utf8($cantidad_municipio->nombre_municipio)); ?></td>
								<td><?= bold($cantidad_municipio->capacitados); ?></td>
								<td><?= bold($cantidad_municipio->certificados); ?></td>
							</tr>
							<?php
								}
							$cantidades++;
							}
							?>
						</tbody>
					</table>
				</div>
				<div class="col-lg-6 text-center">
					<div id="morris-bar-chart-estadistica2-1"></div>
				</div>
			</div>
			<div class="row"><div class="col-lg-12"><?= nbs(); ?></div></div>
			<div class="row">
				<div class="col-lg-12">
					<?= form_fieldset(heading('Listado de Usuarios por Municipio', 4)); ?>
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th>Municipio</th>
									<th>Capacitados</th>
									<th>Certificados</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$usuarios = 1;
								foreach($usuarios_municipio as $usuario_municipio){
								?>
								<tr>
									<td><?= $usuarios; ?></td>
									<td><?= utf8($usuario_municipio->nombre_municipio); ?></td>
									<td><?= utf8($usuario_municipio->nombre_usuario); ?></td>
									<td><?= utf8($usuario_municipio->modalidad_usuario); ?></td>
								</tr>
								<?php
								$usuarios++;
								}
								?>
							</tbody>
						</table>
					<?= form_fieldset_close(); ?>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/jquery/jquery.min.js"></script>
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/raphael.min.js"></script>
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/morris.min.js"></script>
		<script type="text/javascript">
			$(function() {
				Morris.Bar({
					element: 'morris-bar-chart-estadistica2-1',
					data: [<?= $cantidad_usuarios_municipio_json; ?>],
					xkey: 'y',
					ykeys: ['a', 'b'],
					labels: ['Capacitados', 'Certificados'],
					hideHover: 'always',
					resize: true
				});
			});
		</script>
	</body>
</html>