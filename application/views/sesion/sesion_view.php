<?= doctype('html5'); ?>
<html lang="en">
<head>
	<?php
	$metainformaciones = array(
		array('name'	=>	'robots', 'content'				=>	'no-cache'),
		array('name'	=>	'description', 'content'		=>	'Sistema Informático para apoyar el Control y Administración de Capacitaciones - SYSCAP'),
		array('name'	=>	'keywords', 'content'			=>	'mined, grado digital, capacitaciones, syscap'),
		array('name'	=>	'X-UA-Compatible', 'content'	=>	'IE=edge', 'type' => 'equiv'),
		array('name'	=>	'viewport', 'content'			=>	'width=device-width, initial-scale=1'),
		// array('name'	=>	'Content-type', 'content'		=>	'text/html; charset=utf-8', 'type' => 'equiv'),
		array('name'	=>	'Content-type', 'content'		=>	'text/html; charset=ISO-8859-1', 'type' => 'equiv')
	);
	echo meta($metainformaciones);
	?>
    <title>SYSCAP</title>
    <?= link_tag('libraries/plugins/bootstrap/css/bootstrap.min.css'); ?>
    <?= link_tag('libraries/plugins/bootstrap/css/bootstrap-responsive.min.css'); ?>
    <?= link_tag('libraries/plugins/metis-menu/css/metis-menu.min.css'); ?>
    <?= link_tag('libraries/plugins/sb-admin/css/sb-admin.css'); ?>
    <?= link_tag('libraries/plugins/bootstrap/modern-business.css'); ?>
    <?= link_tag('libraries/plugins/font-awesome/css/font-awesome.min.css'); ?>
    <?= link_tag('libraries/plugins/data-tables/css/data-tables.bootstrap.css'); ?>
    <?= link_tag('libraries/img/syscap.ico', 'shortcut icon', 'image/ico'); ?>
    <script src="<?= base_url(); ?>libraries/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>libraries/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>libraries/plugins/metis-menu/js/metis-menu.min.js"></script>
    <script src="<?= base_url(); ?>libraries/plugins/sb-admin/js/sb-admin.js"></script>
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
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
						<form role="form">
							<fieldset>
								<div class="form-group">
									<input class="form-control" placeholder="Correo electrónico" name="correo_electronico_usuario" type="correo_electronico_usuario" autofocus>
								</div>
								<div class="form-group">
									<input class="form-control" placeholder="Contraseña" name="contrasena_usuario" type="password" value="">
								</div>
								<div class="checkbox">
									<label>
										<input name="remember" type="checkbox" value="Remember Me">Recordarme
									</label>
								</div>
								<!-- Change this to a button or input when using this as a form -->
								<a href="<?= base_url(); ?>inicio" class="btn btn-lg btn-success btn-block">Iniciar Sesión</a>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>