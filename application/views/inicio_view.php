<div class="row">
	<div class="col-lg-12">
		<h1 class="well page-header"><i class="fa fa-home fa-fw"></i> Inicio</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-primary">
			<div class="panel-heading">Modulo de Usuarios</div>
			<div class="panel-body">
				<p>Listado de los usuarios del aula virtual <?= anchor('http://noformal.gradodigital.edu.sv/educanoformal/index.php', 'EducaContinua', 'target="_blank" class="btn btn-default btn-sm"'); ?>. Permite realizar b�squedas de usuarios para verificar que su informaci�n este correcta y actualizada, realizando b�squedas por: Nombre de Usuario, Nombre Completo, N�mero de DUI, Correo Electr�nico y Centro Educativo.</p>
				Entrar al <?= anchor(base_url('usuarios'), '<i class="fa fa-users fa-fw"></i> Modulo de Usuarios', 'class="btn btn-primary btn-sm"'); ?>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="panel panel-primary">
			<div class="panel-heading">Modulo de Centros Educativos</div>
			<div class="panel-body">
				<p>Permite consultar Centros Educativos de capacitaci�n de docentes, realizando b�squedas por: C�digo, Nombre, Departamento y Municipio.</p>
				Entrar al <?= anchor(base_url('centros_educativos'), '<i class="fa fa-university fa-fw"></i> Modulo de Centros Educativos', 'class="btn btn-primary btn-sm"'); ?>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-primary">
			<div class="panel-heading">Modulo de Consultas Estad�sticas</div>
			<div class="panel-body">
				<p>Consultas estad�sticas de usuarios por diferentes tipos de b�squeda.</p>
				Entrar al 
				<div class="btn-group">
					<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					<i class="fa fa-bar-chart-o fa-fw"></i> Modulo de Consultas Estad�sticas <i class="caret"></i>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li><?= anchor(base_url('estadisticas/consulta/1'), 'Usuarios por Modalidad de Capacitaci�n'); ?></li>
						<li><?= anchor(base_url('estadisticas/consulta/2'), 'Usuarios por Departamento y Rango de Fechas'); ?></li>
						<li><?= anchor(base_url('estadisticas/consulta/3'), 'Total de Usuarios por Departamento y Rango de Fechas'); ?></li>
						<li><?= anchor(base_url('estadisticas/consulta/4'), 'Usuarios por Departamento, Municipio y Rango de Fechas'); ?></li>
						<li><?= anchor(base_url('estadisticas/consulta/5'), 'Usuarios por Tipo de Capacitados y Fecha a Nivel Nacional'); ?></li>
						<li><?= anchor(base_url('estadisticas/consulta/6'), 'Usuarios por Tipo de Capacitados, Departamento y Fecha'); ?></li>
						<li><?= anchor(base_url('estadisticas/consulta/7'), 'Usuarios por Tipo de Capacitados, Departamento y Municipio'); ?></li>
						<li><?= anchor(base_url('estadisticas/consulta/8'), 'Usuarios por Departamento, Tipo de Capacitados y Fecha'); ?></li>
						<li><?= anchor(base_url('estadisticas/consulta/9'), 'Usuarios por Tipo de Capacitados y Centro Educativo'); ?></li>
						<li><?= anchor(base_url('estadisticas/consulta/10'), 'Usuarios a Nivel Nacional'); ?></li>
						<li><?= anchor(base_url('estadisticas/consulta/11'), 'Usuarios por Grado Digital'); ?></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="panel panel-primary">
			<div class="panel-heading">Modulo de Mapa Estad�stico</div>
			<div class="panel-body">
				<p>Muestra en el mapa de El Salvador el total de docentes de la modalidad de capacitaci�n tutorizados y tipo de capacitado por departamento, municipio y centro educativo.</p>
				Entrar al <?= anchor(base_url('mapa'), '<i class="fa fa-map-marker fa-fw"></i> Modulo de Mapa Estad�stico', 'class="btn btn-primary btn-sm"'); ?>
			</div>
		</div>
	</div>
</div>