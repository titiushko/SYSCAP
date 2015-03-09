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
		<title><?= @$periodo; ?></title>
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
					<?= form_fieldset(heading('Estad&iacute;stica de Usuarios por Modalidad de Capacitaci&oacute;n', 3, 'class="text-center"')); ?>
						<table align="center" border="0" width="100%">
							<tr>
								<td><?= nbs(); ?></td>
								<th class="column-title">Periodo:</th>
								<td class="column-value"><?= @$periodo; ?></td>
								<td><?= nbs(); ?></td>
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
							$cantidades = 1;
							foreach($modalidades_capacitados as $modalidad_capacitado){
								if($modalidad_capacitado->tipos_capacitados != 'TOTAL'){
							?>
							<tr>
								<th><?= utf8($modalidad_capacitado->tipos_capacitados); ?></th>
								<td><?= limpiar_nulo($modalidad_capacitado->tutorizados); ?></td>
								<td><?= limpiar_nulo($modalidad_capacitado->autoformacion); ?></td>
							</tr>
							<?php
								}
								else{
							?>
							<tr>
								<th><?= bold(utf8($modalidad_capacitado->tipos_capacitados)); ?></th>
								<td><?= bold(limpiar_nulo($modalidad_capacitado->tutorizados)); ?></td>
								<td><?= bold(limpiar_nulo($modalidad_capacitado->autoformacion)); ?></td>
							</tr>
							<?php
								}
							}
							?>
						</tbody>
					</table>
				</div>
				<div class="col-lg-6 text-center">
					<?php if(!estadistica_vacia($modalidades_capacitados)){ ?>
					<div id="morris-bar-chart-estadistica1-1"></div>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php if(!estadistica_vacia($modalidades_capacitados)){ ?>
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/jquery/jquery.min.js"></script>
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/raphael.min.js"></script>
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/morris.min.js"></script>
		<script type="text/javascript">
			$(function(){
				Morris.Bar({
					element: 'morris-bar-chart-estadistica1-1',
					data: [<?= $modalidades_capacitados_json; ?>],
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