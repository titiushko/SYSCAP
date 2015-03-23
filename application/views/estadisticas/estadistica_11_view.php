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
$lista_grados_digitales =  array('' => '', 1 => 1, 2 => 2, 3 => 3, 4 => 4);
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
	'onclick'	=> 'redireccionar(\''.base_url().'estadisticas/consulta/11\');'
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
	'tipo_grado_digital'	=> set_value('tipo_grado_digital', @$campos['grado_digital']),
	'fecha_1'				=> set_value('fecha_1', @$campos['fecha1']),
	'fecha_2'				=> set_value('fecha_2', @$campos['fecha2'])
);
?>
<?= form_open('index.php/estadisticas/imprimir/11', $formulario_imprimir, $campos_ocultos_formulario); ?>
<?= form_close(); ?>
<?= form_open('index.php/estadisticas/exportar/11', $formulario_exportar, $campos_ocultos_formulario); ?>
<?= form_close(); ?>
<?= form_open('index.php/estadisticas/consulta/11', $formulario_consultar); ?>
	<div class="row">
        <div class="col-lg-6">
			<div class="form-group">
				<?= form_label('Grado Digital:'); ?>
				<?= form_dropdown('grado_digital', $lista_grados_digitales, set_value('grado_digital', @$campos['grado_digital']), 'class="form-control" required'); ?>
				<?= form_error('grado_digital'); ?>
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
							foreach($usuarios_grado_digital as $usuario_grado_digital){
								if($usuario_grado_digital->tipo_capacitado != 'Total'){
							?>
							<tr>
								<th><?= utf8($usuario_grado_digital->tipo_capacitado); ?></th>
								<td><?= limpiar_nulo($usuario_grado_digital->tutorizados); ?></td>
								<td><?= limpiar_nulo($usuario_grado_digital->autoformacion); ?></td>
							</tr>
							<?php } else{ ?>
							<tr>
								<th><?= bold(utf8($usuario_grado_digital->tipo_capacitado)); ?></th>
								<td><?= bold(limpiar_nulo($usuario_grado_digital->tutorizados)); ?></td>
								<td><?= bold(limpiar_nulo($usuario_grado_digital->autoformacion)); ?></td>
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
				<?php if(!estadistica_vacia($usuarios_grado_digital)){ ?>
				<a data-toggle="modal" href="#myModalChart"><div id="morris-bar-chart-estadistica11-1"></div></a>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<?= heading('Listado de Certificaciones por Grado Digital', 4); ?>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="data-tables-estadistica11-2">
						<thead>
							<tr>
								<th>#</th>
								<th>Categor&iacute;a</th>
								<th>Curso</th>
								<th>Tutorizados</th>
								<th>Autoformaci&oacute;n</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if(count($certificaciones_grado_digital) > 1){
								$indice = 1;
								foreach($certificaciones_grado_digital as $certificacion_grado_digital){
									if($certificacion_grado_digital->nombre_curso_categoria != 'Total'){
							?>
							<tr>
								<td><?= $indice++; ?></td>
								<td><?= utf8($certificacion_grado_digital->nombre_curso_categoria); ?></td>
								<td><?= utf8($certificacion_grado_digital->nombre_completo_curso); ?></td>
								<td><?= limpiar_nulo($certificacion_grado_digital->tutorizados); ?></td>
								<td><?= limpiar_nulo($certificacion_grado_digital->autoformacion); ?></td>
							</tr>
							<?php } else{ ?>
							<tfoot>
								<tr>
									<td></td>
									<td><?= bold(utf8($certificacion_grado_digital->nombre_curso_categoria)); ?></td>
									<td></td>
									<td><?= bold(limpiar_nulo($certificacion_grado_digital->tutorizados)); ?></td>
									<td><?= bold(limpiar_nulo($certificacion_grado_digital->autoformacion)); ?></td>
								</tr>
							</tfoot>
							<?php
									}
								}
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
	$(document).ready(function(){
		$('#data-tables-estadistica11-1').dataTable({
			"searching":	false,
			"lengthChange":	false,
			"ordering":		false,
			"info":			false,
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
		$('#data-tables-estadistica11-2').dataTable({
			language:{
				url: '<?= base_url(); ?>resources/plugins/data-tables/js/spanish_language.json'
			}
		});
	});
</script>
<?php if(!estadistica_vacia($usuarios_grado_digital)){ ?>
<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/raphael.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/morris.min.js"></script>
<script type="text/javascript">
	$(function(){
		Morris.Bar({
			element: 'morris-bar-chart-estadistica11-1',
			data: [<?= $usuarios_grado_digital_json; ?>],
			xkey: 'y',
			ykeys: ['a', 'b'],
			labels: ['Tutorizados', 'Autoformaci&oacute;n'],
			hideHover: 'auto',
			resize: true
		});
		Morris.Bar({
			element: 'morris-bar-chart-estadistica11-2',
			data: [<?= $usuarios_grado_digital_json; ?>],
			xkey: 'y',
			ykeys: ['a', 'b'],
			labels: ['Tutorizados', 'Autoformaci&oacute;n'],
			hideHover: 'auto',
			resize: true
		});
	});
</script>
<?php } ?>