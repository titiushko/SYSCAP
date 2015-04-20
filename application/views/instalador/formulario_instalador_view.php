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
		<?= link_tag('resources/plugins/morris/css/morris.css'); ?>
		<?= link_tag('resources/plugins/font-awesome/css/font-awesome.min.css'); ?>
		<?= link_tag('resources/plugins/data-tables/css/data-tables.bootstrap.css'); ?>
		<?= link_tag('resources/plugins/dashgumfree/css/dashgumfree.css'); ?>
		<?= link_tag('resources/plugins/dashgumfree/css/dashgumfree-responsive.css'); ?>
		<?= link_tag('resources/css/estilo.css'); ?>
		<?= link_tag('resources/img/syscap.ico', 'shortcut icon', 'image/ico'); ?>
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script type="text/javascript" src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script type="text/javascript" src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/jquery/jquery.min.js"></script>
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/jquery/jquery.dcjqaccordion.js"></script>
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/jquery/jquery.scrollTo.min.js"></script>
	    <script type="text/javascript" src="<?= base_url(); ?>resources/js/funciones.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#sidebar > ul').hide();
				$("#container").addClass("sidebar-closed");
				$('#main-content').css({'margin-left': '0px'});
				$('#sidebar').css({'margin-left': '-307px'});
				$('#footer').css({'margin-left': '0px'});
				$('.wrapper').css({"margin-top": "60px"});
				$('ul.sidebar-menu').css({"margin-top": "75px"});
			});
		</script>
	</head>
	<body>
		<section id="container" >
			<!-- **********************************************************************************************************************************************************
			TOP BAR CONTENT & NOTIFICATIONS
			*********************************************************************************************************************************************************** -->
			<!--header start-->
			<header class="header black-bg navbar-fixed-top">
				<div class="sidebar-toggle-box">
				</div>
				<!--logo start-->
				<div>
					<a class="logo">
						<b class="visible-desktop" title="Sistema Informático para apoyar el Control y Administración de Capacitaciones">Sistema Informático para apoyar el Control y Administración de Capacitaciones</b>
						<b class="visible-phone visible-tablet" title="Sistema Informático para apoyar el Control y Administración de Capacitaciones">SYSCAP</b>
					</a>
				</div>
				<!--logo end-->
			</header>
			<!--header end-->
			<!-- **********************************************************************************************************************************************************
			MAIN CONTENT
			*********************************************************************************************************************************************************** -->
			<!--main content start-->
			<section id="main-content">
				<section class="wrapper">
					<div id="page-wrapper">
						<?= form_open('index.php/instalador', array('name' => 'instalador', 'id' => 'instalador', 'role' => 'form', 'class' => 'form-horizontal')); ?>
							<div class="row">
								<div class="col-lg-12">
									<h1 class="well page-header"><i class="fa fa-gears"></i> Instalador de SYSCAP</h1>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<div class="panel panel-primary">
										<div class="panel-heading">
											<?= heading('<i class="fa fa-database"></i> Configuraci&oacute;n de Base de Datos', 2); ?>
										</div>
										<div class="panel-body" style="background-color: #f5f5f5;">
											<?php
												echo tag('p', 'Se necesita configurar la conectividad a la base de datos de SYSCAP.');
												echo tag('p', 'Se debe haber creado con anterioridad la base de datos y usuario de SYSCAP para disponer de acceso.');
												echo br();
												echo ul(array(
												bold('Servidor:').' Nombre del servidor de la base de datos. Ej.: localhost o syscap.com',
												bold('Base de Datos:').' Nombre de la base de datos. Ej.: syscap',
												bold('Usuario:').' Usuario de la base de datos. Ej.: syscap',
												bold('Contraseña:').' Contraseña del usuario de la base de datos.'
												));
											?>
										</div>
										<div class="panel-body">
											<div class="row">
												<div class="col-lg-4 col-lg-offset-4 ">
													<div class="form-group">
														<?= form_label('Servidor:', 'servidor', array('class' => 'control-label col-lg-4')); ?>
														<div class="col-lg-8">
															<?= form_input(array('name' => 'servidor', 'id' => 'servidor', 'type' => 'text', 'autocomplete' => 'off', 'class' => 'form-control', 'value' => set_value('servidor', @$campos[0]->servidor ? @$campos[0]->servidor : 'localhost'), 'required' => 'required')); ?>
															<?= form_error('servidor'); ?>
														</div>
													</div>
													<div class="form-group">
														<?= form_label('Base de Datos:', 'base_datos', array('class' => 'control-label col-lg-4')); ?>
														<div class="col-lg-8">
															<?= form_input(array('name' => 'base_datos', 'id' => 'base_datos', 'type' => 'text', 'autocomplete' => 'off', 'class' => 'form-control', 'value' => set_value('base_datos', @$campos[0]->base_datos ? @$campos[0]->base_datos : 'syscap'), 'required' => 'required')); ?>
															<?= form_error('base_datos'); ?>
														</div>
													</div>
													<div class="form-group">
														<?= form_label('Usuario:', 'usuario', array('class' => 'control-label col-lg-4')); ?>
														<div class="col-lg-8">
															<?= form_input(array('name' => 'usuario', 'id' => 'usuario', 'type' => 'text', 'autocomplete' => 'off', 'class' => 'form-control', 'value' => set_value('usuario', @$campos[0]->usuario ? @$campos[0]->usuario : 'syscap'), 'required' => 'required')); ?>
															<?= form_error('usuario'); ?>
														</div>
													</div>
													<div class="form-group">
														<?= form_label('Contraseña:', 'contrasena', array('class' => 'control-label col-lg-4')); ?>
														<div class="col-lg-8">
															<?= form_input(array('name' => 'contrasena', 'id' => 'contrasena', 'type' => 'password', 'autocomplete' => 'off', 'class' => 'form-control', 'value' => set_value('contrasena', @$campos[0]->contrasena), 'required' => 'required')); ?>
															<?= form_error('contrasena'); ?>
														</div>
													</div>
													<div class="form-group">
														<div class="col-lg-12">
															<?= tag('span', '<i class="fa fa-tachometer"></i> Probar Conexión', 'class="btn btn-primary" id="probar_conexion"'); ?>
														</div>
													</div>
													<span id="resultado">
														<?php if(!empty($resultado_conexion)){ ?>
														<div class="col-lg-12 text-center"><?= @$resultado_conexion; ?></div>
														<?php } ?>
													</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<div class="panel panel-primary">
										<div class="panel-heading">
											<?= heading('<i class="fa fa-clock-o"></i> Configuraci&oacute;n de Sesión de Usuario', 2); ?>
										</div>
										<div class="panel-body" style="background-color: #f5f5f5;">
											<?php
												echo tag('p', 'Se necesita establecer la configuración de sesión de usuarios.');
												echo br();
												echo ul(array(
												bold('Tiempo de Conexión de Sesión:').' Determina el número de segundos que desea que dure una sesión de usuario. Por defecto son 600 segundos (10 minutos).<br>Ajustar a cero para que no expire el tiempo de conexión de las sesiones.',
												bold('Semilla de Encriptación de Moodle:').' Establece la semilla de encriptación de contraseñas que utiliza Moodle.<br>El valor de la semilla de encriptación de Moodle se encuentra en la variable $CFG->passwordsaltmain del archivo moodle/config.php.'
												));
											?>
										</div>
										<div class="panel-body">
											<div class="row">
												<div class="col-lg-4 col-lg-offset-4 ">
													<div class="form-group">
														<?= form_label('Tiempo de Conexión de Sesión:', 'tiempo_conexion', array('class' => 'control-label col-lg-5')); ?>
														<div class="col-lg-7">
															<?= form_input(array('name' => 'tiempo_conexion', 'id' => 'tiempo_conexion', 'type' => 'text', 'autocomplete' => 'off', 'class' => 'form-control', 'value' => set_value('tiempo_conexion', @$campos[0]->tiempo_conexion ? @$campos[0]->tiempo_conexion : '600'), 'required' => 'required')); ?>
															<?= form_error('tiempo_conexion'); ?>
														</div>
													</div>
													<div class="form-group">
														<?= form_label('Semilla de Encriptación de Moodle:', 'semilla', array('class' => 'control-label col-lg-5')); ?>
														<div class="col-lg-7">
															<?= form_input(array('name' => 'semilla', 'id' => 'semilla', 'type' => 'text', 'autocomplete' => 'off', 'class' => 'form-control', 'value' => set_value('semilla', @$campos[0]->semilla ? @$campos[0]->semilla : 'Mtx5;;1>0EWn:,,{go%~}=aPJ#Hky'), 'required' => 'required')); ?>
															<?= form_error('semilla'); ?>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 text-center">
									<?= form_button(array('name' => 'continuar', 'id' => 'continuar', 'value' => 'true', 'type' => 'submit', 'content' => '<i class="fa fa-toggle-right"></i> Continuar', 'class' => 'btn btn-primary')); ?>
								</div>
							</div>
						<?= form_close(); ?>
					</div>
				</section>
			</section>
			<!--main content end-->
			<!--footer start-->
			<footer id="footer" class="site-footer">
				<div class="text-center">
					SYSCAP - 2015
					<a href="<?= current_url().'#'; ?>" class="go-top">
						<i class="fa fa-angle-up"></i>
					</a>
				</div>
			</footer>
			<!--footer end-->
		</section>
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/dashgumfree/js/dashgumfree.js"></script>
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/bootstrap/js/bootstrap-hover-dropdown.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#servidor, #base_datos, #usuario, #contrasena").bind('click', function(evento){
					$("#resultado").html('');
				});
				$("#probar_conexion").bind('click', function(evento){
					if(validar_campos_conexion()){
						$.post(
							'<?= base_url('index.php/instalador/probar_conexion'); ?>',
							{
								servidor: $("#servidor").val(),
								base_datos: $("#base_datos").val(),
								usuario: $("#usuario").val(),
								contrasena: $("#contrasena").val()
							},
							function(resultado){
								if(resultado != ''){
									$("#resultado").html('<div class="col-lg-12 text-center">' + resultado + '</div>');
								}
						});
					}
					else{
						$("#resultado").html('<div class="col-lg-12 text-center"><?= icono_notificacion('error'); ?> Campos vac&iacute;os. Por favor, complete los campos vac&iacute;os.</div>');
					}
				});
				
				$('#servidor').blur(function(){
					validar_campo('servidor');
				});
				
				$('#base_datos').blur(function(){
					validar_campo('base_datos');
				});
				
				$('#usuario').blur(function(){
					validar_campo('usuario');
				});
				
				$('#contrasena').blur(function(){
					validar_campo('contrasena');
				});
				
				$('#tiempo_conexion').blur(function(){
					validar_campo('tiempo_conexion');
				});
				
				$('#semilla').blur(function(){
					validar_campo('semilla');
				});
			});
			
			function validar_tiempo_conexion(tiempo_conexion){
				var verify = new RegExp(/^[0-9]+$/);
				return verify.test(tiempo_conexion);
			}
			
			function validar_campo(campo){
				if($('#' + campo).val() == ''){
					$('#' + campo).addClass('error-validacion');
					validacion = false;
				}
				else{
					if(campo == 'tiempo_conexion'){
						if(validar_tiempo_conexion($('#tiempo_conexion').val())){
							$('#tiempo_conexion').removeClass('error-validacion');
							validacion = true;
						}
						else{
							$('#tiempo_conexion').addClass('error-validacion');
							validacion = false;
						}
					}
					else{
						$('#' + campo).removeClass('error-validacion');
						validacion = true;
					}
				}
				return validacion;
			}
			
			function validar_campos_conexion(){
				return validar_campo('servidor') && validar_campo('base_datos') && validar_campo('usuario') && validar_campo('contrasena');
			}
		</script>
	</body>
</html>