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
        <div class="col-lg-6">
			<div class="form-group">
				<?= form_label('Tipo de Capacitado:'); ?>
				<?= form_dropdown('id_tipo_capacitados', $lista_tipo_capacitados, 'Evaluacion', 'class="form-control" required'); ?>
				<?= form_error('id_tipo_capacitados'); ?>
			</div>
		</div>
        <div class="col-lg-6">
			<div class="form-group">
				<?= form_label('Centro Educativo:'); ?>
				<?= form_dropdown('id_centro_educativo', $lista_centros_educativos, '', 'class="form-control" required'); ?>
				<?= form_error('id_centro_educativo'); ?>
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
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th></th>
								<th>Cantidades</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Tutorizados</td>
								<td><?= $capacitados[0]->tutorizado?></td>				
							</tr>
							<tr>
								<td>Autoformaci&oacute;n</td>
								<td><?= $certificados[0]->tutorizado?></td>
							</tr>
							<tr>
								<th>TOTAL</th>
								<td><?= $total[0]->tutorizado?></td>						
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-lg-6">
				<a data-toggle="modal" href="#myModalChart"><div id="morris-bar-chart-estadistica9-1"></div></a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/raphael.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/morris.min.js"></script>
<script type="text/javascript">
	$(function() {
		Morris.Bar({
			element: 'morris-bar-chart-estadistica9-1',
			data: [<?= $grafica_json; ?>],
			xkey: 'y',
			ykeys: ['a'],
			labels: ['Cantidades'],
			hideHover: 'auto',
			resize: true
		});
		Morris.Bar({
			element: 'morris-bar-chart-estadistica9-2',
			data: [<?= $grafica_json; ?>],
			xkey: 'y',
			ykeys: ['a'],
			labels: ['Cantidades'],
			hideHover: 'auto',
			resize: true
		});
	});
</script>