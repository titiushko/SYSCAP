<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Convierte todos los caracteres aplicables a entidades HTML. */
if(!function_exists('utf8')){
	function utf8($cadena){
		return htmlentities($cadena, ENT_COMPAT, 'UTF-8');
	}
}

/* Convierte todos los caracteres aplicables a entidades HTML. */
if(!function_exists('formato_dui')){
	function formato_dui($dui){
		return preg_match('/^\d{8}-\d$/', $dui) ? $dui : substr($dui, 0, 7).'-'.substr($dui, 8, 1);
	}
}

/* Elimina caracteres especiales. */
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

if(!function_exists('icono_notificacion')){
	function icono_notificacion($notificacion){
		$iconos = array('informacion' => '<span style="color: #428bca;"><i class="fa fa-info-circle"></i></span> ',
						'alerta' => '<span style="color: #f0ad4e;"><i class="fa fa-exclamation-triangle"></i></span> ',
						'error' => '<span style="color: #d9534f;"><i class="fa fa-times-circle"></i></span> ');
		return $iconos[$notificacion];
	}
}

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

/* End of file funciones_helper.php */
/* Location: ./application/helpers/funciones_helper.php */