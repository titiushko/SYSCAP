<?php
$fecha_ini = array(
	'name'		=> 'fecha_ini',
	'id'		=> 'fecha_ini',
	'maxlength'	=> '60',
	'size'		=> '20',
	'type'		=> 'date',
	'required'	=> 'required',
	'class'		=> 'form-control'
);
$fecha_fin = array(
	'name'		=> 'fecha_fin',
	'id'		=> 'fecha_fin',
	'maxlength'	=> '60',
	'size'		=> '20',
	'type'		=> 'date',
	'required'	=> 'required',
	'class'		=> 'form-control'
);
$attr = array('id'   => 'formulario',
              'name' => 'formulario'
);
$boton_primario = array('id'    => 'boton_primario',
						'class' => 'btn btn-primary',
						'name'	=> 'boton_primario',
						'value' => 'Consultar',
);
?>
<?= form_open('',$attr); ?>
	<div class="row">
		<div class="col-lg-3"><?= nbs(); ?></div>
		<div class="col-lg-6">
			<div class="form-group">
				<?= form_label('Periodo:'); ?>
				<div class="row">
					<div class="col-lg-6">
						<?= form_input($fecha_ini); ?>
						<?= form_error('fecha_ini'); ?>
					</div>
					<div class="col-lg-6">
						<?= form_input($fecha_fin); ?>
						<?= form_error('fecha_fin'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-3"><?= nbs(); ?></div>
		<div class="col-lg-6">
			<div class="form-group">
				<?= form_submit($boton_primario); ?>
			</div>
		</div>
	</div>
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
							<tr>
								<th>Capacitados</th>
								<td><?= $capacitados[0]->tutorizado?></td>
								<td><?= $capacitados[0]->autoformacion ?></td>
							</tr>
							<tr>
								<th>Certificados</th>
								<td><?= $certificados[0]->tutorizado?></td>
								<td><?= $certificados[0]->autoformacion ?></td>
							</tr>
							<tr>
								<th>TOTAL</th>
								<th><?= $total[0]->tutorizado ?></th>
								<th><?= $total[0]->autoformacion ?></th>
							</tr>
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
			data: [<?= $grafica_json; ?>],
			xkey: 'y',
			ykeys: ['a', 'b'],
			labels: ['Capacitados', 'Certificados'],
			hideHover: 'auto',
			resize: true
		});
		Morris.Bar({
			element: 'morris-bar-chart-estadistica1-2',
			data: [<?= $grafica_json; ?>],
			xkey: 'y',
			ykeys: ['a', 'b'],
			labels: ['Capacitados', 'Certificados'],
			hideHover: 'auto',
			resize: true
		});
	});
</script>