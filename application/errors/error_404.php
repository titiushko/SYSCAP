<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="robots" content="no-cache" />
		<meta name="description" content="Sistema Informático para apoyar el Control y Administración de Capacitaciones - SYSCAP" />
		<meta name="keywords" content="mined, grado digital, capacitaciones, syscap" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<meta http-equiv="Content-type" content="text/html; charset=ISO-8859-1" />
		<title>SYSCAP</title>
		<link href="../syscap/sources/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="../syscap/sources/plugins/metis-menu/css/metis-menu.min.css" rel="stylesheet" type="text/css" />
		<link href="../syscap/sources/plugins/bootstrap/modern-business.css" rel="stylesheet" type="text/css" />
		<link href="../syscap/sources/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="../syscap/sources/plugins/data-tables/css/data-tables.bootstrap.css" rel="stylesheet" type="text/css" />
		<link href="../syscap/sources/plugins/dashgumfree/css/dashgumfree.css" rel="stylesheet" type="text/css" />
		<link href="../syscap/sources/plugins/dashgumfree/css/dashgumfree-responsive.css" rel="stylesheet" type="text/css" />
		<link href="../syscap/sources/img/syscap.ico" rel="shortcut icon" type="image/ico" />
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script type="text/javascript" src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script type="text/javascript" src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script type="text/javascript" src="../syscap/sources/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../syscap/sources/plugins/metis-menu/js/metis-menu.min.js"></script>
		<script type="text/javascript" src="../syscap/sources/plugins/jquery/jquery.min.js"></script>
		<script type="text/javascript" src="../syscap/sources/plugins/jquery/jquery.dcjqaccordion.js"></script>
		<script type="text/javascript" src="../syscap/sources/plugins/jquery/jquery.scrollTo.min.js"></script>
	</head>
	<body>
		<section id="container" >
			<header class="header black-bg navbar-fixed-top">
				<div class="sidebar-toggle-box">
					<div class="btn btn-default">
						<div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
					</div>
				</div>
				<div>
					<a class="logo" href="../syscap/inicio">
						<b class="visible-desktop" title="Sistema Informático para apoyar el Control y Administración de Capacitaciones">Sistema Informático para apoyar el Control y Administración de Capacitaciones</b>
						<b class="visible-phone visible-tablet" title="Sistema Informático para apoyar el Control y Administración de Capacitaciones">SYSCAP</b>
					</a>
				</div>
				<div class="top-menu btn-toolbar dropdown-user">
					<div class="btn-group">
						<a class="btn btn-primary dropdown-toggle dropdown-user-name" data-toggle="dropdown" data-hover="dropdown">
							<i class="fa fa-user fa-fw"></i> &lt;nombre_usuario&gt; <i class="caret"></i>
						</a>
						<ul class="dropdown-menu dropdown-user-name">
							<li><a href="../syscap/"><i class="fa fa-sign-out fa-fw"></i> Salir</a></li>
						</ul>
					</div>
				</div>
			</header>
			<aside>
				<div id="sidebar"  class="nav-collapse">
					<ul class="error sidebar-menu" id="nav-accordion">
						<li class="sub-menu">
							<a class="" href="../syscap/inicio">
								<i class="fa fa-home fa-fw"></i> Inicio
							</a>
						</li>
						<li class="sub-menu">
							<a class="" href="../syscap/usuarios">
								<i class="fa fa-users fa-fw"></i> Modulo Usuarios
							</a>
						</li>
						<li class="sub-menu">
							<a class="" href="../syscap/centros_educativos">
								<i class="fa fa-university fa-fw"></i> Modulo Centros Educativos
							</a>
						</li>
						<li class="sub-menu">
							<a class="" href="javascript:;" >
								<i class="fa fa-bar-chart-o fa-fw"></i> Modulo Estadísticas
							</a>
							<ul class="sub">
								<li class=""><a href="../syscap/estadisticas/consulta/1">Modalidad de Capacitación</a></li>
								<li class=""><a href="../syscap/estadisticas/consulta/2">Departamento y Rango de Fechas</a></li>
								<li class=""><a href="../syscap/estadisticas/consulta/3">Total por Departamento y Rango de Fechas</a></li>
								<li class=""><a href="../syscap/estadisticas/consulta/4">Departamento, Municipio y Rango de Fechas</a></li>
								<li class=""><a href="../syscap/estadisticas/consulta/5">Tipo de Capacitados y Fecha a Nivel Nacional</a></li>
								<li class=""><a href="../syscap/estadisticas/consulta/6">Tipo de Capacitados, Departamento y Fecha</a></li>
								<li class=""><a href="../syscap/estadisticas/consulta/7">Tipo de Capacitados, Departamento y Municipio</a></li>
								<li class=""><a href="../syscap/estadisticas/consulta/8">Departamento, Tipo de Capacitados y Fecha</a></li>
								<li class=""><a href="../syscap/estadisticas/consulta/9">Tipo de Capacitados y Centro Educativo</a></li>
								<li class=""><a href="../syscap/estadisticas/consulta/10">Nivel Nacional</a></li>
								<li class=""><a href="../syscap/estadisticas/consulta/11">Grado Digital</a></li>
							</ul>
						</li>
						<li class="sub-menu">
							<a href="../syscap/mapa">
								<i class="fa fa-map-marker fa-fw"></i> Modulo Mapa
							</a>
						</li>
						<li><a href='javascript:void(0);' onclick="window.open('../syscap/ayuda', '_blank', 'width=600,height=400,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0');" left="50" top="50" toolbar="yes"><i class="fa fa-life-ring fa-fw"></i> Ayuda</a></li>
					</ul>
				</div>
			</aside>
			<section id="main-content">
				<section class="error wrapper">
					<div id="page-wrapper">
						<div class="row">
							<div class="col-lg-12">
								<h1 class="well page-header">Error 404</h1>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="panel panel-primary">
									<div class="panel-heading">
										<h3>Página no Encontrada</h3>
									</div>
									<div class="panel-body">
									Lo sentimos, ha ocurrido un error, la página solicitada no se encuentra!
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</section>
			<footer id="footer" class="site-footer">
				<div class="text-center">
					SYSCAP - 2014
					<a href="#" class="go-top">
						<i class="fa fa-angle-up"></i>
					</a>
				</div>
			</footer>
		</section>
		<script type="text/javascript" src="../syscap/sources/plugins/dashgumfree/js/dashgumfree.js"></script>
		<script type="text/javascript" src="../syscap/sources/plugins/bootstrap/js/bootstrap-hover-dropdown.min.js"></script>
	</body>
</html>