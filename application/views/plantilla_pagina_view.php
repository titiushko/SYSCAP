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
			array('name'	=>	'Content-type', 'content'		=>	'text/html; charset=ISO-8859-1', 'type' => 'equiv')
		);
		echo meta($metainformaciones);
		?>
	    <title>SYSCAP</title>
	    <?= link_tag('sources/plugins/bootstrap/css/bootstrap.min.css'); ?>
	    <!-- <?= link_tag('sources/plugins/bootstrap/css/bootstrap-responsive.min.css'); ?> -->
	    <?= link_tag('sources/plugins/metis-menu/css/metis-menu.min.css'); ?>
	    <!-- <?= link_tag('sources/plugins/sb-admin/css/sb-admin.css'); ?> -->
	    <!-- <?= link_tag('sources/plugins/bootstrap/modern-business.css'); ?> -->
	    <?= link_tag('sources/plugins/font-awesome/css/font-awesome.min.css'); ?>
	    <?= link_tag('sources/plugins/data-tables/css/data-tables.bootstrap.css'); ?>
	    <?= link_tag('sources/plugins/dashgumfree/css/dashgumfree.css'); ?>
	    <?= link_tag('sources/plugins/dashgumfree/css/dashgumfree-responsive.css'); ?>
	    <?= link_tag('sources/img/syscap.ico', 'shortcut icon', 'image/ico'); ?>
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	    <![endif]-->
	    <script src="<?= base_url(); ?>sources/plugins/jquery/jquery.min.js"></script>
	    <script src="<?= base_url(); ?>sources/plugins/bootstrap/js/bootstrap.min.js"></script>
	    <script src="<?= base_url(); ?>sources/plugins/metis-menu/js/metis-menu.min.js"></script>
	    <!-- <script src="<?= base_url(); ?>sources/plugins/sb-admin/js/sb-admin.js"></script> -->
	    <script src="<?= base_url(); ?>sources/plugins/jquery/jquery.dcjqaccordion.js"></script>
	    <script src="<?= base_url(); ?>sources/plugins/jquery/jquery.scrollTo.min.js"></script>
	</head>
	<body <?= @$notificacion; ?>>
		<section id="container" >
			<!-- **********************************************************************************************************************************************************
			TOP BAR CONTENT & NOTIFICATIONS
			*********************************************************************************************************************************************************** -->
			<!--header start-->
			<header class="header black-bg navbar-fixed-top">
				<div class="sidebar-toggle-box">
					<div class="btn btn-default">
						<div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
					</div>
				</div>
				<!--logo start-->
				<div>
					<a class="logo" href="<?= base_url(); ?>inicio">
	                	<b class="visible-desktop" title="Sistema Informático para apoyar el Control y Administración de Capacitaciones">Sistema Informático para apoyar el Control y Administración de Capacitaciones</b>
	                	<b class="visible-phone visible-tablet" title="Sistema Informático para apoyar el Control y Administración de Capacitaciones">SYSCAP</b>
	                </a>
				</div>
				<!--logo end-->
				<div class="top-menu btn-toolbar dropdown-user">
					<div class="btn-group">
						<a class="btn btn-primary dropdown-toggle dropdown-user-name" data-toggle="dropdown" data-hover="dropdown">
							<i class="fa fa-user fa-fw"></i> <?= $usuario_actual; ?> <i class="caret"></i>
						</a>
						<ul class="dropdown-menu dropdown-user-name">
							<li><a href="<?= base_url(); ?>"><i class="fa fa-sign-out fa-fw"></i> Salir</a></li>
						</ul>
					</div>
				</div>
			</header>
			<!--header end-->
			<!-- **********************************************************************************************************************************************************
			MAIN SIDEBAR MENU
			*********************************************************************************************************************************************************** -->
			<!--sidebar start-->
			<aside>
				<div id="sidebar"  class="nav-collapse">
					<!-- sidebar menu start-->
					<ul class="sidebar-menu" id="nav-accordion">
						<li class="sub-menu">
							<a class="<?= $opcion_menu['inicio']; ?>" href="<?= base_url(); ?>inicio">
								<i class="fa fa-home fa-fw"></i> Inicio
							</a>
						</li>
						<li class="sub-menu">
							<a class="<?= $opcion_menu['modulo_usuarios']; ?>" href="<?= base_url(); ?>usuarios">
								<i class="fa fa-users fa-fw"></i> Modulo Usuarios
							</a>
						</li>
						<li class="sub-menu">
							<a class="<?= $opcion_menu['modulo_centros_educativos']; ?>" href="<?= base_url(); ?>centros_educativos">
								<i class="fa fa-university fa-fw"></i> Modulo Centros Educativos
							</a>
						</li>
						<li class="sub-menu">
							<a class="<?= $opcion_menu['modulo_consultas_estadisticas']; ?>" href="javascript:;" >
								<i class="fa fa-bar-chart-o fa-fw"></i> Modulo Estadísticas
							</a>
							<ul class="sub">
								<li class="<?= @$estadistica[1]; ?>"><a href="<?= base_url(); ?>estadisticas/consulta/1">Modalidad de Capacitación</a></li>
                                <li class="<?= @$estadistica[2]; ?>"><a href="<?= base_url(); ?>estadisticas/consulta/2">Departamento y Rango de Fechas</a></li>
                                <li class="<?= @$estadistica[3]; ?>"><a href="<?= base_url(); ?>estadisticas/consulta/3">Total por Departamento y Rango de Fechas</a></li>
                                <li class="<?= @$estadistica[4]; ?>"><a href="<?= base_url(); ?>estadisticas/consulta/4">Departamento, Municipio y Rango de Fechas</a></li>
                                <li class="<?= @$estadistica[5]; ?>"><a href="<?= base_url(); ?>estadisticas/consulta/5">Tipo de Capacitados y Fecha a Nivel Nacional</a></li>
                                <li class="<?= @$estadistica[6]; ?>"><a href="<?= base_url(); ?>estadisticas/consulta/6">Tipo de Capacitados, Departamento y Fecha</a></li>
                                <li class="<?= @$estadistica[7]; ?>"><a href="<?= base_url(); ?>estadisticas/consulta/7">Tipo de Capacitados, Departamento y Municipio</a></li>
                                <li class="<?= @$estadistica[8]; ?>"><a href="<?= base_url(); ?>estadisticas/consulta/8">Departamento, Tipo de Capacitados y Fecha</a></li>
                                <li class="<?= @$estadistica[9]; ?>"><a href="<?= base_url(); ?>estadisticas/consulta/9">Tipo de Capacitados y Centro Educativo</a></li>
                                <li class="<?= @$estadistica[10]; ?>"><a href="<?= base_url(); ?>estadisticas/consulta/10">Nivel Nacional</a></li>
                                <li class="<?= @$estadistica[11]; ?>"><a href="<?= base_url(); ?>estadisticas/consulta/11">Grado Digital</a></li>
							</ul>
						</li>
						<li class="sub-menu">
							<a class="<?= $opcion_menu['modulo_mapa_estadistico']; ?>" href="<?= base_url(); ?>mapa">
								<i class="fa fa-map-marker fa-fw"></i> Modulo Mapa
							</a>
						</li>
						<li><?= anchor_popup('ayuda', '<i class="fa fa-life-ring fa-fw"></i> Ayuda', array('width'=>'600', 'height'=>'800', 'left'=>'50', 'top'=>'50', 'toolbar'=>'yes')); ?></li>
					</ul>
					<!-- sidebar menu end-->
				</div>
			</aside>
			<!--sidebar end-->
			<!-- **********************************************************************************************************************************************************
			MAIN CONTENT
			*********************************************************************************************************************************************************** -->
			<!--main content start-->
			<section id="main-content">
				<!-- Carousel -->
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="3000">
					<!-- Indicators -->
					<ol class="carousel-indicators">
						<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
						<li data-target="#carousel-example-generic" data-slide-to="1"></li>
						<li data-target="#carousel-example-generic" data-slide-to="2"></li>
					</ol>
					<!-- Wrapper for slides -->
					<div class="carousel-inner">
						<div class="item active" align="center">
							<img src="<?= base_url(); ?>sources/img/slide01.png">
							<div class="carousel-caption">
								<!-- <h3>Caption Text</h3> -->
							</div>
						</div>
						<div class="item" align="center">
							<img src="<?= base_url(); ?>sources/img/slide02.png">
							<div class="carousel-caption">
								<!-- <h3>Caption Text</h3> -->
							</div>
						</div>
						<div class="item" align="center">
							<img src="<?= base_url(); ?>sources/img/slide03.png">
							<div class="carousel-caption">
								<!-- <h3>Caption Text</h3> -->
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
				<section class="wrapper">
					<div id="page-wrapper">
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
						<?php if(isset($pagina)){
				        $this->load->view($pagina);
				        } ?>
					</div>
				</section>
			</section>
			<!--main content end-->
			<!--footer start-->
			<footer id="footer" class="site-footer">
				<div class="text-center">
					SYSCAP - 2014
					<a href="<?= base_url().uri_string().'#'; ?>" class="go-top">
						<i class="fa fa-angle-up"></i>
					</a>
				</div>
			</footer>
			<!--footer end-->
		</section>
		<script src="<?= base_url(); ?>sources/plugins/dashgumfree/js/dashgumfree.js"></script>
	    <script src="<?= base_url(); ?>sources/plugins/bootstrap/js/bootstrap-hover-dropdown.min.js"></script>
	</body>
</html>