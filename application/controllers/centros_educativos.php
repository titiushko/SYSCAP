<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Centros_educativos extends CI_Controller{
	function __construct(){
		parent::__construct();
		
		$this->load->helper(array('url', 'html', 'form', 'funciones_helper', 'file'));
		$this->load->library('pdf');
		$this->load->model(array('centros_educativos_model', 'departamentos_model', 'municipios_model', 'usuarios_model'));
	}
	
	public function index(){
		$data['pagina'] = 'centros_educativos/consultar_centros_educativos_view';
		$data['usuario_actual'] = "&lt;nombre_usuario&gt;";
		$data['opcion_menu'] = modulo_actual('modulo_centros_educativos');
		$data['lista_centros_educativos'] = $this->centros_educativos_model->centros_educativos();
		
		$this->load->view('plantilla_pagina_view', $data);
	}
	
	public function mostrar($codigo_centro_educativo = NULL){
		$data['operacion'] = "Mostrar";
		$data['pagina'] = 'centros_educativos/formulario_centros_educativos_view';
		$data['usuario_actual'] = "&lt;nombre_usuario&gt;";
		$data['opcion_menu'] = modulo_actual('modulo_centros_educativos');
		$data['centro_educativo'] = $this->centros_educativos_model->centro_educativo($codigo_centro_educativo);
		$data['lista_departamentos'] = $this->departamentos_model->lista_departamentos();
		$data['lista_municipios'] = $this->municipios_model->lista_municipios();
		$data['lista_docentes_certificados'] = $this->usuarios_model->tipos_capacitados_usuarios($codigo_centro_educativo, 7, '%certificacion%', array('docentes'), 'tutorizado');
		$data['lista_docentes_capacitados'] = $this->usuarios_model->tipos_capacitados_usuarios($codigo_centro_educativo, 0, '%', array('docentes'), 'tutorizado');
		
		if(empty($data['centro_educativo'])){
			echo 'ID Invalido';		//TODO: crear algo en respuesta, cuando sea un id no valido.
		}
		else{
			$this->load->view('plantilla_pagina_view', $data);
		}
	}
	
	public function modificar($codigo_centro_educativo = NULL){
		$data['operacion'] = "Editar";
		$data['pagina'] = 'centros_educativos/formulario_centros_educativos_view';
		$data['usuario_actual'] = "&lt;nombre_usuario&gt;";
		$data['opcion_menu'] = modulo_actual('modulo_centros_educativos');
		$data['lista_departamentos'] = $this->departamentos_model->lista_departamentos();
		$data['lista_municipios'] = $this->municipios_model->lista_municipios();
		$data['lista_docentes_certificados'] = $this->usuarios_model->tipos_capacitados_usuarios($codigo_centro_educativo, 7, '%certificacion%', array('docentes'), 'tutorizado');
		$data['lista_docentes_capacitados'] = $this->usuarios_model->tipos_capacitados_usuarios($codigo_centro_educativo, 0, '%', array('docentes'), 'tutorizado');
		
		if($this->input->post('estado', TRUE)){
			$update_centro_educativo = $this->input->post();
			$this->centros_educativos_model->modificar($update_centro_educativo, $codigo_centro_educativo);
			redirect('centros_educativos');
		}
		else{
			$data['centro_educativo'] = $this->centros_educativos_model->centro_educativo($codigo_centro_educativo);
			if(empty($data['centro_educativo'])){
				echo 'ID Invalido';		//TODO: crear algo en respuesta, cuando sea un id no valido. 
			}
			else{
				$this->load->view('plantilla_pagina_view', $data);
			}
		}
	}
	
	function exportar(){
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetTitle('Reporte de Centros Educativos');
		// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Reporte de Centros Educativos', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
		$pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));
		// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		// se pueden modificar en el archivo tcpdf_config.php de libraries/config
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		// se pueden modificar en el archivo tcpdf_config.php de libraries/config
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		// se pueden modificar en el archivo tcpdf_config.php de libraries/config
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		//relación utilizada para ajustar la conversión de los píxeles
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		// establecer el modo de fuente por defecto
		$pdf->setFontSubsetting(true);
		// establecer el tipo de letra: si se tiene que imprimir carácteres ASCII estándar, se puede utilizar las fuentes básicas como Helvetica para reducir el tamaño del archivo
		$pdf->SetFont('freemono', '', 14, '', true);
		// añadir una página: este método tiene varias opciones, consultar la documentación para más información
		$pdf->AddPage();
		// fijar efecto de sombra en el texto
		$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
		// establecer el contenido para generar el pdf
		$plantilla_pdf = read_file('sources/templates/pdf/centros_educativos.php');
		$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $plantilla_pdf, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
		$nombre_archivo = utf8_decode("Reporte de Centros Educativos.pdf");
		// cerrar el documento pdf y prepar la salida: este método tiene varias opciones, consultar la documentación para más información
		$pdf->Output($nombre_archivo, 'I');
	}
}

/* End of file centros_educativos.php */
/* Location: ./application/controllers/centros_educativos.php */