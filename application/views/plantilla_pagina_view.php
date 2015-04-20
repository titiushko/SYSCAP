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
			var carousel = <?= $this->config->item('carousel') ? '\'TRUE\'' : '\'FALSE\''; ?>;
			var boton_menu = <?= $this->session->userdata('boton_menu') ? '\'TRUE\'' : '\'FALSE\''; ?>;
			$(document).ready(function(){
				$(".fa.fa-bars.tooltips").click(function(){
					if ($('#sidebar > ul').is(":visible") === true){
						$.post('<?= base_url('index.php/ajax/boton_menu'); ?>', {boton_menu: "FALSE"}, function(resultado){
							boton_menu = resultado;
						});
					}
					else{
						$.post('<?= base_url('index.php/ajax/boton_menu'); ?>', {boton_menu: "TRUE"}, function(resultado){
							boton_menu = resultado;
						});
					}
				});
			});
			$(function(){
				if(boton_menu == 'TRUE'){
					mostrar_ocultar_menu(true);
				}
				else{
					mostrar_ocultar_menu(false);
				}
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
			});
			function mostrar_ocultar_menu(opcion){
				if(opcion){
					$('#sidebar > ul').show();
					$("#container").removeClass("sidebar-closed");
					$('#main-content').css({
						'margin-left': '307px'
					});
					$('#footer').css({
						'margin-left': '307px'
					});
					$('#sidebar').css({
						'margin-left': '0'
					});
				}
				else{
					$('#sidebar > ul').hide();
					$("#container").addClass("sidebar-closed");
					$('#main-content').css({
						'margin-left': '0px'
					});
					$('#sidebar').css({
						'margin-left': '-307px'
					});
					$('#footer').css({
						'margin-left': '0px'
					});
				}
			}
		</script>
	</head>
	<body <?= @$eventos_body; ?>>
		<section id="container" >
			<!-- **********************************************************************************************************************************************************
			TOP BAR CONTENT & NOTIFICATIONS
			*********************************************************************************************************************************************************** -->
			<!--header start-->
			<header class="header black-bg navbar-fixed-top">
				<div class="sidebar-toggle-box">
					<div id="toggle-syscap" class="btn btn-default">
						<div class="fa fa-bars tooltips" data-placement="right" data-original-title="Mostrar/Ocultar Menú"></div>
					</div>
				</div>
				<!--logo start-->
				<div>
					<?php if($this->session->userdata('nombre_corto_rol') == 'admin' && uri_string(1) != 'ayuda'){ ?>
					<a class="logo" href="<?= base_url(); ?>inicio">
					<?php } else{ ?>
					<a class="logo">
					<?php } ?>
						<b class="visible-desktop" title="Sistema Informático para apoyar el Control y Administración de Capacitaciones">Sistema Informático para apoyar el Control y Administración de Capacitaciones</b>
						<b class="visible-phone visible-tablet" title="Sistema Informático para apoyar el Control y Administración de Capacitaciones">SYSCAP</b>
					</a>
				</div>
				<!--logo end-->
				<div class="top-menu btn-toolbar dropdown-user">
					<div class="btn-group">
						<a class="btn btn-primary dropdown-toggle dropdown-user-name" data-toggle="dropdown" data-hover="dropdown">
							<i class="fa fa-user fa-fw"></i> <?= utf8($this->session->userdata('nombre_completo_usuario')); ?> <i class="caret"></i>
						</a>
						<ul class="dropdown-menu dropdown-user-name">
							<li><a><?= $this->session->userdata('nombre_completo_rol'); ?></a></li>
							<li class="divider"></li>
							<li><a href="<?= base_url(); ?>sesion/cerrar_sesion"><i class="fa fa-sign-out fa-fw"></i> Salir</a></li>
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
				<div id="sidebar" class="nav-collapse">
					<!-- sidebar menu start-->
					<ul class="sidebar-menu" id="nav-accordion">
					<?php if(uri_string(1) != 'ayuda'){ ?>
						<?php if($this->session->userdata('nombre_corto_rol') == 'admin'){ ?>
						<li class="sub-menu">
							<a class="<?= @$opcion_menu['inicio']; ?>" href="<?= base_url(); ?>inicio">
								<i class="fa fa-home fa-fw"></i> Inicio
							</a>
						</li>
						<?php } ?>
						<?php if($this->session->userdata('nombre_corto_rol') != 'student'){ ?>
						<li class="sub-menu">
							<a class="<?= @$opcion_menu['modulo_usuarios']; ?>" href="<?= base_url(); ?>usuarios">
								<i class="fa fa-users fa-fw"></i> Módulo Usuarios
							</a>
						</li>
						<?php } ?>
						<?php if($this->session->userdata('nombre_corto_rol') == 'admin'){ ?>
						<li class="sub-menu">
							<a class="<?= @$opcion_menu['modulo_centros_educativos']; ?>" href="<?= base_url(); ?>centros_educativos">
								<i class="fa fa-university fa-fw"></i> Módulo Centros Educativos
							</a>
						</li>
						<li class="sub-menu">
							<a class="<?= @$opcion_menu['modulo_consultas_estadisticas']; ?>" href="javascript:;" ondblclick="redireccionar('<?= base_url('resumen_estadistico'); ?>');">
								<i class="fa fa-bar-chart-o fa-fw"></i> Módulo Estadísticas
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
							<a class="<?= @$opcion_menu['modulo_mapa_estadistico']; ?>" href="<?= base_url(); ?>mapa">
								<i class="fa fa-map-marker fa-fw"></i> Módulo Mapa
							</a>
						</li>
						<?php } ?>
						<li class="sub-menu">
							<?= anchor_popup('ayuda'.uri_ayuda(uri_string()), '<i class="fa fa-life-ring fa-fw"></i> Ayuda', array('width'=>'600', 'height'=>'800', 'left'=>'50', 'top'=>'50', 'toolbar'=>'yes')); ?>
						</li>
					<?php } else{ ?>
						<li class="sub-menu">
							<a class="enlace" onclick="javascript:window.close();">
								<i class="fa fa-times"></i> Cerrar Ayuda
							</a>
						</li>
					<?php } ?>
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
						<!-- Modal -->
						<?php
						if(!empty($notificaciones)){
							if(is_array($notificaciones)){
								foreach(@$notificaciones as $indice => $notificacion){
									echo $notificacion;
								}
							}
							else{
								echo @$notificaciones;
							}
						}
						?>
						<!-- Modal End -->
						<?php
						if(isset($pagina)){
							$this->load->view(@$pagina);
						}
						?>
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