<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
		return 'Estad&iacute;stica de '.$nombres_estadisticas[$estadistica];
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

/* End of file funciones_helper.php */
/* Location: ./application/helpers/funciones_helper.php */