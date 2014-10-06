<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Inicio</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<div class="panel panel-primary">
				<div class="panel-heading">Modulo de Usuarios</div>
				<div class="panel-body">
					<p>Listado de los usuarios del aula virtual <?= anchor('http://noformal.gradodigital.edu.sv/educanoformal/index.php', 'EducaContinua', 'target="_blank" class="btn btn-default btn-sm"'); ?>. Permite realizar búsquedas de un usuario para verificar su información este correcta y actualizada.</p>
					Entrar al <?= anchor(base_url().'usuarios', '<i class="fa fa-users fa-fw"></i> Modulo de Usuarios', 'class="btn btn-primary btn-sm"'); ?>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="panel panel-primary">
				<div class="panel-heading">Modulo de Centros Educativos</div>
				<div class="panel-body">
					<p>Permite consultar Centros Educativos de capacitación de docentes. Cuenta con opciones para realizar la búsqueda de usuarios por Centro Educativo.</p>
					Entrar al <?= anchor(base_url().'centros_educativos', '<i class="fa fa-university fa-fw"></i> Modulo de Centros Educativos', 'class="btn btn-primary btn-sm"'); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<div class="panel panel-primary">
				<div class="panel-heading">Modulo de Consultas Estadísticas</div>
				<div class="panel-body">
					<p>Consultas estadísticas de usuarios por diferentes tipos de búsqueda.</p>
					Entrar al <?= anchor(base_url().'estadisticas/consulta/1', '<i class="fa fa-bar-chart-o fa-fw"></i> Modulo de Consultas Estadísticas', 'class="btn btn-primary btn-sm"'); ?>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="panel panel-primary">
				<div class="panel-heading">Modulo de Mapa Estadístico</div>
				<div class="panel-body">
					<p>Muestra en un mapa de El Salvador con el total de docentes por tipo de capacitados en cada departamento. Permite seleccionar un Departamento para mostrar el total de docentes capacitados por municipios.</p>
					Entrar al <?= anchor(base_url().'mapa', '<i class="fa fa-map-marker fa-fw"></i> Modulo de Mapa Estadístico', 'class="btn btn-primary btn-sm"'); ?>
				</div>
			</div>
		</div>
	</div>
</div>