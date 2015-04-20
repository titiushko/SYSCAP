<?= doctype('html5'); ?>
<html lang="en">
	<head>
		<?php
		$metainformaciones = array(
			array('name'	=>	'robots', 'content'				=>	'no-cache'),
			array('name'	=>	'description', 'content'		=>	'Sistema Informático para apoyar el Control y Administración de Capacitaciones - SYSCAP'),
			array('name'	=>	'keywords', 'content'			=>	'mined, grado digital, capacitaciones, syscap'),
			array('name'	=>	'X-UA-Compatible', 'content'	=>	'IE=edge', 'type' => 'equiv'),
			array('name'	=>	'viewport', 'content'			=>	'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'),
			// array('name'	=>	'Content-type', 'content'		=>	'text/html; charset=utf-8', 'type' => 'equiv'),
			array('name'	=>	'Content-type', 'content'		=>	'text/html; charset=ISO-8859-1', 'type' => 'equiv'),
			array('name'	=>	'expires', 'content'			=>	'0', 'type' => 'equiv'),
			array('name'	=>	'pragma', 'content'				=>	'no-cache', 'type' => 'equiv')
		);
		echo meta($metainformaciones);
		?>
	    <title>SYSCAP</title>
	    <?= link_tag('resources/plugins/bootstrap/css/bootstrap.min.css'); ?>
	    <?= link_tag('resources/plugins/bootstrap/css/bootstrap-responsive.min.css'); ?>
	    <?= link_tag('resources/plugins/sb-admin/css/sb-admin.css'); ?>
	    <?= link_tag('resources/plugins/font-awesome/css/font-awesome.min.css'); ?>
	    <?= link_tag('resources/css/estilo.css'); ?>
	    <?= link_tag('resources/img/syscap.ico', 'shortcut icon', 'image/ico'); ?>
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	        <script type="text/javascript" src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	        <script type="text/javascript" src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	    <![endif]-->
	    <script type="text/javascript" src="<?= base_url(); ?>resources/plugins/jquery/prototype.js"></script>
	    <script type="text/javascript" src="<?= base_url(); ?>resources/js/funciones.js"></script>
	    <?php
			$formulario = array('name' => 'login', 'id' => 'login', 'role' => 'form');
			$campos_ocultos = array('sesion_usuario' => @$sesion_usuario);
			$boton_primario = array(
				'name'		=> 'boton_primario',
				'id'		=> 'boton_primario',
				'value'		=> 'true',
				'type'		=> 'submit',
				'content'	=> '<i class="fa fa-sign-in"></i> Iniciar Sesi&oacute;n',
				'class'		=> 'btn btn-lg btn-success btn-block'
			);
	        $nombre_usuario = array(
        		'name'			=> 'nombre_usuario',
        		'id'			=> 'nombre_usuario',
				'type'			=> 'text',
				'autocomplete'	=> 'off',
        		'placeholder'	=> 'Nombre de usuario',
				'value'			=>	set_value('nombre_usuario', @$usuario[0]->nombre_usuario),
        		'class'			=> 'form-control',
				'autofocus'		=> 'autofocus'
	        );
			$contrasena_usuario = array(
				'name'			=> 'contrasena_usuario',
				'id'			=> 'contrasena_usuario',
				'type'			=> 'password',
				'autocomplete'	=> 'off',
				'placeholder'	=> 'Contraseña',
				'value'			=>	set_value('contrasena_usuario', @$usuario[0]->contrasena_usuario),
				'class'			=> 'form-control',
				'onKeyPress'	=> 'bloq_mayus(event)'
			);
	    ?>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="login-panel panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Acceder a SYSCAP</h3>
						</div>
						<div class="panel-body">
							<?= form_open('index.php/sesion/iniciar_sesion', $formulario, $campos_ocultos); ?>
								<?= form_fieldset(); ?>
									<div class="form-group">
										<?= form_input($nombre_usuario); ?>
										<?= form_error('nombre_usuario'); ?>
										<div id="nombre_usuario_incorrecto" class="oculto" title="¡Error!">
											<?= icono_notificacion('error'); ?>Nombre de usuario incorrecto.
										</div>
									</div>
									<div class="form-group">
										<?= form_input($contrasena_usuario); ?>
										<?= form_error('contrasena_usuario'); ?>
										<div id="contrasena_incorrecto" class="oculto" title="¡Error!">
											<?= icono_notificacion('error'); ?>Contrase&ntilde;a incorrecta.
										</div>
										<div id="bloq_mayus_activado" class="oculto" title="¡Advertencia!">
											<?= icono_notificacion('alerta'); ?>BLOQ MAY&Uacute;S est&aacute; activado.
										</div>
									</div>
									<div class="form-group">
										<?php
										if($this->session->flashdata('usuario_incorrecto'))
											echo $this->session->flashdata('usuario_incorrecto');
										?>
									</div>
									<?= form_button($boton_primario); ?>
								<?= form_fieldset_close(); ?>
							<?= form_close(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>