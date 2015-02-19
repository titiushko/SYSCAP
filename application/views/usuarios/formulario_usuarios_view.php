<?php
// Atributos del Formulario
$formulario = array(
	1	=>	array(
		'name'		=>	'datos_personales',
		'id'		=>	'datos_personales',
		'role'		=>	'form'
	),
	2	=>	array(
		'name'		=>	'informacion_usuario',
		'id'		=>	'informacion_usuario',
		'role'		=>	'form'
	),
	3	=>	array(
		'name'		=>	'informacion_cursos',
		'id'		=>	'informacion_cursos',
		'role'		=>	'form'
	)
);
$campos_ocultos = array('estado' => '0', 'grupo_campos' => '');
$bloqueo_datos_personales = $valor_bloqueo_datos_personales = $bloqueo_informacion_usuario = $valor_bloqueo_informacion_usuario = '';
if($operacion == "Mostrar"){
	$bloqueo_datos_personales = $valor_bloqueo_datos_personales = $bloqueo_informacion_usuario = $valor_bloqueo_informacion_usuario = 'disabled';
	$listas_datos_personales = $bloqueo_datos_personales.'="'.$valor_bloqueo_datos_personales.'"';
	$listas_informacion_usuario = $bloqueo_informacion_usuario.'="'.$valor_bloqueo_informacion_usuario.'"';
	$boton_primario = 'class="btn btn-primary" onclick="redireccionar(\''.base_url().'usuarios/modificar/'.@$usuario[0]->id_usuario.'\');"';
	$boton_secundario = 'class="btn btn-primary" onclick="redireccionar(\''.base_url().'usuarios/recuperar_contrasena/'.@$usuario[0]->id_usuario.'\');"';
	if($this->session->userdata('uri_usuarios')){
		$uri_usuarios = $this->session->userdata('uri_usuarios');
		if(strpos($uri_usuarios, 'mostrar') != FALSE){
			$boton_regresar = 'class="btn btn-danger" onclick="redireccionar(\''.base_url().$uri_usuarios.'\');"';
		}
		else{
			$boton_regresar = 'class="btn btn-danger" onclick="redireccionar(\''.base_url().'usuarios\');"';
		}
	}
	else{
		$boton_regresar = 'class="btn btn-danger" onclick="redireccionar(\''.base_url().'usuarios\');"';
	}
}
if($operacion == "Editar"){
	$bloqueo_informacion_usuario = $valor_bloqueo_informacion_usuario = 'disabled';
	$listas_informacion_usuario = $bloqueo_informacion_usuario.'="'.$valor_bloqueo_informacion_usuario.'"';
	$boton_primario = 'class="btn btn-primary" onclick="document.datos_personales.estado.value=\'1\'; document.datos_personales.grupo_campos.value=\'datos_personales\';"';
}
if($operacion == "Recuperar Contraseña"){
	$bloqueo_datos_personales = $valor_bloqueo_datos_personales = 'disabled';
	$listas_datos_personales = $bloqueo_datos_personales.'="'.$valor_bloqueo_datos_personales.'"';
	$boton_primario = 'class="btn btn-primary" onclick="document.informacion_usuario.estado.value=\'1\'; document.informacion_usuario.grupo_campos.value=\'informacion_usuario\';"';
}
$boton_cancelar = 'class="btn btn-danger" onclick="redireccionar(\''.base_url().'usuarios/mostrar/'.@$usuario[0]->id_usuario.'\');"';
// Definición de los campos Datos Personales
$nombres_usuario = array(
	'name'		=>	'nombres_usuario',
	'id'		=>	'nombres_usuario',
	'maxlength'	=>	'60',
	'size'		=>	'20',
	'value'		=>	utf8(set_value('nombres_usuario', @$usuario[0]->nombres_usuario)),
	'class'		=>	'form-control',
	$bloqueo_datos_personales	=>	$valor_bloqueo_datos_personales
);
$apellido1_usuario = array(
	'name'		=>	'apellido1_usuario',
	'id'		=>	'apellido1_usuario',
	'maxlength'	=>	'60',
	'size'		=>	'20',
	'value'		=>	utf8(set_value('apellido1_usuario', @$usuario[0]->apellido1_usuario)),
	'class'		=>	'form-control',
	$bloqueo_datos_personales	=>	$valor_bloqueo_datos_personales
);
$dui_usuario = array(
	'name'		=>	'dui_usuario',
	'id'		=>	'dui_usuario',
	'maxlength'	=>	'12',
	'size'		=>	'20',
	'value'		=>	set_value('dui_usuario', formato_dui(@$usuario[0]->dui_usuario)),
	'class'		=>	'form-control',
	$bloqueo_datos_personales	=>	$valor_bloqueo_datos_personales
);
$correo_electronico_usuario = array(
	'name'		=>	'correo_electronico_usuario',
	'id'		=>	'correo_electronico_usuario',
	'maxlength'	=>	'40',
	'size'		=>	'30',
	'type'		=>	'email',
	'value'		=>	set_value('correo_electronico_usuario', @$usuario[0]->correo_electronico_usuario),
	'class'		=>	'form-control',
	$bloqueo_datos_personales	=>	$valor_bloqueo_datos_personales
);
$direccion_usuario = array(
	'name'		=>	'direccion_usuario',
	'id'		=>	'direccion_usuario',
	'rows'		=>	'3',
	'value'		=>	utf8(set_value('direccion_usuario', @$usuario[0]->direccion_usuario)),
	'class'		=>	'form-control',
	$bloqueo_datos_personales	=>	$valor_bloqueo_datos_personales
);
// Definición de los campos Información de Usuario
$nombre_usuario = array(
	'name'		=>	'nombre_usuario',
	'id'		=>	'nombre_usuario',
	'maxlength'	=>	'30',
	'size'		=>	'20',
	'value'		=>	set_value('nombre_usuario', @$usuario[0]->nombre_usuario),
	'class'		=>	'form-control',
	$bloqueo_informacion_usuario	=>	$valor_bloqueo_informacion_usuario
);
$contrasena_usuario = array(
	'name'		=>	'contrasena_usuario',
	'id'		=>	'contrasena_usuario',
	'maxlength'	=>	'20',
	'size'		=>	'20',
	'value'		=>	set_value('contrasena_usuario', @$usuario[0]->contrasena_usuario),
	'class'		=>	'form-control',
	$bloqueo_informacion_usuario	=>	$valor_bloqueo_informacion_usuario
);
// Definición de los campos Información de Cursos
$modalidad_usuario = array(
	'name'		=>	'modalidad_usuario',
	'id'		=>	'modalidad_usuario',
	'maxlength'	=>	'30',
	'size'		=>	'20',
	'value'		=>	utf8(set_value('modalidad_usuario', @$usuario[0]->modalidad_usuario)),
	'class'		=>	'form-control',
	'disabled'	=>	'disabled'
);
?>
<script src="<?= base_url(); ?>resources/js/validaciones-usuarios.js"></script>
<div class="row">
	<div class="col-lg-12">
		<h1 class="well page-header">Modulo de Usuarios</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<?= heading($operacion.' Usuario', 2); ?>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<?= form_open('index.php/usuarios/modificar/'.@$usuario[0]->id_usuario, $formulario[1], $campos_ocultos); ?>
							<?= form_fieldset(heading('Datos Personales', 3)); ?>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<?= form_label('Nombres:'); ?>
										<?= form_input($nombres_usuario); ?>
										<?= form_error('nombres_usuario'); ?>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<?= form_label('Apellidos:'); ?>
										<?= form_input($apellido1_usuario); ?>
										<?= form_error('apellido1_usuario'); ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<?= form_label('DUI:'); ?>
										<?= form_input($dui_usuario); ?>
										<?= form_error('dui_usuario'); ?>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<?= form_label('Correo Electrónico:'); ?>
										<?= form_input($correo_electronico_usuario); ?>
										<?= form_error('correo_electronico_usuario'); ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<?= form_label('Profesión:'); ?>
										<?= form_dropdown('id_profesion', $lista_profesiones, set_value('id_profesion', @$usuario[0]->id_profesion), 'class="form-control" '.@$listas_datos_personales); ?>
										<?= form_error('id_profesion'); ?>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<?= form_label('Centro Educativo:'); ?>
										<?= form_dropdown('id_centro_educativo', $lista_centros_educativos, set_value('id_centro_educativo', @$usuario[0]->id_centro_educativo), 'class="form-control" '.@$listas_datos_personales); ?>
										<?= form_error('id_centro_educativo'); ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<?= form_label('Dirección:'); ?>
										<?= form_textarea($direccion_usuario); ?>
										<?= form_error('direccion_usuario'); ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<?php if($operacion == "Mostrar"){ ?>
										<?= form_button('boton_primario', 'Editar', $boton_primario); ?>
										<?= form_button('boton_regresar','Regresar', $boton_regresar); ?>
										<?php } else if($operacion == "Editar"){ ?>
										<?= form_submit('boton_primario', 'Guardar', $boton_primario); ?>
										<?= form_button('boton_secundario', 'Cancelar', $boton_cancelar); ?>
										<?php } ?>
									</div>
								</div>
							</div>
							<?= form_fieldset_close(); ?>
						<?= form_close(); ?>
						<?= form_open('index.php/usuarios/modificar/'.@$usuario[0]->id_usuario, $formulario[2], $campos_ocultos); ?>
							<?= form_fieldset(heading('Información de Usuario', 3)); ?>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<?= form_label('Nombre de Usuario:'); ?>
										<?= form_input($nombre_usuario); ?>
										<?= form_error('nombre_usuario'); ?>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<?= form_label('Contraseña:'); ?>
										<?= form_password($contrasena_usuario); ?>
										<?= form_error('contrasena_usuario'); ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3">
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<?= form_label('Tipo de Usuario:'); ?>
										<?= form_dropdown('id_tipo_usuario', $lista_tipos_usuarios, set_value('id_tipo_usuario', @$usuario[0]->id_tipo_usuario), 'class="form-control" '.@$listas_informacion_usuario); ?>
										<?= form_error('id_tipo_usuario'); ?>
									</div>
								</div>
								<div class="col-lg-3">
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<?php if($operacion == "Mostrar"){ ?>
										<?= form_button('boton_primario', 'Recuperar Contraseña', $boton_secundario); ?>
										<?php } else if($operacion == "Recuperar Contraseña"){ ?>
										<?= form_submit('boton_primario', 'Guardar', $boton_primario); ?>
										<?= form_button('boton_secundario', 'Cancelar', $boton_cancelar); ?>
										<?php } ?>
									</div>
								</div>
							</div>
							<?= form_fieldset_close(); ?>
						<?= form_close(); ?>
						<?= form_open('index.php/usuarios/modificar/'.@$usuario[0]->id_usuario, $formulario[3], $campos_ocultos); ?>
							<?= form_fieldset(heading('Información de Cursos', 3)); ?>
							<div class="row">
								<div class="col-lg-3">
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<?= form_label('Modalidad de Capacitación:'); ?>
										<?= form_input($modalidad_usuario); ?>
										<?= form_error('modalidad_usuario'); ?>
									</div>
								</div>
								<div class="col-lg-3">
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<?= heading('Certificaciones Obtenidas', 4, 'class="text-center"'); ?>
									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover" id="data-tables-certificaciones_usuario">
											<thead>
												<tr>
													<th>#</th>
													<th>Nombre de la Certificación</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$certificaciones = 1;
												foreach($lista_certificaciones_usuario as $certificacion){
												?>
												<tr>
													<td><?= $certificaciones; ?></td>
													<td><?= utf8($certificacion->nombre); ?></td>
												</tr>
												<?php
													$certificaciones++;
												}
												?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="col-lg-6">
									<?= heading('Cursos Recibidos y Calificaciones Obtenidas', 4, 'class="text-center"'); ?>
									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover" id="data-tables-calificaciones_usuario">
											<thead>
												<tr>
													<th>#</th>
													<th>Nombre del Curso</th>
													<th>Calificación</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$cursos = 1;
												foreach($lista_calificaciones_usuario as $curso){
												?>
												<tr>
													<td><?= $cursos; ?></td>
													<td><?= utf8($curso->nombre); ?></td>
													<td><?= $curso->nota; ?></td>
												</tr>
												<?php
													$cursos++;
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
								<a href="<?= base_url().'usuarios/imprimir/'.@$usuario[0]->id_usuario; ?>" target="_blank" class="btn btn-success"><i class="fa fa-print"></i> Imprimir</a>
								<?php } ?>
								<a href="<?= base_url().'usuarios/exportar/'.@$usuario[0]->id_usuario; ?>" target="_blank" class="btn btn-success"><i class="fa fa-file-pdf-o"></i> Exportar</a>
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
	$('#data-tables-certificaciones_usuario').dataTable({
		"searching":		false,
		"scrollY":			"200px",
		"scrollCollapse":	true,
		"info":				false,
		"ordering":			false,
		"paging":			false,
		"oLanguage":		{"sEmptyTable": "El usuario no tiene certificaciones."}
	});
	$('#data-tables-calificaciones_usuario').dataTable({
		"searching":		false,
		"scrollY":			"200px",
		"scrollCollapse":	true,
		"info":				false,
		"ordering":			false,
		"paging":			false,
		"oLanguage":		{"sEmptyTable": "El usuario no a recibido cursos."}
	});
});
</script>