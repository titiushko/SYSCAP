<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Controlador default de SYSCAP que gestiona el acceso al sistema
*/
class Sesion extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->eliminar_cache();
		$this->load->model('sesion_model');
		// DOC: Detectar si se está utilizando SYSCAP desde un dispositivo móvil y el resultado se establece a la variable de sesión
		$this->session->set_userdata('dispositivo_movil', (new Mobile_Detect)->isMobile() ? TRUE : FALSE);
	}
	
	/**
	* Método default del controlador
	* Si no hay una conexión de usuario, muestra el formulario de inicio de sesión a SYSCAP, de lo contrario muestra la vista según el rol del usuario conectado
	*/
	public function index(){
		// DOC: Realizar una acción dependiendo del contenido de la variable de sesión del tipo de rol del usuario
		switch($this->session->userdata('nombre_corto_rol')){
			case '':
				// DOC: Si la variable de sesión del tipo de rol del usuario no contiene ningún valor,
				// entonces: crear una nueva clave aleatoria única
				$datos['sesion_usuario'] = $this->token();
				break;
			case 'admin':
				// DOC: Si la variable de sesión del tipo de rol del usuario es administrador,
				// entonces: redirigir al controlador inicio
				redirect('inicio');
				break;
			case 'moderador':
				// DOC: Si la variable de sesión del tipo de rol del usuario es moderador,
				// entonces: redirigir al controlador usuarios
				redirect('usuarios');
				break;
			case 'student':
				// DOC: Si la variable de sesión del tipo de rol del usuario es estudiante,
				// entonces: redirigir al controlador usuarios y llamar al método mostrar enviando como parámetro el código del estudiante
				redirect('usuarios/mostrar/'.$this->session->userdata('id_usuario'));
				break;
		}
		// DOC: Cargar la vista con el formulario de inicio de sesión de usuario
		$this->load->view('sesion/sesion_view', $datos);
	}
	
	/**
	* Método que valida el inicio de sesión a SYSCAP
	*/
	public function iniciar_sesion(){
		// DOC: Si los campos del formulario de inicio de sesión a SYSCAP tienen valores,
		// entonces: validar los valores de los campos, si no: destruir la sesión y volver a mostrar la vista con el formulario de inicio de sesión
		if($this->input->post()){
			// DOC: Establecer las reglas de validación
			$this->form_validation->set_rules('nombre_usuario', 'Nombre de Usuario', 'required|trim|min_length[5]|max_length[50]|xss_clean');
			$this->form_validation->set_rules('contrasena_usuario', 'Contrase&ntilde;a', 'required|trim|min_length[5]|max_length[50]|xss_clean');
			$datos = NULL;
			// DOC: Ejecutar las reglas de validación de los campos del formulario de inicio de sesión a SYSCAP, si se cumplen las reglas de validación,
			// entonces: permitir que el usuario inicie sesión a SYSCAP, si no: regresar a la vista con el formulario de inicio de sesión y mostrar los mensajes de error
			if($this->form_validation->run()){
				// DOC: Si es una solicitud de inicio de sesión válida,
				// entonces: buscar que el usuario esté registrado en SYSCAP, si no: regresar a la vista con el formulario de inicio de sesión sin procesar ningún dato
				if($this->input->post('sesion_usuario') == $this->session->userdata('sesion_usuario')){
					// DOC: Realizar una consulta a la base de datos para buscar que el usuario esté registrado en SYSCAP
					$datos['usuario'] = $this->sesion_model->conectar_usuario($this->input->post('nombre_usuario'), md5($this->input->post('contrasena_usuario').$this->config->item('semilla_moodle')));
					// DOC: Si el usuario se encuentra registrado en SYSCAP,
					// entonces: cargar la información del usuario y permitir el acceso a SYSCAP,
					// si no: regresar a la vista con el formulario de inicio de sesión y mostrar los mensajes de error
					if(!empty($datos['usuario'])){
						// DOC: Inicializar las variables de sesión con la información del usuario para crear la sesión del sistema
						$datos_sesion_usuario = array(
							// DOC: Variable de sesión para determinar que hay una conexión de usuario; TRUE: hay conexión, FALSE: no hay conexión
							'conexion_usuario'			=> 	TRUE,
							// DOC: Variable de sesión con el código del usuario
							'id_usuario' 				=> 	$datos['usuario']->id_usuario,
							// DOC: Variable de sesión con el disminutivo del tipo de rol del usuario
							'nombre_corto_rol'			=>	$this->validar_rol_corto($datos['usuario']->nombre_corto_rol),
							// DOC: Variable de sesión con el nombre del tipo de rol del usuario
							'nombre_completo_rol'		=>	$this->validar_rol_completo($datos['usuario']->nombre_completo_rol),
							// DOC: Variable de sesión con el nombre completo del usuario
							'nombre_completo_usuario'	=> 	$datos['usuario']->nombre_completo_usuario,
							// DOC: Variable de sesión para determinar el estado del botón toggle del menú principal; TRUE: activado, FALSE: desactivado
							'boton_menu'				=>	TRUE
						);
						// DOC: Establecer la sesión del sistema
						$this->session->set_userdata($datos_sesion_usuario);
						// DOC: Cargar la vista de SYSCAP dependiendo del tipo de rol del usuario
						$this->index();
					}
					else{
						$this->index();
					}
				}
				else{
					$this->index();
				}
			}
			else{
				$this->load->view('sesion/sesion_view', $datos);
			}
		}
		else{
			$this->cerrar_sesion();
		}
	}
	
	/**
	* Método para crear una nueva clave aleatoria única y evitar un ataque cruzado entre sitios (CSRF: Cross-Site Request Forgery)
	*/
	public function token(){
		$sesion_usuario = md5(uniqid(rand(), TRUE));
		$this->session->set_userdata('sesion_usuario', $sesion_usuario);
		return $sesion_usuario;
	}
	
	/**
	* Método que elimina las variables de sesión para cerrar la sesión de usuario y regresar a la página de inicio de SYSCAP
	*/
	public function cerrar_sesion(){
		$this->session->sess_destroy();
		redirect();
	}
	
	/**
	* Método para asegurar que el disminutivo del tipo de rol de usuario sea válido (admin, moderador o student),
	* de lo contrario el método devuelve el disminutivo del tipo de rol de usuario de menor prioridad (student)
	*/
	private function validar_rol_corto($nombre_corto_rol){
		return is_null($nombre_corto_rol) || ($nombre_corto_rol != 'admin' && $nombre_corto_rol != 'moderador' && $nombre_corto_rol != 'student') ? 'student' : $nombre_corto_rol;
	}
	
	/**
	* Método para asegurar que el nombre del tipo de rol de usuario sea válido (Administador, Moderador De Grado Digital o Estudiante),
	* de lo contrario el método devuelve el nombre del tipo de rol de usuario de menor prioridad (Estudiante)
	*/
	private function validar_rol_completo($nombre_completo_rol){
		return is_null($nombre_completo_rol) || ($nombre_completo_rol != 'Administador' && $nombre_completo_rol != 'Moderador De Grado Digital' && $nombre_completo_rol != 'Estudiante') ? 'Estudiante' : $nombre_completo_rol;
	}
}

/* End of file sesion.php */
/* Location: ./application/controllers/sesion.php */