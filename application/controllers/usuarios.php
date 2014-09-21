<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller{
	function __construct(){
		parent::__construct();
		
		$this->load->helper(array('form', 'url', 'html'));
		$this->load->library('form_validation');
		$this->load->model('usuarios_model');
	}
	
	public function index(){
		$data['usuario_actual'] = "Tito Miguel";
		$data['opcion_menu'] = array('modulo_usuarios'					=>	'active',
									 'modulo_centros_educativos'		=>	'',
									 'modulo_consultas_estadisticas'	=>	'',
									 'modulo_mapa_estadistico'			=>	''
		);
		$data['lista_usuarios'] = $this->usuarios_model->usuarios();
		
		$this->load->view('cabecera_pagina_view', $data);
		$this->load->view('usuarios/consultar_usuarios_view', $data);
		$this->load->view('pie_pagina_view');
	}
	
	public function agregar(){
		$data['operacion'] = "Agregar Usuario";
		$data['opcion'] = "Agregar";
		
		if($this->input->post()){
			
			$this->validaciones();
			
			if($this->form_validation->run() == TRUE){
				$insert_usuario = $this->input->post();
				unset($insert_usuario['btn_guardar'], $insert_usuario['btn_cancelar']);
				
				$codigo_usuario = $this->usuarios_model->agregar($insert_usuario);
				$this->resultado($codigo_usuario);
			}
			else{
				$this->load->view('usuarios/formulario_usuarios_view', $data);
			}
		}
		else{
			$this->load->view('usuarios/formulario_usuarios_view', $data);
		}
	}
	
	public function eliminar($codigo_usuario = NULL){
		$data['operacion'] = "Eliminar Usuario";
		$data['opcion'] = "Eliminar";
		$data['usuario_actual'] = "Tito Miguel";
		$data['opcion_menu'] = array('modulo_usuarios'					=>	'',
									 'modulo_centros_educativos'		=>	'',
									 'modulo_consultas_estadisticas'	=>	'',
									 'modulo_mapa_estadistico'			=>	'active'
									 );
		
		if ($this->input->post('estado') == '1'){
			echo "eliminar registro";
			$delete_usuario = $this->input->post('id');
			$this->usuarios_model->eliminar($delete_usuario);
			redirect('usuarios');
		}
		else{
			$data['usuario'] = $this->usuarios_model->usuario($codigo_usuario);
			if(empty($data['usuario'])){
				echo 'ID Invalido';
			}
			else{
				$this->load->view('cabecera_pagina_view', $data);
				$this->load->view('usuarios/formulario_usuarios_view');
				$this->load->view('pie_pagina_view');
			}
		}
	}
	
	public function modificar($codigo_usuario = NULL){
		$data['operacion'] = "Editar Usuario";
		$data['opcion'] = "Guardar";
		$data['usuario_actual'] = "Tito Miguel";
		$data['opcion_menu'] = array('modulo_usuarios'					=>	'',
									 'modulo_centros_educativos'		=>	'',
									 'modulo_consultas_estadisticas'	=>	'',
									 'modulo_mapa_estadistico'			=>	'active'
									 );
	
		if ($this->input->post('estado') == '1'){
			$update_usuario = $this->input->post('id');
			$this->usuarios_model->modificar($update_usuario);
			redirect('usuarios');
		}
		else{
			$data['usuario'] = $this->usuarios_model->usuario($codigo_usuario);
			if(empty($data['usuario'])){
				echo 'ID Invalido';
			}
			else{
				$this->load->view('cabecera_pagina_view', $data);
				$this->load->view('usuarios/formulario_usuarios_view');
				$this->load->view('pie_pagina_view');
			}
		}
	}
	
	public function resultado($codigo_usuario = NULL){
		$this->load->view('usuarios/resultado_usuarios_view');
	}
	
	public function validaciones(){
		$reglas = array(
			array(
				'field' => 'firstname',
				'label' => 'Nombres',
				'rules' => 'trim|required' 
			),
			array(
				'field' => 'lastname',
				'label' => 'Apellidos',
				'rules' => 'trim|required' 
			),
			array(
				'field' => 'dui',
				'label' => 'DUI',
				'rules' => 'trim|required' 
			),
			array(
				'field' => 'email',
				'label' => 'Correo Electrónico',
				'rules' => 'trim|required|email' 
			),
			array(
				'field' => 'profesion',
				'label' => 'Profesión',
				'rules' => 'trim|required' 
			),
			array(
				'field' => 'centro_educativo',
				'label' => 'Centro Educativo',
				'rules' => 'trim|required' 
			),
			array(
				'field' => 'direccion',
				'label' => 'Dirección',
				'rules' => 'trim|required' 
			),
			array(
				'field' => 'username',
				'label' => 'Nombre de Usuario',
				'rules' => 'trim|required|min_length[6]' 
			),
			array(
				'field' => 'password',
				'label' => 'Contraseña',
				'rules' => 'trim|required|min_length[6]' 
			),
			array(
				'field' => 'tipo_usuario',
				'label' => 'Tipo Usuario',
				'rules' => 'trim|required' 
			)
		);
		
		$this->form_validation->set_rules($reglas);
		
		/*$this->form_validation->set_message('required','El Campo: %s, Es Obligatorio');
		$this->form_validation->set_message('min_length','El Campo: %s, Debe tener al Menos %s Caracteres');*/
	}
}

/* End of file usuarios.php */
/* Location: ./application/controllers/usuarios.php */