<?php
$bloqueo_informacion_general = $valor_bloqueo_informacion_general = '';
if($operacion == "Mostrar"){
	$bloqueo_informacion_general = $valor_bloqueo_informacion_general = 'disabled';
	$boton_primario = 'class="btn btn-primary" onclick="redireccionar(\''.base_url('centros_educativos/modificar/'.@$centro_educativo[0]->id_centro_educativo).'\');"';
	if($this->session->userdata('uri_centros_educativos')){
		$uri_centros_educativos = $this->session->userdata('uri_centros_educativos');
		if(strpos($uri_centros_educativos, 'municipio') != FALSE){
			$boton_secundario = 'class="btn btn-danger" onclick="redireccionar(\''.base_url($uri_centros_educativos).'\');"';
		}
		else{
			$boton_secundario = 'class="btn btn-danger" onclick="redireccionar(\''.base_url('centros_educativos').'\');"';
		}
	}
	else{
		$boton_secundario = 'class="btn btn-danger" onclick="redireccionar(\''.base_url('centros_educativos').'\');"';
	}
}
else{
	$boton_primario = 'class="btn btn-primary" onclick="document.centros_educativos.estado.value=\'1\';"';
	$boton_secundario = 'class="btn btn-danger" onclick="redireccionar(\''.base_url('centros_educativos/mostrar/'.@$centro_educativo[0]->id_centro_educativo).'\');"';
}
// Atributos del Formulario
$formulario = array(
	'name'		=> 'centros_educativos',
	'id'		=> 'centros_educativos',
	'role'		=> 'form'
);
$campos_ocultos = array('estado' => '0');
// Definición de los campos Información General
$nombre_centro_educativo = array(
	'name'		=> 'nombre_centro_educativo',
	'id'		=> 'nombre_centro_educativo',
	'maxlength'	=> '60',
	'size'		=> '20',
	'value'		=> utf8(set_value('nombre_centro_educativo', @$centro_educativo[0]->nombre_centro_educativo)),
	'class'		=> 'form-control text-capitalize',
	$bloqueo_informacion_general => $valor_bloqueo_informacion_general
);
$codigo_centro_educativo = array(
	'name'		=> 'codigo_centro_educativo',
	'id'		=> 'codigo_centro_educativo',
	'maxlength'	=> '60',
	'size'		=> '20',
	'value'		=> set_value('codigo_centro_educativo', @$centro_educativo[0]->codigo_centro_educativo),
	'class'		=> 'form-control',
	'disabled'	=> 'disabled'
);
$departamentos = 'id = "id_departamento" required = "required" class = "form-control" '.$bloqueo_informacion_general.'="'.$valor_bloqueo_informacion_general.'"';
$municipios = 'id = "id_municipio" required = "required" class = "form-control" '.$bloqueo_informacion_general.'="'.$valor_bloqueo_informacion_general.'"';
?>
<script src="<?= base_url(); ?>resources/js/validaciones-centros_educativos.js"></script>
<div class="row">
	<div class="col-lg-12">
		<h1 class="well page-header">Modulo de Centros Educativos</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<?= heading($operacion.' Centro Educativo', 2); ?>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<?= form_open('index.php/centros_educativos/modificar/'.@$centro_educativo[0]->id_centro_educativo, $formulario, $campos_ocultos); ?>
							<?= form_fieldset(heading('Información General', 3)); ?>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<?= form_label('Nombre:'); ?>
										<?= form_input($nombre_centro_educativo); ?>
										<?= form_error('nombre_centro_educativo'); ?>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<?= form_label('Código:'); ?>
										<?= form_input($codigo_centro_educativo); ?>
										<?= form_error('codigo_centro_educativo'); ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<?= form_label('Departamento:'); ?>
										<?= form_dropdown('id_departamento', $lista_departamentos, utf8(set_value('id_departamento', @$centro_educativo[0]->id_departamento)), $departamentos); ?>
										<?= form_error('id_departamento'); ?>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<?= form_label('Municipio:'); ?>
										<?= form_dropdown('id_municipio', $lista_municipios, utf8(set_value('id_municipio', @$centro_educativo[0]->id_municipio)), $municipios); ?>
										<?= form_error('id_municipio'); ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<?php if($operacion == "Mostrar"){ ?>
										<?= form_button('boton_primario', 'Editar', $boton_primario); ?>
										<?= form_button('boton_secundario','Regresar', $boton_secundario); ?>
										<?php } else{ ?>
										<?= form_submit('boton_primario', 'Guardar', $boton_primario); ?>
										<?= form_button('boton_secundario','Cancelar', $boton_secundario); ?>
										<?php } ?>
									</div>
								</div>
							</div>
							<?= form_fieldset_close(); ?>
							<?= form_fieldset(heading('Certificaciones', 3)); ?>
							<div class="row">
								<div class="col-lg-6">
									<div class="table-responsive">
										<?= heading('Docentes Capacitados', 4, 'class="text-center"'); ?>
										<table class="table table-striped table-bordered table-hover" id="data-tables-docentes_capacitados">
											<thead>
												<tr>
													<th>#</th>
													<th>Nombre</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$docentes_capacitados = 1;
												foreach($lista_docentes_capacitados as $docente_capacitado){
												?>
												<tr onclick="redireccionar('<?= base_url('usuarios/mostrar/'.$docente_capacitado->id_usuario); ?>');" style="cursor: pointer;" title="Clic para ver información de <?= utf8($docente_capacitado->nombre_completo_usuario); ?>">
													<td><?= $docentes_capacitados; ?></td>
													<td><?= utf8($docente_capacitado->nombre_completo_usuario); ?></td>
												</tr>
												<?php
													$docentes_capacitados++;
												}
												?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="table-responsive">
										<?= heading('Docentes Certificados', 4, 'class="text-center"'); ?>
										<table class="table table-striped table-bordered table-hover" id="data-tables-docentes_certificados">
											<thead>
												<tr>
													<th>#</th>
													<th>Nombre</th>
													<th>Certificaci&oacute;n</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$docentes_certificados = 1;
												foreach($lista_docentes_certificados as $docente_certificado){
												?>
												<tr onclick="redireccionar('<?= base_url('usuarios/mostrar/'.$docente_certificado->id_usuario); ?>');" style="cursor: pointer;" title="Clic para ver información de <?= utf8($docente_certificado->nombre_completo_usuario); ?>">
													<td><?= $docentes_certificados; ?></td>
													<td><?= utf8($docente_certificado->nombre_completo_usuario); ?></td>
													<td><?= utf8($docente_certificado->certificacion_usuario); ?></td>
												</tr>
												<?php
													$docentes_certificados++;
												}
												?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<?= form_fieldset_close(); ?>
						<?= form_close(); ?>
						<?php
						if($operacion == "Mostrar"){
						?>
						<div class="row">
							<div class="col-lg-12 visible-desktop"><?= nbs(); ?></div>
						</div>
						<div class="row">
							<div class="col-lg-12 text-center">
								<?php if(!$this->session->userdata('dispositivo_movil')){ ?>
								<a href="<?= base_url('centros_educativos/imprimir/'.@$centro_educativo[0]->id_centro_educativo); ?>" target="_blank" class="btn btn-success"><i class="fa fa-print"></i> Imprimir</a>
								<?php } ?>
								<a href="<?= base_url('centros_educativos/exportar/'.@$centro_educativo[0]->id_centro_educativo); ?>" target="_blank" class="btn btn-success"><i class="fa fa-file-pdf-o"></i> Exportar</a>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?= base_url(); ?>resources/plugins/data-tables/js/data-tables.jquery.js"></script>
<script src="<?= base_url(); ?>resources/plugins/data-tables/js/data-tables.bootstrap.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#data-tables-docentes_capacitados').dataTable({
			"searching":		false,
			"scrollY":			"200px",
			"scrollCollapse":	true,
			"info":				false,
			"ordering":			false,
			"paging":			false,
			"oLanguage":		{"sEmptyTable": "No hay docentes capacitados en el centro educativo."}
		});
		$('#data-tables-docentes_certificados').dataTable({
			"searching":		false,
			"scrollY":			"200px",
			"scrollCollapse":	true,
			"info":				false,
			"ordering":			false,
			"paging":			false,
			"oLanguage":		{"sEmptyTable": "No hay docentes certificados en el centro educativo."}
		});
		$("#id_departamento").change(function() {
			$.ajax({
				type:		"get",
				datatype:	"json",
				url:		"<?= base_url('ajax/lista_municipios')?>",
				cache:		false,
				data:		{id_departamento: $("#id_departamento").val()},
				error:		function(resultado, exception) {
								$('#id_municipio').empty();
								$.each(jQuery.parseJSON(resultado.responseText), function(respuesta, lista_municipios) {
									if(lista_municipios.id_municipio == '<?= @$centro_educativo[0]->id_municipio; ?>'){
										$("#id_municipio").append($("<option></option>").attr({"value":	lista_municipios.id_municipio, "selected":	"selected"}).text(lista_municipios.nombre_municipio));
									}
									else{
										$("#id_municipio").append($("<option></option>").attr({"value":	lista_municipios.id_municipio}).text(lista_municipios.nombre_municipio));
									}
								});
				}
			});
		}).change();
	});
</script>
<?php $this->session->set_userdata('uri_usuarios', uri_string()); ?>