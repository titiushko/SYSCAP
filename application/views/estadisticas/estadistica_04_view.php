<?php
$fecha = array(
	'name'		=> '',
	'id'		=> '',
	'maxlength'	=> '60',
	'size'		=> '20',
	'type'		=> 'date',
	'required'	=> 'required',
	'class'		=> 'form-control'
);
$boton_primario = 'class="btn btn-primary"';
?>
<?= form_open(); ?>
	<div class="row">
		<div class="col-lg-3">
			<div class="form-group">
				<?= form_label('Departamento:'); ?>
				<?= form_dropdown('id_departamento', $lista_departamentos, '', 'class="form-control" required'); ?>
				<?= form_error('id_departamento'); ?>
			</div>
		</div>
        <div class="col-lg-3">
			<div class="form-group">
				<?= form_label('Municipio:'); ?>
				<?= form_dropdown('id_municipio', $lista_municipios, '', 'class="form-control" required'); ?>
				<?= form_error('id_municipio'); ?>
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
					<table class="table table-striped table-bordered table-hover" id="data-tables-estadistica4-1">
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
							$centroseducativos = 1;
							foreach($tabla as $tbl){ ?>
							<tr>
								<td><?= $centroseducativos; ?></td>
								<td><?= utf8($tbl->nombre_centro_educativo); ?></td>
								<td><?= $tbl->capacitados; ?></td>
								<td><?= $tbl->certificados; ?></td>
							</tr>
							<?php
							$centroseducativos++;
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-lg-6">
				<a data-toggle="modal" href="#myModalChart"><div id="morris-bar-chart-estadistica4-1"></div></a>
			</div>
		</div>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<?= heading('Listado de Usuarios por Centro Educativo', 4); ?>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="data-tables-estadistica4-2">
						<thead>
							<tr>
								<th>#</th>
								<th>Nombre</th>
								<th>Tipo de Capacitado</th>
								<th>Modalidad de Capacitaci&oacute;n</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$centroseducativos = 1;
							foreach($listado as $lst){
							?>
							<tr>
								<td><?= $centroseducativos; ?></td>
								<td><?= utf8($lst->nombre_usuario); ?></td>
								<td><?= utf8($lst->tipo_capacitado); ?></td>
								<td><?= utf8($lst->modalidad_usuario); ?></td>
							</tr>
							<?php
							$centroseducativos++;
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
		$('#data-tables-estadistica4-1').dataTable({
			"searching": false,
			"lengthChange": false,
			"oLanguage": {
				"oPaginate": {
					"sFirst": "Primero",
					"sLast": "Último",
					"sNext": ">",
					"sPrevious": "<"
				},
				"sInfo": "_START_/_END_ de _TOTAL_ registros",
				"sEmptyTable": "No hay resultado para esta Consulta Estadística."
			  }
		});
		$('#data-tables-estadistica4-2').dataTable({
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
			element: 'morris-bar-chart-estadistica4-1',
			data: [<?= $grafica_json; ?>],
			xkey: 'y',
			ykeys: ['a', 'b'],
			labels: ['Capacitados', 'Certificados'],
			hideHover: 'auto',
			resize: true
		});
		Morris.Bar({
			element: 'morris-bar-chart-estadistica4-2',
			data: [<?= $grafica_json; ?>],
			xkey: 'y',
			ykeys: ['a', 'b'],
			labels: ['Capacitados', 'Certificados'],
			hideHover: 'auto',
			resize: true
		});
	});
</script>