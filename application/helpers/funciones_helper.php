<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Convierte todos los caracteres aplicables a entidades HTML */
if(!function_exists('utf8')){
	function utf8($cadena){
		return htmlentities(acentos($cadena), ENT_COMPAT, 'UTF-8');
	}
}

/* Convierte un String a formato de DUI */
if(!function_exists('formato_dui')){
	function formato_dui($dui){
		return preg_match('/^\d{8}-\d$/', $dui) ? $dui : substr($dui, 0, 7).'-'.substr($dui, 8, 1);
	}
}

/* Elimina caracteres especiales */
if(!function_exists('acentos')){
	function acentos($cadena){
		$cadena = trim($cadena);
		$cadena = str_replace(
				array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
				array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
				$cadena
		);
		$cadena = str_replace(
				array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
				array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
				$cadena
		);
		$cadena = str_replace(
				array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
				array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
				$cadena
		);
		$cadena = str_replace(
				array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
				array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
				$cadena
		);
		$cadena = str_replace(
				array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
				array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
				$cadena
		);
		$cadena = str_replace(
				array('ñ', 'Ñ', 'ç', 'Ç'),
				array('n', 'N', 'c', 'C'),
				$cadena
		);
		// $cadena = str_replace(' ', '_', $cadena);
		$cadena = str_replace('&', 'y', $cadena);
		$cadena = str_replace(
				array("\\", "¨", "º", "~", "#", "@", "|", "!", "\"", "·", "$", "%", "/", "(", ")", "?", "'", "¡", "¿", "[", "^", "`", "]", "+", "}", "{", "¨", "´", ">", "< ", ";", ":"),
				'',
				$cadena
		);
		return $cadena;
	}
}

/* Activa la opción seleccionada del menú */
if(!function_exists('modulo_actual')){
	function modulo_actual($modulo){
		$listado_modulos = array('inicio'							=>	'',
					 			 'modulo_usuarios'					=>	'',
					 			 'modulo_centros_educativos'		=>	'',
					 			 'modulo_consultas_estadisticas'	=>	'',
					 			 'modulo_mapa_estadistico'			=>	'');
		$listado_modulos[$modulo] = 'active';
		return $listado_modulos;
	}
}

/* Devuelve el titulo de la consulta estadística */
if(!function_exists('listado_estadisticas')){
	function listado_estadisticas($estadistica){
		$nombres_estadisticas = array(1 => 'Usuarios por Modalidad de Capacitaci&oacute;n',
									  2 => 'Usuarios por Departamento y Rango de Fechas',
									  3 => 'Total de Usuarios por Departamento y Rango de Fechas',
									  4 => 'Usuarios por Departamento, Municipio y Rango de Fechas',
									  5 => 'Usuarios por Tipo de Capacitados y Fecha a Nivel Nacional',
									  6 => 'Usuarios por Tipo de Capacitados, Departamento y Fecha',
									  7 => 'Usuarios por Tipo de Capacitados, Departamento y Municipio',
									  8 => 'Usuarios por Departamento, Tipo de Capacitados y Fecha',
									  9 => 'Usuarios por Tipo de Capacitados y Centro Educativo',
									  10 => 'Usuarios a Nivel Nacional',
									  11 => 'Usuarios por Grado Digital');
		return $nombres_estadisticas[$estadistica];
	}
}

/* Devuelve un ícono de notificación de: información, alerta o error */
if(!function_exists('icono_notificacion')){
	function icono_notificacion($notificacion){
		$iconos = array('informacion' => '<span style="color: #428bca;"><i class="fa fa-info-circle"></i></span> ',
						'alerta' => '<span style="color: #f0ad4e;"><i class="fa fa-exclamation-triangle"></i></span> ',
						'error' => '<span style="color: #d9534f;"><i class="fa fa-times-circle"></i></span> ');
		return $iconos[$notificacion];
	}
}

