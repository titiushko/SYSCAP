<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sesion extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->eliminar_cache();
		$this->load->model('sesion_model');
		$this->session->set_userdata('dispositivo_movil', (new Mobile_Detect)->isMobile() ? TRUE : FALSE);
	}
	
	public function index(){
		switch($this->session->userdata('nombre_corto_rol')) {
			case '':
				$datos['sesion_usuario'] = $this->token();
				break;
			case 'admin':
				redirect('inicio');
				break;
			case 'moderador':
				redirect('usuarios');
				break;
			case 'student':
				redirect('usuarios/mostrar/'.$this->session->userdata('id_usuario'));
				break;
		}
		$this->load->view('sesion/sesion_view', $datos);
	}
	
	public function iniciar_sesion(){
		if($this->input->post()){
			$this->form_validation->set_rules('nombre_usuario', 'Nombre de Usuario', 'required|trim|min_length[5]|max_length[50]|xss_clean');
			$this->form_validation->set_rules('contrasena_usuario', 'Contrase&ntilde;a', 'required|trim|min_length[5]|max_length[50]|xss_clean');
			$datos = NULL;
			if($this->form_validation->run()){
				if($this->input->post('sesion_usuario') == $this->session->userdata('sesion_usuario')){
					$datos['usuario'] = $this->sesion_model->conectar_usuario($this->input->post('nombre_usuario'), md5($this->input->post('contrasena_usuario').$this->config->item('semilla_moodle')));
					if(!empty($datos['usuario'])){
						$datos_sesion_usuario = array(
							'conexion_usuario'			=> 	TRUE,
							'id_usuario' 				=> 	$datos['usuario']->id_usuario,
							'nombre_corto_rol'			=>	$this->validar_rol_corto($datos['usuario']->nombre_corto_rol),
							'nombre_completo_rol'		=>	$this->validar_rol_completo($datos['usuario']->nombre_completo_rol),
							'nombre_completo_usuario'	=> 	$datos['usuario']->nombre_completo_usuario,
							'boton_menu'				=>	TRUE
						);
						$this->session->set_userdata($datos_sesion_usuario);
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
	
	public function token(){
		$sesion_usuario = md5(uniqid(rand(), TRUE));
		$this->session->set_userdata('sesion_usuario', $sesion_usuario);
		return $sesion_usuario;
	}
	
	public function cerrar_sesion(){
		$this->session->sess_destroy();
		redirect();
	}
	
	private function validar_rol_corto($nombre_corto_rol){
		return is_null($nombre_corto_rol) || ($nombre_corto_rol != 'admin' && $nombre_corto_rol != 'moderador' && $nombre_corto_rol != 'student') ? 'student' : $nombre_corto_rol;
	}
	
	private function validar_rol_completo($nombre_completo_rol){
		return is_null($nombre_completo_rol) || ($nombre_completo_rol != 'Administador' && $nombre_completo_rol != 'Moderador De Grado Digital' && $nombre_completo_rol != 'Estudiante') ? 'Estudiante' : $nombre_completo_rol;
	}
}

/* End of file sesion.php */
/* Location: ./application/controllers/sesion.php */