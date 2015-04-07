<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Resumen_estadistico_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	private function _consultas(
		$codigo_departamento,
		$codigo_municipio,
		$codigo_centro_educativo,
		$tipo_capacitado,
		$modalidad_usuario,
		$grado_digital,
		$fecha1, $fecha2,
		$sexo_usuario,
		$busqueda,
		$consulta
	){
		$codigo_departamento = $codigo_departamento != '' ? $codigo_departamento : '%';
		$codigo_municipio = $codigo_municipio != '' ? $codigo_municipio : '%';
		$codigo_centro_educativo = $codigo_centro_educativo != '' ? $codigo_centro_educativo : '%';
		$tipo_capacitado = $tipo_capacitado != '' ? $tipo_capacitado : '%';
		$modalidad_usuario = $modalidad_usuario != '' ? $modalidad_usuario : '%';
		$grado_digital = $grado_digital != '' ? $grado_digital : '%';
		$sexo_usuario = $sexo_usuario != '' ? $sexo_usuario : '%';
		if($busqueda == 'sexo_usuario'){
			$campo1 = 'IF(sexo_usuario = \'H\', \'Hombre\', IF(sexo_usuario = \'M\', \'Mujer\', \'Nulo\'))';
		}
		elseif($busqueda == 'grado_digital'){
			$campo1 = 'IF(grado_digital IS NOT NULL, grado_digital, \'Nulo\')';
		}
		else{
			$campo1 = 'initcap('.$busqueda.')';
		}
		if($fecha1 != '' && $fecha2 != ''){
			$filtro1 = 'AND fecha_examen_calificacion BETWEEN ? AND ?';
			$parametros = array(
				$codigo_departamento,
				$codigo_municipio,
				$codigo_centro_educativo,
				$tipo_capacitado,
				$modalidad_usuario,
				$grado_digital,
				$fecha1, $fecha2,
				$sexo_usuario,
				$codigo_departamento,
				$codigo_municipio,
				$codigo_centro_educativo,
				$tipo_capacitado,
				$modalidad_usuario,
				$grado_digital,
				$fecha1, $fecha2,
				$sexo_usuario
			);
		}
		elseif($fecha1 != '' && $fecha2 == ''){
			$filtro1 = 'AND fecha_examen_calificacion >= ?';
			$parametros = array(
				$codigo_departamento,
				$codigo_municipio,
				$codigo_centro_educativo,
				$tipo_capacitado,
				$modalidad_usuario,
				$grado_digital,
				$fecha1,
				$sexo_usuario,
				$codigo_departamento,
				$codigo_municipio,
				$codigo_centro_educativo,
				$tipo_capacitado,
				$modalidad_usuario,
				$grado_digital,
				$fecha1,
				$sexo_usuario
			);
		}
		elseif($fecha1 == '' && $fecha2 != ''){
			$filtro1 = 'AND fecha_examen_calificacion <= ?';
			$parametros = array(
				$codigo_departamento,
				$codigo_municipio,
				$codigo_centro_educativo,
				$tipo_capacitado,
				$modalidad_usuario,
				$grado_digital,
				$fecha2,
				$sexo_usuario,
				$codigo_departamento,
				$codigo_municipio,
				$codigo_centro_educativo,
				$tipo_capacitado,
				$modalidad_usuario,
				$grado_digital,
				$fecha2,
				$sexo_usuario
			);
		}
		else{
			$filtro1 = '';
			$parametros = array(
				$codigo_departamento,
				$codigo_municipio,
				$codigo_centro_educativo,
				$tipo_capacitado,
				$modalidad_usuario,
				$grado_digital,
				$sexo_usuario,
				$codigo_departamento,
				$codigo_municipio,
				$codigo_centro_educativo,
				$tipo_capacitado,
				$modalidad_usuario,
				$grado_digital,
				$sexo_usuario
			);
		}
		switch($consulta){
			case 1:
				$campo2 = '
					SUM(CASE WHEN tipo_capacitado LIKE \'capacitado\' THEN 1 ELSE 0 END) capacitados,
					SUM(CASE WHEN tipo_capacitado LIKE \'certificado\' THEN 1 ELSE 0 END) certificados,
					SUM(CASE WHEN tipo_capacitado LIKE \'capacitado\' OR tipo_capacitado LIKE \'certificado\' THEN 1 ELSE 0 END) total';
				break;
			case 2:
				$campo2 = '
					SUM(CASE WHEN modalidad_usuario LIKE \'tutorizado\' THEN 1 ELSE 0 END) tutorizados,
					SUM(CASE WHEN modalidad_usuario LIKE \'autoformacion\' THEN 1 ELSE 0 END) autoformacion,
					SUM(CASE WHEN modalidad_usuario LIKE \'tutorizado\' OR modalidad_usuario LIKE \'autoformacion\' THEN 1 ELSE 0 END) total';
				break;
			case 3:
				$campo2 = '
					SUM(CASE WHEN grado_digital LIKE \'1\' THEN 1 ELSE 0 END) uno,
					SUM(CASE WHEN grado_digital LIKE \'2\' THEN 1 ELSE 0 END) dos,
					SUM(CASE WHEN grado_digital LIKE \'3\' THEN 1 ELSE 0 END) tres,
					SUM(CASE WHEN grado_digital LIKE \'4\' THEN 1 ELSE 0 END) cuatro,
					SUM(CASE WHEN grado_digital LIKE \'1\' OR grado_digital LIKE \'2\' OR grado_digital LIKE \'3\' OR grado_digital LIKE \'4\' THEN 1 ELSE 0 END) total';
				break;
			case 4:
				$campo2 = '
					SUM(CASE WHEN sexo_usuario LIKE \'H\' THEN 1 ELSE 0 END) hombres,
					SUM(CASE WHEN sexo_usuario LIKE \'M\' THEN 1 ELSE 0 END) mujeres,
					SUM(CASE WHEN sexo_usuario LIKE \'H\' OR sexo_usuario LIKE \'M\' THEN 1 ELSE 0 END) total';
				break;
		}
		$query = $this->db->query('
			SELECT DISTINCT '.$campo1.' nombre_campo, '.$campo2.'
			FROM V_Estadisticas
			WHERE id_departamento LIKE ? AND id_municipio LIKE ? AND id_centro_educativo LIKE ?
			AND tipo_capacitado LIKE ? AND modalidad_usuario LIKE ?
			AND grado_digital LIKE ? '.$filtro1.' AND sexo_usuario LIKE ?
			GROUP BY nombre_campo
			UNION
			SELECT DISTINCT \'Total\' nombre_campo, '.$campo2.'
			FROM V_Estadisticas
			WHERE id_departamento LIKE ? AND id_municipio LIKE ? AND id_centro_educativo LIKE ?
			AND tipo_capacitado LIKE ? AND modalidad_usuario LIKE ?
			AND grado_digital LIKE ? '.$filtro1.' AND sexo_usuario LIKE ?',
		$parametros);
		return $query->result();
	}
	
	function tipo_capacitado_x_busqueda(
		$codigo_departamento,
		$codigo_municipio,
		$codigo_centro_educativo,
		$tipo_capacitado,
		$modalidad_usuario,
		$grado_digital,
		$fecha1, $fecha2,
		$sexo_usuario,
		$busqueda
	){
		return $this->_consultas(
			$codigo_departamento,
			$codigo_municipio,
			$codigo_centro_educativo,
			$tipo_capacitado,
			$modalidad_usuario,
			$grado_digital,
			$fecha1, $fecha2,
			$sexo_usuario,
			$busqueda,
			1
		);
	}
	
	function modalidad_usuario_x_busqueda(
		$codigo_departamento,
		$codigo_municipio,
		$codigo_centro_educativo,
		$tipo_capacitado,
		$modalidad_usuario,
		$grado_digital,
		$fecha1, $fecha2,
		$sexo_usuario,
		$busqueda
	){
		return $this->_consultas(
			$codigo_departamento,
			$codigo_municipio,
			$codigo_centro_educativo,
			$tipo_capacitado,
			$modalidad_usuario,
			$grado_digital,
			$fecha1, $fecha2,
			$sexo_usuario,
			$busqueda,
			2
		);
	}
	
	function grado_digital_x_busqueda(
		$codigo_departamento,
		$codigo_municipio,
		$codigo_centro_educativo,
		$tipo_capacitado,
		$modalidad_usuario,
		$grado_digital,
		$fecha1, $fecha2,
		$sexo_usuario,
		$busqueda
	){
		return $this->_consultas(
			$codigo_departamento,
			$codigo_municipio,
			$codigo_centro_educativo,
			$tipo_capacitado,
			$modalidad_usuario,
			$grado_digital,
			$fecha1, $fecha2,
			$sexo_usuario,
			$busqueda,
			3
		);
	}
	
	function sexo_usuario_x_busqueda(
		$codigo_departamento,
		$codigo_municipio,
		$codigo_centro_educativo,
		$tipo_capacitado,
		$modalidad_usuario,
		$grado_digital,
		$fecha1, $fecha2,
		$sexo_usuario,
		$busqueda
	){
		return $this->_consultas(
			$codigo_departamento,
			$codigo_municipio,
			$codigo_centro_educativo,
			$tipo_capacitado,
			$modalidad_usuario,
			$grado_digital,
			$fecha1, $fecha2,
			$sexo_usuario,
			$busqueda,
			4
		);
	}
}

/* End of file resumen_estadistico_model.php */
/* Location: ./application/models/resumen_estadistico_model.php */