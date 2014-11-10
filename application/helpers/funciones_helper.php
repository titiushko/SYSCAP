<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!function_exists('invierte_date_time')){	
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

/* End of file funciones_helper.php */
/* Location: ./application/helpers/funciones_helper.php */