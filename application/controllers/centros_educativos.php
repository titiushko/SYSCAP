<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Centros_educativos extends CI_Controller{
	function __construct(){
		parent::__construct();

		$this->load->helper(array('url', 'html'));
	}
	public function index(){
		$data['pagina'] = 'centros_educativos/consultar_centros_educativos_view';
		$data['usuario_actual'] = "Tito Miguel";
		$data['opcion_menu'] = array('modulo_usuarios'					=>	'',
									 'modulo_centros_educativos'		=>	'active',
									 'modulo_consultas_estadisticas'	=>	'',
									 'modulo_mapa_estadistico'			=>	''
									 );
		
		$this->load->view('plantilla_pagina_view', $data);
	}
}

/* End of file centros_educativos.php */
/* Location: ./application/controllers/centros_educativos.php */