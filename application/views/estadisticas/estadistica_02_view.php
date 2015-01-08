<?php
$fecha = array(
	'name'		=> '',
	'id'		=> '',
	'maxlength'	=> '60',
	'size'		=> '20',
	'type'		=> 'date',
	'required'	=> 'required',
	'class'		=> 'form-control text-capitalize'
);

$boton_primario = 'class="btn btn-primary"';
?>
<?= form_open(); ?>
	<div class="row">
		<div class="col-lg-6">
			<div class="form-group">
				<?= form_label('Departamento:'); ?>
				<?= form_dropdown('id_departamento', $lista_departamentos, '', 'class="form-control" required'); ?>
				<?= form_error('id_departamento'); ?>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="form-group">
				<?= form_label('Periodo:'); ?>
				<div class="row">
					<div class="col-lg-6">
						<?php $fecha['name'] = $fecha['id'] = 'fecha1'; ?>
						<?= form_input($fecha); ?>
						<?= form_error('fecha1'); ?>
					</div>
					<div class="col-lg-6">
						<?php $fecha['name'] = $fecha['id'] = 'fecha2'; ?>
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
							$municipios = 1;
							foreach($cantidad_usuarios_municipio as $cantidad_municipio){ ?>
							<tr>
								<td><?= $municipios; ?></td>
								<td><?= htmlentities($cantidad_municipio->nombre_municipio, ENT_COMPAT, 'UTF-8'); ?></td>
								<td><?= $cantidad_municipio->total; ?></td>
								<td><?= $cantidad_municipio->total; ?></td>
							</tr>
							<?php
							$municipios++;
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
								<th>Capacitados</th>
								<th>Certificados</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$municipios = 1;
							foreach($usuarios_municipio as $cantidad_municipio){
							?>
							<tr>
								<td><?= $municipios; ?></td>
								<td><?= htmlentities($cantidad_municipio->nombre_municipio, ENT_COMPAT, 'UTF-8'); ?></td>
								<td><?= htmlentities($cantidad_municipio->nombre_usuario, ENT_COMPAT, 'UTF-8'); ?></td>
								<td><?= htmlentities($cantidad_municipio->modalidad_usuario, ENT_COMPAT, 'UTF-8'); ?></td>
							</tr>
							<?php
							$municipios++;
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
			"oLanguage": {
				"oPaginate": {
					"sFirst": "Primero",
					"sLast": "Último",
					"sNext": ">>",
					"sPrevious": "<<"
				},
				"sInfo": "_START_/_END_ de _TOTAL_ registros",
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