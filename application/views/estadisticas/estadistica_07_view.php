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
$departamentos = 'id = "id_departamento" required = "required" class = "form-control"';
$municipios = 'id = "id_municipio" required = "required" class = "form-control"';
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
	'onclick'	=> 'redireccionar(\''.base_url().'estadisticas/consulta/7\');'
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
	'codigo_municipio'		=> set_value('codigo_municipio', @$campos['id_municipio']),
	'fecha_1'				=> set_value('fecha_1', @$campos['fecha1']),
	'fecha_2'				=> set_value('fecha_2', @$campos['fecha2'])
);
?>
<?= form_open('index.php/estadisticas/imprimir/7', $formulario_imprimir, $campos_ocultos_formulario); ?>
<?= form_close(); ?>
<?= form_open('index.php/estadisticas/exportar/7', $formulario_exportar, $campos_ocultos_formulario); ?>
<?= form_close(); ?>
<?= form_open('index.php/estadisticas/consulta/7', $formulario_consultar); ?>
	<div class="row">
		<div class="col-lg-6">
			<div class="form-group">
				<?= form_label('Departamento:'); ?>
				<?= form_dropdown('id_departamento', $lista_departamentos, set_value('id_departamento', @$campos['id_departamento']), $departamentos); ?>
				<?= form_error('id_departamento'); ?>
			</div>
		</div>
        <div class="col-lg-6">
			<div class="form-group">
				<?= form_label('Municipio:'); ?>
				<?= form_dropdown('id_municipio', $lista_municipios, set_value('id_municipio', @$campos['id_municipio']), $municipios); ?>
				<?= form_error('id_municipio'); ?>
			</div>
		</div>
	</div>
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
				<?= form_submit($boton_primario); ?>
				<?= form_reset($boton_secundario); ?>
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
					<table class="table table-striped table-bordered table-hover" id="data-tables-estadistica7-1">
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
							$indice = 1;
							foreach($usuarios_departamento_municipio as $usuario_departamento_municipio){
								if($usuario_departamento_municipio->nombre_centro_educativo != 'Total'){
							?>
							<tr>
								<td><?= $indice++; ?></td>
								<td><?= utf8($usuario_departamento_municipio->nombre_centro_educativo); ?></td>
								<td><?= number_format($usuario_departamento_municipio->capacitados, 0, '', ','); ?></td>
								<td><?= number_format($usuario_departamento_municipio->certificados, 0, '', ','); ?></td>
							</tr>
							<?php } else{ ?>
							<tfoot>
								<tr>
									<td></td>
									<td><?= bold(utf8($usuario_departamento_municipio->nombre_centro_educativo)); ?></td>
									<td><?= bold(number_format($usuario_departamento_municipio->capacitados, 0, '', ',')); ?></td>
									<td><?= bold(number_format($usuario_departamento_municipio->certificados, 0, '', ',')); ?></td>
								</tr>
							</tfoot>
							<?php
								}
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-lg-6">
				<?php if(count($usuarios_departamento_municipio) > 1){ ?>
				<a data-toggle="modal" href="#myModalChart"><div id="morris-bar-chart-estadistica7-1"></div></a>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<?= heading('Listado de Usuarios por Centro Educativo', 3); ?>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="data-tables-estadistica7-2">
						<thead>
							<tr>
								<th>#</th>
								<th>Centro Educativo</th>
								<th>Nombre</th>
								<th>Tipo de Capacitado</th>
								<th>Modalidad de Capacitaci&oacute;n</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$usuarios = 1;
							foreach($usuarios_centro_educativo as $usuario_centro_educativo){
							?>
							<tr>
								<td><?= $usuarios++; ?></td>
								<td><?= utf8($usuario_centro_educativo->nombre_centro_educativo); ?></td>
								<td><?= utf8($usuario_centro_educativo->nombre_usuario); ?></td>
								<td><?= utf8($usuario_centro_educativo->tipo_capacitado); ?></td>
								<td><?= utf8($usuario_centro_educativo->modalidad_usuario); ?></td>
							</tr>
							<?php
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
		$('#data-tables-estadistica7-1').dataTable({
			"searching":	false,
			"lengthChange":	false,
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
		$('#data-tables-estadistica7-2').dataTable({
			language:{
				url: '<?= base_url(); ?>resources/plugins/data-tables/js/spanish_language.json'
			}
		});
		$("#id_departamento").change(function(){
			$.post('<?= base_url('index.php/ajax/lista_municipios'); ?>', {id_departamento: $("#id_departamento").val()}, function(resultado){
				$('#id_municipio').empty();
				$.each(jQuery.parseJSON(resultado), function(respuesta, municipio){
					if(municipio.id_municipio == '<?= @$campos['id_municipio']; ?>'){
						$("#id_municipio").append($("<option></option>").attr({"value":	municipio.id_municipio, "selected":	"selected"}).text(municipio.nombre_municipio));
					}
					else{
						$("#id_municipio").append($("<option></option>").attr({"value":	municipio.id_municipio}).text(municipio.nombre_municipio));
					}
				});
			});
		});
	});
</script>
<?php if(count($usuarios_departamento_municipio) > 1){ ?>
<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/raphael.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/morris.min.js"></script>
<script type="text/javascript">
	$(function(){
		Morris.Bar({
			element: 'morris-bar-chart-estadistica7-1',
			data: [<?= $usuarios_departamento_municipio_json; ?>],
			xkey: 'y',
			ykeys: ['a', 'b'],
			labels: ['Capacitados', 'Certificados'],
			hideHover: 'auto',
			resize: true
		});
		Morris.Bar({
			element: 'morris-bar-chart-estadistica7-2',
			data: [<?= $usuarios_departamento_municipio_json; ?>],
			xkey: 'y',
			ykeys: ['a', 'b'],
			labels: ['Capacitados', 'Certificados'],
			hideHover: 'auto',
			resize: true
		});
	});
</script>
<?php } ?>