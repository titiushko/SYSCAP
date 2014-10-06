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
    <?= link_tag('libraries/plugins/bootstrap/css/bootstrap.min.css'); ?>
    <!-- <?= link_tag('libraries/plugins/bootstrap/css/bootstrap-responsive.min.css'); ?> -->
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
	 <!-- Header Carousel -->
	<header id="myCarousel" class="carousel slide margin-slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
			<li data-target="#myCarousel" data-slide-to="3"></li>
			<li data-target="#myCarousel" data-slide-to="4"></li>
		</ol>
		<div class="carousel-inner">
			<div class="item active">
				<div class="fill" style="background-image:url('<?= base_url(); ?>libraries/img/slide01.png');"></div>
				<div class="carousel-caption">
					<!-- <h2>Caption 1</h2> -->
				</div>
			</div>
			<div class="item">
				<div class="fill" style="background-image:url('<?= base_url(); ?>libraries/img/slide02.jpg');"></div>
				<div class="carousel-caption">
					<!-- <h2>Caption 2</h2> -->
				</div>
			</div>
			<div class="item">
				<div class="fill" style="background-image:url('<?= base_url(); ?>libraries/img/slide03.jpg');"></div>
				<div class="carousel-caption">
					<!-- <h2>Caption 3</h2> -->
				</div>
			</div>
			<div class="item">
				<div class="fill" style="background-image:url('<?= base_url(); ?>libraries/img/slide04.jpg');"></div>
				<div class="carousel-caption">
					<!-- <h2>Caption 4</h2> -->
				</div>
			</div>
			<div class="item">
				<div class="fill" style="background-image:url('<?= base_url(); ?>libraries/img/slide05.png');"></div>
				<div class="carousel-caption">
					<!-- <h2>Caption 5</h2> -->
				</div>
			</div>
		</div>
		<a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="icon-prev"></span></a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="icon-next"></span></a>
	</header>
	<!-- Wrapper -->
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= base_url(); ?>inicio">
                	<span class="visible-desktop" title="Sistema Informático para apoyar el Control y Administración de Capacitaciones">Sistema Informático para apoyar el Control y Administración de Capacitaciones - SYSCAP</span>
                	<span class="visible-phone visible-tablet" title="Sistema Informático para apoyar el Control y Administración de Capacitaciones">SYSCAP</span>
                </a>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>
                        <?= $usuario_actual; ?>
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?= base_url(); ?>"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li><a href="<?= base_url(); ?>inicio"><i class="fa fa-home fa-fw"></i> Inicio</a></li>
                        <li class="<?= $opcion_menu['modulo_usuarios']; ?>"><a href="<?= base_url(); ?>usuarios"><i class="fa fa-users fa-fw"></i> Modulo Usuarios</a></li>
                        <li class="<?= $opcion_menu['modulo_centros_educativos']; ?>"><a href="<?= base_url(); ?>centros_educativos"><i class="fa fa-university fa-fw"></i> Modulo Centros Educativos</a></li>
                        <li class="<?= $opcion_menu['modulo_consultas_estadisticas']; ?>">
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Modulo Estadísticas<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="<?= base_url(); ?>estadisticas/consulta/1">Modalidad de Capacitación</a></li>
                                <li><a href="<?= base_url(); ?>estadisticas/consulta/2">Departamento y Rango de Fechas</a></li>
                                <li><a href="<?= base_url(); ?>estadisticas/consulta/3">Total por Departamento y Rango de Fechas</a></li>
                                <li><a href="<?= base_url(); ?>estadisticas/consulta/4">Departamento, Municipio y Rango de Fechas</a></li>
                                <li><a href="<?= base_url(); ?>estadisticas/consulta/5">Tipo de Capacitados y Fecha a Nivel Nacional</a></li>
                                <li><a href="<?= base_url(); ?>estadisticas/consulta/6">Tipo de Capacitados, Departamento y Fecha</a></li>
                                <li><a href="<?= base_url(); ?>estadisticas/consulta/7">Tipo de Capacitados, Departamento y Municipio</a></li>
                                <li><a href="<?= base_url(); ?>estadisticas/consulta/8">Departamento, Tipo de Capacitados y Fecha</a></li>
                                <li><a href="<?= base_url(); ?>estadisticas/consulta/9">Tipo de Capacitados y Centro Educativo</a></li>
                                <li><a href="<?= base_url(); ?>estadisticas/consulta/10">Nivel Nacional</a></li>
                                <li><a href="<?= base_url(); ?>estadisticas/consulta/11">Grado Digital</a></li>
                            </ul>
                        </li>
                        <li class="<?= $opcion_menu['modulo_mapa_estadistico']; ?>"><a href="<?= base_url(); ?>mapa"><i class="fa fa-map-marker fa-fw"></i> Modulo Mapa Estadístico</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Contenido de una Página -->
        <?php if(isset($pagina)){
        $this->load->view($pagina);
        } ?>
	</div>
</body>
</html>