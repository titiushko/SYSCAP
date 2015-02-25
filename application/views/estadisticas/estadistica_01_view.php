<?php
$formulario_consultar = array(
	'name'		=> 'formulario_consultar',
	'id'		=> 'formulario_consultar',
	'role'		=> 'form'
);
$fecha = array(
	'name'		=> '',
	'id'		=> '',
	'maxlength'	=> '60',
	'size'		=> '20',
	'value'		=> '',
	'type'		=> 'date',
	'required'	=> 'required',
	'class'		=> 'form-control'
);
$boton_primario = array(
	'name'		=> 'boton_primario',
	'id'		=> 'boton_primario',
	'value'		=> 'Consultar',
	'class'		=> 'btn btn-primary'
);
$boton_secundario = array(
	'name'		=> 'boton_secundario',
	'id'		=> 'boton_secundario',
	'value'		=> 'Limpiar',
	'class'		=> 'btn btn-danger',
	'onclick'	=> 'redireccionar(\''.base_url().'estadisticas/consulta/1\');'
);
// Definición de formularios ocultos para enviar información a imprimir y exportar
$formulario_imprimir = array(
	'name'		=> 'formulario_imprimir',
	'id'		=> 'formulario_imprimir',
	'role'		=> 'form',
	'target'	=> '_blank'
);
$formulario_exportar = array(
	'name'		=> 'formulario_exportar',
	'id'		=> 'formulario_exportar',
	'role'		=> 'form',
	'target'	=> '_blank'
);
$campos_ocultos_formulario = array(
	'fecha_1'	=> set_value('fecha_1', @$campos['fecha1']),
	'fecha_2'	=> set_value('fecha_2', @$campos['fecha2'])
);
?>
<?= form_open('index.php/estadisticas/imprimir/1', $formulario_imprimir, $campos_ocultos_formulario); ?>
<?= form_close(); ?>
<?= form_open('index.php/estadisticas/exportar/1', $formulario_exportar, $campos_ocultos_formulario); ?>
<?= form_close(); ?>
<?= form_open('index.php/estadisticas/consulta/1', $formulario_consultar); ?>
	<div class="row">
		<div class="col-lg-3 visible-desktop"><?= nbs(); ?></div>
		<div class="col-lg-6">
			<div class="form-group">
				<?= form_label('Periodo:'); ?>
				<div class="row">
					<div class="col-lg-6">
						<?php $fecha['name'] = $fecha['id'] = 'fecha1'; $fecha['value'] = set_value('fecha1', @$campos['fecha1']); ?>
						<?= form_input($fecha); ?>
						<?= form_error('fecha1'); ?>
					</div>
					<div class="visible-phone visible-tablet"><?= nbs(); ?></div>
					<div class="col-lg-6">
						<?php $fecha['name'] = $fecha['id'] = 'fecha2'; $fecha['value'] = set_value('fecha2', @$campos['fecha2']); ?>
						<?= form_input($fecha); ?>
						<?= form_error('fecha2'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-3 visible-desktop"><?= nbs(); ?></div>
		<div class="col-lg-6">
			<div class="form-group">
				<?= form_submit($boton_primario); ?>
				<?= form_reset($boton_secundario); ?>
			</div>
		</div>
	</div>
<?= form_close(); ?>
<div class="panel panel-default">
	<div class="panel-heading">
		<?= heading('Resultado', 4); ?>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-6">
				<div class="table-responsive">        
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
							foreach($modalidades_capacitados as $modalidad_capacitado){
								if($modalidad_capacitado->tipos_capacitados != 'TOTAL'){
							?>
							<tr>
								<th><?= utf8($modalidad_capacitado->tipos_capacitados); ?></th>
								<td><?= $modalidad_capacitado->tutorizados; ?></td>
								<td><?= $modalidad_capacitado->autoformacion; ?></td>
							</tr>
							<?php
								}
								else{
							?>
							<tr>
								<th><?= bold(utf8($modalidad_capacitado->tipos_capacitados)); ?></th>
								<td><?= bold($modalidad_capacitado->tutorizados); ?></td>
								<td><?= bold($modalidad_capacitado->autoformacion); ?></td>
							</tr>
							<?php
								}
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-lg-6">
				<a data-toggle="modal" href="#myModalChart"><div id="morris-bar-chart-estadistica1-1"></div></a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/raphael.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/morris.min.js"></script>
<script type="text/javascript">
	$(function() {
		Morris.Bar({
			element: 'morris-bar-chart-estadistica1-1',
			data: [<?= $modalidades_capacitados_json; ?>],
			xkey: 'y',
			ykeys: ['a', 'b'],
			labels: ['Tutorizados', 'Autoformaci&oacute;n'],
			hideHover: 'auto',
			resize: true
		});
		Morris.Bar({
			element: 'morris-bar-chart-estadistica1-2',
			data: [<?= $modalidades_capacitados_json; ?>],
			xkey: 'y',
			ykeys: ['a', 'b'],
			labels: ['Tutorizados', 'Autoformaci&oacute;n'],
			hideHover: 'auto',
			resize: true
		});
	});
</script>