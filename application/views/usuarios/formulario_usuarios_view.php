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

$campos_ocultos = array('estado' => '0');

$bloqueo_datos_personales = $valor_bloqueo_datos_personales = $bloqueo_informacion_usuario = $valor_bloqueo_informacion_usuario = '';

if($operacion == "Mostrar"){
	$bloqueo_datos_personales = $valor_bloqueo_datos_personales = $bloqueo_informacion_usuario = $valor_bloqueo_informacion_usuario = 'disabled';
	$listas_datos_personales = $bloqueo_datos_personales.'="'.$valor_bloqueo_datos_personales.'"';
	$listas_informacion_usuario = $bloqueo_informacion_usuario.'="'.$valor_bloqueo_informacion_usuario.'"';
	
	$boton_primario = 'class="btn btn-primary" onclick="location.href=\''.base_url().'usuarios/modificar/'.@$usuario[0]->id_usuario.'\';"';
	$boton_secundario = 'class="btn btn-primary" onclick="location.href=\''.base_url().'usuarios/recuperar_contrasena/'.@$usuario[0]->id_usuario.'\';"';
	$boton_regresar = 'class="btn btn-danger" onclick="location.href=\''.base_url().'usuarios\';"';
}
if($operacion == "Editar"){
	$bloqueo_informacion_usuario = $valor_bloqueo_informacion_usuario = 'disabled';
	$listas_informacion_usuario = $bloqueo_informacion_usuario.'="'.$valor_bloqueo_informacion_usuario.'"';
	
	$boton_primario = 'class="btn btn-primary" onclick="document.datos_personales.estado.value=\'1\';"';
}
if($operacion == "Recuperar Contraseña"){
	$bloqueo_datos_personales = $valor_bloqueo_datos_personales = 'disabled';
	$listas_datos_personales = $bloqueo_datos_personales.'="'.$valor_bloqueo_datos_personales.'"';
	
	$boton_primario = 'class="btn btn-primary" onclick="document.informacion_usuario.estado.value=\'1\';"';
}
$boton_cancelar = 'class="btn btn-danger" onclick="location.href=\''.base_url().'usuarios/mostrar/'.@$usuario[0]->id_usuario.'\';"';

// Definición de los campos Datos Personales

$nombres_usuario = array(
	'name'		=>	'nombres_usuario',
	'id'		=>	'nombres_usuario',
	'maxlength'	=>	'60',
	'size'		=>	'20',
	'value'		=>	htmlentities(set_value('nombres_usuario', @$usuario[0]->nombres_usuario), ENT_COMPAT, 'UTF-8'),
	'class'		=>	'form-control',
	$bloqueo_datos_personales	=>	$valor_bloqueo_datos_personales
);

$apellido1_usuario = array(
	'name'		=>	'apellido1_usuario',
	'id'		=>	'apellido1_usuario',
	'maxlength'	=>	'60',
	'size'		=>	'20',
	'value'		=>	htmlentities(set_value('apellido1_usuario', @$usuario[0]->apellido1_usuario), ENT_COMPAT, 'UTF-8'),
	'class'		=>	'form-control',
	$bloqueo_datos_personales	=>	$valor_bloqueo_datos_personales
);

$dui_usuario = array(
	'name'		=>	'dui_usuario',
	'id'		=>	'dui_usuario',
	'maxlength'	=>	'12',
	'size'		=>	'20',
	'value'		=>	htmlentities(set_value('dui_usuario', @$usuario[0]->dui_usuario), ENT_COMPAT, 'UTF-8'),
	'class'		=>	'form-control',
	$bloqueo_datos_personales	=>	$valor_bloqueo_datos_personales
);

$correo_electronico_usuario = array(
	'name'		=>	'correo_electronico_usuario',
	'id'		=>	'correo_electronico_usuario',
	'maxlength'	=>	'40',
	'size'		=>	'30',
	'value'		=>	htmlentities(set_value('correo_electronico_usuario', @$usuario[0]->correo_electronico_usuario), ENT_COMPAT, 'UTF-8'),
	'class'		=>	'form-control',
	$bloqueo_datos_personales	=>	$valor_bloqueo_datos_personales
);

