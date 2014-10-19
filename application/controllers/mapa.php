<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapa extends CI_Controller{
	function __construct(){
		parent::__construct();

		$this->load->helper(array('url', 'html'));
	}
	public function index(){
		$data['pagina'] = 'mapa/consultar_mapa_view';
		$data['usuario_actual'] = "&lt;nombre_usuario&gt;";
		$data['opcion_menu'] = array('modulo_usuarios'					=>	'',
									 'modulo_centros_educativos'		=>	'',
									 'modulo_consultas_estadisticas'	=>	'',
									 'modulo_mapa_estadistico'			=>	'active'
									 );
		
		$this->load->view('plantilla_pagina_view', $data);
	}
}

/* End of file mapa.php */
/* Location: ./application/controllers/mapa.php */