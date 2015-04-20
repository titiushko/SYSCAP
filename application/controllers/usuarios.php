<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends MY_Controller{
	private $notificacion;
	
	function __construct(){
		parent::__construct();
		$this->eliminar_cache();
		if(isset($this->session->userdata['conexion_usuario'])){
			$this->notificacion = FALSE;
			$this->load->model(array('usuarios_model', 'centros_educativos_model', 'profesiones_model', 'tipos_usuarios_model'));
		}
		else{
			$this->acceso_denegado('sin_conexion');
		}
	}
	
	public function index(){
		if($this->session->userdata['nombre_corto_rol'] == 'admin' || $this->session->userdata['nombre_corto_rol'] == 'moderador'){
			$datos['pagina'] = 'usuarios/consultar_usuarios_view';
			$datos['opcion_menu'] = modulo_actual('modulo_usuarios');
			$datos['lista_usuarios'] = $this->usuarios_model->usuarios();
			$this->load->view('plantilla_pagina_view', $datos);
		}
		else{
			$this->acceso_denegado('sin_permiso', utf8($this->session->userdata('nombre_completo_usuario')), utf8($this->session->userdata('nombre_completo_rol')));
		}
	}
	
	public function mostrar($codigo_usuario = NULL){
		if($this->validar_parametros($codigo_usuario)){
			if($this->session->userdata['nombre_corto_rol'] == 'student' && $this->session->userdata['id_usuario'] != $codigo_usuario){
				$this->acceso_denegado('sin_permiso', utf8($this->session->userdata('nombre_completo_usuario')), utf8($this->session->userdata('nombre_completo_rol')));
			}
			$datos = $this->datos_formulario_usuarios_view($codigo_usuario, 'Mostrar');
			if($this->notificacion){
				$datos['eventos_body'] = 'onload="$(\'#myModal\').modal(\'show\');" onclick="redireccionar(\''.base_url('usuarios/mostrar/'.$codigo_usuario).'\');" onkeyup="redireccionar(\''.base_url('usuarios/mostrar/'.$codigo_usuario).'\');"';
				$datos['notificaciones'] = mensaje_notificacion(
					'myModal',
					icono_notificacion('informacion').'Actualizaci&oacute;n de Usuario',
					'Se guardaron los cambios de '.utf8($this->usuarios_model->nombre_completo_usuario($codigo_usuario)).'.'
				);
				$this->notificacion = FALSE;
			}
			if(empty($datos['usuario'])){
				$this->error_404(current_url(), utf8($this->session->userdata('nombre_completo_usuario')), utf8($this->session->userdata('nombre_completo_rol')), $this->session->userdata('nombre_corto_rol'));
			}
			else{
				$this->load->view('plantilla_pagina_view', $datos);
			}
		}
		else{
			$this->error_404(current_url(), utf8($this->session->userdata('nombre_completo_usuario')), utf8($this->session->userdata('nombre_completo_rol')), $this->session->userdata('nombre_corto_rol'));
		}
	}
	
	public function modificar($codigo_usuario = NULL){
		if($this->validar_parametros($codigo_usuario)){
			if($this->session->userdata['nombre_corto_rol'] == 'admin'){
				$datos = $this->datos_formulario_usuarios_view($codigo_usuario, 'Editar');
				if($this->input->post('estado') == '1'){
					if($this->input->post('grupo_campos') == 'datos_personales'){
						$this->validaciones('datos_personales');
						$datos = $this->datos_formulario_usuarios_view($codigo_usuario, 'Editar');
					}
					if($this->input->post('grupo_campos') == 'informacion_usuario'){
						$this->validaciones('informacion_usuario', $codigo_usuario);
						$datos = $this->datos_formulario_usuarios_view($codigo_usuario, 'Recuperar Contraseña');
					}
					if($this->form_validation->run()){
						$update_usuario = $this->input->post();
						$validar_contrasena_usuario = $this->usuarios_model->validar_contrasena_usuario($this->input->post('contrasena_usuario'), $codigo_usuario);
						if($this->input->post('contrasena_usuario') && empty($validar_contrasena_usuario))
							$update_usuario['contrasena_usuario'] = md5($this->input->post('contrasena_usuario').$this->config->item('semilla_moodle'));
						unset($update_usuario['estado'], $update_usuario['nombre_centro_educativo'], $update_usuario['grupo_campos'], $update_usuario['boton_primario']);
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
						$this->error_404(current_url(), utf8($this->session->userdata('nombre_completo_usuario')), utf8($this->session->userdata('nombre_completo_rol')), $this->session->userdata('nombre_corto_rol'));
					}
					else{
						$this->load->view('plantilla_pagina_view', $datos);
					}
				}
			}
			else{
				$this->acceso_denegado('sin_permiso', utf8($this->session->userdata('nombre_completo_usuario')), utf8($this->session->userdata('nombre_completo_rol')));
			}
		}
		else{
			$this->error_404(current_url(), utf8($this->session->userdata('nombre_completo_usuario')), utf8($this->session->userdata('nombre_completo_rol')), $this->session->userdata('nombre_corto_rol'));
		}
	}
	
	public function recuperar_contrasena($codigo_usuario = NULL){
		if($this->validar_parametros($codigo_usuario)){
			if($this->session->userdata['nombre_corto_rol'] == 'admin'){
				$datos = $this->datos_formulario_usuarios_view($codigo_usuario, 'Recuperar Contraseña');
				if(empty($datos['usuario'])){
					$this->error_404(current_url(), utf8($this->session->userdata('nombre_completo_usuario')), utf8($this->session->userdata('nombre_completo_rol')), $this->session->userdata('nombre_corto_rol'));
				}
				else{
					$this->load->view('plantilla_pagina_view', $datos);
				}
			}
			else{
				$this->acceso_denegado('sin_permiso', utf8($this->session->userdata('nombre_completo_usuario')), utf8($this->session->userdata('nombre_completo_rol')));
			}
		}
		else{
			$this->error_404(current_url(), utf8($this->session->userdata('nombre_completo_usuario')), utf8($this->session->userdata('nombre_completo_rol')), $this->session->userdata('nombre_corto_rol'));
		}
	}
	
	private function datos_formulario_usuarios_view($codigo_usuario, $operacion = ''){
		$validar_codigo_usuario = $this->usuarios_model->validar_codigo_usuario($codigo_usuario);
		if(empty($validar_codigo_usuario)){
			return NULL;
		}
		else{
			$datos['usuario'] = $this->usuarios_model->usuario($codigo_usuario);
			if($operacion != ''){
				$datos['operacion'] = $operacion;
				$datos['pagina'] = $this->session->userdata('nombre_corto_rol') != 'admin' ? 'usuarios/usuarios_view' : 'usuarios/formulario_usuarios_view';
				$datos['opcion_menu'] = modulo_actual('modulo_usuarios');
				$datos['lista_profesiones'] = $this->profesiones_model->lista_profesiones();
				$datos['lista_tipos_usuarios'] = $this->tipos_usuarios_model->lista_tipos_usuarios();
			}
			else{
				$datos['nombre_centro_educativo'] = utf8($this->centros_educativos_model->nombre_centro_educativo($datos['usuario'][0]->id_centro_educativo));
				$datos['nombre_profesion'] = utf8($this->profesiones_model->nombre_profesion($datos['usuario'][0]->id_profesion));
				$datos['nombre_tipo_usuario'] = utf8($this->tipos_usuarios_model->nombre_tipo_usuario($datos['usuario'][0]->id_tipo_usuario));
			}
			$datos['lista_calificaciones_usuario'] = $this->usuarios_model->calificaciones_usuario($codigo_usuario);
			$datos['lista_certificaciones_usuario'] = $this->usuarios_model->certificaciones_usuario($codigo_usuario);
			return $datos;
		}
	}
	
	private function validaciones($grupo_campos, $codigo_usuario = NULL){
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
					'rules' => 'trim|required|regex_match[/^\d{8}-\d$/]' 
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
					'rules' => 'required|trim|min_length[5]|max_length[150]|xss_clean|callback_validar_nombre_usuario['.$codigo_usuario.']'
				),
				array(
					'field' => 'contrasena_usuario',
					'label' => 'Contraseña',
					'rules' => 'required|trim|min_length[5]|max_length[150]|xss_clean' 
				),
				array(
					'field' => 'id_tipo_usuario',
					'label' => 'Tipo Usuario',
					'rules' => 'trim|required' 
				)
			)
		);
		$this->form_validation->set_rules($reglas[$grupo_campos]);
	}
	
	public function validar_nombre_usuario($nombre_usuario, $codigo_usuario){
		$validar_nombre_usuario = $this->usuarios_model->validar_nombre_usuario($nombre_usuario, $codigo_usuario);
		if(empty($validar_nombre_usuario)){
			return TRUE;
		}
		else{
			$this->form_validation->set_message('validar_nombre_usuario', icono_notificacion('error').bold('%s').' ya existe.');
			return FALSE;
		}
	}
	
	public function exportar($codigo_usuario = NULL){
		if($this->validar_parametros($codigo_usuario)){
			if($this->session->userdata['nombre_corto_rol'] == 'student' && $this->session->userdata['id_usuario'] != $codigo_usuario){
				$this->acceso_denegado('sin_permiso', utf8($this->session->userdata('nombre_completo_usuario')), utf8($this->session->userdata('nombre_completo_rol')));
			}
			$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, TRUE, 'UTF-8', FALSE);
			$pdf->setPrintHeader(FALSE);
			$pdf->setPrintFooter(FALSE);
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
			$pdf->SetFont('helvetica', '', 13, '', true);
			$pdf->AddPage();
			$plantilla_pdf = $this->cargar_plantilla_pdf($codigo_usuario);
			$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $plantilla_pdf, $border = 0, $ln = 1, $fill = 0, $reseth = TRUE, $align = '', $autopadding = TRUE);
			$nombre_archivo = utf8_decode(acentos($this->usuarios_model->nombre_completo_usuario($codigo_usuario)).'.pdf');
			echo $plantilla_pdf; //$pdf->Output($nombre_archivo, 'I');
		}
		else{
			$this->error_404(current_url(), utf8($this->session->userdata('nombre_completo_usuario')), utf8($this->session->userdata('nombre_completo_rol')), $this->session->userdata('nombre_corto_rol'));
		}
	}
	
	private function cargar_plantilla_pdf($codigo_usuario){
		$usuario = $this->usuarios_model->usuario($codigo_usuario);
		$plantilla_pdf = read_file('resources/templates/pdf/usuarios.php');
		$lista_certificaciones_usuario = ''; $certificaciones = 1;
		foreach($this->usuarios_model->certificaciones_usuario($codigo_usuario) as $certificacion){
			$lista_certificaciones_usuario .= '<tr><td>'.$certificaciones++.'</td><td>'.str_replace('Examen Certificacion', '', str_replace('Examen De Certificacion', '', utf8($certificacion->nombre))).'</td></tr>';
		}
		if($lista_certificaciones_usuario == ''){
			$lista_certificaciones_usuario = 'El usuario no tiene certificaciones.';
		}
		$lista_cursos_usuario = ''; $cursos = 1;
		foreach($this->usuarios_model->calificaciones_usuario($codigo_usuario) as $curso){
			$lista_cursos_usuario .= '<tr><td>'.$cursos++.'</td><td>'.str_replace('Examen Certificacion', '', str_replace('Examen De Certificacion', '', utf8($curso->nombre))).'</td><td>'.number_format(limpiar_nulo($curso->nota), 2, '.', ',').'</td></tr>';
		}
		if($lista_cursos_usuario == ''){
			$lista_cursos_usuario = 'El usuario no a recibido cursos.';
		}
		$plantilla_pdf = str_replace(array('<ENCABEZADO_REPORTE>',
										   '<NOMBRES_USUARIO>',
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
									 array(encabezado_reporte(),
										   utf8($usuario[0]->nombres_usuario),
										   utf8($usuario[0]->apellido1_usuario),
										   $usuario[0]->dui_usuario,
										   $usuario[0]->correo_electronico_usuario,
										   utf8($this->profesiones_model->nombre_profesion($usuario[0]->id_profesion)),
										   utf8($this->centros_educativos_model->nombre_centro_educativo($usuario[0]->id_centro_educativo)),
										   utf8($usuario[0]->direccion_usuario),
										   utf8($usuario[0]->nombre_usuario),
										   utf8($this->tipos_usuarios_model->nombre_tipo_usuario($usuario[0]->id_tipo_usuario)),
										   $usuario[0]->modalidad_usuario,
										   $lista_certificaciones_usuario,
										   $lista_cursos_usuario),
									 $plantilla_pdf);
		return $plantilla_pdf;
	}
	
	public function imprimir($codigo_usuario = NULL){
		if(!$this->session->userdata('dispositivo_movil')){
			if($this->validar_parametros($codigo_usuario)){
				if($this->session->userdata['nombre_corto_rol'] == 'student' && $this->session->userdata['id_usuario'] != $codigo_usuario){
					$this->acceso_denegado('sin_permiso', utf8($this->session->userdata('nombre_completo_usuario')), utf8($this->session->userdata('nombre_completo_rol')));
				}
				$datos = $this->datos_formulario_usuarios_view($codigo_usuario);
				if(empty($datos['usuario'])){
					$this->error_404(current_url(), utf8($this->session->userdata('nombre_completo_usuario')), utf8($this->session->userdata('nombre_completo_rol')), $this->session->userdata('nombre_corto_rol'));
				}
				else{
					$this->load->view('usuarios/imprimir_usuarios_view', $datos);
				}
			}
			else{
				$this->error_404(current_url(), utf8($this->session->userdata('nombre_completo_usuario')), utf8($this->session->userdata('nombre_completo_rol')), $this->session->userdata('nombre_corto_rol'));
			}
		}
		else{
			$this->show_error_mobile(current_url(), utf8($this->session->userdata('nombre_completo_usuario')));
		}
	}
	
	private function validar_parametros($codigo_usuario){
		if(empty($codigo_usuario)){
			return FALSE;
		}
		elseif(is_numeric($codigo_usuario)){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}

/* End of file usuarios.php */
/* Location: ./application/controllers/usuarios.php */