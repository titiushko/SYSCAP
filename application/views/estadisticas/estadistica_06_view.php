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
$lista_tipo_capacitados =  array(
	''			=> '',
	'Evaluaci'	=> 'Capacitados',
	'Examen'	=> 'Certificados'
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
	'onclick'	=> 'redireccionar(\''.base_url().'estadisticas/consulta/6\');'
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
	'tipo_de_capacitado'	=> set_value('tipo_de_capacitado', @$campos['tipo_capacitado']),
	'codigo_departamento'	=> set_value('codigo_departamento', @$campos['id_departamento']),
	'fecha_1'				=> set_value('fecha_1', @$campos['fecha1']),
	'fecha_2'				=> set_value('fecha_2', @$campos['fecha2'])
);
?>
<?= form_open('index.php/estadisticas/imprimir/6', $formulario_imprimir, $campos_ocultos_formulario); ?>
<?= form_close(); ?>
<?= form_open('index.php/estadisticas/exportar/6', $formulario_exportar, $campos_ocultos_formulario); ?>
<?= form_close(); ?>
<?= form_open('index.php/estadisticas/consulta/6', $formulario_consultar); ?>
	<div class="row">
        <div class="col-lg-6">
			<div class="form-group">
				<?= form_label('Tipo de Capacitado:'); ?>
				<?= form_dropdown('tipo_capacitado', $lista_tipo_capacitados, set_value('tipo_capacitado', @$campos['tipo_capacitado']), 'class="form-control" required'); ?>
				<?= form_error('tipo_capacitado'); ?>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="form-group">
				<?= form_label('Departamento:'); ?>
				<?= form_dropdown('id_departamento', $lista_departamentos, set_value('id_departamento', @$campos['id_departamento']), 'class="form-control" required'); ?>
				<?= form_error('id_departamento'); ?>
			</div>
		</div>
	</div>
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
		<div class="col-lg-12">
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
				<div class="table-responsive" id="contenedor-table">
					<table class="table table-striped table-bordered table-hover" id="data-tables-estadistica6-1">
						<thead>
							<tr>
								<th>#</th>
								<th>Municipio</th>
								<th>Tutorizados</th>
								<th>Autoformaci&oacute;n</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$estaditicas = 1;
							foreach($estaditicas_departamento_tipo_fechas as $estaditica_departamento_tipo_fecha){
								if($estaditica_departamento_tipo_fecha->nombre_municipio != 'TOTAL'){
							?>
							<tr>
								<td><?= $estaditicas++; ?></td>
								<td><?= utf8($estaditica_departamento_tipo_fecha->nombre_municipio); ?></td>
								<td><?= $estaditica_departamento_tipo_fecha->tutorizado; ?></td>
								<td><?= $estaditica_departamento_tipo_fecha->autoformacion; ?></td>
							</tr>
							<?php
								}
								else{
							?>
							<tr>
								<td style="opacity: 0.0;"><?= $estaditicas++; ?></td>
								<td><?= bold(utf8($estaditica_departamento_tipo_fecha->nombre_municipio)); ?></td>
								<td><?= bold($estaditica_departamento_tipo_fecha->tutorizado); ?></td>
								<td><?= bold($estaditica_departamento_tipo_fecha->autoformacion); ?></td>
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
				<a data-toggle="modal" href="#myModalChart"><div id="morris-bar-chart-estadistica6-1"></div></a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/raphael.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/morris.min.js"></script>
<script type="text/javascript">
	$(function() {
		Morris.Bar({
			element: 'morris-bar-chart-estadistica6-1',
			data: [<?= $estaditicas_departamento_tipo_fechas_json; ?>],
			xkey: 'y',
			ykeys: ['a', 'b'],
			labels: ['Capacitados', 'Certificados'],
			hideHover: 'auto',
			resize: true
		});
		Morris.Bar({
			element: 'morris-bar-chart-estadistica6-2',
			data: [<?= $estaditicas_departamento_tipo_fechas_json; ?>],
			xkey: 'y',
			ykeys: ['a', 'b'],
			labels: ['Capacitados', 'Certificados'],
			hideHover: 'auto',
			resize: true
		});
	});
</script>