/* Devuelve el encabezado de los reportes */
if(!function_exists('encabezado_reporte')){
	function encabezado_reporte(){
		$html = '<table align="center" border="0" width="100%">
				<tr>
					<td align="center">'.img(array('src' => 'resources/img/escudo-nacional-de-el-salvador.jpg', 'height' => '100px')).'</td>
					<td align="center">
						<b>
						MINISTERIO DE EDUCACIÓN<br/>
						VICEMINISTERIO DE CIENCIA Y TECNOLOGÍA<br/>
						DIRECCIÓN NACIONAL DE EDUCACIÓN EN CIENCIA, TECNOLOGÍA E INNOVACIÓN<br/>
						GERENCIA DE TECNOLOGÍAS EDUCATIVAS<br/>
						ÁREA DE FORMACIÓN VIRTUAL
						</b>
					</td>
					<td align="center">'.img(array('src' => 'resources/img/logo-mined.jpg', 'height' => '100px')).'</td>
				</tr>
			</table>';
		return $html;
	}
}

/* Devuelve 0 si un valor es NULL */
if(!function_exists('limpiar_nulo')){
	function limpiar_nulo($valor){
		return is_null($valor) ? 0 : $valor;
	}
}

/* Verifica si una consulta estadistica tiene valores nulos */
if(!function_exists('estadistica_vacia')){
	function estadistica_vacia($estadistica){
		$nulos = 0; $valores = 0;
		foreach(objeto_a_vector($estadistica) as $indice => $valor){
			if(is_array($valor)){
				foreach($valor as $i => $j){
					$nulos = !is_string($j) && is_null($j) ? $nulos + 1 : $nulos;
					$valores = !is_string($j) || is_numeric($j) ? $valores + 1 : $valores;
				}
			}
			else{
				$nulos = !is_string($valor) && is_null($valor) ? $nulos + 1 : $nulos;
				$valores = !is_string($valor) || is_numeric($valor) ? $valores + 1 : $valores;
			}
		}
		return $nulos == $valores ? TRUE : FALSE;
	}
}

/* Convierte un Object a Array */
if(!function_exists('objeto_a_vector')){
	function objeto_a_vector($datos){
		if(is_object($datos)){
			$datos = get_object_vars($datos);
		}
		if(is_array($datos)){
			return array_map(__FUNCTION__, $datos);
		}
		else{
			return $datos;
		}
	}
}

/* Genera el ancla de la ayuda dependiento en que lugar de SYSCAP se encuentre el usuario */
if(!function_exists('uri_ayuda')){
	function uri_ayuda($uri){
		$uri_ayuda = '';
		$limite_inicial = stripos($uri, '/');
		$limite_final = strripos($uri, '/');
		$diferencia = $limite_final - $limite_inicial - 1;
		if($diferencia > 0){
			switch(substr($uri, 0, $limite_inicial)){
				case 'usuarios':
				case 'centros_educativos':
					$uri_ayuda = str_replace('/', '-', substr($uri, 0, $limite_final));
					break;
				case 'estadisticas':
					$uri_ayuda = str_replace('/', '-', $uri);
					break;
				case 'mapa':
					$uri_ayuda = substr($uri, 0, $limite_inicial).'-'.(strpos($uri, 'departamento') ? 'departamento' : (strpos($uri, 'municipio') ? 'municipio' : ''));
					break;
			}
		}
		else{
			$uri_ayuda = $uri;
		}
		return '#'.$uri_ayuda;
	}
}

/* Devuelve el HTML de los mensajes de notificación */
if(!function_exists('mensaje_notificacion')){
	function mensaje_notificacion($identificador, $titulo, $mensaje){
		return '<div class="row">
					<div class="col-lg-12">
						<div class="modal fade" id="'.$identificador.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title" id="myModalLabel">'.$titulo.'</h4>
									</div>
									<div class="modal-body">'.$mensaje.'</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>';
	}
}

/* End of file funciones_helper.php */
/* Location: ./application/helpers/funciones_helper.php */