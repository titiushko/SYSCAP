<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Gestiona el proceso de instalación de SYSCAP
*/
class Instalador extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->eliminar_cache();
		$this->session->sess_destroy();
		$this->load->model('instalador_model');
	}
	
	/**
	* Método default del controlador, procesa la instalación de SYSCAP
	*/
	public function index(){
		// DOC: Comprobar si tienen permiso de escritura los archivos de configuración de la instalación de SYSCAP
		$basedatos = get_file_info('application/config/database.php', 'writable')['writable'];
		$propiedades = get_file_info('application/config/properties.php', 'writable')['writable'];
		$rutas = get_file_info('application/config/routes.php', 'writable')['writable'];
		/*
		// DOC: Otra forma de comprobar si tienen permiso de escritura los archivos de configuración de la instalación de SYSCAP
		$basedatos = get_file_info('application/config/database.php', 'fileperms')['fileperms'];
		$propiedades = get_file_info('application/config/properties.php', 'fileperms')['fileperms'];
		$rutas = get_file_info('application/config/routes.php', 'fileperms')['fileperms'];
		$basedatos = (($basedatos & 0x0100) && ($basedatos & 0x0080)) && (($basedatos & 0x0004) && ($basedatos & 0x0002));
		$propiedades = (($propiedades & 0x0100) && ($propiedades & 0x0080)) && (($propiedades & 0x0004) && ($propiedades & 0x0002));
		$rutas = (($rutas & 0x0100) && ($rutas & 0x0080)) && (($rutas & 0x0004) && ($rutas & 0x0002));
		*/
		// DOC: Si tienen permiso de escritura los archivos de configuración,
		// entonces: mostrar la vista con el formulario de instalación de SYSCAP
		if($basedatos && $propiedades && $rutas){
			// DOC: Si los campos del formulario de instalación tienen valores,
			// entonces: validar los valores de los campos
			if($this->input->post()){
				// DOC: Cargar las reglas de validación de los campos del formulario de instalación
				$this->validaciones('configuracion_conexion');
				$this->validaciones('configuracion_sesion');
				// DOC: Comprobar que SYSCAP se pueda conectar con los valores de los campos para la conexión a la base de datos
				$resultado = $this->instalador_model->probar_conexion($this->input->post('servidor'), $this->input->post('base_datos'), $this->input->post('usuario'), $this->input->post('contrasena'));
				// DOC: Si SYSCAP no se puede conectar con los valores de los campos para la conexión a la base de datos,
				// entonces: establecer el mensaje de error
				if(!$resultado){
					$datos['resultado_conexion'] = icono_notificacion('error').' Conexi&oacute;n fallida. Por favor, compruebe los ajustes de la base de datos.';
				}
				// DOC: Se crea un array con los valores de los campos del formulario de instalación
				$datos['campos'] = $this->input->post();
				// DOC: Ejecutar las reglas de validación de los campos del formulario de instalación, si se cumplen las reglas de validación,
				// entonces: permitir la configuración de la instalación de SYSCAP
				if($this->form_validation->run()){
					// DOC: Si SYSCAP se puede conectar con los valores de los campos para la conexión a la base de datos,
					// entonces: permitir establecer la configuración de la instalación de SYSCAP
					if($resultado){
						// DOC: Leer el contenido de las plantillas de los archivos de configuración de la instalación de SYSCAP
						$database = read_file('resources/templates/config/database.php');
						$properties = read_file('resources/templates/config/properties.php');
						$routes = read_file('resources/templates/config/routes.php');
						// DOC: Establecer la configuración de la instalación de SYSCAP con los valores de los campos del formulario de instalación
						$database = str_replace(
							array('<SERVIDOR>', '<USUARIO>', '<CONTRASENA>', '<BASE_DATOS>'),
							array($this->input->post('servidor'), $this->input->post('usuario'), $this->input->post('contrasena'), $this->input->post('base_datos')),
							$database
						);
						$properties = str_replace(
							array('<SEMILLA>', '<TIEMPO_CONEXION>'),
							array($this->input->post('semilla'), $this->input->post('tiempo_conexion')),
							$properties
						);
						// DOC: Sobre escribir los archivos de configuración de la instalación de SYSCAP
						$basedatos = write_file('application/config/database.php', $database, 'w');
						$propiedades = write_file('application/config/properties.php', $properties, 'w');
						$rutas = write_file('application/config/routes.php', $routes, 'w');
						// DOC: Se crea un array que almacenará el resultado de la instalación de SYSCAP para ser mostrado en la vista resultado
						$datos['resultado_instalador'] = array('', '', '');
						// DOC: El array con el resultado de la instalación en la posición cero tiene el título de la vista resultado
						$datos['resultado_instalador'][0] .= 'Resultado de la Instalaci&oacute;n de SYSCAP';
						// DOC: El array con el resultado de la instalación en la posición uno tiene que archivos se pudieron configurar
						$datos['resultado_instalador'][1] .= '<div class="row"><div class="col-lg-4 col-lg-offset-4 "><div class="row">';
						// DOC: Si el archivo de configuración de la base de datos se pudo sobre escribir,
						// entonces: mostrar con un cheque de correcto, si no: mostrar con una equis de error
						if($basedatos){
							$datos['resultado_instalador'][1] .= tag('div', '<i class="fa fa-database"></i> Configuraci&oacute;n de base de datos', 'class="col-lg-8"');
							$datos['resultado_instalador'][1] .= tag('div', tag('font', '<i class="fa fa-check" title="Correcto"></i>', 'color="green"'), 'class="col-lg-4"');
						}
						else{
							$datos['resultado_instalador'][1] .= tag('div', '<i class="fa fa-database"></i> Configuraci&oacute;n de base de datos', 'class="col-lg-8"');
							$datos['resultado_instalador'][1] .= tag('div', tag('font', '<i class="fa fa-times" title="Error"></i>', 'color="red"'), 'class="col-lg-4"');
						}
						$datos['resultado_instalador'][1] .= '</div><div class="row">';
						// DOC: Si el archivo de configuración de propiedades se pudo sobre escribir,
						// entonces: mostrar con un cheque de correcto, si no: mostrar con una equis de error
						if($propiedades){
							$datos['resultado_instalador'][1] .= tag('div', '<i class="fa fa-clock-o"></i> Configuraci&oacute;n de sesi&oacute;n de usuario', 'class="col-lg-8"');
							$datos['resultado_instalador'][1] .= tag('div', tag('font', '<i class="fa fa-check" title="Correcto"></i>', 'color="green"'), 'class="col-lg-4"');
						}
						else{
							$datos['resultado_instalador'][1] .= tag('div', '<i class="fa fa-clock-o"></i> Configuraci&oacute;n de sesi&oacute;n de usuario', 'class="col-lg-8"');
							$datos['resultado_instalador'][1] .= tag('div', tag('font', '<i class="fa fa-times" title="Error"></i>', 'color="red"'), 'class="col-lg-4"');
						}
						$datos['resultado_instalador'][1] .= '</div><div class="row">';
						// DOC: Si el archivo de configuración de rutas se pudo sobre escribir,
						// entonces: mostrar con un cheque de correcto, si no: mostrar con una equis de error
						if($rutas){
							$datos['resultado_instalador'][1] .= tag('div', '<i class="fa fa-wrench"></i> Configuraci&oacute;n de SYSCAP', 'class="col-lg-8"');
							$datos['resultado_instalador'][1] .= tag('div', tag('font', '<i class="fa fa-check" title="Correcto"></i>', 'color="green"'), 'class="col-lg-4"');
						}
						else{
							$datos['resultado_instalador'][1] .= tag('div', '<i class="fa fa-wrench"></i> Configuraci&oacute;n de SYSCAP', 'class="col-lg-8"');
							$datos['resultado_instalador'][1] .= tag('div', tag('font', '<i class="fa fa-times" title="Error"></i>', 'color="red"'), 'class="col-lg-4"');
						}
						$datos['resultado_instalador'][1] .= '</div></div></div>';
						// DOC: El array con el resultado de la instalación en la posición dos tiene el botón para salir de la instalación de SYSCAP
						// y mostrar la vista de inicio de sesión de usuario
						$datos['resultado_instalador'][2] .= anchor(base_url(''), 'Finalizar', 'class="btn btn-primary"');
						// DOC: Cargar la vista con el resultado de la instalación
						$this->load->view('instalador/resultado_instalador_view', $datos);
					}
					else{
						// DOC: Si SYSCAP no se puede conectar con los valores de los campos para la conexión a la base de datos,
						// entonces: regresar a la vista con el formulario de instalación y mostrar el mensaje de error
						$this->load->view('instalador/formulario_instalador_view', $datos);
					}
				}
				else{
					// DOC: Si no se cumplen las reglas de validación,
					// entonces: regresar a la vista con el formulario de instalación y mostrar los mensajes de error
					$this->load->view('instalador/formulario_instalador_view', $datos);
				}
			}
			else{
				// DOC: Si los campos del formulario de instalación no tienen valores,
				// entonces: volver a mostrar la vista con el formulario de instalación
				$this->load->view('instalador/formulario_instalador_view');
			}
		}
		else{
			// DOC: Si no tienen permiso de escritura los archivos de configuración,
			// entonces: mostrar la vista resultado con los permisos de escritura en los archivos de configuración
			// DOC: Se crea un array que almacenará el resultado de los permisos de escritura
			$datos['resultado_instalador'] = array('', '', '');
			// DOC: El array con el resultado de los permisos de escritura en la posición cero tiene el título de la vista resultado
			$datos['resultado_instalador'][0] .= 'Error Requerimientos de Instalaci&oacute;n de SYSCAP';
			// DOC: El array con el resultado de los permisos de escritura en la posición uno tiene que archivos tienen permisos de escritura
			$datos['resultado_instalador'][1] .= '<div class="row"><div class="col-lg-12">'.tag('p', 'Por favor, aseg&uacute;rese que los siguientes archivos existen y tengan permisos de escritura:').'</div></div>';
			$datos['resultado_instalador'][1] .= '<div class="row"><div class="col-lg-4 col-lg-offset-4 "><div class="row">';
			// DOC: Si el archivo de configuración de la base de datos tiene permisos de escritura,
			// entonces: mostrar con un cheque de correcto, si no: mostrar con una equis de error
			if($basedatos){
				$datos['resultado_instalador'][1] .= tag('div', 'SYSCAP/application/config/database.php', 'class="col-lg-8"');
				$datos['resultado_instalador'][1] .= tag('div', tag('font', '<i class="fa fa-check" title="Correcto"></i>', 'color="green"'), 'class="col-lg-4"');
			}
			else{
				$datos['resultado_instalador'][1] .= tag('div', 'SYSCAP/application/config/database.php', 'class="col-lg-8"');
				$datos['resultado_instalador'][1] .= tag('div', tag('font', '<i class="fa fa-times" title="Error"></i>', 'color="red"'), 'class="col-lg-4"');
			}
			$datos['resultado_instalador'][1] .= '</div><div class="row">';
			// DOC: Si el archivo de configuración de propiedades tiene permisos de escritura,
			// entonces: mostrar con un cheque de correcto, si no: mostrar con una equis de error
			if($propiedades){
				$datos['resultado_instalador'][1] .= tag('div', 'SYSCAP/application/config/properties.php', 'class="col-lg-8"');
				$datos['resultado_instalador'][1] .= tag('div', tag('font', '<i class="fa fa-check" title="Correcto"></i>', 'color="green"'), 'class="col-lg-4"');
			}
			else{
				$datos['resultado_instalador'][1] .= tag('div', 'SYSCAP/application/config/properties.php', 'class="col-lg-8"');
				$datos['resultado_instalador'][1] .= tag('div', tag('font', '<i class="fa fa-times" title="Error"></i>', 'color="red"'), 'class="col-lg-4"');
			}
			$datos['resultado_instalador'][1] .= '</div><div class="row">';
			// DOC: Si el archivo de configuración de rutas tiene permisos de escritura, 
			// entonces: mostrar con un cheque de correcto, si no: mostrar con una equis de error
			if($rutas){
				$datos['resultado_instalador'][1] .= tag('div', 'SYSCAP/application/config/routes.php', 'class="col-lg-8"');
				$datos['resultado_instalador'][1] .= tag('div', tag('font', '<i class="fa fa-check" title="Correcto"></i>', 'color="green"'), 'class="col-lg-4"');
			}
			else{
				$datos['resultado_instalador'][1] .= tag('div', 'SYSCAP/application/config/routes.php', 'class="col-lg-8"');
				$datos['resultado_instalador'][1] .= tag('div', tag('font', '<i class="fa fa-times" title="Error"></i>', 'color="red"'), 'class="col-lg-4"');
			}
			$datos['resultado_instalador'][1] .= '</div></div></div>';
			// DOC: El array con el resultado de los permisos de escritura en la posición dos tiene un botón que permite recargar el controlador
			// y volver a hacer la compronación de permisos de escritura en los archivos de configuración
			$datos['resultado_instalador'][2] .= anchor(base_url(''), 'Volver a Probar', 'class="btn btn-primary" onclick="window.location.reload();"');
			// DOC: Cargar la vista con el resultado de permisos de escritura
			$this->load->view('instalador/resultado_instalador_view', $datos);
		}
	}
	
	/**
	* Método utilizado con AJAX desde la vista: instalador/formulario_instalador_view
	* El devuelve el resultado de probar si SYSCAP se puede conectar con los valores de los campos para la conexión a la base de datos
	*/
	public function probar_conexion(){
		// DOC: Si es una petición por medio de AJAX,
		// entonces: probar la conexión a la base de datos, si no: salir del método
		if($this->input->is_ajax_request()){
			// DOC: Obtener el contenido de los campos para la conexión a la base de datos
			$servidor = $this->security->xss_clean($this->input->get_post('servidor'));
			$base_datos = $this->security->xss_clean($this->input->get_post('base_datos'));
			$usuario = $this->security->xss_clean($this->input->get_post('usuario'));
			$contrasena = $this->security->xss_clean($this->input->get_post('contrasena'));
			// DOC: Cargar las reglas de validación de los campos del formulario de instalación para la conexión a la base de datos
			$this->validaciones('configuracion_conexion');
			// DOC: Ejecutar las reglas de validación de los campos del formulario de instalación para la conexión a la base de datos, si se cumplen las reglas de validación,
			// entonces: permitir probar la conexión a la base de datos
			if($this->form_validation->run()){
				// DOC: Si SYSCAP se puede conectar con los valores de los campos para la conexión a la base de datos,
				// entonces: enviar a la vista el mensaje de éxito, si no: enviar a la vista el mensaje de error
				if($this->instalador_model->probar_conexion($servidor, $base_datos, $usuario, $contrasena)){
					echo icono_notificacion('informacion').' Conexión &eacute;xitosa.';
				}
				else{
					echo icono_notificacion('error').' Conexi&oacute;n fallida. Por favor, compruebe los ajustes de la base de datos.';
				}
			}
			else{
				// DOC: Si no se cumplen las reglas de validación,
				// entonces: enviar a la vista el mensaje de error
				echo icono_notificacion('error').' Campos vac&iacute;os. Por favor, complete los campos vac&iacute;os.';
			}
		}
		exit;
	}
	
	/**
	* Método que carga las reglas de validación del formulario de instalación
	*/
	private function validaciones($grupo_campos){
		$reglas = array(
			// DOC: Reglas de validación para la conexión a la base de datos
			'configuracion_conexion' => array(
				array(
					'field' => 'servidor',
					'label' => 'Servidor',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'base_datos',
					'label' => 'Base de Datos',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'usuario',
					'label' => 'Usuario',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'contrasena',
					'label' => 'Contrase&ntilde;a',
					'rules' => 'trim',
					'rules' => 'trim|required'
				)
			),
			// DOC: Reglas de validación para configuración de sesión
			'configuracion_sesion' => array(
				array(
					'field' => 'tiempo_conexion',
					'label' => 'Tiempo de Conexi&oacute;n de Sesi&oacute;n',
					'rules' => 'trim|required|is_natural'
				),
				array(
					'field' => 'semilla',
					'label' => 'Semilla de Encriptaci&oacute;n de Moodle',
					'rules' => 'trim|required'
				)
			)
		);
		// DOC: Establecer las reglas de validación
		$this->form_validation->set_rules($reglas[$grupo_campos]);
	}
}

/* End of file instalador.php */
/* Location: ./application/controllers/instalador.php */