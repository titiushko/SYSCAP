
<?php
$formulario = array(
	'name'		=>	'usuarios',
	'id'		=>	'usuarios'
);

// Definición de los campos Datos Personales

$firstname = array(
	'name'		=>	'firstname',
	'id'		=>	'firstname',
	'maxlength'	=>	'60',
	'size'		=>	'20',
	'value'		=>	set_value('firstname', @$usuario[0]->firstname)
);

$lastname = array(
	'name'		=>	'lastname',
	'id'		=>	'lastname',
	'maxlength'	=>	'60',
	'size'		=>	'20',
	'value'		=>	set_value('lastname', @$usuario[0]->lastname)
);

$dui = array(
	'name'		=>	'dui',
	'id'		=>	'dui',
	'maxlength'	=>	'12',
	'size'		=>	'20',
	'value'		=>	set_value('dui', @$usuario[0]->dui) 
);

$email = array(
	'name'		=>	'email',
	'id'		=>	'email',
	'maxlength'	=>	'40',
	'size'		=>	'30',
	'value'		=>	set_value('email', @$usuario[0]->email)
);

$profesion = array(
	'name'		=>	'profesion',
	'id'		=>	'profesion',
	'maxlength'	=>	'30',
	'size'		=>	'20',
	'value'		=>	set_value('profesion', @$usuario[0]->profesion) 
);

$centro_educativo = array(
	'name'		=>	'centro_educativo',
	'id'		=>	'centro_educativo',
	'maxlength'	=>	'50',
	'size'		=>	'20',
	'value'		=>	set_value('centro_educativo', @$usuario[0]->centro_educativo)
);

$direccion = array(
	'name'		=>	'direccion',
	'id'		=>	'direccion',
	'cols'		=>	'70',
	'rows'		=>	'5',
	'value'		=>	set_value('direccion', @$usuario[0]->direccion)
);

// Definición de los campos Información de Usuario

$username = array(
	'name'		=>	'username',
	'id'		=>	'username',
	'maxlength'	=>	'30',
	'size'		=>	'20',
	'value'		=>	set_value('username', @$usuario[0]->username) 
);

$password = array(
	'name'		=>	'password',
	'id'		=>	'password',
	'maxlength'	=>	'20',
	'size'		=>	'20',
	'value'		=>	set_value('password', @$usuario[0]->password)
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
		'value'		=>	set_value('modalidad_capacitacion', @$usuario[0]->modalidad_capacitacion)
);

// --

$campos_ocultos = array('estado' => '0');
$btn_guardar = 'class="btn btn-primary" onclick="usuarios.estado.value=\'1\';"';
$btn_cancelar = 'class="btn btn-danger" onclick="location.href=\''.base_url().'usuarios/\';"';
?>
<html>
	<head>
		<title>SYSCAP</title>
		<?php echo link_tag('librerias/plugins/bootstrap/css/bootstrap.min.css'); ?>
		<?php echo link_tag('librerias/css/patron.css'); ?>
	</head>
	<body id="formato">
		<div id="cabeza">
			<?php echo heading('SYSCAP', 1); ?>
		</div>
		<div id="cuerpo">
			<?php echo heading($operacion, 2); ?>
			<?php echo form_open('', $formulario, $campos_ocultos); ?>
			<?php echo form_fieldset('Datos Personales'); ?>
			<table border="0" class="cuadricula table">
				<tr><td align="right"><?php echo form_label('Nombres:'); ?></td><td><?php echo form_input($firstname); ?><?php echo form_error('firstname'); ?></td><td align="right"><?php echo form_label('Apellidos:'); ?></td><td><?php echo form_input($lastname); ?><?php echo form_error('lastname'); ?></td></tr>
				<tr><td align="right"><?php echo form_label('DUI:'); ?></td><td><?php echo form_input($dui); ?><?php echo form_error('dui'); ?></td><td colspan="2"></td></tr>
				<tr><td align="right"><?php echo form_label('Correo Electrónico:'); ?></td><td><?php echo form_input($email); ?><?php echo form_error('email'); ?></td><td colspan="2"></td></tr>
				<tr><td align="right"><?php echo form_label('Profesión:'); ?></td><td><?php echo form_input($profesion); ?><?php echo form_error('profesion'); ?></td><td align="right"><?php echo form_label('Centro Educativo:'); ?></td><td><?php echo form_input($centro_educativo); ?><?php echo form_error('centro_educativo'); ?></td></tr>
				<tr><td align="right"><?php echo form_label('Dirección:'); ?></td><td align="left" colspan="3"><?php echo form_textarea($direccion); ?><?php echo form_error('direccion'); ?></td></tr>
				<tr><td align="center" colspan="2"><?php echo form_submit('btn_guardar',$opcion, $btn_guardar); ?></td><td align="center" colspan="2"><?php echo form_button('btn_cancelar','Cancelar', $btn_cancelar); ?></td></tr>
			</table>
			<?php echo form_fieldset_close(); ?>
			<?php echo br();?>
			<?php echo form_fieldset('Información de Usuario'); ?>
			<table border="0" class="cuadricula table">
				<tr><td align="right"><?php echo form_label('Nombre de Usuario:'); ?></td><td><?php echo form_input($username); ?><?php echo form_error('username'); ?></td><td align="right"><?php echo form_label('Contraseña:'); ?></td><td><?php echo form_password($password); ?><?php echo form_error('password'); ?></td></tr>
				<tr><td align="right"><?php echo form_label('Tipo de Usuario:'); ?></td><td><?php echo form_dropdown('tipo_usuario', $tipo_usuario, set_value('tipo_usuario', @$usuario[0]->tipo_usuario), 'style="width: 200px;"'); ?><?php echo form_error('tipo_usuario'); ?></td><td colspan="2"></td></tr>
			</table>
			<?php echo form_fieldset_close(); ?>
			<?php echo br();?>
			<?php echo form_fieldset('Información de Cursos'); ?>
			<table border="0" class="cuadricula table">
				<tr><td align="right" colspan="2"><?php echo form_label('Modalidad de Capacitación:'); ?></td><td colspan="2"><?php echo form_input($modalidad_capacitacion); ?><?php echo form_error('modalidad_capacitacion'); ?></td></tr>
			</table>
			<?php echo form_fieldset_close(); ?>
			<?php echo form_close(); ?>
		</div>
	</body>
</html>