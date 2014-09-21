<?php
$bloqueado = $valor = '';
if($opcion == "Eliminar"){
	$bloqueado = $valor = 'disabled';
}

// Definición de los campos Datos Personales

$firstname = array(
	'name'		=>	'firstname',
	'id'		=>	'firstname',
	'maxlength'	=>	'60',
	'size'		=>	'20',
	'value'		=>	set_value('firstname', @$usuario[0]->firstname),
	'class'		=>	'form-control',
	$bloqueado	=>	$valor
);

$lastname = array(
	'name'		=>	'lastname',
	'id'		=>	'lastname',
	'maxlength'	=>	'60',
	'size'		=>	'20',
	'value'		=>	set_value('lastname', @$usuario[0]->lastname),
	'class'		=>	'form-control',
	$bloqueado	=>	$valor
);

$dui = array(
	'name'		=>	'dui',
	'id'		=>	'dui',
	'maxlength'	=>	'12',
	'size'		=>	'20',
	'value'		=>	set_value('dui', @$usuario[0]->dui),
	'class'		=>	'form-control',
	$bloqueado	=>	$valor
);

$email = array(
	'name'		=>	'email',
	'id'		=>	'email',
	'maxlength'	=>	'40',
	'size'		=>	'30',
	'value'		=>	set_value('email', @$usuario[0]->email),
	'class'		=>	'form-control',
	$bloqueado	=>	$valor
);

$profesion = array(
	'name'		=>	'profesion',
	'id'		=>	'profesion',
	'maxlength'	=>	'30',
	'size'		=>	'20',
	'value'		=>	set_value('profesion', @$usuario[0]->profesion),
	'class'		=>	'form-control',
	$bloqueado	=>	$valor
);

$centro_educativo = array(
	'name'		=>	'centro_educativo',
	'id'		=>	'centro_educativo',
	'maxlength'	=>	'50',
	'size'		=>	'20',
	'value'		=>	set_value('centro_educativo', @$usuario[0]->centro_educativo),
	'class'		=>	'form-control',
	$bloqueado	=>	$valor
);

$direccion = array(
	'name'		=>	'direccion',
	'id'		=>	'direccion',
	'rows'		=>	'3',
	'value'		=>	set_value('direccion', @$usuario[0]->direccion),
	'class'		=>	'form-control',
	$bloqueado	=>	$valor
);

// Definición de los campos Información de Usuario

$username = array(
	'name'		=>	'username',
	'id'		=>	'username',
	'maxlength'	=>	'30',
	'size'		=>	'20',
	'value'		=>	set_value('username', @$usuario[0]->username),
	'class'		=>	'form-control',
	$bloqueado	=>	$valor
);

$password = array(
	'name'		=>	'password',
	'id'		=>	'password',
	'maxlength'	=>	'20',
	'size'		=>	'20',
	'value'		=>	set_value('password', @$usuario[0]->password),
	'class'		=>	'form-control',
	$bloqueado	=>	$valor
);

$tipo_usuario = array(
	'0'			=>	'',
	'1'			=>	'Ciudadano en general',
	'2'			=>	'Estudiante de basica',
	'3'			=>	'Estudiante de media',
	'4'			=>	'Estudiante universitario',
	'5'			=>	'Docente de básica',
	'6'			=>	'Docente de media',
	'7'			=>	'Docente tecnólogo',
	'8'			=>	'Docente universitario'
);

// Definición de los campos Información de Cursos

$modalidad_capacitacion = array(
	'name'		=>	'modalidad_capacitacion',
	'id'		=>	'modalidad_capacitacion',
	'maxlength'	=>	'30',
	'size'		=>	'20',
	'value'		=>	set_value('modalidad_capacitacion', @$usuario[0]->modalidad_capacitacion),
	'class'		=>	'form-control',
	$bloqueado	=>	$valor
);

// Atributos para el Formulario

$formulario = array(
	'name'		=>	'usuarios',
	'id'		=>	'usuarios',
	'role'		=>	'form'
);

$campos_ocultos = array('id' => set_value('id', @$usuario[0]->id));

$btn_guardar = 'class="btn btn-primary" onclick="usuarios.estado.value=\'1\';"';
$btn_cancelar = 'class="btn btn-danger" onclick="location.href=\''.base_url().'usuarios/\';"';
?>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Modulo de Usuarios</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<?= heading($operacion, 3); ?>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<?= form_open('', $formulario, $campos_ocultos); ?>
								<?= form_fieldset('Datos Personales'); ?>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<?= form_label('Nombres:'); ?>
											<?= form_input($firstname); ?>
											<?= form_error('firstname'); ?>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<?= form_label('Apellidos:'); ?>
											<?= form_input($lastname); ?>
											<?= form_error('lastname'); ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<?= form_label('DUI:'); ?>
											<?= form_input($dui); ?>
											<?= form_error('dui'); ?>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<?= form_label('Correo Electrónico:'); ?>
											<?= form_input($email); ?>
											<?= form_error('email'); ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<?= form_label('Profesión:'); ?>
											<?= form_input($profesion); ?>
											<?= form_error('profesion'); ?>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<?= form_label('Centro Educativo:'); ?>
											<?= form_input($centro_educativo); ?>
											<?= form_error('centro_educativo'); ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<?= form_label('Dirección:'); ?>
											<?= form_textarea($direccion); ?>
											<?= form_error('direccion'); ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<?= form_submit('btn_guardar', $opcion, $btn_guardar); ?>
											<?= form_button('btn_cancelar','Cancelar', $btn_cancelar); ?>
										</div>
									</div>
								</div>
								<?= form_fieldset_close(); ?>
							<?= form_close(); ?>
							<?= form_open('#', 'role="form"'); ?>
								<?= form_fieldset('Información de Usuario'); ?>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<?= form_label('Nombre de Usuario:'); ?>
											<?= form_input($username); ?>
											<?= form_error('username'); ?>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<?= form_label('Contraseña:'); ?>
											<?= form_password($password); ?>
											<?= form_error('password'); ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-3">
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<?= form_label('Tipo de Usuario:'); ?>
											<?= form_dropdown('tipo_usuario', $tipo_usuario, set_value('tipo_usuario', @$usuario[0]->tipo_usuario), 'class="form-control", '.$bloqueado.'="'.$valor.'"'); ?>
											<?= form_error('tipo_usuario'); ?>
										</div>
									</div>
									<div class="col-lg-3">
									</div>
								</div>
								<?= form_fieldset_close(); ?>
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