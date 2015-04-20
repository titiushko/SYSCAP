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
		<title><?= utf8(@$tipo_capacitado).' '.utf8(@$nombre_centro_educativo); ?></title>
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
					<?= form_fieldset(heading('Estad&iacute;stica de Usuarios por Tipo de Capacitados y Centro Educativo', 2, 'class="text-center"')); ?>
						<table align="center" border="0" width="100%">
							<tr>
								<th class="column-title">Tipo de Capacitado:</th><td class="column-value"><?= utf8(@$tipo_capacitado); ?></td>
								<th class="column-title">Centro Educativo:</th><td class="column-value"><?= @$nombre_centro_educativo; ?></td>
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
									<th>Modalidad de Capacitaci&oacute;n</th>
									<th>Cantidades</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach($tipos_capacitados_centro_educativo as $tipo_capacitado_centro_educativo){
									if($tipo_capacitado_centro_educativo->modalidad_usuario != 'Total'){
								?>
								<tr>
									<td><?= utf8($tipo_capacitado_centro_educativo->modalidad_usuario); ?></td>
									<td><?= number_format(limpiar_nulo($tipo_capacitado_centro_educativo->total), 0, '', ','); ?></td>
								</tr>
								<?php } else{ ?>
								<tr>
									<td><?= bold(utf8($tipo_capacitado_centro_educativo->modalidad_usuario)); ?></td>
									<td><?= bold(number_format(limpiar_nulo($tipo_capacitado_centro_educativo->total), 0, '', ',')); ?></td>
								</tr>
								<?php
									}
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-lg-6 text-center">
					<?php if(!estadistica_vacia($tipos_capacitados_centro_educativo)){ ?>
					<div id="morris-bar-chart-estadistica9-1"></div>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php if(!estadistica_vacia($tipos_capacitados_centro_educativo)){ ?>
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/jquery/jquery.min.js"></script>
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/raphael.min.js"></script>
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/morris.min.js"></script>
		<script type="text/javascript">
			$(function(){
				Morris.Bar({
					element: 'morris-bar-chart-estadistica9-1',
					data: [<?= $tipos_capacitados_centro_educativo_json; ?>],
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