<?php
$formulario_consultar = array(
	'name'		=> 'formulario_consultar',
	'id'		=> 'formulario_consultar',
	'role'		=> 'form'
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
	'onclick'	=> 'redireccionar(\''.base_url().'estadisticas/consulta/9\');'
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
	'tipo_de_capacitado'		=> set_value('tipo_de_capacitado', @$campos['tipo_capacitado']),
	'codigo_centro_educativo'	=> set_value('codigo_centro_educativo', @$campos['id_centro_educativo'])
);
?>
<?= form_open('index.php/estadisticas/imprimir/9', $formulario_imprimir, $campos_ocultos_formulario); ?>
<?= form_close(); ?>
<?= form_open('index.php/estadisticas/exportar/9', $formulario_exportar, $campos_ocultos_formulario); ?>
<?= form_close(); ?>
<?= form_open('index.php/estadisticas/consulta/9', $formulario_consultar); ?>
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
				<?= form_label('Centro Educativo:'); ?>
				<?= form_dropdown('id_centro_educativo', $lista_centros_educativos, set_value('id_centro_educativo', @$campos['id_centro_educativo']), 'class="form-control" required'); ?>
				<?= form_error('id_centro_educativo'); ?>
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
								<th>Modalidades de Capacitaci&oacute;n</th>
								<th>Cantidades</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach($tipos_capacitados_centro_educativo as $tipo_capacitado_centro_educativo){
								if($tipo_capacitado_centro_educativo->modalidad_capacitado != 'TOTAL'){
							?>
							<tr>
								<td><?= utf8($tipo_capacitado_centro_educativo->modalidad_capacitado); ?></td>
								<td><?= $tipo_capacitado_centro_educativo->total; ?></td>
							</tr>
							<?php
								}
								else{
							?>
							<tr>
								<td><?= bold(utf8($tipo_capacitado_centro_educativo->modalidad_capacitado)); ?></td>
								<td><?= bold($tipo_capacitado_centro_educativo->total); ?></td>
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
			data: [<?= $tipos_capacitados_centro_educativo_json; ?>],
			xkey: 'y',
			ykeys: ['a'],
			labels: ['Cantidades'],
			hideHover: 'auto',
			resize: true
		});
		Morris.Bar({
			element: 'morris-bar-chart-estadistica9-2',
			data: [<?= $tipos_capacitados_centro_educativo_json; ?>],
			xkey: 'y',
			ykeys: ['a'],
			labels: ['Cantidades'],
			hideHover: 'auto',
			resize: true
		});
	});
</script>