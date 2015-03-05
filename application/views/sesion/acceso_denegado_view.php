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
		<?= link_tag('resources/plugins/metis-menu/css/metis-menu.min.css'); ?>
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
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/metis-menu/js/metis-menu.min.js"></script>
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/jquery/jquery.dcjqaccordion.js"></script>
		<script type="text/javascript" src="<?= base_url(); ?>resources/plugins/jquery/jquery.scrollTo.min.js"></script>
	    <script type="text/javascript" src="<?= base_url(); ?>resources/js/funciones.js"></script>
		<script type="text/javascript">
			$(function(){
				var carousel = <?= $this->config->item('carousel') ? '\'TRUE\'' : '\'FALSE\''; ?>;
				if(carousel == 'TRUE'){
					$('.wrapper').css({
						"margin-top": "0px"
					});
					$('ul.sidebar-menu').css({
						"margin-top": "15px"
					});
				}
				else{
					$('.wrapper').css({
						"margin-top": "60px"
					});
					$('ul.sidebar-menu').css({
						"margin-top": "75px"
					});
				}
				$('#main-content').css({
					'margin-left': '0px'
				});
				$('#sidebar').css({
					'margin-left': '-307px'
				});
				$('#footer').css({
					'margin-left': '0px'
				});
				$('#sidebar > ul').hide();
				$("#container").addClass("sidebar-closed");
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
				<div class="top-menu btn-toolbar dropdown-user">
					<div class="btn-group">
					<?php if($tipo_acceso == 'sin_permiso'){ ?>
						<a class="btn btn-primary dropdown-toggle dropdown-user-name" data-toggle="dropdown" data-hover="dropdown">
							<i class="fa fa-user fa-fw"></i> <?= @$usuario_actual; ?> <i class="caret"></i>
						</a>
						<ul class="dropdown-menu dropdown-user-name">
							<li><a href="<?= base_url(); ?>sesion/cerrar_sesion"><i class="fa fa-sign-out fa-fw"></i> Salir</a></li>
						</ul>
					<?php } else{ ?>
						<a href="<?= base_url(); ?>" class="btn btn-primary dropdown-toggle dropdown-user-name">
							<i class="fa fa-user fa-fw"></i> Iniciar Sesión
						</a>
					<?php } ?>
					</div>
				</div>
			</header>
			<!--header end-->
			<!-- **********************************************************************************************************************************************************
			MAIN SIDEBAR MENU
			*********************************************************************************************************************************************************** -->
			<!--sidebar start-->
			<!--sidebar end-->
			<!-- **********************************************************************************************************************************************************
			MAIN CONTENT
			*********************************************************************************************************************************************************** -->
			<!--main content start-->
			<section id="main-content">
				<?php if($this->config->item('carousel')){ ?>
				<!-- Carousel -->
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="3000">
					<!-- Indicators -->
					<ol class="carousel-indicators">
						<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
						<li data-target="#carousel-example-generic" data-slide-to="1"></li>
						<li data-target="#carousel-example-generic" data-slide-to="2"></li>
					</ol>
					<!-- Wrapper for Slides -->
					<div class="carousel-inner">
						<div class="item active" align="center">
							<img src="<?= base_url(); ?>resources/img/slide01.png">
							<div class="carousel-caption">
							</div>
						</div>
						<div class="item" align="center">
							<img src="<?= base_url(); ?>resources/img/slide02.png">
							<div class="carousel-caption">
							</div>
						</div>
						<div class="item" align="center">
							<img src="<?= base_url(); ?>resources/img/slide03.png">
							<div class="carousel-caption">
							</div>
						</div>
					</div>
					<!-- Controls -->
					<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left"></span>
					</a>
					<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right"></span>
					</a>
				</div>
				<?php } ?>
				<section class="wrapper">
					<div id="page-wrapper">
						<div class="row">
							<div class="col-lg-12">
								<h1 class="well page-header"><?= @$mensaje[$tipo_acceso]['icono']; ?>Acceso Denegado</h1>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="panel panel-primary">
									<div class="panel-heading">
										<?= heading(@$mensaje[$tipo_acceso]['encabezado'], 2); ?>
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-lg-12">
												<p><?= @$mensaje[$tipo_acceso]['cuerpo']; ?></p>
												<?php if($tipo_acceso == 'sin_permiso'){ ?>
												<p><span class="enlace" onclick="redireccionar('javascript:window.history.back()');">Regresar a la p&aacute;gina anterior.</span></p>
												<?php } else{ ?>
												<p><a href="<?= base_url(); ?>">Iniciar sesi&oacute;n.</a></p>
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
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
	</body>
</html>