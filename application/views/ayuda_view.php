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
						echo p('SYSCAP muestra el listado de estudiantes por: Nombre de Usuario, Nombre Completo, N�mero de DUI, Correo Electr�nico y Centro Educativo.').br();
						echo heading('B�squeda de Estudiante por Nombre de Usuario.', 4);
						echo ol(array(
						'Dentro del m�dulo de usuarios, ubicarse en el campo de b�squeda '.bold('Buscar').' ubicado en la parte superior derecha del listado de usuarios.',
						'Digitar el nombre de usuario que corresponda al estudiante que se requiere consultar.',
						'SYSCAP filtrar� el listado de usuarios que coicidan con la b�squeda. Para acceder a la ficha del estudiante, hacer clic en la fila del registro del estudiante que se desea consultar.',
						'Dar clic en el bot�n '.div('Regresar', 'class="btn btn-sm btn-danger"').' para salir de la ficha del estudiante y regresar al listado de usuarios.'
						)).br();
						echo heading('B�squeda de Estudiante por Nombre Completo.', 4);
						echo ol(array(
						'Dentro del m�dulo de usuarios, ubicarse en el campo de b�squeda '.bold('Buscar').' ubicado en la parte superior derecha del listado de usuarios.',
						'Digitar el nombre completo, nombre o apellidos del usuario que corresponda al estudiante que se requiere consultar.',
						'SYSCAP filtrar� el listado de usuarios que coicidan con la b�squeda. Para acceder a la ficha del estudiante, hacer clic en la fila del registro del estudiante que se desea consultar.',
						'Dar clic en el bot�n '.div('Regresar', 'class="btn btn-sm btn-danger"').' para salir de la ficha del estudiante y regresar al listado de usuarios.'
						)).br();
						echo heading('B�squeda de Estudiante por N�mero de DUI.', 4);
						echo ol(array(
						'Dentro del m�dulo de usuarios, ubicarse en el campo de b�squeda '.bold('Buscar').' ubicado en la parte superior derecha del listado de usuarios.',
						'Digitar el n�mero de DUI que corresponda al estudiante que se requiere consultar.',
						'SYSCAP filtrar� el listado de usuarios que coicidan con la b�squeda. Para acceder a la ficha del estudiante, hacer clic en la fila del registro del estudiante que se desea consultar.',
						'Dar clic en el bot�n '.div('Regresar', 'class="btn btn-sm btn-danger"').' para salir de la ficha del estudiante y regresar al listado de usuarios.'
						)).br();
						echo heading('B�squeda de Estudiante por Correo Electr�nico.', 4);
						echo ol(array(
						'Dentro del m�dulo de usuarios, ubicarse en el campo de b�squeda '.bold('Buscar').' ubicado en la parte superior derecha del listado de usuarios.',
						'Digitar el correo electr�nico que corresponda al estudiante que se requiere consultar.',
						'SYSCAP filtrar� el listado de usuarios que coicidan con la b�squeda. Para acceder a la ficha del estudiante, hacer clic en la fila del registro del estudiante que se desea consultar.',
						'Dar clic en el bot�n '.div('Regresar', 'class="btn btn-sm btn-danger"').' para salir de la ficha del estudiante y regresar al listado de usuarios.'
						)).br();
						echo heading('B�squeda de Estudiante por Centro Educativo.', 4);
						echo ol(array(
						'Dentro del m�dulo de usuarios, ubicarse en el campo de b�squeda '.bold('Centro Educativo').' ubicado en la parte superior del listado de usuarios.',
						'Digitar el nombre del centro educativo que corresponda al estudiante que se requiere consultar.',
						'SYSCAP filtrar� el listado de usuarios que coicidan con la b�squeda. Para acceder a la ficha del estudiante, hacer clic en la fila del registro del estudiante que se desea consultar.',
						'Dar clic en el bot�n '.div('Regresar', 'class="btn btn-sm btn-danger"').' para salir de la ficha del estudiante y regresar al listado de usuarios.'
						)).br();
						}
						echo heading(anchor(current_url().'#usuarios-mostrar', 'Mostrar Usuario', 'name="usuarios-mostrar"'), 3).br();
						echo heading('Imprimir Ficha de Estudiante.', 4);
						echo ol(array(
						'Dentro del m�dulo de usuarios y desde la ficha de un estudiante, dar clic en el bot�n '.div('<i class="fa fa-print"></i> Imprimir', 'class="btn btn-sm btn-success"').'.',
						'SYSCAP mostrar� un reporte generado con la ficha del estudiante para ser enviado a impresi�n.',
						)).br();
						echo p('El bot�n imprimir no est� disponible s�lo para dispositivos m�viles.').br();
						echo heading('Exportar a Archivo PDF Ficha de Estudiante.', 4);
						echo ol(array(
						'Dentro del m�dulo de usuarios y desde la ficha de un estudiante, dar clic en el bot�n '.div('<i class="fa fa-file-pdf-o"></i> Exportar', 'class="btn btn-sm btn-success"').'.',
						'SYSCAP mostrar� un reporte generado con la ficha del estudiante en archivo PDF para ser almacenado.',
						)).br();
						if($this->session->userdata('nombre_corto_rol') == 'admin'){
						echo heading(anchor(current_url().'#usuarios-modificar', 'Editar Usuario', 'name="usuarios-modificar"'), 3).br();
						echo ol(array(
						'Dentro del m�dulo de usuarios y desde la ficha de un estudiante, dar clic en el bot�n '.div('Editar', 'class="btn btn-sm btn-primary"').'.',
						'SYSCAP habilitar� los campos de la ficha para modificar los '.bold('Datos Personales').' del estudiante. Modificar los datos que se necesitan actualizar, cuando se termine de realizar los cambios dar clic en el bot�n '.bold('Guardar').'; si se desea cancelar la edici�n, dar clic en el bot�n '.div('Cancelar', 'class="btn btn-sm btn-danger"').'.',
						'Luego de dar clic en el bot�n Guardar, SYSCAP mostrar� un mensaje de confirmaci�n notificando que se han guardado los datos del usuario.'
						)).br();
						echo heading(anchor(current_url().'#usuarios-recuperar_contrasena', 'Recuperar Contrase�a Usuario', 'name="usuarios-recuperar_contrasena"'), 3).br();
						echo p('Esta secci�n es �til para que el administrador proporcione una nueva contrase�a a un estudiante que la ha olvidado o extraviado su contrase�a.').br();
						echo ol(array(
						'Dentro del m�dulo de usuarios y desde la ficha de un estudiante, dar clic en el bot�n '.div('Recuperar Contrase�a', 'class="btn btn-sm btn-primary"').'.',
						'SYSCAP habilitar� los campos de la ficha para modificar los '.bold('Datos de Usuario').' del estudiante. Modificar la contrase�a que se desea recuperar, cuando se termine de realizar los cambios dar clic en el bot�n '.bold('Guardar').'; si se desea cancelar la recuperaci�n de contrase�a, dar clic en el bot�n '.div('Cancelar', 'class="btn btn-sm btn-danger"').'.',
						'Luego de dar clic en el bot�n Guardar, SYSCAP mostrar� un mensaje de confirmaci�n notificando que se han guardado los datos del usuario.'
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
						echo p('Permite consultar Centros Educativos de capacitaci�n de docentes, realizando b�squedas por: C�digo, Nombre, Departamento y Municipio.').br();
						echo heading('B�squeda de Centro Educativo por C�digo.', 4);
						echo ol(array(
						'Dentro del m�dulo de centros educativos, ubicarse en el campo de b�squeda '.bold('Buscar').' ubicado en la parte superior derecha del listado de centros educativos.',
						'Digitar el c�digo del centro educativo que se requiere consultar.',
						'SYSCAP filtrar� el listado de centros educativos que coicidan con la b�squeda. Para acceder a la ficha del centro educativo, hacer clic en la fila del registro del centro educativo que se desea consultar.',
						'Dar clic en el bot�n '.div('Regresar', 'class="btn btn-sm btn-danger"').' para salir de la ficha del centro educativo y regresar al listado de centros educativos.'
						)).br();
						echo heading('B�squeda de Centro Educativo por Nombre.', 4);
						echo ol(array(
						'Dentro del m�dulo de centros educativos, ubicarse en el campo de b�squeda '.bold('Buscar').' ubicado en la parte superior derecha del listado de centros educativos.',
						'Digitar el nombre del centro educativo que se requiere consultar.',
						'SYSCAP filtrar� el listado de centros educativos que coicidan con la b�squeda. Para acceder a la ficha del centro educativo, hacer clic en la fila del registro del centro educativo que se desea consultar.',
						'Dar clic en el bot�n '.div('Regresar', 'class="btn btn-sm btn-danger"').' para salir de la ficha del centro educativo y regresar al listado de centros educativos.'
						)).br();
						echo heading('B�squeda de Centro Educativo por Departamento.', 4);
						echo ol(array(
						'Dentro del m�dulo de centros educativos, ubicarse en el campo de b�squeda '.bold('Buscar').' ubicado en la parte superior derecha del listado de centros educativos.',
						'Digitar el nombre del departamento donde esta ubicado el centro educativo que se requiere consultar.',
						'SYSCAP filtrar� el listado de centros educativos que coicidan con la b�squeda. Para acceder a la ficha del centro educativo, hacer clic en la fila del registro del centro educativo que se desea consultar.',
						'Dar clic en el bot�n '.div('Regresar', 'class="btn btn-sm btn-danger"').' para salir de la ficha del centro educativo y regresar al listado de centros educativos.'
						)).br();
						echo heading('B�squeda de Centro Educativo por Municipio.', 4);
						echo ol(array(
						'Dentro del m�dulo de centros educativos, ubicarse en el campo de b�squeda '.bold('Buscar').' ubicado en la parte superior derecha del listado de centros educativos.',
						'Digitar el nombre del municipio donde esta ubicado el centro educativo que se requiere consultar.',
						'SYSCAP filtrar� el listado de centros educativos que coicidan con la b�squeda. Para acceder a la ficha del centro educativo, hacer clic en la fila del registro del centro educativo que se desea consultar.',
						'Dar clic en el bot�n '.div('Regresar', 'class="btn btn-sm btn-danger"').' para salir de la ficha del centro educativo y regresar al listado de centros educativos.'
						)).br();
						echo heading(anchor(current_url().'#centros_educativos-mostrar', 'Mostrar Centro Educativo', 'name="centros_educativos-mostrar"'), 3).br();
						echo heading('Imprimir Ficha de Centro Educativo.', 4);
						echo ol(array(
						'Dentro del m�dulo de centros educativos y desde la ficha de un centro educativo, dar clic en el bot�n '.div('<i class="fa fa-print"></i> Imprimir', 'class="btn btn-sm btn-success"').'.',
						'SYSCAP mostrar� un reporte generado con la ficha del centro educativo para ser enviado a impresi�n.',
						)).br();
						echo p('El bot�n imprimir no est� disponible s�lo para dispositivos m�viles.').br();
						echo heading('Exportar a Archivo PDF Ficha de Centro Educativo.', 4);
						echo ol(array(
						'Dentro del m�dulo de centros educativos y desde la ficha de un centro educativo, dar clic en el bot�n '.div('<i class="fa fa-file-pdf-o"></i> Exportar', 'class="btn btn-sm btn-success"').'.',
						'SYSCAP mostrar� un reporte generado con la ficha del centro educativo en archivo PDF para ser almacenado.',
						)).br();
						echo heading('Mostrar la Ficha de un Estudiante.', 4);
						echo ol(array(
						'Dentro del m�dulo de centros educativos y desde la ficha de un centro educativo, ubicarse en los listados de '.bold('Docentes Capacitados').' y '.bold('Docentes Certificados').', dar clic sobre el registro del estudiante que se desea consultar.',
						'SYSCAP mostrar� la ficha del estudiante que se seleccion�.',
						)).br();
						echo heading(anchor(current_url().'#centros_educativos-modificar', 'Editar Centro Educativo', 'name="centros_educativos-modificar"'), 3).br();
						echo ol(array(
						'Dentro del m�dulo de centros educativos y desde la ficha de un centro educativo, dar clic en el bot�n '.div('Editar', 'class="btn btn-sm btn-primary"').'.',
						'SYSCAP habilitar� los campos de la ficha para modificar la '.bold('Informaci�n General').' del centro educativo. Modificar los datos que se necesitan actualizar, cuando se termine de realizar los cambios dar clic en el bot�n '.bold('Guardar').'; si se desea cancelar la edici�n, dar clic en el bot�n '.div('Cancelar', 'class="btn btn-sm btn-danger"').'.',
						'Luego de dar clic en el bot�n Guardar, SYSCAP mostrar� un mensaje de confirmaci�n notificando que se han guardado los datos del centro educativo.'
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
				<?= heading('<i class="fa fa-bar-chart-o fa-fw"></i> Modulo de Consultas Estad�sticas', 2); ?>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<?php
						echo heading(anchor(current_url().'#estadisticas-consulta-1', 'Estad�stica de Usuarios por Modalidad de Capacitaci�n', 'name="estadisticas-consulta-1"'), 3).br();
						echo ol(array(
						'Dentro del m�dulo de consultas estad�sticas, dar clic a la opci�n '.bold('Modalidad de Capacitaci�n').' del sub men� del m�dulo de consultas estad�sticas.',
						'Seleccionar un rango de fechas en los calendarios (teniendo en cuenta que la la fecha inicial debe de ser diferente y menor a la fecha final) y dar clic al bot�n '.div('Consultar', 'class="btn btn-sm btn-primary"').'.',
						'SYSCAP mostrar� el resultado de la consulta estad�stica.',
						'Si se desea deshacer el resultado de la consulta estad�stica, dar clic al bot�n '.div('Limpiar', 'class="btn btn-sm btn-danger"').'.'
						)).br();
						echo heading(anchor(current_url().'#estadisticas-generar_reporte', 'Hacer clic aqu� para ver como Generar Reporte Estad�stico.'), 4).br();
						echo heading(anchor(current_url().'#estadisticas-consulta-2', 'Estad�stica de Usuarios por Departamento y Rango de Fechas', 'name="estadisticas-consulta-2"'), 3).br();
						echo ol(array(
						'Dentro del m�dulo de consultas estad�sticas, dar clic a la opci�n '.bold('Departamento y Rango de Fecha').' del sub men� del m�dulo de consultas estad�sticas.',
						'Seleccionar el nombre del departamento de la lista desplegable Departamentos, seleccionar un rango de fechas en los calendarios (teniendo en cuenta que la la fecha inicial debe de ser diferente y menor a la fecha final) y dar clic al bot�n '.div('Consultar', 'class="btn btn-sm btn-primary"').'.',
						'SYSCAP mostrar� el resultado de la consulta estad�stica.',
						'Si se desea deshacer el resultado de la consulta estad�stica, dar clic al bot�n '.div('Limpiar', 'class="btn btn-sm btn-danger"').'.'
						)).br();
						echo heading(anchor(current_url().'#estadisticas-generar_reporte', 'Hacer clic aqu� para ver como Generar Reporte Estad�stico.'), 4).br();
						echo heading(anchor(current_url().'#estadisticas-consulta-3', 'Estad�stica de Total de Usuarios por Departamento y Rango de Fechas', 'name="estadisticas-consulta-3"'), 3).br();
						echo ol(array(
						'Dentro del m�dulo de consultas estad�sticas, dar clic a la opci�n '.bold('Total por Departamento y Rango de Fecha').' del sub men� del m�dulo de consultas estad�sticas.',
						'Seleccionar un rango de fechas en los calendarios (teniendo en cuenta que la la fecha inicial debe de ser diferente y menor a la fecha final) y dar clic al bot�n '.div('Consultar', 'class="btn btn-sm btn-primary"').'.',
						'SYSCAP mostrar� el resultado de la consulta estad�stica.',
						'Si se desea deshacer el resultado de la consulta estad�stica, dar clic al bot�n '.div('Limpiar', 'class="btn btn-sm btn-danger"').'.'
						)).br();
						echo heading(anchor(current_url().'#estadisticas-generar_reporte', 'Hacer clic aqu� para ver como Generar Reporte Estad�stico.'), 4).br();
						echo heading(anchor(current_url().'#estadisticas-consulta-4', 'Estad�stica de Usuarios por Departamento, Municipio y Rango de Fechas', 'name="estadisticas-consulta-4"'), 3).br();
						echo ol(array(
						'Dentro del m�dulo de consultas estad�sticas, dar clic a la opci�n '.bold('Departamento, Municipio y Rango de Fechas').' del sub men� del m�dulo de consultas estad�sticas.',
						'Seleccionar el nombre del departamento de la lista desplegable Departamentos, seleccionar el nombre del municipio de la lista desplegable Municipios, seleccionar un rango de fechas en los calendarios (teniendo en cuenta que la la fecha inicial debe de ser diferente y menor a la fecha final) y dar clic al bot�n '.div('Consultar', 'class="btn btn-sm btn-primary"').'.',
						'SYSCAP mostrar� el resultado de la consulta estad�stica.',
						'Si se desea deshacer el resultado de la consulta estad�stica, dar clic al bot�n '.div('Limpiar', 'class="btn btn-sm btn-danger"').'.'
						)).br();
						echo heading(anchor(current_url().'#estadisticas-generar_reporte', 'Hacer clic aqu� para ver como Generar Reporte Estad�stico.'), 4).br();
						echo heading(anchor(current_url().'#estadisticas-consulta-5', 'Estad�stica de Usuarios por Tipo de Capacitados y Fecha a Nivel Nacional', 'name="estadisticas-consulta-5"'), 3).br();
						echo ol(array(
						'Dentro del m�dulo de consultas estad�sticas, dar clic a la opci�n '.bold('Tipo de Capacitados y Fecha a Nivel Nacional').' del sub men� del m�dulo de consultas estad�sticas.',
						'Seleccionar un tipo de capacitado de la lista desplegable Tipo de Capacitados, seleccionar un rango de fechas en los calendarios (teniendo en cuenta que la la fecha inicial debe de ser diferente y menor a la fecha final) y dar clic al bot�n '.div('Consultar', 'class="btn btn-sm btn-primary"').'.',
						'SYSCAP mostrar� el resultado de la consulta estad�stica.',
						'Si se desea deshacer el resultado de la consulta estad�stica, dar clic al bot�n '.div('Limpiar', 'class="btn btn-sm btn-danger"').'.'
						)).br();
						echo heading(anchor(current_url().'#estadisticas-generar_reporte', 'Hacer clic aqu� para ver como Generar Reporte Estad�stico.'), 4).br();
						echo heading(anchor(current_url().'#estadisticas-consulta-6', 'Estad�stica de Usuarios por Tipo de Capacitados, Departamento y Fecha', 'name="estadisticas-consulta-6"'), 3).br();
						echo ol(array(
						'Dentro del m�dulo de consultas estad�sticas, dar clic a la opci�n '.bold('Tipo de Capacitados, Departamento y Fecha').' del sub men� del m�dulo de consultas estad�sticas.',
						'Seleccionar un tipo de capacitado de la lista desplegable Tipo de Capacitados, seleccionar el nombre del departamento de la lista desplegable Departamentos, seleccionar un rango de fechas en los calendarios (teniendo en cuenta que la la fecha inicial debe de ser diferente y menor a la fecha final) y dar clic al bot�n '.div('Consultar', 'class="btn btn-sm btn-primary"').'.',
						'SYSCAP mostrar� el resultado de la consulta estad�stica.',
						'Si se desea deshacer el resultado de la consulta estad�stica, dar clic al bot�n '.div('Limpiar', 'class="btn btn-sm btn-danger"').'.'
						)).br();
						echo heading(anchor(current_url().'#estadisticas-generar_reporte', 'Hacer clic aqu� para ver como Generar Reporte Estad�stico.'), 4).br();
						echo heading(anchor(current_url().'#estadisticas-consulta-7', 'Estad�stica de Usuarios por Tipo de Capacitados, Departamento y Municipio', 'name="estadisticas-consulta-7"'), 3).br();
						echo ol(array(
						'Dentro del m�dulo de consultas estad�sticas, dar clic a la opci�n '.bold('Tipo de Capacitados, Departamento y Municipio').' del sub men� del m�dulo de consultas estad�sticas.',
						'Seleccionar el nombre del departamento de la lista desplegable Departamentos, seleccionar el nombre del municipio de la lista desplegable Municipios, seleccionar un tipo de capacitado de la lista desplegable Tipo de Capacitados, seleccionar un rango de fechas en los calendarios (teniendo en cuenta que la la fecha inicial debe de ser diferente y menor a la fecha final) y dar clic al bot�n '.div('Consultar', 'class="btn btn-sm btn-primary"').'.',
						'SYSCAP mostrar� el resultado de la consulta estad�stica.',
						'Si se desea deshacer el resultado de la consulta estad�stica, dar clic al bot�n '.div('Limpiar', 'class="btn btn-sm btn-danger"').'.'
						)).br();
						echo heading(anchor(current_url().'#estadisticas-generar_reporte', 'Hacer clic aqu� para ver como Generar Reporte Estad�stico.'), 4).br();
						echo heading(anchor(current_url().'#estadisticas-consulta-8', 'Estad�stica de Usuarios por Departamento, Tipo de Capacitados y Fecha', 'name="estadisticas-consulta-8"'), 3).br();
						echo ol(array(
						'Dentro del m�dulo de consultas estad�sticas, dar clic a la opci�n '.bold('Departamento, Tipo de Capacitados y Fecha').' del sub men� del m�dulo de consultas estad�sticas.',
						'Seleccionar un tipo de capacitado de la lista desplegable Tipo de Capacitados, seleccionar un rango de fechas en los calendarios (teniendo en cuenta que la la fecha inicial debe de ser diferente y menor a la fecha final) y dar clic al bot�n '.div('Consultar', 'class="btn btn-sm btn-primary"').'.',
						'SYSCAP mostrar� el resultado de la consulta estad�stica.',
						'Si se desea deshacer el resultado de la consulta estad�stica, dar clic al bot�n '.div('Limpiar', 'class="btn btn-sm btn-danger"').'.'
						)).br();
						echo heading(anchor(current_url().'#estadisticas-generar_reporte', 'Hacer clic aqu� para ver como Generar Reporte Estad�stico.'), 4).br();
						echo heading(anchor(current_url().'#estadisticas-consulta-9', 'Estad�stica de Usuarios por Tipo de Capacitados y Centro Educativo', 'name="estadisticas-consulta-9"'), 3).br();
						echo ol(array(
						'Dentro del m�dulo de consultas estad�sticas, dar clic a la opci�n '.bold('Tipo de Capacitados y Centro Educativo').' del sub men� del m�dulo de consultas estad�sticas.',
						'Seleccionar un tipo de capacitado de la lista desplegable Tipo de Capacitados, seleccionar un centros educativo del campo Centros Educativos y dar clic al bot�n '.div('Consultar', 'class="btn btn-sm btn-primary"').'.',
						'SYSCAP mostrar� el resultado de la consulta estad�stica.',
						'Si se desea deshacer el resultado de la consulta estad�stica, dar clic al bot�n '.div('Limpiar', 'class="btn btn-sm btn-danger"').'.'
						)).br();
						echo heading(anchor(current_url().'#estadisticas-generar_reporte', 'Hacer clic aqu� para ver como Generar Reporte Estad�stico.'), 4).br();
						echo heading(anchor(current_url().'#estadisticas-consulta-10', 'Estad�stica de Usuarios a Nivel Nacional', 'name="estadisticas-consulta-10"'), 3).br();
						echo ol(array(
						'Dentro del m�dulo de consultas estad�sticas, dar clic a la opci�n '.bold('Nivel Nacional').' del sub men� del m�dulo de consultas estad�sticas.',
						'Seleccionar un tipo de capacitado de la lista desplegable Tipo de Capacitados, seleccionar un rango de fechas en los calendarios (teniendo en cuenta que la la fecha inicial debe de ser diferente y menor a la fecha final) y dar clic al bot�n '.div('Consultar', 'class="btn btn-sm btn-primary"').'.',
						'SYSCAP mostrar� el resultado de la consulta estad�stica.',
						'Si se desea deshacer el resultado de la consulta estad�stica, dar clic al bot�n '.div('Limpiar', 'class="btn btn-sm btn-danger"').'.'
						)).br();
						echo heading(anchor(current_url().'#estadisticas-generar_reporte', 'Hacer clic aqu� para ver como Generar Reporte Estad�stico.'), 4).br();
						
						echo heading(anchor(current_url().'#estadisticas-consulta-11', 'Estad�stica de Usuarios por Grado Digital', 'name="estadisticas-consulta-11"'), 3).br();
						echo ol(array(
						'Dentro del m�dulo de consultas estad�sticas, dar clic a la opci�n '.bold('Grado Digital').' del sub men� del m�dulo de consultas estad�sticas.',
						'Seleccionar una categor�a de grado digital de la lista desplegable Grado Digital, seleccionar un rango de fechas en los calendarios (teniendo en cuenta que la la fecha inicial debe de ser diferente y menor a la fecha final) y dar clic al bot�n '.div('Consultar', 'class="btn btn-sm btn-primary"').'.',
						'SYSCAP mostrar� el resultado de la consulta estad�stica.',
						'Si se desea deshacer el resultado de la consulta estad�stica, dar clic al bot�n '.div('Limpiar', 'class="btn btn-sm btn-danger"').'.'
						)).br();
						echo heading(anchor(current_url().'#estadisticas-generar_reporte', 'Hacer clic aqu� para ver como Generar Reporte Estad�stico.'), 4).br();
						
						echo heading(anchor(current_url().'#estadisticas-generar_reporte', 'Generar Reporte Estad�stico', 'name="estadisticas-generar_reporte"'), 3).br();
						echo heading('Imprimir Consulta Estad�stica.', 4);
						echo ol(array(
						'Dentro del m�dulo de consultas estad�sticas y desde la pantalla de resultado de una consulta estad�stica, dar clic en el bot�n '.div('<i class="fa fa-print"></i> Imprimir', 'class="btn btn-sm btn-success"').'.',
						'SYSCAP mostrar� un reporte generado con el resultado de la consulta estad�stica para ser enviado a impresi�n.',
						)).br();
						echo p('El bot�n imprimir no est� disponible s�lo para dispositivos m�viles.').br();
						echo heading('Exportar a Archivo PDF Consulta Estad�stica.', 4);
						echo ol(array(
						'Dentro del m�dulo de consultas estad�sticas y desde la pantalla de resultado de una consulta estad�stica, dar clic en el bot�n '.div('<i class="fa fa-file-pdf-o"></i> Exportar', 'class="btn btn-sm btn-success"').'.',
						'SYSCAP mostrar� un reporte generado con el resultado de la consulta estad�stica en archivo PDF para ser almacenado.',
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
				<?= heading('<i class="fa fa-map-marker fa-fw"></i> Modulo de Mapa Estad�stico', 2); ?>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<?php
						echo p('Muestra en el mapa de El Salvador el total de docentes de la modalidad de capacitaci�n tutorizados y tipo de capacitado por departamento, municipio y centro educativo.').br();
						echo heading(anchor(current_url().'#mapa', 'Lista de Departamentos', 'name="mapa"'), 3).br();
						echo heading('Consultar Cantidad de Docentes Capacitados y Docentes Certificados por Departamento.', 4);
						echo p('M�todo 1.');
						echo ol(array(
						'Dentro del m�dulo de mapa estad�stico, ubicarse en el listado de '.bold('Departamentos').' ubicado en la parte inferior del mapa de El Salvador.',
						'Hacer clic sobre el registro del departamento que se desea consultar.',
						'SYSCAP mostrar� el departamento seleccionado en el mapa de El Salvador y en una vi�eta mostrar� la cantidad de docentes por tipo de capacitado de la modalidad de capacitaci�n tutorizados del departamento.',
						'Dar clic al enlace '.bold('Ver departamento').' para ver los municipios del departamento.'
						)).br();
						echo p('M�todo 2.');
						echo ol(array(
						'Dentro del m�dulo de mapa estad�stico, ubicarse en el mapa de El Salvador.',
						'Navegar sobre el mapa de El Salvador y dar clic al '.bold('Marcador <font color="red" size="4"><i class="fa fa-map-marker fa-fw"></i></font>').' sobre el departamento que se desea consultar.',
						'SYSCAP mostrar� el departamento seleccionado en el mapa de El Salvador y en una vi�eta mostrar� la cantidad de docentes por tipo de capacitado de la modalidad de capacitaci�n tutorizados del departamento.',
						'Dar clic al enlace '.bold('Ver departamento').' para ver los municipios del departamento.'
						)).br();
						echo heading(anchor(current_url().'#mapa-departamento', 'Lista de Municipios', 'name="mapa-departamento"'), 3).br();
						echo heading('Consultar Cantidad de Docentes Capacitados y Docentes Certificados por Municipio.', 4);
						echo p('M�todo 1.');
						echo ol(array(
						'Dentro del m�dulo de mapa estad�stico y el mapa de un departamento, ubicarse en el listado de '.bold('Municipios').' ubicado en la parte inferior del mapa del Departamento.',
						'Hacer clic sobre el registro del municipio que se desea consultar.',
						'SYSCAP mostrar� el municipio seleccionado en el mapa del departamento y en una vi�eta mostrar� la cantidad de docentes por tipo de capacitado de la modalidad de capacitaci�n tutorizados del municipio.',
						'Dar clic al enlace '.bold('Ver municipio').' para ver los centros educativos del municipio.',
						'Para regresar al mapa de El Salvador y realizar otra b�squeda con un departamento diferente, ubicarse sobre la parte superior izquierda del mapa y hacer clic al enlace '.bold('El Salvador').'.'
						)).br();
						echo p('M�todo 2.');
						echo ol(array(
						'Dentro del m�dulo de mapa estad�stico y el mapa de un departamento, ubicarse en el mapa del departamento.',
						'Navegar sobre el mapa del departamento y dar clic al '.bold('Marcador <font color="red" size="4"><i class="fa fa-map-marker fa-fw"></i></font>').' sobre el municipio que se desea consultar.',
						'SYSCAP mostrar� el municipio seleccionado en el mapa del departamento y en una vi�eta mostrar� la cantidad de docentes por tipo de capacitado de la modalidad de capacitaci�n tutorizados del municipio.',
						'Dar clic al enlace '.bold('Ver municipio').' para ver los centros educativos del municipio.',
						'Para regresar al mapa de El Salvador y realizar otra b�squeda con un departamento diferente, ubicarse sobre la parte superior izquierda del mapa y hacer clic al enlace '.bold('El Salvador').'.'
						)).br();
						echo heading(anchor(current_url().'#mapa-municipio', 'Lista de Centros Educativos', 'name="mapa-municipio"'), 3).br();
						echo heading('Consultar Cantidad de Docentes Capacitados y Docentes Certificados por Centro Educativo.', 4);
						echo p('M�todo 1.');
						echo ol(array(
						'Dentro del m�dulo de mapa estad�stico y el mapa de un municipio, ubicarse en el listado de '.bold('Centros Educativos').' ubicado en la parte inferior del mapa del Municipio.',
						'Hacer clic sobre el registro del centro educativo que se desea consultar.',
						'SYSCAP mostrar� el centro educativo seleccionado en el mapa del municipio y en una vi�eta mostrar� la cantidad de docentes por tipo de capacitado de la modalidad de capacitaci�n tutorizados del centro educativo.',
						'Dar clic al enlace '.bold('Ver centro educativo').' para ir a la ficha del centro educativo y ver los docentes capacitados y docentes certificados.',
						'Para regresar al mapa del departamento y realizar otra b�squeda con un municipio diferente, ubicarse sobre la parte superior izquierda del mapa y hacer clic al enlace con el '.bold('Nombre del Departamento').', o si desea realizar otra b�squeda con un departamento diferente, hacer clic al enlace '.bold('El Salvador').'.'
						)).br();
						echo p('M�todo 2.');
						echo ol(array(
						'Dentro del m�dulo de mapa estad�stico y el mapa de un municipio, ubicarse en el mapa del municipio.',
						'Navegar sobre el mapa del municipio y dar clic al '.bold('Marcador <font color="red" size="4"><i class="fa fa-map-marker fa-fw"></i></font>').' sobre el centro educativo que se desea consultar.',
						'SYSCAP mostrar� el centro educativo seleccionado en el mapa del municipio y en una vi�eta mostrar� la cantidad de docentes por tipo de capacitado de la modalidad de capacitaci�n tutorizados del centro educativo.',
						'Dar clic al enlace '.bold('Ver centro educativo').' para ir a la ficha del centro educativo y ver los docentes capacitados y docentes certificados.',
						'Para regresar al mapa del departamento y realizar otra b�squeda con un municipio diferente, ubicarse sobre la parte superior izquierda del mapa y hacer clic al enlace con el '.bold('Nombre del Departamento').', o si desea realizar otra b�squeda con un departamento diferente, hacer clic al enlace '.bold('El Salvador').'.'
						)).br();
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>