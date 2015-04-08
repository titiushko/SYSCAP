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
											<?= heading('<i class="fa fa-gear"></i> '.@$resultado_instalador[0], 2); ?>
										</div>
										<div class="panel-body">
											<?= @$resultado_instalador[1]; ?>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 text-center">
									<?= @$resultado_instalador[2]; ?>
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
	</body>
</html>