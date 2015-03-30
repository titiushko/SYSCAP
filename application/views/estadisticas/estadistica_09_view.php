<?php
$formulario_consultar = array(
	'name'		=> 'formulario_consultar',
	'id'		=> 'formulario_consultar',
	'role'		=> 'form'
);
$lista_tipo_capacitados =  array(
	''				=> '',
	'capacitado'	=> 'Capacitados',
	'certificado'	=> 'Certificados'
);
$nombre_centro_educativo = array (
	'name'			=> 'nombre_centro_educativo',
	'id'			=> 'nombre_centro_educativo',
	'maxlength'		=> '60',
	'size'			=> '20',
	'value'			=> utf8(set_value('nombre_centro_educativo', @$campos['nombre_centro_educativo'])),
	'onpaste'		=> 'return false',
	'type'			=> 'text',
	'autocomplete'	=> 'off',
	'required'		=> 'required',
	'placeholder'	=> 'Buscar Centro Educativo',
	'class'			=> 'form-control'
);
$codigo_centro_educativo = array (
	'name'			=> 'id_centro_educativo',
	'id'			=> 'id_centro_educativo',
	'value'			=> set_value('id_centro_educativo', @$campos['id_centro_educativo']),
	'type'			=> 'hidden',
	'required'		=> 'required'
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
				<?= form_input($nombre_centro_educativo); ?>
				<?= form_input($codigo_centro_educativo); ?>
				<div id="resultado-centro_educativo"></div>
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
		<?= heading('Resultado', 3); ?>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-6">
				<div class="table-responsive">        
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>Modalidad de Capacitaci&oacute;n</th>
								<th>Cantidades</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach($tipos_capacitados_centro_educativo as $tipo_capacitado_centro_educativo){
								if($tipo_capacitado_centro_educativo->modalidad_usuario != 'Total'){
							?>
							<tr>
								<td><?= utf8($tipo_capacitado_centro_educativo->modalidad_usuario); ?></td>
								<td><?= number_format(limpiar_nulo($tipo_capacitado_centro_educativo->total), 0, '', ','); ?></td>
							</tr>
							<?php } else{ ?>
							<tr>
								<td><?= bold(utf8($tipo_capacitado_centro_educativo->modalidad_usuario)); ?></td>
								<td><?= bold(number_format(limpiar_nulo($tipo_capacitado_centro_educativo->total), 0, '', ',')); ?></td>
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
				<?php if(!estadistica_vacia($tipos_capacitados_centro_educativo)){ ?>
				<a data-toggle="modal" href="#myModalChart"><div id="morris-bar-chart-estadistica9-1"></div></a>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#nombre_centro_educativo").bind('keyup focusin', function(evento){
			if(evento.which != 27){
				var v_nombre_centro_educativo = $(this).val();
				$.post('<?= base_url('index.php/ajax/lista_centros_educativos'); ?>', {nombre_centro_educativo: v_nombre_centro_educativo.length > 0 ? v_nombre_centro_educativo : '%'}, function(resultado){
					if(resultado != ''){
						$('#resultado-centro_educativo').show();
						var centros_educativos = jQuery.parseJSON(resultado);
						var clase = centros_educativos.length < 5 ? "contenedor-centro_educativo-1" : "contenedor-centro_educativo-2";
						$('#resultado-centro_educativo').empty();
						$("#resultado-centro_educativo").append($("<div></div>").attr({"class": clase}));
						$.each(centros_educativos, function(respuesta, centro_educativo){
							$("." + clase).append($("<p></p>").attr({"onclick": "seleccionar_centro_educativo('" + centro_educativo.id_centro_educativo + "', '" + centro_educativo.nombre_centro_educativo + "');"}).text(centro_educativo.nombre_centro_educativo));
						});
					}
					else{
						$('#resultado-centro_educativo').hide();
					}
				});
			}
			else{
				$(this).val('');
				$('#id_centro_educativo').val('');
				$('#resultado-centro_educativo').hide();
			}
		});
	});
	function seleccionar_centro_educativo(codigo, nombre){
		$('#id_centro_educativo').val(codigo);
		$('#nombre_centro_educativo').val(nombre);
		$('#resultado-centro_educativo').hide();
	}
</script>
<?php if(!estadistica_vacia($tipos_capacitados_centro_educativo)){ ?>
<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/raphael.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/morris/js/morris.min.js"></script>
<script type="text/javascript">
	$(function(){
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
<?php } ?>