<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model(array('usuarios_model', 'centros_educativos_model', 'profesiones_model', 'tipos_usuarios_model'));
	}
	
	public function index(){
		$datos['pagina'] = 'usuarios/consultar_usuarios_view';
		$datos['usuario_actual'] = "&lt;nombre_usuario&gt;";
		$datos['opcion_menu'] = modulo_actual('modulo_usuarios');
		$datos['lista_usuarios'] = $this->usuarios_model->usuarios();
		$this->load->view('plantilla_pagina_view', $datos);
	}
	
	public function mostrar($codigo_usuario = NULL){
		$datos = $this->datos_formulario_usuarios_view("Mostrar", $codigo_usuario);
		
		if(empty($datos['usuario'])){
			echo 'mostrar(): id_usuario= '.$codigo_usuario.' Invalido';		//TODO: crear algo en respuesta, cuando sea un id no valido.
		}
		else{
			$this->load->view('plantilla_pagina_view', $datos);
		}
	}
	
	public function modificar($codigo_usuario = NULL){
		$datos = $this->datos_formulario_usuarios_view("Editar", $codigo_usuario);
	
		if($this->input->post('estado') == '1'){
			$update_usuario = $this->input->post();
			unset($update_usuario['estado'], $update_usuario['boton_primario']);
			$this->usuarios_model->modificar($update_usuario, $codigo_usuario);
			//redirect('usuarios/mostrar/'.$codigo_usuario);
			redirect('usuarios/resultado/'.$codigo_usuario);
		}
		else{
			if(empty($datos['usuario'])){
				echo 'modificar(): id_usuario= '.$codigo_usuario.' Invalido';		//TODO: crear algo en respuesta, cuando sea un id no valido.
			}
			else{
				$this->load->view('plantilla_pagina_view', $datos);
			}
		}
	}
	
	public function recuperar_contrasena($codigo_usuario = NULL){
		$datos = $this->datos_formulario_usuarios_view("Recuperar Contraseña", $codigo_usuario);
		
		if(empty($datos['usuario'])){
			echo 'recuperar_contrasena(): id_usuario= '.$codigo_usuario.' Invalido';		//TODO: crear algo en respuesta, cuando sea un id no valido.
		}
		else{
			$this->load->view('plantilla_pagina_view', $datos);
		}
	}
	
	public function resultado($codigo_usuario = NULL){
		$datos = $this->datos_formulario_usuarios_view("Mostrar", $codigo_usuario);
		$datos['notificacion'] = 'onload="$(\'#myModal\').modal(\'show\');"';
		$datos['mensaje_notificacion'] = 'Se guardaron los cambios del usuario.';
		
		if(empty($datos['usuario'])){
			echo 'resultado(): id_usuario= '.$codigo_usuario.' Invalido';		//TODO: crear algo en respuesta, cuando sea un id no valido.
		}
		else{
			$this->load->view('plantilla_pagina_view', $datos);
		}
	}
	
	private function datos_formulario_usuarios_view($operacion = '', $codigo_usuario = NULL){
		$datos['operacion'] = $operacion;
		$datos['pagina'] = 'usuarios/formulario_usuarios_view';
		$datos['usuario_actual'] = "&lt;nombre_usuario&gt;";
		$datos['opcion_menu'] = modulo_actual('modulo_usuarios');
		$datos['usuario'] = $this->usuarios_model->usuario($codigo_usuario);
		$datos['lista_centros_educativos'] = $this->centros_educativos_model->lista_centros_educativos();
		$datos['lista_profesiones'] = $this->profesiones_model->lista_profesiones();
		$datos['lista_tipos_usuarios'] = $this->tipos_usuarios_model->lista_tipos_usuarios();
		$datos['lista_calificaciones_usuario'] = $this->usuarios_model->calificaciones_usuario($codigo_usuario);
		$datos['lista_certificaciones_usuario'] = $this->usuarios_model->certificaciones_usuario($codigo_usuario);
		return $datos;
	}
	
	private function validaciones(){
		$reglas = array(
			array(
				'field' => 'nombres_usuario',
				'label' => 'Nombres',
				'rules' => 'trim|required' 
			),
			array(
				'field' => 'apellido1_usuario',
				'label' => 'Apellidos',
				'rules' => 'trim|required' 
			),
			array(
				'field' => 'dui_usuario',
				'label' => 'DUI',
				'rules' => 'trim|required' 
			),
			array(
				'field' => 'correo_electronico_usuario',
				'label' => 'Correo Electrónico',
				'rules' => 'trim|required|correo_electronico_usuario' 
			),
			array(
				'field' => 'id_profesion',
				'label' => 'Profesión',
				'rules' => 'trim|required' 
			),
			array(
				'field' => 'id_centro_educativo',
				'label' => 'Centro Educativo',
				'rules' => 'trim|required' 
			),
			array(
				'field' => 'direccion_usuario',
				'label' => 'Dirección',
				'rules' => 'trim|required' 
			),
			array(
				'field' => 'nombre_usuario',
				'label' => 'Nombre de Usuario',
				'rules' => 'trim|required|min_length[6]' 
			),
			array(
				'field' => 'contrasena_usuario',
				'label' => 'Contraseña',
				'rules' => 'trim|required|min_length[6]' 
			),
			array(
				'field' => 'id_tipo_usuario',
				'label' => 'Tipo Usuario',
				'rules' => 'trim|required' 
			)
		);
		
		$this->form_validation->set_rules($reglas);
		
		/*$this->form_validation->set_message('required','El Campo: %s, Es Obligatorio');
		$this->form_validation->set_message('min_length','El Campo: %s, Debe tener al Menos %s Caracteres');*/
	}
	
	public function exportar(){
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetTitle('Reporte de Usuarios');
		// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Reporte de Usuarios', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
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
		$plantilla_pdf = read_file('sources/templates/pdf/usuarios.php');
		$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $plantilla_pdf, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
		$nombre_archivo = utf8_decode("Reporte de Usuarios.pdf");
		// cerrar el documento pdf y prepar la salida: este método tiene varias opciones, consultar la documentación para más información
		$pdf->Output($nombre_archivo, 'I');
	}
}

/* End of file usuarios.php */
/* Location: ./application/controllers/usuarios.php */