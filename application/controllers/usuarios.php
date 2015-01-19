<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller{
	private $notificacion;
	
	function __construct(){
		parent::__construct();
		$this->notificacion = FALSE;
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
		
		if($this->notificacion){
			$datos['id_modal'] = 'myModal';
			$datos['eventos_body'] = 'onload="$(\'#myModal\').modal(\'show\');" onclick="location.href=\''.base_url().'usuarios/mostrar/'.$codigo_usuario.'\';"';
			$datos['titulo_notificacion'] = 'Actualizaci&oacute;n de Usuario';
			$datos['mensaje_notificacion'] = 'Se guardaron los cambios de '.htmlentities($this->usuarios_model->nombre_completo_usuario($codigo_usuario), ENT_COMPAT, 'UTF-8').'.';
			$this->notificacion = FALSE;
		}
		
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
			if($this->input->post('grupo_campos') == 'datos_personales'){
				$this->validaciones('datos_personales');
				$datos = $this->datos_formulario_usuarios_view("Editar", $codigo_usuario);
			}
			if($this->input->post('grupo_campos') == 'informacion_usuario'){
				$this->validaciones('informacion_usuario');
				$datos = $this->datos_formulario_usuarios_view("Recuperar Contraseña", $codigo_usuario);
			}
			
			if($this->form_validation->run() == TRUE){
				$update_usuario = $this->input->post();
				unset($update_usuario['estado'], $update_usuario['grupo_campos'], $update_usuario['boton_primario']);
				$this->usuarios_model->modificar($update_usuario, $codigo_usuario);
				$this->notificacion = TRUE;
				$this->mostrar($codigo_usuario);
			}
			else{
				$this->load->view('plantilla_pagina_view', $datos);
			}
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
	
	private function datos_formulario_usuarios_view($operacion = '', $codigo_usuario = NULL){
		$datos['usuario'] = $this->usuarios_model->usuario($codigo_usuario);
		if($operacion != ''){
			$datos['operacion'] = $operacion;
			$datos['pagina'] = 'usuarios/formulario_usuarios_view';
			$datos['usuario_actual'] = "&lt;nombre_usuario&gt;";
			$datos['opcion_menu'] = modulo_actual('modulo_usuarios');
			$datos['lista_centros_educativos'] = $this->centros_educativos_model->lista_centros_educativos();
			$datos['lista_profesiones'] = $this->profesiones_model->lista_profesiones();
			$datos['lista_tipos_usuarios'] = $this->tipos_usuarios_model->lista_tipos_usuarios();
		}
		else{
			$datos['nombre_centro_educativo'] = $this->centros_educativos_model->nombre_centro_educativo($datos['usuario'][0]->id_centro_educativo);
			$datos['nombre_profesion'] = $this->profesiones_model->nombre_profesion($datos['usuario'][0]->id_profesion);
			$datos['nombre_tipo_usuario'] = $this->tipos_usuarios_model->nombre_tipo_usuario($datos['usuario'][0]->id_tipo_usuario);
		}
		$datos['lista_calificaciones_usuario'] = $this->usuarios_model->calificaciones_usuario($codigo_usuario);
		$datos['lista_certificaciones_usuario'] = $this->usuarios_model->certificaciones_usuario($codigo_usuario);
		return $datos;
	}
	
	private function validaciones($grupo_campos){
		$reglas = array(
			'datos_personales' => array(
				array(
					'field' => 'nombres_usuario',
					'label' => 'Nombres del Usuario',
					'rules' => 'trim|required' 
				),
				array(
					'field' => 'apellido1_usuario',
					'label' => 'Apellidos del Usuario',
					'rules' => 'trim|required' 
				),
				array(
					'field' => 'dui_usuario',
					'label' => 'DUI del Usuario',
					'rules' => 'trim|required' 
				),
				array(
					'field' => 'correo_electronico_usuario',
					'label' => 'Correo Electrónico del Usuario',
					'rules' => 'trim|required|valid_email' 
				),
				array(
					'field' => 'id_profesion',
					'label' => 'Profesión del Usuario',
					'rules' => 'trim|required' 
				),
				array(
					'field' => 'id_centro_educativo',
					'label' => 'Centro Educativo del Usuario',
					'rules' => 'trim|required' 
				),
				array(
					'field' => 'direccion_usuario',
					'label' => 'Dirección del Usuario',
					'rules' => 'trim|required' 
				)
			),
			'informacion_usuario' => array(
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
			)
		);
		
		$this->form_validation->set_rules($reglas[$grupo_campos]);
		$this->form_validation->set_message('required', icono_notificacion('error').'El campo '.bold('%s').' es obligatorio.');
		$this->form_validation->set_message('min_length', icono_notificacion('error').'El campo '.bold('%s').' debe tener al menos %s caracteres.');
	}
	
	public function exportar($codigo_usuario = NULL){
		$pdf = new Pdf('P', 'cm', 'A4', true, 'UTF-8', false);
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
		$plantilla_pdf = $this->cargar_plantilla_pdf($codigo_usuario);
		$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $plantilla_pdf, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
		$nombre_archivo = utf8_decode(acentos($this->usuarios_model->nombre_completo_usuario($codigo_usuario)).'.pdf');
		// cerrar el documento pdf y prepar la salida: este método tiene varias opciones, consultar la documentación para más información
		$pdf->Output($nombre_archivo, 'I');
	}
	
	private function cargar_plantilla_pdf($codigo_usuario = NULL){
		$usuario = $this->usuarios_model->usuario($codigo_usuario);
		
		$lista_certificaciones_usuario = ''; $certificaciones = 1;
		foreach($this->usuarios_model->certificaciones_usuario($codigo_usuario) as $certificacion){
			$lista_certificaciones_usuario .= '<tr><td>'.$certificaciones++.'</td><td>'.htmlentities($certificacion->nombre, ENT_COMPAT, 'UTF-8').'</td></tr>';
		}
		if($lista_certificaciones_usuario == ''){
			$lista_certificaciones_usuario = 'El usuario no tiene certificaciones.';
		}
		
		$lista_cursos_usuario = ''; $cursos = 1;
		foreach($this->usuarios_model->calificaciones_usuario($codigo_usuario) as $curso){
			$lista_cursos_usuario .= '<tr><td>'.$cursos++.'</td><td>'.htmlentities($curso->nombre, ENT_COMPAT, 'UTF-8').'</td><td>'.$curso->nota.'</td></tr>';
		}
		if($lista_cursos_usuario == ''){
			$lista_cursos_usuario = 'El usuario no a recibido cursos.';
		}
		
		$plantilla_pdf = read_file('resources/templates/pdf/usuarios.php');
		$plantilla_pdf = str_replace(array('<NOMBRES_USUARIO>',
										   '<APELLIDO1_USUARIO>',
										   '<DUI_USUARIO>',
										   '<CORREO_USUARIO>',
										   '<PROFESION_USUARIO>',
										   '<CENTRO_EDUCATIVO_USUARIO>',
										   '<DIRECCION_USUARIO>',
										   '<NOMBRE_USUARIO>',
										   '<TIPO_USUARIO>',
										   '<MODALIDAD_USUARIO>',
										   '<CERTIFICACIONES_USUARIO>',
										   '<CURSOS_USUARIO>'),
									 array(htmlentities($usuario[0]->nombres_usuario, ENT_COMPAT, 'UTF-8'),
										   htmlentities($usuario[0]->apellido1_usuario, ENT_COMPAT, 'UTF-8'),
										   $usuario[0]->dui_usuario,
										   $usuario[0]->correo_electronico_usuario,
										   htmlentities($this->profesiones_model->nombre_profesion($usuario[0]->id_profesion), ENT_COMPAT, 'UTF-8'),
										   htmlentities($this->centros_educativos_model->nombre_centro_educativo($usuario[0]->id_centro_educativo), ENT_COMPAT, 'UTF-8'),
										   htmlentities($usuario[0]->direccion_usuario, ENT_COMPAT, 'UTF-8'),
										   htmlentities($usuario[0]->nombre_usuario, ENT_COMPAT, 'UTF-8'),
										   htmlentities($this->tipos_usuarios_model->nombre_tipo_usuario($usuario[0]->id_tipo_usuario), ENT_COMPAT, 'UTF-8'),
										   $usuario[0]->modalidad_usuario,
										   $lista_certificaciones_usuario,
										   $lista_cursos_usuario),
									 $plantilla_pdf);
		return $plantilla_pdf;
	}
	
	public function imprimir($codigo_usuario = NULL){
		$datos = $this->datos_formulario_usuarios_view('', $codigo_usuario);
		if(empty($datos['usuario'])){
			echo 'mostrar(): id_usuario= '.$codigo_usuario.' Invalido';		//TODO: crear algo en respuesta, cuando sea un id no valido.
		}
		else{
			$this->load->view('usuarios/imprimir_usuarios_view', $datos);
		}
	}
}

/* End of file usuarios.php */
/* Location: ./application/controllers/usuarios.php */