$direccion_usuario = array(
	'name'		=>	'direccion_usuario',
	'id'		=>	'direccion_usuario',
	'rows'		=>	'3',
	'value'		=>	htmlentities(set_value('direccion_usuario', @$usuario[0]->direccion_usuario), ENT_COMPAT, 'UTF-8'),
	'class'		=>	'form-control',
	$bloqueo_datos_personales	=>	$valor_bloqueo_datos_personales
);

// Definición de los campos Información de Usuario

$nombre_usuario = array(
	'name'		=>	'nombre_usuario',
	'id'		=>	'nombre_usuario',
	'maxlength'	=>	'30',
	'size'		=>	'20',
	'value'		=>	htmlentities(set_value('nombre_usuario', @$usuario[0]->nombre_usuario), ENT_COMPAT, 'UTF-8'),
	'class'		=>	'form-control',
	$bloqueo_informacion_usuario	=>	$valor_bloqueo_informacion_usuario
);

$contrasena_usuario = array(
	'name'		=>	'contrasena_usuario',
	'id'		=>	'contrasena_usuario',
	'maxlength'	=>	'20',
	'size'		=>	'20',
	'value'		=>	htmlentities(set_value('contrasena_usuario', @$usuario[0]->contrasena_usuario), ENT_COMPAT, 'UTF-8'),
	'class'		=>	'form-control',
	$bloqueo_informacion_usuario	=>	$valor_bloqueo_informacion_usuario
);

// Definición de los campos Información de Cursos

