<?php
$formulario_consultar = array(
	'name'		=> 'formulario_consultar',
	'id'		=> 'formulario_consultar',
	'role'		=> 'form'
);
$fecha = array(
	'name'			=> '',
	'id'			=> '',
	'maxlength'		=> '60',
	'size'			=> '20',
	'value'			=> '',
	'type'			=> 'date',
	'autocomplete'	=> 'off',
	'required'		=> 'required',
	'class'			=> 'form-control'
);
$lista_tipo_capacitados =  array(
	''				=> '',
	'capacitado'	=> 'Capacitados',
	'certificado'	=> 'Certificados'
);
$boton_primario = array(
	'name'		=> 'boton_primario',
	'id'		=> 'boton_primario',
	'value'		=> 'true',
	'type'		=> 'submit',
	'content'	=> '<i class="fa fa-filter"></i> Consultar',
	'class'		=> 'btn btn-primary'
);
$boton_secundario = array(
	'name'		=> 'boton_secundario',
	'id'		=> 'boton_secundario',
	'value'		=> 'true',
	'type'		=> 'reset',
	'content'	=> '<i class="fa fa-eraser"></i> Limpiar',
	'class'		=> 'btn btn-danger',
	'onclick'	=> 'redireccionar(\''.base_url().'estadisticas/consulta/8\');'
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
	'fecha_1'	=> set_value('fecha_1', @$campos['fecha1']),
	'fecha_2'	=> set_value('fecha_2', @$campos['fecha2'])
);
?>
<?= form_open('index.php/estadisticas/imprimir/8', $formulario_imprimir, $campos_ocultos_formulario); ?>
<?= form_close(); ?>
<?= form_open('index.php/estadisticas/exportar/8', $formulario_exportar, $campos_ocultos_formulario); ?>
<?= form_close(); ?>
<?= form_open('index.php/estadisticas/consulta/8', $formulario_consultar); ?>
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
				<?= form_button($boton_primario); ?>
				<?= form_button($boton_secundario); ?>
			</div>
		</div>
	</div>
<?= form_close(); ?>
<div class="panel panel-default">
	<div class="panel-heading">
		<?= heading('Resultado', 3); ?>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-6">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="data-tables-estadistica8-1">
						<thead>
							<tr>
								<th>#</th>
								<th>Departamento</th>
								<th>Tutorizados</th>
								<th>Autoformaci&oacute;n</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$indice = 1;
							foreach($estaditicas_departamento_fechas as $estaditica_departamento_fecha){
								if($estaditica_departamento_fecha->nombre_departamento != 'Total'){
							?>
							<tr>
								<td><?= $indice++; ?></td>
								<td><?= utf8($estaditica_departamento_fecha->nombre_departamento); ?></td>
								<td><?= number_format($estaditica_departamento_fecha->capacitados, 0, '', ','); ?></td>
								<td><?= number_format($estaditica_departamento_fecha->certificados, 0, '', ','); ?></td>
							</tr>
							<?php } else{ ?>
							<tfoot>
								<tr>
									<td></td>
									<td><?= bold(utf8($estaditica_departamento_fecha->nombre_departamento)); ?></td>
									<td><?= bold(number_format($estaditica_departamento_fecha->capacitados, 0, '', ',')); ?></td>
									<td><?= bold(number_format($estaditica_departamento_fecha->certificados, 0, '', ',')); ?></td>
								</tr>
							</tfoot>
							<?php
								}
							}
							?>
						</tbody>
					</table>
					<?= $sin_departamento; ?>
				</div>
			</div>
			<div class="col-lg-6">
				<?php if(count($estaditicas_departamento_fechas) > 0){ ?>
				<a data-toggle="modal" href="#myModalChart"><div id="morris-bar-chart-estadistica8-1"></div></a>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/data-tables/js/data-tables.jquery.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/data-tables/js/data-tables.bootstrap.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#data-tables-estadistica8-1').dataTable({
			"searching":	false,
			"lengthChange":	false,
			"oLanguage":{
				"oPaginate":{
					"sFirst":		"<<",
					"sLast":		">>",
					"sNext":		">",
					"sPrevious":	"<"
				},
				"sInfo":		"_START_/_END_ de _TOTAL_ registros",
				"sEmptyTable":	"No hay resultado para esta Consulta Estadística."
			}
		});
	});
</script>
<?php if(count($estaditicas_departamento_fechas) > 0){ ?>
<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/raphael.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/morris.min.js"></script>
<script type="text/javascript">
	$(function(){
		Morris.Bar({
			element: 'morris-bar-chart-estadistica8-1',
			data: [<?= $estaditicas_departamento_fechas_json; ?>],
			xkey: 'y',
			ykeys: ['a', 'b'],
			labels: ['Tutorizados', 'Autoformacion'],
			hideHover: 'auto',
			resize: true
		});
		Morris.Bar({
			element: 'morris-bar-chart-estadistica8-2',
			data: [<?= $estaditicas_departamento_fechas_json; ?>],
			xkey: 'y',
			ykeys: ['a', 'b'],
			labels: ['Tutorizados', 'Autoformacion'],
			hideHover: 'auto',
			resize: true
		});
	});
</script>
<?php } ?>