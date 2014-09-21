<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapa extends CI_Controller{
	function __construct(){
		parent::__construct();

		$this->load->helper(array('url', 'html'));
	}
	public function index(){
		$data['usuario_actual'] = "Tito Miguel";
		$data['opcion_menu'] = array('modulo_usuarios'					=>	'',
									 'modulo_centros_educativos'		=>	'',
									 'modulo_consultas_estadisticas'	=>	'',
									 'modulo_mapa_estadistico'			=>	'active'
									 );
		
		$this->load->view('cabecera_pagina_view', $data);
		$this->load->view('mapa/consultar_mapa_view');
		$this->load->view('pie_pagina_view');
	}
}

/* End of file mapa.php */
/* Location: ./application/controllers/mapa.php */