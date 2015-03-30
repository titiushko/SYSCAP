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
		<title>Resumen Estad&iacute;stico</title>
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
					<?= form_fieldset(heading('Resumen Estad&iacute;stico', 2, 'class="text-center"')); ?>
						<table align="center" border="0" width="100%">
							<tr>
								<th class="column-title">Departamento:</th><td class="column-value"><?= utf8(@$nombre_departamento); ?></td>
								<th class="column-title">Municipio:</th><td class="column-value"><?= utf8(@$nombre_municipio); ?></td>
								<th class="column-title">Centro Educativo:</th><td class="column-value"><?= utf8(@$nombre_centro_educativo); ?></td>
							</tr>
							<tr>
								<th class="column-title">Tipo de Capacitado:</th><td class="column-value"><?= utf8(@$tipo_capacitado); ?></td>
								<th class="column-title">Modalidad de Capacitaci&oacute;n:</th><td class="column-value"><?= utf8(@$modalidad_capacitacion); ?></td>
								<th class="column-title">Grado Digital:</th><td class="column-value"><?= utf8(@$grado_digital); ?></td>
							</tr>
							<tr>
								<th class="column-title">Periodo:</th><td class="column-value"><?= @$periodo; ?></td>
								<td class="column-nbs"><?= nbs(); ?></td>
								<td class="column-nbs"><?= nbs(); ?></td>
								<th class="column-title">Sexo de Usuario:</th><td class="column-value"><?= @$sexo_usuario; ?></td>
							</tr>
						</table>
					<?= form_fieldset_close(); ?>
				</div>
			</div>
			<div class="row"><div class="col-lg-12"><?= br(); ?></div></div>
			<div class="row"><div class="col-lg-12"><?= form_fieldset(heading('Resultado por '.$lista_busqueda[@$busqueda], 3)); ?></div></div>
			<div class="row"><div class="col-lg-12"><?= br(); ?></div></div>
			<?php if(@$busqueda != 'tipo_capacitado'){ ?>
			<div class="row">
				<div class="col-lg-12">
					<?= form_fieldset(heading('Tipos de Capacitados por '.$lista_busqueda[@$busqueda], 4)); ?>
					<div class="row">
						<div class="col-lg-6">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th colspan="2"></th>
											<th colspan="2">Tipo de Capacitado</th>
											<th></th>
										</tr>
										<tr>
											<th>#</th>
											<th><?= $lista_busqueda[@$busqueda]; ?></th>
											<th>Capacitados</th>
											<th>Certificados</th>
											<th>Total</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$indice = 1;
										foreach($tipo_capacitado_x_busqueda as $resultado){
											if($resultado->nombre_campo != 'Total'){
										?>
										<tr>
											<td><?= $indice++; ?></td>
											<td><?= utf8($resultado->nombre_campo); ?></td>
											<td><?= number_format($resultado->capacitados, 0, '', ','); ?></td>
											<td><?= number_format($resultado->certificados, 0, '', ','); ?></td>
											<td><?= number_format($resultado->total, 0, '', ','); ?></td>
										</tr>
										<?php } else{ ?>
										<tfoot>
											<tr>
												<td></td>
												<td><?= bold(utf8($resultado->nombre_campo)); ?></td>
												<td><?= bold(number_format($resultado->capacitados, 0, '', ',')); ?></td>
												<td><?= bold(number_format($resultado->certificados, 0, '', ',')); ?></td>
												<td><?= bold(number_format($resultado->total, 0, '', ',')); ?></td>
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
							<?php if(!estadistica_vacia($tipo_capacitado_x_busqueda)){ ?>
							<div id="morris-bar-chart-estadistica1-1"></div>
							<?php } ?>
						</div>
					</div>
					<?= form_fieldset_close(); ?>
				</div>
			</div>
			<div class="row"><div class="col-lg-12"><?= form_fieldset_close(); ?></div></div>
			<?php } if(@$busqueda != 'modalidad_capacitacion'){ ?>
			<div class="row">
				<div class="col-lg-12">
					<?= form_fieldset(heading('Modalidad de Capacitaci&oacute;n por '.$lista_busqueda[@$busqueda], 4)); ?>
					<div class="row">
						<div class="col-lg-6">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th colspan="2"></th>
											<th colspan="2">Modalidad de Capacitaci&oacute;n</th>
											<th></th>
										</tr>
										<tr>
											<th>#</th>
											<th><?= $lista_busqueda[@$busqueda]; ?></th>
											<th>Tutorizados</th>
											<th>Autoformaci&oacute;n</th>
											<th>Total</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$indice = 1;
										foreach($modalidad_capacitacion_x_busqueda as $resultado){
											if($resultado->nombre_campo != 'Total'){
										?>
										<tr>
											<td><?= $indice++; ?></td>
											<td><?= utf8($resultado->nombre_campo); ?></td>
											<td><?= number_format($resultado->tutorizados, 0, '', ','); ?></td>
											<td><?= number_format($resultado->autoformacion, 0, '', ','); ?></td>
											<td><?= number_format($resultado->total, 0, '', ','); ?></td>
										</tr>
										<?php } else{ ?>
										<tfoot>
											<tr>
												<td></td>
												<td><?= bold(utf8($resultado->nombre_campo)); ?></td>
												<td><?= bold(number_format($resultado->tutorizados, 0, '', ',')); ?></td>
												<td><?= bold(number_format($resultado->autoformacion, 0, '', ',')); ?></td>
												<td><?= bold(number_format($resultado->total, 0, '', ',')); ?></td>
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
							<?php if(!estadistica_vacia($modalidad_capacitacion_x_busqueda)){ ?>
							<div id="morris-bar-chart-estadistica2-1"></div>
							<?php } ?>
						</div>
					</div>
					<?= form_fieldset_close(); ?>
				</div>
			</div>
			<div class="row"><div class="col-lg-12"><?= form_fieldset_close(); ?></div></div>
			<?php } if(@$busqueda != 'grado_digital'){ ?>
			<div class="row">
				<div class="col-lg-12">
					<?= form_fieldset(heading('Modalidad de Capacitaci&oacute;n por '.$lista_busqueda[@$busqueda], 4)); ?>
					<div class="row">
						<div class="col-lg-6">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th colspan="2"></th>
											<th colspan="4">Grado Digital</th>
											<th></th>
										</tr>
										<tr>
											<th>#</th>
											<th><?= $lista_busqueda[@$busqueda]; ?></th>
											<th>1</th>
											<th>2</th>
											<th>3</th>
											<th>4</th>
											<th>Total</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$indice = 1;
										foreach($grado_digital_x_busqueda as $resultado){
											if($resultado->nombre_campo != 'Total'){
										?>
										<tr>
											<td><?= $indice++; ?></td>
											<td><?= utf8($resultado->nombre_campo); ?></td>
											<td><?= number_format($resultado->uno, 0, '', ','); ?></td>
											<td><?= number_format($resultado->dos, 0, '', ','); ?></td>
											<td><?= number_format($resultado->tres, 0, '', ','); ?></td>
											<td><?= number_format($resultado->cuatro, 0, '', ','); ?></td>
											<td><?= number_format($resultado->total, 0, '', ','); ?></td>
										</tr>
										<?php } else{ ?>
										<tfoot>
											<tr>
												<td></td>
												<td><?= bold(utf8($resultado->nombre_campo)); ?></td>
												<td><?= bold(number_format($resultado->uno, 0, '', ',')); ?></td>
												<td><?= bold(number_format($resultado->dos, 0, '', ',')); ?></td>
												<td><?= bold(number_format($resultado->tres, 0, '', ',')); ?></td>
												<td><?= bold(number_format($resultado->cuatro, 0, '', ',')); ?></td>
												<td><?= bold(number_format($resultado->total, 0, '', ',')); ?></td>
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
							<?php if(!estadistica_vacia($grado_digital_x_busqueda)){ ?>
							<div id="morris-bar-chart-estadistica3-1"></div>
							<?php } ?>
						</div>
					</div>
					<?= form_fieldset_close(); ?>
				</div>
			</div>
			<div class="row"><div class="col-lg-12"><?= form_fieldset_close(); ?></div></div>
			<?php } if(@$busqueda != 'sexo_usuario'){ ?>
			<div class="row">
				<div class="col-lg-12">
					<?= form_fieldset(heading('Modalidad de Capacitaci&oacute;n por '.$lista_busqueda[@$busqueda], 4)); ?>
					<div class="row">
						<div class="col-lg-6">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th colspan="2"></th>
											<th colspan="2">Sexo Usuario</th>
											<th></th>
										</tr>
										<tr>
											<th>#</th>
											<th><?= $lista_busqueda[@$busqueda]; ?></th>
											<th>Hombres</th>
											<th>Mujeres</th>
											<th>Total</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$indice = 1;
										foreach($sexo_usuario_x_busqueda as $resultado){
											if($resultado->nombre_campo != 'Total'){
										?>
										<tr>
											<td><?= $indice++; ?></td>
											<td><?= utf8($resultado->nombre_campo); ?></td>
											<td><?= number_format($resultado->hombres, 0, '', ','); ?></td>
											<td><?= number_format($resultado->mujeres, 0, '', ','); ?></td>
											<td><?= number_format($resultado->total, 0, '', ','); ?></td>
										</tr>
										<?php } else{ ?>
										<tfoot>
											<tr>
												<td></td>
												<td><?= bold(utf8($resultado->nombre_campo)); ?></td>
												<td><?= bold(number_format($resultado->hombres, 0, '', ',')); ?></td>
												<td><?= bold(number_format($resultado->mujeres, 0, '', ',')); ?></td>
												<td><?= bold(number_format($resultado->total, 0, '', ',')); ?></td>
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
							<?php if(!estadistica_vacia($sexo_usuario_x_busqueda)){ ?>
							<div id="morris-bar-chart-estadistica4-1"></div>
							<?php } ?>
						</div>
					</div>
					<?= form_fieldset_close(); ?>
				</div>
			</div>
			<div class="row"><div class="col-lg-12"><?= form_fieldset_close(); ?></div></div>
			<?php } ?>
		</div>
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/jquery/jquery.min.js"></script>
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/raphael.min.js"></script>
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/morris.min.js"></script>
		<script type="text/javascript">
			$(function(){
				<?php if(!estadistica_vacia($tipo_capacitado_x_busqueda) && @$busqueda != 'tipo_capacitado'){ ?>
				Morris.Bar({
					element: 'morris-bar-chart-estadistica1-1',
					data: [<?= $tipo_capacitado_x_busqueda_json; ?>],
					xkey: 'y',
					ykeys: ['a', 'b'],
					labels: ['Capacitados', 'Certificados'],
					hideHover: 'auto',
					resize: true
				});
				<?php } if(!estadistica_vacia($modalidad_capacitacion_x_busqueda) && @$busqueda != 'modalidad_capacitacion'){ ?>
				Morris.Bar({
					element: 'morris-bar-chart-estadistica2-1',
					data: [<?= $modalidad_capacitacion_x_busqueda_json; ?>],
					xkey: 'y',
					ykeys: ['a', 'b'],
					labels: ['Tutorizados', 'Autoformaci&oacute;n'],
					hideHover: 'auto',
					resize: true
				});
				<?php } if(!estadistica_vacia($grado_digital_x_busqueda) && @$busqueda != 'grado_digital'){ ?>
				Morris.Bar({
					element: 'morris-bar-chart-estadistica3-1',
					data: [<?= $grado_digital_x_busqueda_json; ?>],
					xkey: 'y',
					ykeys: ['a', 'b', 'c', 'd'],
					labels: ['Grado Digital 1', 'Grado Digital 2', 'Grado Digital 3', 'Grado Digital 4'],
					hideHover: 'auto',
					resize: true
				});
				<?php } if(!estadistica_vacia($sexo_usuario_x_busqueda) && @$busqueda != 'sexo_usuario'){ ?>
				Morris.Bar({
					element: 'morris-bar-chart-estadistica4-1',
					data: [<?= $sexo_usuario_x_busqueda_json; ?>],
					xkey: 'y',
					ykeys: ['a', 'b'],
					labels: ['Hombres', 'Mujeres'],
					hideHover: 'auto',
					resize: true
				});
				<?php } ?>
			});
		</script>
	</body>
</html>