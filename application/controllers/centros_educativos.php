<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Centros_educativos extends CI_Controller{
	private $notificacion;
	
	function __construct(){
		parent::__construct();
		$this->notificacion = FALSE;
		$this->load->model(array('centros_educativos_model', 'departamentos_model', 'municipios_model', 'usuarios_model'));
	}
	
	public function index(){
		$datos['pagina'] = 'centros_educativos/consultar_centros_educativos_view';
		$datos['usuario_actual'] = "&lt;nombre_usuario&gt;";
		$datos['opcion_menu'] = modulo_actual('modulo_centros_educativos');
		$datos['lista_centros_educativos'] = $this->centros_educativos_model->centros_educativos();
		$this->load->view('plantilla_pagina_view', $datos);
	}
	
	public function mostrar($codigo_centro_educativo = NULL){
		$datos = $this->datos_formulario_centros_educativos_view("Mostrar", $codigo_centro_educativo);
		
		if($this->notificacion){
			$datos['id_modal'] = 'myModal';
			$datos['eventos_body'] = 'onload="$(\'#myModal\').modal(\'show\');" onclick="location.href=\''.base_url().'centros_educativos/mostrar/'.$codigo_centro_educativo.'\';"';
			$datos['titulo_notificacion'] = 'Actualizaci&oacute;n de Centro Educativo';
			$datos['mensaje_notificacion'] = 'Se guardaron los cambios de '.utf8($this->centros_educativos_model->nombre_centro_educativo($codigo_centro_educativo)).'.';
			$this->notificacion = FALSE;
		}
		
		if(empty($datos['centro_educativo'])){
			echo 'mostrar(): id_centro_educativo= '.$codigo_centro_educativo.' Invalido';		//TODO: crear algo en respuesta, cuando sea un id no valido.
		}
		else{
			$this->load->view('plantilla_pagina_view', $datos);
		}
	}
	
	public function modificar($codigo_centro_educativo = NULL){
		$datos = $this->datos_formulario_centros_educativos_view("Editar", $codigo_centro_educativo);
		
		if($this->input->post('estado') == '1'){
			$this->validaciones();
			if($this->form_validation->run() == TRUE){
				$update_centro_educativo = $this->input->post();
				unset($update_centro_educativo['estado'], $update_centro_educativo['boton_primario']);
				$this->centros_educativos_model->modificar($update_centro_educativo, $codigo_centro_educativo);
				$this->notificacion = TRUE;
				$this->mostrar($codigo_centro_educativo);
			}
			else{
				$this->load->view('plantilla_pagina_view', $datos);
			}
		}
		else{
			if(empty($datos['centro_educativo'])){
				echo 'modificar(): id_centro_educativo= '.$codigo_centro_educativo.' Invalido';		//TODO: crear algo en respuesta, cuando sea un id no valido.
			}
			else{
				$this->load->view('plantilla_pagina_view', $datos);
			}
		}
	}
	
	private function datos_formulario_centros_educativos_view($operacion = '', $codigo_centro_educativo = NULL){
		$datos['centro_educativo'] = $this->centros_educativos_model->centro_educativo($codigo_centro_educativo);
		 if($operacion != ''){
			$datos['operacion'] = $operacion;
			$datos['pagina'] = 'centros_educativos/formulario_centros_educativos_view';
			$datos['usuario_actual'] = "&lt;nombre_usuario&gt;";
			$datos['opcion_menu'] = modulo_actual('modulo_centros_educativos');
			$datos['lista_departamentos'] = $this->departamentos_model->lista_departamentos();
			$datos['lista_municipios'] = $this->municipios_model->lista_municipios();
		}
		else{
			$datos['nombre_departamento'] = $this->departamentos_model->nombre_departamento($datos['centro_educativo'][0]->id_departamento);
			$datos['nombre_municipio'] = $this->municipios_model->nombre_municipio($datos['centro_educativo'][0]->id_municipio);
		}
		$datos['lista_docentes_certificados'] = $this->usuarios_model->tipos_capacitados_usuarios($codigo_centro_educativo, 7, 'Examen%', array('docentes'), 'tutorizado');
		$datos['lista_docentes_capacitados'] = $this->usuarios_model->tipos_capacitados_usuarios($codigo_centro_educativo, 7, 'Evaluaci%', array('docentes'), 'tutorizado');
		return $datos;
	}
	
	private function validaciones(){
		$reglas = array(
			array(
				'field' => 'nombre_centro_educativo',
				'label' => 'Nombre del Centro Educativo',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'id_departamento',
				'label' => 'Departamento del Centro Educativo',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'id_municipio',
				'label' => 'Municipio del Centro Educativo',
				'rules' => 'trim|required'
			)
		);
	
		$this->form_validation->set_rules($reglas);
		$this->form_validation->set_message('required', icono_notificacion('error').'El campo: '.bold('%s').', es obligatorio.');
	}
	
	public function exportar($codigo_centro_educativo = NULL){
		$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, TRUE, 'UTF-8', FALSE);
		$pdf->setPrintHeader(FALSE);
		$pdf->setPrintFooter(FALSE);
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->SetFont('helvetica', '', 13, '', true);
		$pdf->AddPage();
		$plantilla_pdf = $this->cargar_plantilla_pdf($codigo_centro_educativo);
		$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $plantilla_pdf, $border = 0, $ln = 1, $fill = 0, $reseth = TRUE, $align = '', $autopadding = TRUE);
		$nombre_archivo = utf8_decode(acentos($this->centros_educativos_model->nombre_centro_educativo($codigo_centro_educativo)).'.pdf');
		$pdf->Output($nombre_archivo, 'I');
	}
	
	private function cargar_plantilla_pdf($codigo_centro_educativo = NULL){
		$centro_educativo = $this->centros_educativos_model->centro_educativo($codigo_centro_educativo);
		$plantilla_pdf = read_file('resources/templates/pdf/centros_educativos.php');
		if(empty($centro_educativo)){
			$plantilla_pdf = 'mostrar(): id_centro_educativo= '.$codigo_centro_educativo.' Invalido' ;		//TODO: crear algo en respuesta, cuando sea un id no valido.
		}
		else{
			$lista_docentes_capacitados =  ''; $docentes_capacitados = 1;
			foreach($this->usuarios_model->tipos_capacitados_usuarios($codigo_centro_educativo, 7, 'Evaluaci%', array('docentes'),'tutorizado') as $docente_capacitado){
				$lista_docentes_capacitados .='<tr><td>'.$docentes_capacitados++.'</td><td>'.utf8($docente_capacitado->nombre_completo_usuario).'</td></tr>';
			}
			if($lista_docentes_capacitados == ''){
				$lista_docentes_capacitados ='No hay docentes capacitados en el centro educativo.';
			}
			
			$lista_docentes_certificados =  ''; $docentes_certificados= 1;
			foreach($this->usuarios_model->tipos_capacitados_usuarios($codigo_centro_educativo, 7, 'Examen%', array('docentes'),'tutorizado') as $docente_certificado){
				$lista_docentes_certificados.= '<tr><td>'.$docentes_certificados++.'</td><td>'.utf8($docente_certificado->nombre_completo_usuario).'</td></tr>';
			}
			if($lista_docentes_certificados == ''){
				$lista_docentes_certificados ='No hay docentes certificados en el centro educativo.';
			}
			
			$plantilla_pdf = str_replace(array('<ENCABEZADO_REPORTE>',
											   '<NOMBRE_CENTRO_EDUCATIVO>',
											   '<CODIGO_CENTRO_EDUCATIVO>',
											   '<DEPARTAMENTO_CENTRO_EDUCATIVO>',
											   '<MUNICIPIO_CENTRO_EDUCATIVO>',
											   '<DOCENTES_CAPACITADOS_CENTRO_EDUCATIVO>',
											   '<DOCENTES_CERTIFICADOS_CENTRO_EDUCATIVO>',),
										 array(encabezado_reporte(),
											   utf8($centro_educativo[0]->nombre_centro_educativo),
											   $centro_educativo[0]->codigo_centro_educativo,
											   utf8($this->departamentos_model->nombre_departamento($centro_educativo[0]->id_departamento)),
											   utf8($this->municipios_model->nombre_municipio($centro_educativo[0]->id_municipio)), 
											   $lista_docentes_capacitados, 
											   $lista_docentes_certificados),
										 $plantilla_pdf);
		}
		return $plantilla_pdf;
	}
	
	public function imprimir($codigo_centro_educativo = NULL){
		$datos = $this->datos_formulario_centros_educativos_view('', $codigo_centro_educativo);
		if(empty($datos['centro_educativo'])){
			echo 'mostrar(): id_centro_educativo= '.$codigo_centro_educativo.' Invalido' ;		//TODO: crear algo en respuesta, cuando sea un id no valido.
		}
		else{
			$this->load->view('centros_educativos/imprimir_centros_educativos_view', $datos);
		}
	}
}

/* End of file centros_educativos.php */
/* Location: ./application/controllers/centros_educativos.php */