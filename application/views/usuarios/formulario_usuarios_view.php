<?php echo doctype('html5'); ?>
<?php
// Definición de los campos Datos Personales

$firstname = array(
	'name'		=>	'firstname',
	'id'		=>	'firstname',
	'maxlength'	=>	'60',
	'size'		=>	'20',
	'value'		=>	set_value('firstname', @$usuario[0]->firstname),
	'class'		=>	'form-control input-md'
);

$lastname = array(
	'name'		=>	'lastname',
	'id'		=>	'lastname',
	'maxlength'	=>	'60',
	'size'		=>	'20',
	'value'		=>	set_value('lastname', @$usuario[0]->lastname),
	'class'		=>	'form-control input-md'
);

$dui = array(
	'name'		=>	'dui',
	'id'		=>	'dui',
	'maxlength'	=>	'12',
	'size'		=>	'20',
	'value'		=>	set_value('dui', @$usuario[0]->dui),
	'class'		=>	'form-control input-md'
);

$email = array(
	'name'		=>	'email',
	'id'		=>	'email',
	'maxlength'	=>	'40',
	'size'		=>	'30',
	'value'		=>	set_value('email', @$usuario[0]->email),
	'class'		=>	'form-control input-md'
);

$profesion = array(
	'name'		=>	'profesion',
	'id'		=>	'profesion',
	'maxlength'	=>	'30',
	'size'		=>	'20',
	'value'		=>	set_value('profesion', @$usuario[0]->profesion),
	'class'		=>	'form-control input-md'
);

$centro_educativo = array(
	'name'		=>	'centro_educativo',
	'id'		=>	'centro_educativo',
	'maxlength'	=>	'50',
	'size'		=>	'20',
	'value'		=>	set_value('centro_educativo', @$usuario[0]->centro_educativo),
	'class'		=>	'form-control input-md'
);

$direccion = array(
	'name'		=>	'direccion',
	'id'		=>	'direccion',
	'cols'		=>	'70',
	'rows'		=>	'5',
	'value'		=>	set_value('direccion', @$usuario[0]->direccion),
	'class'		=>	'form-control'
);

// Definición de los campos Información de Usuario

$username = array(
	'name'		=>	'username',
	'id'		=>	'username',
	'maxlength'	=>	'30',
	'size'		=>	'20',
	'value'		=>	set_value('username', @$usuario[0]->username),
	'class'		=>	'form-control input-md'
);

$password = array(
	'name'		=>	'password',
	'id'		=>	'password',
	'maxlength'	=>	'20',
	'size'		=>	'20',
	'value'		=>	set_value('password', @$usuario[0]->password),
	'class'		=>	'form-control input-md'
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
	'class'		=>	'form-control input-md'
);

$certificaciones_obtenidas = array(
	'1'			=>	'Grado Digital 1, Software Propietario',
	'2'			=>	'Grado Digital 2, Software Libre'
);

$cursos_recibidos = array(
	'1'			=>	'Curso Sistema Operativo Windows Vista',
	'2'			=>	'Curso Sistema Operativo Windows XP',
	'3'			=>	'Curso Procesador de Texto Microsoft Word',
	'4'			=>	'Curso Hoja de Calculo Microsoft Excel',
	'5'			=>	'Curso Microsoft Visual Basic 2008',
	'6'			=>	'Curso Microsoft Acces 2007',
	'7'			=>	'Curso Microsoft SQL Server 2008'
);

$calificaciones_cursos = array(
		'1'			=>	'Curso Sistema Operativo Windows Vista: 6.0',
		'2'			=>	'Curso Sistema Operativo Windows XP: 8.0',
		'3'			=>	'Curso Procesador de Texto Microsoft Word: 7.2',
		'4'			=>	'Curso Hoja de Calculo Microsoft Excel: 6.7',
		'5'			=>	'Curso Microsoft Visual Basic 2008: 9.0',
		'6'			=>	'Curso Microsoft Acces 2007: 7.0',
		'7'			=>	'Curso Microsoft SQL Server 2008: 8.4'
);

// Atributos para el Formulario

$formulario = array(
	'name'		=>	'usuarios',
	'id'		=>	'usuarios',
	'class'		=>	'form-horizontal'
);

$atributos_label = array(
	'class'		=>	'col-md-3 control-label'
);

$atributos_modalidad_capacitacion_label = array(
	'class'		=>	'col-md-6 control-label'
);

$campos_ocultos = array('estado' => '0');

