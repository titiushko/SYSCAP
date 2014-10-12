<?php
$bloqueo_informacion_general = $valor_bloqueo_informacion_general = '';
if($operacion == "Mostrar"){
	$bloqueo_informacion_general = $valor_bloqueo_informacion_general = 'disabled';
}

// Definición de los campos Información General

$nombre = array(
	'name'		=> 'nombre',
	'id'		=> 'nombre',
	'maxlength'	=> '60',
	'size'		=> '20',
	'value'		=> htmlentities(set_value('nombre', @$centro_educativo[0]->nombre), ENT_COMPAT, 'UTF-8'),
	'class'		=> 'form-control',
	$bloqueo_informacion_general => $valor_bloqueo_informacion_general
);

$codigo_entidad = array(
	'name'		=> 'codigo_entidad',
	'id'		=> 'codigo_entidad',
	'maxlength'	=> '60',
	'size'		=> '20',
	'value'		=> htmlentities(set_value('codigo_entidad', @$centro_educativo[0]->codigo_entidad), ENT_COMPAT, 'UTF-8'),
	'class'		=> 'form-control',
	$bloqueo_informacion_general => $valor_bloqueo_informacion_general
);

$lista_departamentos = array(
	'0'		=> '',
	'1'		=> 'San Salvador',
	'2'		=> 'La Libertad'
);

$lista_municipios = array(
	'0'		=> '',
	'1'		=> 'San Marcos',
	'2'		=> 'Apopa'
);

// Atributos del Formulario

$formulario = array(
	'name'		=> 'centros_educativos',
	'id'		=> 'centros_educativos',
	'role'		=> 'form'
);

$campos_ocultos = array(
	'row_id' => htmlentities(set_value('row_id', @$centro_educativo[0]->row_id), ENT_COMPAT, 'UTF-8'),
	'estado' => '0'
);

if($operacion == "Mostrar"){
	$boton_primario = 'class="btn btn-primary" onclick="location.href=\''.base_url().'centros_educativos/modificar/'.@$centro_educativo[0]->row_id.'\';"';
	$boton_secundario = 'class="btn btn-danger" onclick="location.href=\''.base_url().'centros_educativos\';"';
}
else{
	$boton_primario = 'class="btn btn-primary" onclick="document.centros_educativos.estado.value=\'1\';"';
	$boton_secundario = 'class="btn btn-danger" onclick="location.href=\''.base_url().'centros_educativos/mostrar/'.@$centro_educativo[0]->row_id.'\';"';
}
?>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Modulo de Centros Educativos</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<?= heading($operacion.' Centro Educativo', 3); ?>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<?= form_open('', $formulario, $campos_ocultos); ?>
								<?= form_fieldset('Información General'); ?>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<?= form_label('Nombre'); ?>
											<?= form_input($nombre); ?>
											<?= form_error('nombre'); ?>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<?= form_label('Código'); ?>
											<?= form_input($codigo_entidad); ?>
											<?= form_error('codigo_entidad'); ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<?= form_label('Departamento'); ?>
											<?= form_dropdown('depto', $lista_departamentos, htmlentities(set_value('depto', @$centro_educativo[0]->depto), ENT_COMPAT, 'UTF-8'), 'class="form-control", '.$bloqueo_informacion_general.'="'.$valor_bloqueo_informacion_general.'"'); ?>
											<?= form_error('depto'); ?>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<?= form_label('Municipio'); ?>
											<?= form_dropdown('muni', $lista_municipios, htmlentities(set_value('muni', @$centro_educativo[0]->muni), ENT_COMPAT, 'UTF-8'), 'class="form-control", '.$bloqueo_informacion_general.'="'.$valor_bloqueo_informacion_general.'"'); ?>
											<?= form_error('muni'); ?>
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
											<script>document.centros_educativos.nombre.focus();</script>
											<?php } ?>
										</div>
									</div>
								</div>
								<?= form_fieldset_close(); ?>
								<?= form_fieldset('Certificaciones'); ?>
								<div class="row">
									<div class="col-lg-6">
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>#</th>
														<th>Docentes Capacitados</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>1</td>
														<td>Tito Miguel</td>
													</tr>
													<tr>
														<td>2</td>
														<td>Javier Galdámez</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>#</th>
														<th>Docentes Certificados</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>1</td>
														<td>Tito</td>
													</tr>
													<tr>
														<td>2</td>
														<td>Javier</td>
													</tr>
													<tr>
														<td>3</td>
														<td>Francisco</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<?= form_fieldset_close(); ?>
							<?= form_close(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>