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
$boton_primario = 'class="btn btn-primary"';
$boton_secundario = 'class="btn btn-danger" onclick="redireccionar(\''.base_url().'estadisticas/consulta/2\');"';
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
	'codigo_departamento'	=> set_value('codigo_departamento', @$campos['id_departamento']),
	'fecha_1'				=> set_value('fecha_1', @$campos['fecha1']),
	'fecha_2'				=> set_value('fecha_2', @$campos['fecha2'])
);
?>
<?= form_open('index.php/estadisticas/imprimir/2', $formulario_imprimir, $campos_ocultos_formulario); ?>
<?= form_close(); ?>
<?= form_open('index.php/estadisticas/exportar/2', $formulario_exportar, $campos_ocultos_formulario); ?>
<?= form_close(); ?>
<?= form_open('index.php/estadisticas/consulta/2', $formulario_consultar); ?>
	<div class="row">
		<div class="col-lg-6">
			<div class="form-group">
				<?= form_label('Departamento:'); ?>
				<?= form_dropdown('id_departamento', $lista_departamentos, set_value('id_departamento', @$campos['id_departamento']), 'class="form-control" required'); ?>
				<?= form_error('id_departamento'); ?>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="form-group">
				<?= form_label('Periodo:'); ?>
				<div class="row">
					<div class="col-lg-6">
						<?php $fecha['name'] = $fecha['id'] = 'fecha1'; $fecha['value'] = set_value('fecha1', @$campos['fecha1']); ?>
						<?= form_input($fecha); ?>
						<?= form_error('fecha1'); ?>
					</div>
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
				<?= form_submit('boton_primario', 'Consultar', $boton_primario); ?>
				<?= form_reset('boton_secundario', 'Limpiar', $boton_secundario); ?>
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
					<table class="table table-striped table-bordered table-hover" id="data-tables-estadistica2-1">
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
								<td><?= bold($cantidad_municipio->nombre_municipio); ?></td>
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
			</div>
			<div class="col-lg-6">
				<a data-toggle="modal" href="#myModalChart"><div id="morris-bar-chart-estadistica2-1"></div></a>
			</div>
		</div>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<?= heading('Listado de Usuarios por Municipio', 4); ?>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="data-tables-estadistica2-2">
						<thead>
							<tr>
								<th>#</th>
								<th>Municipio</th>
								<th>Nombre</th>
								<th>Modalidad Capacitaci&oacute;n</th>
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
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/data-tables/js/data-tables.jquery.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/data-tables/js/data-tables.bootstrap.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#data-tables-estadistica2-1').dataTable({
			"searching": false,
			"lengthChange": false,
			"info": false,
			"oLanguage": {
				"oPaginate": {
					"sFirst": "Primero",
					"sLast": "Último",
					"sNext": ">",
					"sPrevious": "<"
				},
				"sEmptyTable": "No hay resultado para esta Consulta Estadística."
			  }
		});
		$('#data-tables-estadistica2-2').dataTable({
			language:{
				url: '<?= base_url(); ?>resources/plugins/data-tables/js/spanish_language.json'
			}
		});
	});
</script>
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
			hideHover: 'auto',
			resize: true
		});
		Morris.Bar({
			element: 'morris-bar-chart-estadistica2-2',
			data: [<?= $cantidad_usuarios_municipio_json; ?>],
			xkey: 'y',
			ykeys: ['a', 'b'],
			labels: ['Capacitados', 'Certificados'],
			hideHover: 'auto',
			resize: true
		});
	});
</script>