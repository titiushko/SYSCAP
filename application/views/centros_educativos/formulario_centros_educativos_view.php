<?php
$bloqueo_informacion_general = $valor_bloqueo_informacion_general = '';
if($operacion == "Mostrar"){
	$bloqueo_informacion_general = $valor_bloqueo_informacion_general = 'disabled';
}

// Definición de los campos Información General

$nombre_centro_educativo = array(
	'name'		=> 'nombre_centro_educativo',
	'id'		=> 'nombre_centro_educativo',
	'maxlength'	=> '60',
	'size'		=> '20',
	'value'		=> htmlentities(set_value('nombre_centro_educativo', @$centro_educativo[0]->nombre_centro_educativo), ENT_COMPAT, 'UTF-8'),
	'class'		=> 'form-control text-capitalize',
	$bloqueo_informacion_general => $valor_bloqueo_informacion_general
);

$codigo_centro_educativo = array(
	'name'		=> 'codigo_centro_educativo',
	'id'		=> 'codigo_centro_educativo',
	'maxlength'	=> '60',
	'size'		=> '20',
	'value'		=> htmlentities(set_value('codigo_centro_educativo', @$centro_educativo[0]->codigo_centro_educativo), ENT_COMPAT, 'UTF-8'),
	'class'		=> 'form-control',
	$bloqueo_informacion_general => $valor_bloqueo_informacion_general
);

// Atributos del Formulario

$formulario = array(
	'name'		=> 'centros_educativos',
	'id'		=> 'centros_educativos',
	'role'		=> 'form'
);

$campos_ocultos = array('estado' => '0');

if($operacion == "Mostrar"){
	$boton_primario = 'class="btn btn-primary" onclick="location.href=\''.base_url().'centros_educativos/modificar/'.@$centro_educativo[0]->id_centro_educativo.'\';"';
	$boton_secundario = 'class="btn btn-danger" onclick="location.href=\''.base_url().'centros_educativos\';"';
}
else{
	$boton_primario = 'class="btn btn-primary" onclick="document.centros_educativos.estado.value=\'1\';"';
	$boton_secundario = 'class="btn btn-danger" onclick="location.href=\''.base_url().'centros_educativos/mostrar/'.@$centro_educativo[0]->id_centro_educativo.'\';"';
}
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="well page-header">Modulo de Centros Educativos</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<?= heading($operacion.' Centro Educativo', 3); ?>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<?= form_open('index.php/centros_educativos/modificar/'.@$centro_educativo[0]->id_centro_educativo, $formulario, $campos_ocultos); ?>
							<?= form_fieldset('Información General'); ?>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<?= form_label('Nombre'); ?>
										<?= form_input($nombre_centro_educativo); ?>
										<?= form_error('nombre_centro_educativo'); ?>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<?= form_label('Código'); ?>
										<?= form_input($codigo_centro_educativo); ?>
										<?= form_error('codigo_centro_educativo'); ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<?= form_label('Departamento'); ?>
										<?= form_dropdown('id_departamento', $lista_departamentos, htmlentities(set_value('id_departamento', @$centro_educativo[0]->id_departamento), ENT_COMPAT, 'UTF-8'), 'class="form-control", '.$bloqueo_informacion_general.'="'.$valor_bloqueo_informacion_general.'"'); ?>
										<?= form_error('id_departamento'); ?>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<?= form_label('Municipio'); ?>
										<?= form_dropdown('id_municipio', $lista_municipios, htmlentities(set_value('id_municipio', @$centro_educativo[0]->id_municipio), ENT_COMPAT, 'UTF-8'), 'class="form-control", '.$bloqueo_informacion_general.'="'.$valor_bloqueo_informacion_general.'"'); ?>
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
										<script>document.centros_educativos.nombre_centro_educativo.focus();</script>
										<?php } ?>
									</div>
								</div>
							</div>
							<?= form_fieldset_close(); ?>
							<?= form_fieldset('Certificaciones'); ?>
							<div class="row">
								<div class="col-lg-6">
									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover" id="data-tables-docentes_capacitados">
											<thead>
												<tr>
													<th>#</th>
													<th>Docentes Capacitados</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$docentes_capacitados = 1;
												foreach($lista_docentes_capacitados as $docente_capacitado){
												?>
												<tr>
													<td><?= $docentes_capacitados; ?></td>
													<td><?= htmlentities($docente_capacitado->nombre_completo_usuario, ENT_COMPAT, 'UTF-8'); ?></td>
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
										<table class="table table-striped table-bordered table-hover" id="data-tables-docentes_certificados">
											<thead>
												<tr>
													<th>#</th>
													<th>Docentes Certificados</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$docentes_certificados = 1;
												foreach($lista_docentes_certificados as $docente_certificado){
												?>
												<tr>
													<td><?= $docentes_certificados; ?></td>
													<td><?= htmlentities($docente_certificado->nombre_completo_usuario, ENT_COMPAT, 'UTF-8'); ?></td>
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
							<div class="col-lg-12">&nbsp;</div>
						</div>
						<div class="row">
							<div class="col-lg-12 text-center">
								<a class="btn btn-success"><i class="fa fa-print"></i> Imprimir</a>
								<a href="<?= base_url(); ?>centros_educativos/exportar" target="_blank" class="btn btn-success"><i class="fa fa-file-pdf-o"></i> Exportar</a>
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
<script>
$(document).ready(function() {
	$('#data-tables-docentes_capacitados').dataTable({
		"searching":		false,
        "scrollY":			"200px",
        "scrollCollapse":	true,
        "info":				false,
        "ordering":			false,
        "paging":			false,
        "oLanguage": {
            "sEmptyTable": "No hay Docentes Capacitados en éste Centro Educativo."
          }
	});
	$('#data-tables-docentes_certificados').dataTable({
		"searching":		false,
        "scrollY":			"200px",
        "scrollCollapse":	true,
        "info":				false,
        "ordering":			false,
        "paging":			false,
        "oLanguage": {
        	"sEmptyTable": "No hay Docentes Certificados en éste Centro Educativo."
          }
	});
});
</script>