$modalidad_capacitacion = array(
	'name'		=>	'modalidad_capacitacion',
	'id'		=>	'modalidad_capacitacion',
	'maxlength'	=>	'30',
	'size'		=>	'20',
	'value'		=>	htmlentities(set_value('modalidad_capacitacion', @$usuario[0]->modalidad_capacitacion), ENT_COMPAT, 'UTF-8'),
	'class'		=>	'form-control',
	'disabled'	=>	'disabled'
);
?>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="well page-header">Modulo de Usuarios</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<!-- Modal -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="myModalLabel">Resultado</h4>
						</div>
						<div class="modal-body">
							<?= @$mensaje_notificacion; ?>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<?= heading($operacion.' Usuario', 3); ?>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<?= form_open('index.php/usuarios/modificar/'.@$usuario[0]->id_usuario, $formulario[1], $campos_ocultos); ?>
								<?= form_fieldset('Datos Personales'); ?>
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
											<?= form_dropdown('id_profesion', $lista_profesiones, htmlentities(set_value('id_profesion', @$usuario[0]->id_profesion), ENT_COMPAT, 'UTF-8'), 'class="form-control" '.@$listas_datos_personales); ?>
											<?= form_error('id_profesion'); ?>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<?= form_label('Centro Educativo:'); ?>
											<?= form_dropdown('id_centro_educativo', $lista_centros_educativos, htmlentities(set_value('id_centro_educativo', @$usuario[0]->id_centro_educativo), ENT_COMPAT, 'UTF-8'), 'class="form-control" '.@$listas_datos_personales); ?>
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
											<script>document.datos_personales.nombres_usuario.focus();</script>
											<?php } ?>
										</div>
									</div>
								</div>
								<?= form_fieldset_close(); ?>
							<?= form_close(); ?>
							<?= form_open('index.php/usuarios/modificar/'.@$usuario[0]->id_usuario, $formulario[2], $campos_ocultos); ?>
								<?= form_fieldset('Información de Usuario'); ?>
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
											<?= form_dropdown('id_tipo_usuario', $lista_tipos_usuarios, htmlentities(set_value('id_tipo_usuario', @$usuario[0]->id_tipo_usuario), ENT_COMPAT, 'UTF-8'), 'class="form-control" '.@$listas_informacion_usuario); ?>
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
											<script>document.informacion_usuario.nombre_usuario.focus();</script>
											<?php } ?>
										</div>
									</div>
								</div>
								<?= form_fieldset_close(); ?>
							<?= form_close(); ?>
							<?= form_open('index.php/usuarios/modificar/'.@$usuario[0]->id_usuario, $formulario[3], $campos_ocultos); ?>
								<?= form_fieldset('Información de Cursos'); ?>
								<div class="row">
									<div class="col-lg-3">
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<?= form_label('Modalidad de Capacitación:'); ?>
											<?= form_input($modalidad_capacitacion); ?>
											<?= form_error('modalidad_capacitacion'); ?>
										</div>
									</div>
									<div class="col-lg-3">
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<?= form_label('Certificaciones Obtenidas:'); ?>
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>#</th>
														<th>Nombre de la Certificación</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>1</td>
														<td>Grado Digital 1, Software Propietario</td>
													</tr>
													<tr>
														<td>2</td>
														<td>Grado Digital 2, Software Libre (Moodle)</td>
													</tr>
													<tr>
														<td>3</td>
														<td>Grado Digital 3, Software Libre (Web 2.0)</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="col-lg-6">
										<?= form_label('Cursos Recibidos:'); ?>
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>#</th>
														<th>Nombre del Curso</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>1</td>
														<td>Curso Sistema Operativo Windows Vista</td>
													</tr>
													<tr>
														<td>2</td>
														<td>Curso Sistema Operativo Windows XP</td>
													</tr>
													<tr>
														<td>3</td>
														<td>Curso Procesador de Texto Microsoft Word</td>
													</tr>
													<tr>
														<td>4</td>
														<td>Curso Hoja de Calculo Microsoft Excel</td>
													</tr>
													<tr>
														<td>5</td>
														<td>Curso Microsoft Visual Basic 2008</td>
													</tr>
													<tr>
														<td>6</td>
														<td>Curso Microsoft Acces 2007</td>
													</tr>
													<tr>
														<td>7</td>
														<td>Curso Microsoft SQL Server 2008</td>
													</tr>
													<tr>
														<td>8</td>
														<td>Curso Moodle Estudiantes</td>
													</tr>
													<tr>
														<td>9</td>
														<td>Curso Moodle Administradores</td>
													</tr>
													<tr>
														<td>10</td>
														<td>Curso Moodle Tutores</td>
													</tr>
													<tr>
														<td>11</td>
														<td>Curso Herramientas de WEB 2.0</td>
													</tr>
													<tr>
														<td>12</td>
														<td>Curso Sistema Operativo Linux Ubuntu</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-3">
									</div>
									<div class="col-lg-6">
										<?= form_label('Calificaciones Obtenidas por Cursos:'); ?>
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>#</th>
														<th>Nombre del Curso</th>
														<th>Calificación</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>1</td>
														<td>Curso Sistema Operativo Windows Vista</td>
														<td>7.2</td>
													</tr>
													<tr>
														<td>2</td>
														<td>Curso Sistema Operativo Windows XP</td>
														<td>7.0</td>
													</tr>
													<tr>
														<td>3</td>
														<td>Curso Procesador de Texto Microsoft Word</td>
														<td>8.0</td>
													</tr>
													<tr>
														<td>4</td>
														<td>Curso Hoja de Calculo Microsoft Excel</td>
														<td>7.5</td>
													</tr>
													<tr>
														<td>5</td>
														<td>Curso Microsoft Visual Basic 2008</td>
														<td>6.3</td>
													</tr>
													<tr>
														<td>6</td>
														<td>Curso Microsoft Acces 2007</td>
														<td>7.1</td>
													</tr>
													<tr>
														<td>7</td>
														<td>Curso Microsoft SQL Server 2008</td>
														<td>6.0</td>
													</tr>
													<tr>
														<td>8</td>
														<td>Curso Moodle Estudiantes</td>
														<td>9.0</td>
													</tr>
													<tr>
														<td>9</td>
														<td>Curso Moodle Administradores</td>
														<td>8.8</td>
													</tr>
													<tr>
														<td>10</td>
														<td>Curso Moodle Tutores</td>
														<td>8.0</td>
													</tr>
													<tr>
														<td>11</td>
														<td>Curso Herramientas de WEB 2.0</td>
														<td>9.7</td>
													</tr>
													<tr>
														<td>12</td>
														<td>Curso Sistema Operativo Linux Ubuntu</td>
														<td>6.0</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="col-lg-3">
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