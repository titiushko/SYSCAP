<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Instalador extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->eliminar_cache();
		$this->session->sess_destroy();
		$this->load->model(array('instalador_model'));
	}
	
	public function index(){
		if($this->input->post()){
			$this->validaciones('configuracion_conexion');
			$this->validaciones('configuracion_sesion');
			$resultado = $this->instalador_model->probar_conexion($this->input->post('servidor'), $this->input->post('base_datos'), $this->input->post('usuario'), $this->input->post('contrasena'));
			if(!$resultado){
				$datos['resultado_conexion'] = icono_notificacion('error').' Conexi&oacute;n fallida. Por favor, compruebe los ajustes de la base de datos.';
			}
			$datos['campos'] = $this->input->post();
			if($this->form_validation->run()){
				if($resultado){
					$database = read_file('resources/templates/config/database.php');
					$properties = read_file('resources/templates/config/properties.php');
					$routes = read_file('resources/templates/config/routes.php');
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
					$datos['resultado_instalacion'] = '';
					write_file('application/config/database.php', $database, 'w');
					write_file('application/config/properties.php', $properties, 'w');
					write_file('application/config/routes.php', $routes, 'w');
					$datos['resultado_instalacion'] .= tag('p', '<i class="fa fa-database"></i> Configuraci&oacute;n de base de datos '.tag('font', '<i class="fa fa-check"></i>', 'color="green"'));
					$datos['resultado_instalacion'] .= tag('p', '<i class="fa fa-clock-o"></i> Configuraci&oacute;n de sesi&oacute;n de usuario '.tag('font', '<i class="fa fa-check"></i>', 'color="green"'));
					/*
					if(write_file('application/config/database.php', $database, 'w')){
						$datos['resultado_instalacion'] .= tag('p', '<i class="fa fa-database"></i> database.php '.tag('font', '<i class="fa fa-check"></i>', 'color="green"'));
					}
					else{
						$datos['resultado_instalacion'] .= tag('p', '<i class="fa fa-database"></i> database.php '.tag('font', '<i class="fa fa-times"></i>', 'color="red"'));
					}
					if(write_file('application/config/properties.php', $properties, 'w')){
						$datos['resultado_instalacion'] .= tag('p', '<i class="fa fa-clock-o"></i> properties.php '.tag('font', '<i class="fa fa-check"></i>', 'color="green"'));
					}
					else{
						$datos['resultado_instalacion'] .= tag('p', '<i class="fa fa-clock-o"></i> properties.php '.tag('font', '<i class="fa fa-times"></i>', 'color="red"'));
					}
					if(write_file('application/config/routes.php', $routes, 'w')){
						$datos['resultado_instalacion'] .= tag('p', '<i class="fa fa-link"></i> routes.php '.tag('font', '<i class="fa fa-check"></i>', 'color="green"'));
					}
					else{
						$datos['resultado_instalacion'] .= tag('p', '<i class="fa fa-link"></i> routes.php '.tag('font', '<i class="fa fa-times"></i>', 'color="red"'));
					}
					*/
					$this->load->view('instalador/resultado_instalador_view', $datos);
				}
				else{
					$this->load->view('instalador/formulario_instalador_view', $datos);
				}
			}
			else{
				$this->load->view('instalador/formulario_instalador_view', $datos);
			}
		}
		else{
			$this->load->view('instalador/formulario_instalador_view');
		}
	}
	
	public function probar_conexion(){
		if($this->input->is_ajax_request()){
			$servidor = $this->security->xss_clean($this->input->get_post('servidor'));
			$base_datos = $this->security->xss_clean($this->input->get_post('base_datos'));
			$usuario = $this->security->xss_clean($this->input->get_post('usuario'));
			$contrasena = $this->security->xss_clean($this->input->get_post('contrasena'));
			$this->validaciones('configuracion_conexion');
			if($this->form_validation->run()){
				if($this->instalador_model->probar_conexion($servidor, $base_datos, $usuario, $contrasena)){
					echo icono_notificacion('informacion').' Conexión &eacute;xitosa.';
				}
				else{
					echo icono_notificacion('error').' Conexi&oacute;n fallida. Por favor, compruebe los ajustes de la base de datos.';
				}
			}
			else{
				echo icono_notificacion('error').' Campos vac&iacute;os. Por favor, compruebe que no hayan campos vac&iacute;os.';
				/*
				echo '{
					servidor: "'.form_error('servidor').'",
					base_datos: "'.form_error('base_datos').'",
					usuario: "'.form_error('usuario').'",
					contrasena: "'.form_error('contrasena').'",
					resultado_conexion: "'.icono_notificacion('error').' Campos vac&iacute;os. Por favor, compruebe que no hayan campos vac&iacute;os."
				}';
				*/
			}
		}
		/*
		else{
			echo 'Error request.';
		}
		*/
		exit;
	}
	
	private function validaciones($grupo_campos){
		$reglas = array(
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
					'rules' => 'trim'
					//'rules' => 'trim|required'
				)
			),
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
		$this->form_validation->set_rules($reglas[$grupo_campos]);
		$this->form_validation->set_message('required', icono_notificacion('error').'El campo: '.bold('%s').', es obligatorio.');
	}
}

/* End of file instalador.php */
/* Location: ./application/controllers/instalador.php */