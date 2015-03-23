<div class="row">
	<div class="col-lg-12">
		<h1 class="well page-header"><i class="fa fa-life-ring fa-fw"></i> Ayuda</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<?= heading('<i class="fa fa-users fa-fw"></i> Modulo de Usuarios', 2); ?>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<?php
						if($this->session->userdata('nombre_corto_rol') != 'student'){
						echo heading(anchor(current_url().'#usuarios', 'Lista de Usuarios', 'name="usuarios"'), 3).br();
						echo p('SYSCAP muestra el listado de estudiantes por: Nombre de Usuario, Nombre Completo, Número de DUI, Correo Electrónico y Centro Educativo.').br();
						echo heading('Búsqueda de Estudiante por Nombre de Usuario.', 4);
						echo ol(array(
						'Dentro del módulo de usuarios, ubicarse en el campo de búsqueda '.bold('Buscar').' ubicado en la parte superior derecha del listado de usuarios.',
						'Digitar el nombre de usuario que corresponda al estudiante que se requiere consultar.',
						'SYSCAP filtrará el listado de usuarios que coicidan con la búsqueda. Para acceder a la ficha del estudiante, hacer clic en la fila del registro del estudiante que se desea consultar.',
						'Dar clic en el botón '.div('Regresar', 'class="btn btn-sm btn-danger"').' para salir de la ficha del estudiante y regresar al listado de usuarios.'
						)).br();
						echo heading('Búsqueda de Estudiante por Nombre Completo.', 4);
						echo ol(array(
						'Dentro del módulo de usuarios, ubicarse en el campo de búsqueda '.bold('Buscar').' ubicado en la parte superior derecha del listado de usuarios.',
						'Digitar el nombre completo, nombre o apellidos del usuario que corresponda al estudiante que se requiere consultar.',
						'SYSCAP filtrará el listado de usuarios que coicidan con la búsqueda. Para acceder a la ficha del estudiante, hacer clic en la fila del registro del estudiante que se desea consultar.',
						'Dar clic en el botón '.div('Regresar', 'class="btn btn-sm btn-danger"').' para salir de la ficha del estudiante y regresar al listado de usuarios.'
						)).br();
						echo heading('Búsqueda de Estudiante por Número de DUI.', 4);
						echo ol(array(
						'Dentro del módulo de usuarios, ubicarse en el campo de búsqueda '.bold('Buscar').' ubicado en la parte superior derecha del listado de usuarios.',
						'Digitar el número de DUI que corresponda al estudiante que se requiere consultar.',
						'SYSCAP filtrará el listado de usuarios que coicidan con la búsqueda. Para acceder a la ficha del estudiante, hacer clic en la fila del registro del estudiante que se desea consultar.',
						'Dar clic en el botón '.div('Regresar', 'class="btn btn-sm btn-danger"').' para salir de la ficha del estudiante y regresar al listado de usuarios.'
						)).br();
						echo heading('Búsqueda de Estudiante por Correo Electrónico.', 4);
						echo ol(array(
						'Dentro del módulo de usuarios, ubicarse en el campo de búsqueda '.bold('Buscar').' ubicado en la parte superior derecha del listado de usuarios.',
						'Digitar el correo electrónico que corresponda al estudiante que se requiere consultar.',
						'SYSCAP filtrará el listado de usuarios que coicidan con la búsqueda. Para acceder a la ficha del estudiante, hacer clic en la fila del registro del estudiante que se desea consultar.',
						'Dar clic en el botón '.div('Regresar', 'class="btn btn-sm btn-danger"').' para salir de la ficha del estudiante y regresar al listado de usuarios.'
						)).br();
						echo heading('Búsqueda de Estudiante por Centro Educativo.', 4);
						echo ol(array(
						'Dentro del módulo de usuarios, ubicarse en el campo de búsqueda '.bold('Centro Educativo').' ubicado en la parte superior del listado de usuarios.',
						'Digitar el nombre del centro educativo que corresponda al estudiante que se requiere consultar.',
						'SYSCAP filtrará el listado de usuarios que coicidan con la búsqueda. Para acceder a la ficha del estudiante, hacer clic en la fila del registro del estudiante que se desea consultar.',
						'Dar clic en el botón '.div('Regresar', 'class="btn btn-sm btn-danger"').' para salir de la ficha del estudiante y regresar al listado de usuarios.'
						)).br();
						}
						echo heading(anchor(current_url().'#usuarios-mostrar', 'Mostrar Usuario', 'name="usuarios-mostrar"'), 3).br();
						echo heading('Imprimir Ficha de Estudiante.', 4);
						echo ol(array(
						'Dentro del módulo de usuarios y desde la ficha de un estudiante, dar clic en el botón '.div('<i class="fa fa-print"></i> Imprimir', 'class="btn btn-sm btn-success"').'.',
						'SYSCAP mostrará un reporte generado con la ficha del estudiante para ser enviado a impresión.',
						)).br();
						echo p('El botón imprimir no está disponible sólo para dispositivos móviles.').br();
						echo heading('Exportar a Archivo PDF Ficha de Estudiante.', 4);
						echo ol(array(
						'Dentro del módulo de usuarios y desde la ficha de un estudiante, dar clic en el botón '.div('<i class="fa fa-file-pdf-o"></i> Exportar', 'class="btn btn-sm btn-success"').'.',
						'SYSCAP mostrará un reporte generado con la ficha del estudiante en archivo PDF para ser almacenado.',
						)).br();
						if($this->session->userdata('nombre_corto_rol') == 'admin'){
						echo heading(anchor(current_url().'#usuarios-modificar', 'Editar Usuario', 'name="usuarios-modificar"'), 3).br();
						echo ol(array(
						'Dentro del módulo de usuarios y desde la ficha de un estudiante, dar clic en el botón '.div('Editar', 'class="btn btn-sm btn-primary"').'.',
						'SYSCAP habilitará los campos de la ficha para modificar los '.bold('Datos Personales').' del estudiante. Modificar los datos que se necesitan actualizar, cuando se termine de realizar los cambios dar clic en el botón '.bold('Guardar').'; si se desea cancelar la edición, dar clic en el botón '.div('Cancelar', 'class="btn btn-sm btn-danger"').'.',
						'Luego de dar clic en el botón Guardar, SYSCAP mostrará un mensaje de confirmación notificando que se han guardado los datos del usuario.'
						)).br();
						echo heading(anchor(current_url().'#usuarios-recuperar_contrasena', 'Recuperar Contraseña Usuario', 'name="usuarios-recuperar_contrasena"'), 3).br();
						echo p('Esta sección es útil para que el administrador proporcione una nueva contraseña a un estudiante que la ha olvidado o extraviado su contraseña.').br();
						echo ol(array(
						'Dentro del módulo de usuarios y desde la ficha de un estudiante, dar clic en el botón '.div('Recuperar Contraseña', 'class="btn btn-sm btn-primary"').'.',
						'SYSCAP habilitará los campos de la ficha para modificar los '.bold('Datos de Usuario').' del estudiante. Modificar la contraseña que se desea recuperar, cuando se termine de realizar los cambios dar clic en el botón '.bold('Guardar').'; si se desea cancelar la recuperación de contraseña, dar clic en el botón '.div('Cancelar', 'class="btn btn-sm btn-danger"').'.',
						'Luego de dar clic en el botón Guardar, SYSCAP mostrará un mensaje de confirmación notificando que se han guardado los datos del usuario.'
						)).br();
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php if($this->session->userdata('nombre_corto_rol') == 'admin'){ ?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<?= heading('<i class="fa fa-university fa-fw"></i> Modulo de Centros Educativos', 2); ?>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<?php
						echo heading(anchor(current_url().'#centros_educativos', 'Lista de Centros Educativos', 'name="centros_educativos"'), 3).br();
						echo p('Permite consultar Centros Educativos de capacitación de docentes, realizando búsquedas por: Código, Nombre, Departamento y Municipio.').br();
						echo heading('Búsqueda de Centro Educativo por Código.', 4);
						echo ol(array(
						'Dentro del módulo de centros educativos, ubicarse en el campo de búsqueda '.bold('Buscar').' ubicado en la parte superior derecha del listado de centros educativos.',
						'Digitar el código del centro educativo que se requiere consultar.',
						'SYSCAP filtrará el listado de centros educativos que coicidan con la búsqueda. Para acceder a la ficha del centro educativo, hacer clic en la fila del registro del centro educativo que se desea consultar.',
						'Dar clic en el botón '.div('Regresar', 'class="btn btn-sm btn-danger"').' para salir de la ficha del centro educativo y regresar al listado de centros educativos.'
						)).br();
						echo heading('Búsqueda de Centro Educativo por Nombre.', 4);
						echo ol(array(
						'Dentro del módulo de centros educativos, ubicarse en el campo de búsqueda '.bold('Buscar').' ubicado en la parte superior derecha del listado de centros educativos.',
						'Digitar el nombre del centro educativo que se requiere consultar.',
						'SYSCAP filtrará el listado de centros educativos que coicidan con la búsqueda. Para acceder a la ficha del centro educativo, hacer clic en la fila del registro del centro educativo que se desea consultar.',
						'Dar clic en el botón '.div('Regresar', 'class="btn btn-sm btn-danger"').' para salir de la ficha del centro educativo y regresar al listado de centros educativos.'
						)).br();
						echo heading('Búsqueda de Centro Educativo por Departamento.', 4);
						echo ol(array(
						'Dentro del módulo de centros educativos, ubicarse en el campo de búsqueda '.bold('Buscar').' ubicado en la parte superior derecha del listado de centros educativos.',
						'Digitar el nombre del departamento donde esta ubicado el centro educativo que se requiere consultar.',
						'SYSCAP filtrará el listado de centros educativos que coicidan con la búsqueda. Para acceder a la ficha del centro educativo, hacer clic en la fila del registro del centro educativo que se desea consultar.',
						'Dar clic en el botón '.div('Regresar', 'class="btn btn-sm btn-danger"').' para salir de la ficha del centro educativo y regresar al listado de centros educativos.'
						)).br();
						echo heading('Búsqueda de Centro Educativo por Municipio.', 4);
						echo ol(array(
						'Dentro del módulo de centros educativos, ubicarse en el campo de búsqueda '.bold('Buscar').' ubicado en la parte superior derecha del listado de centros educativos.',
						'Digitar el nombre del municipio donde esta ubicado el centro educativo que se requiere consultar.',
						'SYSCAP filtrará el listado de centros educativos que coicidan con la búsqueda. Para acceder a la ficha del centro educativo, hacer clic en la fila del registro del centro educativo que se desea consultar.',
						'Dar clic en el botón '.div('Regresar', 'class="btn btn-sm btn-danger"').' para salir de la ficha del centro educativo y regresar al listado de centros educativos.'
						)).br();
						echo heading(anchor(current_url().'#centros_educativos-mostrar', 'Mostrar Centro Educativo', 'name="centros_educativos-mostrar"'), 3).br();
						echo heading('Imprimir Ficha de Centro Educativo.', 4);
						echo ol(array(
						'Dentro del módulo de centros educativos y desde la ficha de un centro educativo, dar clic en el botón '.div('<i class="fa fa-print"></i> Imprimir', 'class="btn btn-sm btn-success"').'.',
						'SYSCAP mostrará un reporte generado con la ficha del centro educativo para ser enviado a impresión.',
						)).br();
						echo p('El botón imprimir no está disponible sólo para dispositivos móviles.').br();
						echo heading('Exportar a Archivo PDF Ficha de Centro Educativo.', 4);
						echo ol(array(
						'Dentro del módulo de centros educativos y desde la ficha de un centro educativo, dar clic en el botón '.div('<i class="fa fa-file-pdf-o"></i> Exportar', 'class="btn btn-sm btn-success"').'.',
						'SYSCAP mostrará un reporte generado con la ficha del centro educativo en archivo PDF para ser almacenado.',
						)).br();
						echo heading('Mostrar la Ficha de un Estudiante.', 4);
						echo ol(array(
						'Dentro del módulo de centros educativos y desde la ficha de un centro educativo, ubicarse en los listados de '.bold('Docentes Capacitados').' y '.bold('Docentes Certificados').', dar clic sobre el registro del estudiante que se desea consultar.',
						'SYSCAP mostrará la ficha del estudiante que se seleccionó.',
						)).br();
						echo heading(anchor(current_url().'#centros_educativos-modificar', 'Editar Centro Educativo', 'name="centros_educativos-modificar"'), 3).br();
						echo ol(array(
						'Dentro del módulo de centros educativos y desde la ficha de un centro educativo, dar clic en el botón '.div('Editar', 'class="btn btn-sm btn-primary"').'.',
						'SYSCAP habilitará los campos de la ficha para modificar la '.bold('Información General').' del centro educativo. Modificar los datos que se necesitan actualizar, cuando se termine de realizar los cambios dar clic en el botón '.bold('Guardar').'; si se desea cancelar la edición, dar clic en el botón '.div('Cancelar', 'class="btn btn-sm btn-danger"').'.',
						'Luego de dar clic en el botón Guardar, SYSCAP mostrará un mensaje de confirmación notificando que se han guardado los datos del centro educativo.'
						)).br();
						?>
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
				<?= heading('<i class="fa fa-bar-chart-o fa-fw"></i> Modulo de Consultas Estadísticas', 2); ?>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<?php
						echo heading(anchor(current_url().'#estadisticas-consulta-1', 'Estadística de Usuarios por Modalidad de Capacitación', 'name="estadisticas-consulta-1"'), 3).br();
						echo ol(array(
						'Dentro del módulo de consultas estadísticas, dar clic a la opción '.bold('Modalidad de Capacitación').' del sub menú del módulo de consultas estadísticas.',
						'Seleccionar un rango de fechas en los calendarios (teniendo en cuenta que la la fecha inicial debe de ser diferente y menor a la fecha final) y dar clic al botón '.div('Consultar', 'class="btn btn-sm btn-primary"').'.',
						'SYSCAP mostrará el resultado de la consulta estadística.',
						'Si se desea deshacer el resultado de la consulta estadística, dar clic al botón '.div('Limpiar', 'class="btn btn-sm btn-danger"').'.'
						)).br();
						echo heading(anchor(current_url().'#estadisticas-generar_reporte', 'Hacer clic aquí para ver como Generar Reporte Estadístico.'), 4).br();
						echo heading(anchor(current_url().'#estadisticas-consulta-2', 'Estadística de Usuarios por Departamento y Rango de Fechas', 'name="estadisticas-consulta-2"'), 3).br();
						echo ol(array(
						'Dentro del módulo de consultas estadísticas, dar clic a la opción '.bold('Departamento y Rango de Fecha').' del sub menú del módulo de consultas estadísticas.',
						'Seleccionar el nombre del departamento de la lista desplegable Departamentos, seleccionar un rango de fechas en los calendarios (teniendo en cuenta que la la fecha inicial debe de ser diferente y menor a la fecha final) y dar clic al botón '.div('Consultar', 'class="btn btn-sm btn-primary"').'.',
						'SYSCAP mostrará el resultado de la consulta estadística.',
						'Si se desea deshacer el resultado de la consulta estadística, dar clic al botón '.div('Limpiar', 'class="btn btn-sm btn-danger"').'.'
						)).br();
						echo heading(anchor(current_url().'#estadisticas-generar_reporte', 'Hacer clic aquí para ver como Generar Reporte Estadístico.'), 4).br();
						echo heading(anchor(current_url().'#estadisticas-consulta-3', 'Estadística de Total de Usuarios por Departamento y Rango de Fechas', 'name="estadisticas-consulta-3"'), 3).br();
						echo ol(array(
						'Dentro del módulo de consultas estadísticas, dar clic a la opción '.bold('Total por Departamento y Rango de Fecha').' del sub menú del módulo de consultas estadísticas.',
						'Seleccionar un rango de fechas en los calendarios (teniendo en cuenta que la la fecha inicial debe de ser diferente y menor a la fecha final) y dar clic al botón '.div('Consultar', 'class="btn btn-sm btn-primary"').'.',
						'SYSCAP mostrará el resultado de la consulta estadística.',
						'Si se desea deshacer el resultado de la consulta estadística, dar clic al botón '.div('Limpiar', 'class="btn btn-sm btn-danger"').'.'
						)).br();
						echo heading(anchor(current_url().'#estadisticas-generar_reporte', 'Hacer clic aquí para ver como Generar Reporte Estadístico.'), 4).br();
						echo heading(anchor(current_url().'#estadisticas-consulta-4', 'Estadística de Usuarios por Departamento, Municipio y Rango de Fechas', 'name="estadisticas-consulta-4"'), 3).br();
						echo ol(array(
						'Dentro del módulo de consultas estadísticas, dar clic a la opción '.bold('Departamento, Municipio y Rango de Fechas').' del sub menú del módulo de consultas estadísticas.',
						'Seleccionar el nombre del departamento de la lista desplegable Departamentos, seleccionar el nombre del municipio de la lista desplegable Municipios, seleccionar un rango de fechas en los calendarios (teniendo en cuenta que la la fecha inicial debe de ser diferente y menor a la fecha final) y dar clic al botón '.div('Consultar', 'class="btn btn-sm btn-primary"').'.',
						'SYSCAP mostrará el resultado de la consulta estadística.',
						'Si se desea deshacer el resultado de la consulta estadística, dar clic al botón '.div('Limpiar', 'class="btn btn-sm btn-danger"').'.'
						)).br();
						echo heading(anchor(current_url().'#estadisticas-generar_reporte', 'Hacer clic aquí para ver como Generar Reporte Estadístico.'), 4).br();
						echo heading(anchor(current_url().'#estadisticas-consulta-5', 'Estadística de Usuarios por Tipo de Capacitados y Fecha a Nivel Nacional', 'name="estadisticas-consulta-5"'), 3).br();
						echo ol(array(
						'Dentro del módulo de consultas estadísticas, dar clic a la opción '.bold('Tipo de Capacitados y Fecha a Nivel Nacional').' del sub menú del módulo de consultas estadísticas.',
						'Seleccionar un tipo de capacitado de la lista desplegable Tipo de Capacitados, seleccionar un rango de fechas en los calendarios (teniendo en cuenta que la la fecha inicial debe de ser diferente y menor a la fecha final) y dar clic al botón '.div('Consultar', 'class="btn btn-sm btn-primary"').'.',
						'SYSCAP mostrará el resultado de la consulta estadística.',
						'Si se desea deshacer el resultado de la consulta estadística, dar clic al botón '.div('Limpiar', 'class="btn btn-sm btn-danger"').'.'
						)).br();
						echo heading(anchor(current_url().'#estadisticas-generar_reporte', 'Hacer clic aquí para ver como Generar Reporte Estadístico.'), 4).br();
						echo heading(anchor(current_url().'#estadisticas-consulta-6', 'Estadística de Usuarios por Tipo de Capacitados, Departamento y Fecha', 'name="estadisticas-consulta-6"'), 3).br();
						echo ol(array(
						'Dentro del módulo de consultas estadísticas, dar clic a la opción '.bold('Tipo de Capacitados, Departamento y Fecha').' del sub menú del módulo de consultas estadísticas.',
						'Seleccionar un tipo de capacitado de la lista desplegable Tipo de Capacitados, seleccionar el nombre del departamento de la lista desplegable Departamentos, seleccionar un rango de fechas en los calendarios (teniendo en cuenta que la la fecha inicial debe de ser diferente y menor a la fecha final) y dar clic al botón '.div('Consultar', 'class="btn btn-sm btn-primary"').'.',
						'SYSCAP mostrará el resultado de la consulta estadística.',
						'Si se desea deshacer el resultado de la consulta estadística, dar clic al botón '.div('Limpiar', 'class="btn btn-sm btn-danger"').'.'
						)).br();
						echo heading(anchor(current_url().'#estadisticas-generar_reporte', 'Hacer clic aquí para ver como Generar Reporte Estadístico.'), 4).br();
						echo heading(anchor(current_url().'#estadisticas-consulta-7', 'Estadística de Usuarios por Tipo de Capacitados, Departamento y Municipio', 'name="estadisticas-consulta-7"'), 3).br();
						echo ol(array(
						'Dentro del módulo de consultas estadísticas, dar clic a la opción '.bold('Tipo de Capacitados, Departamento y Municipio').' del sub menú del módulo de consultas estadísticas.',
						'Seleccionar el nombre del departamento de la lista desplegable Departamentos, seleccionar el nombre del municipio de la lista desplegable Municipios, seleccionar un tipo de capacitado de la lista desplegable Tipo de Capacitados, seleccionar un rango de fechas en los calendarios (teniendo en cuenta que la la fecha inicial debe de ser diferente y menor a la fecha final) y dar clic al botón '.div('Consultar', 'class="btn btn-sm btn-primary"').'.',
						'SYSCAP mostrará el resultado de la consulta estadística.',
						'Si se desea deshacer el resultado de la consulta estadística, dar clic al botón '.div('Limpiar', 'class="btn btn-sm btn-danger"').'.'
						)).br();
						echo heading(anchor(current_url().'#estadisticas-generar_reporte', 'Hacer clic aquí para ver como Generar Reporte Estadístico.'), 4).br();
						echo heading(anchor(current_url().'#estadisticas-consulta-8', 'Estadística de Usuarios por Departamento, Tipo de Capacitados y Fecha', 'name="estadisticas-consulta-8"'), 3).br();
						echo ol(array(
						'Dentro del módulo de consultas estadísticas, dar clic a la opción '.bold('Departamento, Tipo de Capacitados y Fecha').' del sub menú del módulo de consultas estadísticas.',
						'Seleccionar un tipo de capacitado de la lista desplegable Tipo de Capacitados, seleccionar un rango de fechas en los calendarios (teniendo en cuenta que la la fecha inicial debe de ser diferente y menor a la fecha final) y dar clic al botón '.div('Consultar', 'class="btn btn-sm btn-primary"').'.',
						'SYSCAP mostrará el resultado de la consulta estadística.',
						'Si se desea deshacer el resultado de la consulta estadística, dar clic al botón '.div('Limpiar', 'class="btn btn-sm btn-danger"').'.'
						)).br();
						echo heading(anchor(current_url().'#estadisticas-generar_reporte', 'Hacer clic aquí para ver como Generar Reporte Estadístico.'), 4).br();
						echo heading(anchor(current_url().'#estadisticas-consulta-9', 'Estadística de Usuarios por Tipo de Capacitados y Centro Educativo', 'name="estadisticas-consulta-9"'), 3).br();
						echo ol(array(
						'Dentro del módulo de consultas estadísticas, dar clic a la opción '.bold('Tipo de Capacitados y Centro Educativo').' del sub menú del módulo de consultas estadísticas.',
						'Seleccionar un tipo de capacitado de la lista desplegable Tipo de Capacitados, seleccionar un centros educativo del campo Centros Educativos y dar clic al botón '.div('Consultar', 'class="btn btn-sm btn-primary"').'.',
						'SYSCAP mostrará el resultado de la consulta estadística.',
						'Si se desea deshacer el resultado de la consulta estadística, dar clic al botón '.div('Limpiar', 'class="btn btn-sm btn-danger"').'.'
						)).br();
						echo heading(anchor(current_url().'#estadisticas-generar_reporte', 'Hacer clic aquí para ver como Generar Reporte Estadístico.'), 4).br();
						echo heading(anchor(current_url().'#estadisticas-consulta-10', 'Estadística de Usuarios a Nivel Nacional', 'name="estadisticas-consulta-10"'), 3).br();
						echo ol(array(
						'Dentro del módulo de consultas estadísticas, dar clic a la opción '.bold('Nivel Nacional').' del sub menú del módulo de consultas estadísticas.',
						'Seleccionar un tipo de capacitado de la lista desplegable Tipo de Capacitados, seleccionar un rango de fechas en los calendarios (teniendo en cuenta que la la fecha inicial debe de ser diferente y menor a la fecha final) y dar clic al botón '.div('Consultar', 'class="btn btn-sm btn-primary"').'.',
						'SYSCAP mostrará el resultado de la consulta estadística.',
						'Si se desea deshacer el resultado de la consulta estadística, dar clic al botón '.div('Limpiar', 'class="btn btn-sm btn-danger"').'.'
						)).br();
						echo heading(anchor(current_url().'#estadisticas-generar_reporte', 'Hacer clic aquí para ver como Generar Reporte Estadístico.'), 4).br();
						
						echo heading(anchor(current_url().'#estadisticas-consulta-11', 'Estadística de Usuarios por Grado Digital', 'name="estadisticas-consulta-11"'), 3).br();
						echo ol(array(
						'Dentro del módulo de consultas estadísticas, dar clic a la opción '.bold('Grado Digital').' del sub menú del módulo de consultas estadísticas.',
						'Seleccionar una categoría de grado digital de la lista desplegable Grado Digital, seleccionar un rango de fechas en los calendarios (teniendo en cuenta que la la fecha inicial debe de ser diferente y menor a la fecha final) y dar clic al botón '.div('Consultar', 'class="btn btn-sm btn-primary"').'.',
						'SYSCAP mostrará el resultado de la consulta estadística.',
						'Si se desea deshacer el resultado de la consulta estadística, dar clic al botón '.div('Limpiar', 'class="btn btn-sm btn-danger"').'.'
						)).br();
						echo heading(anchor(current_url().'#estadisticas-generar_reporte', 'Hacer clic aquí para ver como Generar Reporte Estadístico.'), 4).br();
						
						echo heading(anchor(current_url().'#estadisticas-generar_reporte', 'Generar Reporte Estadístico', 'name="estadisticas-generar_reporte"'), 3).br();
						echo heading('Imprimir Consulta Estadística.', 4);
						echo ol(array(
						'Dentro del módulo de consultas estadísticas y desde la pantalla de resultado de una consulta estadística, dar clic en el botón '.div('<i class="fa fa-print"></i> Imprimir', 'class="btn btn-sm btn-success"').'.',
						'SYSCAP mostrará un reporte generado con el resultado de la consulta estadística para ser enviado a impresión.',
						)).br();
						echo p('El botón imprimir no está disponible sólo para dispositivos móviles.').br();
						echo heading('Exportar a Archivo PDF Consulta Estadística.', 4);
						echo ol(array(
						'Dentro del módulo de consultas estadísticas y desde la pantalla de resultado de una consulta estadística, dar clic en el botón '.div('<i class="fa fa-file-pdf-o"></i> Exportar', 'class="btn btn-sm btn-success"').'.',
						'SYSCAP mostrará un reporte generado con el resultado de la consulta estadística en archivo PDF para ser almacenado.',
						)).br();
						?>
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
				<?= heading('<i class="fa fa-map-marker fa-fw"></i> Modulo de Mapa Estadístico', 2); ?>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<?php
						echo p('Muestra en el mapa de El Salvador el total de docentes de la modalidad de capacitación tutorizados y tipo de capacitado por departamento, municipio y centro educativo.').br();
						echo heading(anchor(current_url().'#mapa', 'Lista de Departamentos', 'name="mapa"'), 3).br();
						echo heading('Consultar Cantidad de Docentes Capacitados y Docentes Certificados por Departamento.', 4);
						echo p('Método 1.');
						echo ol(array(
						'Dentro del módulo de mapa estadístico, ubicarse en el listado de '.bold('Departamentos').' ubicado en la parte inferior del mapa de El Salvador.',
						'Hacer clic sobre el registro del departamento que se desea consultar.',
						'SYSCAP mostrará el departamento seleccionado en el mapa de El Salvador y en una viñeta mostrará la cantidad de docentes por tipo de capacitado de la modalidad de capacitación tutorizados del departamento.',
						'Dar clic al enlace '.bold('Ver departamento').' para ver los municipios del departamento.'
						)).br();
						echo p('Método 2.');
						echo ol(array(
						'Dentro del módulo de mapa estadístico, ubicarse en el mapa de El Salvador.',
						'Navegar sobre el mapa de El Salvador y dar clic al '.bold('Marcador <font color="red" size="4"><i class="fa fa-map-marker fa-fw"></i></font>').' sobre el departamento que se desea consultar.',
						'SYSCAP mostrará el departamento seleccionado en el mapa de El Salvador y en una viñeta mostrará la cantidad de docentes por tipo de capacitado de la modalidad de capacitación tutorizados del departamento.',
						'Dar clic al enlace '.bold('Ver departamento').' para ver los municipios del departamento.'
						)).br();
						echo heading(anchor(current_url().'#mapa-departamento', 'Lista de Municipios', 'name="mapa-departamento"'), 3).br();
						echo heading('Consultar Cantidad de Docentes Capacitados y Docentes Certificados por Municipio.', 4);
						echo p('Método 1.');
						echo ol(array(
						'Dentro del módulo de mapa estadístico y el mapa de un departamento, ubicarse en el listado de '.bold('Municipios').' ubicado en la parte inferior del mapa del Departamento.',
						'Hacer clic sobre el registro del municipio que se desea consultar.',
						'SYSCAP mostrará el municipio seleccionado en el mapa del departamento y en una viñeta mostrará la cantidad de docentes por tipo de capacitado de la modalidad de capacitación tutorizados del municipio.',
						'Dar clic al enlace '.bold('Ver municipio').' para ver los centros educativos del municipio.',
						'Para regresar al mapa de El Salvador y realizar otra búsqueda con un departamento diferente, ubicarse sobre la parte superior izquierda del mapa y hacer clic al enlace '.bold('El Salvador').'.'
						)).br();
						echo p('Método 2.');
						echo ol(array(
						'Dentro del módulo de mapa estadístico y el mapa de un departamento, ubicarse en el mapa del departamento.',
						'Navegar sobre el mapa del departamento y dar clic al '.bold('Marcador <font color="red" size="4"><i class="fa fa-map-marker fa-fw"></i></font>').' sobre el municipio que se desea consultar.',
						'SYSCAP mostrará el municipio seleccionado en el mapa del departamento y en una viñeta mostrará la cantidad de docentes por tipo de capacitado de la modalidad de capacitación tutorizados del municipio.',
						'Dar clic al enlace '.bold('Ver municipio').' para ver los centros educativos del municipio.',
						'Para regresar al mapa de El Salvador y realizar otra búsqueda con un departamento diferente, ubicarse sobre la parte superior izquierda del mapa y hacer clic al enlace '.bold('El Salvador').'.'
						)).br();
						echo heading(anchor(current_url().'#mapa-municipio', 'Lista de Centros Educativos', 'name="mapa-municipio"'), 3).br();
						echo heading('Consultar Cantidad de Docentes Capacitados y Docentes Certificados por Centro Educativo.', 4);
						echo p('Método 1.');
						echo ol(array(
						'Dentro del módulo de mapa estadístico y el mapa de un municipio, ubicarse en el listado de '.bold('Centros Educativos').' ubicado en la parte inferior del mapa del Municipio.',
						'Hacer clic sobre el registro del centro educativo que se desea consultar.',
						'SYSCAP mostrará el centro educativo seleccionado en el mapa del municipio y en una viñeta mostrará la cantidad de docentes por tipo de capacitado de la modalidad de capacitación tutorizados del centro educativo.',
						'Dar clic al enlace '.bold('Ver centro educativo').' para ir a la ficha del centro educativo y ver los docentes capacitados y docentes certificados.',
						'Para regresar al mapa del departamento y realizar otra búsqueda con un municipio diferente, ubicarse sobre la parte superior izquierda del mapa y hacer clic al enlace con el '.bold('Nombre del Departamento').', o si desea realizar otra búsqueda con un departamento diferente, hacer clic al enlace '.bold('El Salvador').'.'
						)).br();
						echo p('Método 2.');
						echo ol(array(
						'Dentro del módulo de mapa estadístico y el mapa de un municipio, ubicarse en el mapa del municipio.',
						'Navegar sobre el mapa del municipio y dar clic al '.bold('Marcador <font color="red" size="4"><i class="fa fa-map-marker fa-fw"></i></font>').' sobre el centro educativo que se desea consultar.',
						'SYSCAP mostrará el centro educativo seleccionado en el mapa del municipio y en una viñeta mostrará la cantidad de docentes por tipo de capacitado de la modalidad de capacitación tutorizados del centro educativo.',
						'Dar clic al enlace '.bold('Ver centro educativo').' para ir a la ficha del centro educativo y ver los docentes capacitados y docentes certificados.',
						'Para regresar al mapa del departamento y realizar otra búsqueda con un municipio diferente, ubicarse sobre la parte superior izquierda del mapa y hacer clic al enlace con el '.bold('Nombre del Departamento').', o si desea realizar otra búsqueda con un departamento diferente, hacer clic al enlace '.bold('El Salvador').'.'
						)).br();
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>