$btn_guardar = 'class="btn btn-primary" onclick="usuarios.estado.value=\'1\';"';
$btn_cancelar = 'class="btn btn-danger" onclick="location.href=\''.base_url().'usuarios/\';"';
?>
<html>
	<head>
		<title>SYSCAP</title>
		<?php echo link_tag('librerias/plugins/bootstrap/css/bootstrap.min.css'); ?>
		<?php echo link_tag('librerias/css/estilo.css'); ?>
	</head>
	<body id="formato">
		<div id="cabeza">
			<?php echo heading('SYSCAP', 1); ?>
		</div>
		<div id="cuerpo">
			<?php echo heading($operacion, 2); ?>
			<div id="formulario">
				<?php echo form_open('', $formulario, $campos_ocultos); ?>
				<?php echo form_fieldset('Datos Personales'); ?>
					<div class="grupo">
						<div class="row form-group">
							<?php echo form_label('Nombres:', '', $atributos_label); ?>
							<div class="col-md-3"><?php echo form_input($firstname); ?><?php echo form_error('firstname'); ?></div>
							<?php echo form_label('Apellidos:', '', $atributos_label); ?>
							<div class="col-md-3"><?php echo form_input($lastname); ?><?php echo form_error('lastname'); ?></div>
						</div>
						<div class="row form-group">
							<?php echo form_label('DUI:', '', $atributos_label); ?>
							<div class="col-md-3"><?php echo form_input($dui); ?><?php echo form_error('dui'); ?></div>
							<div class="col-md-6"></div>
						</div>
						<div class="row form-group">
							<?php echo form_label('Correo Electrónico:', '', $atributos_label); ?>
							<div class="col-md-3"><?php echo form_input($email); ?><?php echo form_error('email'); ?></div>
							<div class="col-md-6"></div>
						</div>
						<div class="row form-group">
							<?php echo form_label('Profesión:', '', $atributos_label); ?>
							<div class="col-md-3"><?php echo form_input($profesion); ?><?php echo form_error('profesion'); ?></div>
							<?php echo form_label('Centro Educativo:', '', $atributos_label); ?>
							<div class="col-md-3"><?php echo form_input($centro_educativo); ?><?php echo form_error('centro_educativo'); ?></div>
						</div>
						<div class="row form-group">
							<?php echo form_label('Dirección:', '', $atributos_label); ?>
							<div class="col-md-9"><?php echo form_textarea($direccion); ?><?php echo form_error('direccion'); ?></div>
						</div>
						<div class="row form-group">
							<div class="col-md-3"></div>
							<div class="col-md-3"><?php echo form_submit('btn_guardar', $opcion, $btn_guardar); ?></div>
							<div class="col-md-3"></div>
							<div class="col-md-3"><?php echo form_button('btn_cancelar','Cancelar', $btn_cancelar); ?></div>
						</div>
					</div>
				<?php echo form_fieldset_close(); ?>
				<?php echo br();?>
				<?php echo form_fieldset('Información de Usuario'); ?>
					<div class="grupo">
						<div class="row form-group">
							<?php echo form_label('Nombre de Usuario:', '', $atributos_label); ?>
							<div class="col-md-3"><?php echo form_input($username); ?><?php echo form_error('username'); ?></div>
							<?php echo form_label('Contraseña:', '', $atributos_label); ?>
							<div class="col-md-3"><?php echo form_input($password); ?><?php echo form_error('password'); ?></div>
						</div>
						<div class="row form-group">
							<?php echo form_label('Tipo de Usuario:', '', $atributos_label); ?>
							<div class="col-md-3"><?php echo form_dropdown('tipo_usuario', $tipo_usuario, set_value('tipo_usuario', @$usuario[0]->tipo_usuario), 'class="form-control"'); ?><?php echo form_error('tipo_usuario'); ?></div>
							<div class="col-md-6"></div>
						</div>
					</div>
				<?php echo form_fieldset_close(); ?>
				<?php echo br();?>
				<?php echo form_fieldset('Información de Cursos'); ?>
					<div class="grupo">
						<div class="row form-group">
							<?php echo form_label('Modalidad de Capacitación:', '', $atributos_modalidad_capacitacion_label); ?>
							<div class="col-md-3"><?php echo form_input($modalidad_capacitacion); ?><?php echo form_error('modalidad_capacitacion'); ?></div>
							<div class="col-md-3"></div>
						</div>
						<div class="row form-group">
							<div class="col-md-6" align="center"><b>Certificaciones Obtenidas</b></div>
							<div class="col-md-6" align="center"><b>Cursos Recibidos</b></div>
						</div>
						<div class="row form-group">
							<div class="col-md-6"><?php echo form_multiselect('certificaciones_obtenidas', $certificaciones_obtenidas, set_value('certificaciones_obtenidas', @$usuario[0]->certificaciones_obtenidas), 'class="form-control"'); ?><?php echo form_error('certificaciones_obtenidas'); ?></div>
							<div class="col-md-6"><?php echo form_multiselect('cursos_recibidos', $cursos_recibidos, set_value('cursos_recibidos', @$usuario[0]->cursos_recibidos), 'class="form-control"'); ?><?php echo form_error('cursos_recibidos'); ?></div>
						</div>
						<div class="row form-group">
							<div class="col-md-12" align="center"><b>Calificaciones Obtenidas por Cursos</b></div>
						</div>
						<div class="row form-group">
							<div class="col-md-3"></div>
							<div class="col-md-6"><?php echo form_multiselect('calificaciones_cursos', $calificaciones_cursos, set_value('calificaciones_cursos', @$usuario[0]->calificaciones_cursos), 'class="form-control"'); ?><?php echo form_error('calificaciones_cursos'); ?></div>
							<div class="col-md-3"></div>
						</div>
					</div>
				<?php echo form_fieldset_close(); ?>
				<?php echo form_close(); ?>
			</div>
		</div>
	</body>
</html>