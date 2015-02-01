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
		<div class="col-lg-3"><?= nbs(); ?></div>
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
		<div class="col-lg-3"><?= nbs(); ?></div>
		<div class="col-lg-6">
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
					<table class="table table-striped table-bordered table-hover" id="data-tables-estadistica3-1">
						<thead>
							<tr>
								<th>#</th>
								<th>Departamento</th>
								<th>Capacitados</th>
								<th>Certificados</th>
							</tr>
						</thead>
						<tbody>
							<?php							
							foreach($tabla as $tbl){ ?>
							<tr>
								<td><?= $tbl->row_number; ?></td>
								<td><?= utf8($tbl->nombre_departamento); ?></td>
								<td><?= $tbl->capacitados; ?></td>
								<td><?= $tbl->certificados; ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-lg-6">
				<a data-toggle="modal" href="#myModalChart"><div id="morris-bar-chart-estadistica3-1"></div></a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/data-tables/js/data-tables.jquery.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/data-tables/js/data-tables.bootstrap.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#data-tables-estadistica3-1').dataTable({
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
	});
</script>
<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/raphael.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/morris.min.js"></script>
<script type="text/javascript">
	$(function() {
		Morris.Bar({
			element: 'morris-bar-chart-estadistica3-1',
			data: [<?= $grafica_estaditicas_departamento_json; ?>],
			xkey: 'y',
			ykeys: ['a', 'b'],
			labels: ['Capacitados', 'Certificados'],
			hideHover: 'auto',
			resize: true
		});
		Morris.Bar({
			element: 'morris-bar-chart-estadistica3-2',
			data: [<?= $grafica_estaditicas_departamento_json; ?>],
			xkey: 'y',
			ykeys: ['a', 'b'],
			labels: ['Capacitados', 'Certificados'],
			hideHover: 'auto',
			resize: true
		});
	});
</script>