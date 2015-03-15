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
		<title><?= @$grado_digital.' '.@$periodo; ?></title>
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
					<?= form_fieldset(heading('Estad&iacute;stica de Usuarios a Nivel Nacional', 3, 'class="text-center"')); ?>
						<table align="center" border="0" width="100%">
							<tr>
								<th class="column-title">Grado Digital:</th><td class="column-value"><?= @$grado_digital; ?></td>
								<td class="column-nbs"><?= nbs(); ?></td>
								<th class="column-title">Periodo:</th><td class="column-value" colspan="2"><?= @$periodo; ?></td>
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
								<th></th>
								<th colspan="2">Modalidad de Capacitaci&oacute;n</th>
							</tr>
							<tr>
								<th rowspan="2">Tipo de Capacitado</th>
								<th>Tutorizados</th>
								<th>Autoformaci&oacute;n</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach($usuarios_grado_digital as $usuario_grado_digital){
								if($usuario_grado_digital->tipos_capacitados != 'Total'){
							?>
							<tr>
								<th><?= utf8($usuario_grado_digital->tipos_capacitados); ?></th>
								<td><?= limpiar_nulo($usuario_grado_digital->tutorizados); ?></td>
								<td><?= limpiar_nulo($usuario_grado_digital->autoformacion); ?></td>
							</tr>
							<?php } else{ ?>
							<tr>
								<th><?= bold(utf8($usuario_grado_digital->tipos_capacitados)); ?></th>
								<td><?= bold(limpiar_nulo($usuario_grado_digital->tutorizados)); ?></td>
								<td><?= bold(limpiar_nulo($usuario_grado_digital->autoformacion)); ?></td>
							</tr>
							<?php
								}
							}
							?>
						</tbody>
					</table>
				</div>
				<div class="col-lg-6 text-center">
					<?php if(!estadistica_vacia($usuarios_grado_digital)){ ?>
					<div id="morris-bar-chart-estadistica11-1"></div>
					<?php } ?>
				</div>
			</div>
		</div>
			<div class="row"><div class="col-lg-12"><?= nbs(); ?></div></div>
			<div class="row">
				<div class="col-lg-12">
					<?= form_fieldset(heading('Listado de Certificaciones por Grado Digital', 4)); ?>
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th>Categor&iacute;a</th>
									<th>Curso</th>
									<th>Tutorizados</th>
									<th>Autoformaci&oacute;n</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$usuarios = 1;
								foreach($certificaciones_grado_digital as $certificacion_grado_digital){
									if($certificacion_grado_digital->nombre_curso_categoria != 'Total'){
								?>
								<tr>
									<td><?= $usuarios; ?></td>
									<td><?= utf8($certificacion_grado_digital->nombre_curso_categoria); ?></td>
									<td><?= utf8($certificacion_grado_digital->nombre_completo_curso); ?></td>
									<td><?= limpiar_nulo($certificacion_grado_digital->tutorizados); ?></td>
									<td><?= limpiar_nulo($certificacion_grado_digital->autoformacion); ?></td>
								</tr>
								<?php } else{ ?>
								<tr>
									<td style="opacity: 0.0;"><?= $usuarios; ?></td>
									<td><?= bold(utf8($certificacion_grado_digital->nombre_curso_categoria)); ?></td>
									<td><?= bold(utf8($certificacion_grado_digital->nombre_completo_curso)); ?></td>
									<td><?= bold(limpiar_nulo($certificacion_grado_digital->tutorizados)); ?></td>
									<td><?= bold(limpiar_nulo($certificacion_grado_digital->autoformacion)); ?></td>
								</tr>
								<?php
									}
									$usuarios++;
								}
								?>
							</tbody>
						</table>
					<?= form_fieldset_close(); ?>
				</div>
			</div>
		</div>
		<?php if(!estadistica_vacia($usuarios_grado_digital)){ ?>
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/jquery/jquery.min.js"></script>
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/raphael.min.js"></script>
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/morris.min.js"></script>
		<script type="text/javascript">
			$(function(){
				Morris.Bar({
					element: 'morris-bar-chart-estadistica11-1',
					data: [<?= $usuarios_grado_digital_json; ?>],
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