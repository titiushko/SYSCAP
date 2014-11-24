<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapa extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	
	public function index(){
		$datos['pagina'] = 'mapa/consultar_mapa_view';
		$datos['usuario_actual'] = "&lt;nombre_usuario&gt;";
		$datos['opcion_menu'] = modulo_actual('modulo_mapa_estadistico');
		
		$this->load->view('plantilla_pagina_view', $datos);
	}
}

/* End of file mapa.php */
/* Location: ./application/controllers/mapa.php */