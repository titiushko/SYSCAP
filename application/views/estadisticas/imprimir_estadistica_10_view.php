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
		<title><?= @$tipo_capacitado.' '.@$periodo; ?></title>
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
					<?= form_fieldset(heading('Estad&iacute;stica de indice a Nivel Nacional', 2, 'class="text-center"')); ?>
						<table align="center" border="0" width="100%">
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
									<th>Departamento</th>
									<th>Municipio</th>
									<th>Tutorizados</th>
									<th>Autoformaci&oacute;n</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$indice = 1;
								foreach($usuarios_nivel_nacional as $usuario_nivel_nacional){
									if($usuario_nivel_nacional->nombre_municipio != 'Total'){
								?>
								<tr>
									<td><?= $indice++; ?></td>
									<td><?= utf8($usuario_nivel_nacional->nombre_departamento); ?></td>
									<td><?= utf8($usuario_nivel_nacional->nombre_municipio); ?></td>
									<td><?= number_format($usuario_nivel_nacional->tutorizado, 0, '', ','); ?></td>
									<td><?= number_format($usuario_nivel_nacional->autoformacion, 0, '', ','); ?></td>
								</tr>
								<?php } else{ ?>
								<tfoot>
									<tr>
										<td></td>
										<td><?= bold(utf8($usuario_nivel_nacional->nombre_departamento)); ?></td>
										<td><?= bold(utf8($usuario_nivel_nacional->nombre_municipio)); ?></td>
										<td><?= bold(number_format($usuario_nivel_nacional->tutorizado, 0, '', ',')); ?></td>
										<td><?= bold(number_format($usuario_nivel_nacional->autoformacion, 0, '', ',')); ?></td>
									</tr>
								</tfoot>
								<?php
									}
								}
								?>
							</tbody>
						</table>
					</div>
					<?= (!empty($sin_departamento) && !empty($sin_municipio)) ? $sin_departamento.br().$sin_municipio : (!empty($sin_departamento) ? $sin_departamento : (!empty($sin_municipio) ? $sin_municipio : '')); ?>
				</div>
				<div class="col-lg-6 text-center">
					<?php if(count($usuarios_nivel_nacional) > 1){ ?>
					<div id="morris-bar-chart-estadistica10-1"></div>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php if(count($usuarios_nivel_nacional) > 1){ ?>
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/jquery/jquery.min.js"></script>
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/raphael.min.js"></script>
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/morris.min.js"></script>
		<script type="text/javascript">
			$(function(){
				Morris.Bar({
					element: 'morris-bar-chart-estadistica10-1',
					data: [<?= $usuarios_nivel_nacional_json; ?>],
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