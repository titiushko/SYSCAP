<?= doctype('html5'); ?>
<html lang="en">
	<head>
		<?php
		$metainformaciones = array(
			array('name'	=>	'robots', 'content'				=>	'no-cache'),
			array('name'	=>	'description', 'content'		=>	'Sistema Inform�tico para apoyar el Control y Administraci�n de Capacitaciones - SYSCAP'),
			array('name'	=>	'keywords', 'content'			=>	'mined, grado digital, capacitaciones, syscap'),
			array('name'	=>	'X-UA-Compatible', 'content'	=>	'IE=edge', 'type' => 'equiv'),
			array('name'	=>	'viewport', 'content'			=>	'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'),
			array('name'	=>	'Content-type', 'content'		=>	'text/html; charset=utf-8', 'type' => 'equiv'),
			//array('name'	=>	'Content-type', 'content'		=>	'text/html; charset=ISO-8859-1', 'type' => 'equiv')
		);
		echo meta($metainformaciones);
		?>
		<title><?= @$tipo_capacitado.' '.utf8(@$nombre_departamento).' '.utf8(@$nombre_municipio).' '.@$periodo; ?></title>
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
	<body onload="window.print();">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<?= encabezado_reporte(); ?>
					<?= heading('Reporte de Consulta Estad&iacute;stica', 1, 'class="text-center"'); ?>
					<?= form_fieldset(heading('Estad&iacute;stica de Usuarios por Tipo de Capacitados, Departamento y Municipio', 2, 'class="text-center"')); ?>
						<table align="center" border="0" width="100%">
							<tr>
								<th class="column-title">Departamento:</th><td class="column-value"><?= utf8(@$nombre_departamento); ?></td>
								<td class="column-nbs"><?= nbs(); ?></td>
								<th class="column-title">Municipio:</th><td class="column-value"><?= utf8(@$nombre_municipio); ?></td>
							</tr>
							<tr>
								<th class="column-title">Tipo de Capacitado:</th><td class="column-value"><?= @$tipo_capacitado; ?></td>
								<td class="column-nbs"><?= nbs(); ?></td>
								<th class="column-title">Periodo:</th><td class="column-value" colspan="2"><?= @$periodo; ?></td>
							</tr>
						</table>
					<?= form_fieldset_close(); ?>
				</div>
			</div>
			<div class="row"><div class="col-lg-12"><?= br(); ?></div></div>
			<div class="row">
				<div class="col-lg-6">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th>Centro Educativo</th>
									<th>Capacitados</th>
									<th>Certificados</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$indice = 1;
								foreach($usuarios_departamento_municipio as $usuario_departamento_municipio){
									if($usuario_departamento_municipio->nombre_centro_educativo != 'Total'){
								?>
								<tr>
									<td><?= $indice++; ?></td>
									<td><?= utf8($usuario_departamento_municipio->nombre_centro_educativo); ?></td>
									<td><?= number_format($usuario_departamento_municipio->capacitados, 0, '', ','); ?></td>
									<td><?= number_format($usuario_departamento_municipio->certificados, 0, '', ','); ?></td>
								</tr>
								<?php } else{ ?>
								<tfoot>
									<tr>
										<td></td>
										<td><?= bold(utf8($usuario_departamento_municipio->nombre_centro_educativo)); ?></td>
										<td><?= bold(number_format($usuario_departamento_municipio->capacitados, 0, '', ',')); ?></td>
										<td><?= bold(number_format($usuario_departamento_municipio->certificados, 0, '', ',')); ?></td>
									</tr>
								</tfoot>
								<?php
									}
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-lg-6 text-center">
					<?php if(count($usuarios_departamento_municipio) > 1){ ?>
					<div id="morris-bar-chart-estadistica7-1"></div>
					<?php } ?>
				</div>
			</div>
			<div class="row"><div class="col-lg-12"><?= br(4); ?></div></div>
			<div class="row">
				<div class="col-lg-12">
					<?= form_fieldset(heading('Listado de Usuarios por Centro Educativo', 3)); ?>
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th>Centro Educativo</th>
									<th>Nombre</th>
									<th>Tipo de Capacitado</th>
									<th>Modalidad de Capacitaci&oacute;n</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$usuarios = 1;
								foreach($usuarios_centro_educativo as $usuario_centro_educativo){
								?>
								<tr>
									<td><?= $usuarios++; ?></td>
									<td><?= utf8($usuario_centro_educativo->nombre_centro_educativo); ?></td>
									<td><?= utf8($usuario_centro_educativo->nombre_usuario); ?></td>
									<td><?= utf8($usuario_centro_educativo->tipo_capacitado); ?></td>
									<td><?= utf8($usuario_centro_educativo->modalidad_usuario); ?></td>
								</tr>
								<?php
								}
								?>
							</tbody>
						</table>
					</div>
					<?= form_fieldset_close(); ?>
				</div>
			</div>
		</div>
		<?php if(count($usuarios_departamento_municipio) > 1){ ?>
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/jquery/jquery.min.js"></script>
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/raphael.min.js"></script>
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/morris.min.js"></script>
		<script type="text/javascript">
			$(function(){
				Morris.Bar({
					element: 'morris-bar-chart-estadistica7-1',
					data: [<?= $usuarios_departamento_municipio_json; ?>],
					xkey: 'y',
					ykeys: ['a', 'b'],
					labels: ['Capacitados', 'Certificados'],
					hideHover: 'always',
					resize: true
				});
			});
		</script>
		<?php } ?>
	</body>
</html>