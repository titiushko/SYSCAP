<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}
	
	public function eliminar_cache(){
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', FALSE);
		$this->output->set_header('Pragma: no-cache');
	}
	
	public function acceso_denegado($tipo_acceso = '', $usuario_actual = '', $nombre_completo_rol = ''){
		$mensaje = array(
			'sin_conexion'	=> array('encabezado'	=> 'Usuario no Autentificado',
									 'cuerpo'		=> 'Debe de inicar sesi&oacute;n para poder acceder a SYSCAP.',
									 'icono'		=> icono_notificacion('error')),
			'sin_permiso'	=> array('encabezado'	=> 'Usuario sin Privilegios',
									 'cuerpo'		=> 'No tiene permisos para ver &eacute;ste contenido.',
									 'icono'		=> icono_notificacion('alerta'))
		);
		include(APPPATH.'views/sesion/acceso_denegado_view.php');
		exit;
	}
	
	function error_mobile($page = '', $username = '', $role = ''){
		ob_start();
		include(APPPATH.'errors/error_mobile.php');
		$buffer = ob_get_contents();
		ob_end_clean();
		echo $buffer;
		exit;
	}
	
	function error_404($page = '', $username = '', $complete_role = '', $role = ''){
		$heading = "404 Page Not Found";
		$message = "The page you requested was not found.";
		echo $this->_error($heading, $message, 'error_404', 404, $page, $username, $complete_role, $role);
		exit;
	}
	
	function _error($heading, $message, $template = 'error_general', $status_code = 500, $page = '', $username = '', $complete_role = '', $role = ''){
		set_status_header($status_code);
		$message = '<p>'.implode('</p><p>', (!is_array($message)) ? array($message) : $message).'</p>';
		ob_start();
		include(APPPATH.'errors/'.$template.'.php');
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	}
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */