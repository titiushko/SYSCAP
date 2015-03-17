<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Estadisticas_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	// Consulta Estadística 1: Usuarios por Modalidad de Capacitación
	function modalidades_capacitados($fecha1, $fecha2, $tipo_capacitado = ''){
		if($tipo_capacitado != ''){
			$filtro = ' AND tipo_capacitado = ?';
			$parametros = array($fecha1, $fecha2, $tipo_capacitado, $fecha1, $fecha2, $tipo_capacitado, $fecha1, $fecha2, $tipo_capacitado);
		}
		else{
			$filtro = '';
			$parametros = array($fecha1, $fecha2, $fecha1, $fecha2, $fecha1, $fecha2);
		}
		$query = $this->db->query('SELECT \'Capacitados\' tipos_capacitados,
								   SUM(CASE WHEN modalidad_usuario = \'tutorizado\' THEN 1 ELSE 0 END) tutorizados,
								   SUM(CASE WHEN modalidad_usuario = \'autoformacion\' THEN 1 ELSE 0 END) autoformacion
								   FROM V_Estadisticas
								   WHERE nota_examen_calificacion >= 7.00 AND nombre_examen LIKE \'Evaluaci%\' AND fecha_examen_calificacion BETWEEN ? AND ?'.$filtro.'
								   UNION
								   SELECT \'Certificados\' tipos_capacitados,
								   SUM(CASE WHEN modalidad_usuario = \'tutorizado\' THEN 1 ELSE 0 END) tutorizados,
								   SUM(CASE WHEN modalidad_usuario = \'autoformacion\' THEN 1 ELSE 0 END) autoformacion
								   FROM V_Estadisticas
								   WHERE nota_examen_calificacion >= 7.00 AND nombre_examen LIKE \'Examen%\' AND fecha_examen_calificacion BETWEEN ? AND ?'.$filtro.'
								   UNION
								   SELECT \'Total\' tipos_capacitados,
								   SUM(CASE WHEN modalidad_usuario = \'tutorizado\' THEN 1 ELSE 0 END) tutorizados,
								   SUM(CASE WHEN modalidad_usuario = \'autoformacion\' THEN 1 ELSE 0 END) autoformacion
								   FROM V_Estadisticas
								   WHERE nota_examen_calificacion >= 7.00 AND fecha_examen_calificacion BETWEEN ? AND ?'.$filtro, $parametros);
		return $query->result();
	}
	
	// Consulta Estadística 2: Usuarios por Departamento y Rango de Fechas
	function cantidad_usuarios_municipio($codigo_departamento, $fecha1, $fecha2){
		$query = $this->db->query('SELECT DISTINCT nombre_municipio,
								   SUM(CASE WHEN tipo_capacitado LIKE \'capacitado\' THEN 1 ELSE 0 END) capacitados,
								   SUM(CASE WHEN tipo_capacitado LIKE \'certificado\' THEN 1 ELSE 0 END) certificados
								   FROM V_Estadisticas
								   WHERE nota_examen_calificacion >= 7.00 AND id_departamento = ? AND fecha_examen_calificacion BETWEEN ? AND ?
								   GROUP BY nombre_municipio
								   UNION
								   SELECT DISTINCT \'Total\' nombre_municipio,
								   SUM(CASE WHEN tipo_capacitado LIKE \'capacitado\' THEN 1 ELSE 0 END) capacitados,
								   SUM(CASE WHEN tipo_capacitado LIKE \'certificado\' THEN 1 ELSE 0 END) certificados
								   FROM V_Estadisticas
								   WHERE nota_examen_calificacion >= 7.00 AND id_departamento = ? AND fecha_examen_calificacion BETWEEN ? AND ?',
								   array($codigo_departamento, $fecha1, $fecha2, $codigo_departamento, $fecha1, $fecha2));
		return $query->result();
	}
	
	// Consulta Estadística 2: Usuarios por Departamento y Rango de Fechas
	function usuarios_municipio($codigo_departamento, $fecha1, $fecha2){
		$query = $this->db->query('SELECT nombre_municipio, nombre_usuario, initcap(modalidad_usuario) modalidad_usuario
								   FROM V_Estadisticas
								   WHERE nota_examen_calificacion >= 7.00 AND id_departamento = ? AND fecha_examen_calificacion BETWEEN ? AND ?
								   ORDER BY nombre_municipio', array($codigo_departamento, $fecha1, $fecha2));
		return $query->result();
	}
	
	// Consulta Estadística 4: Usuarios por Departamento, Municipio y Rango de Fechas
	// Consulta Estadística 7: Usuarios por Tipo de Capacitados, Departamento y Municipio
	function usuarios_departamento_municipio($codigo_departamento, $codigo_municipio, $fecha1, $fecha2, $tipo_capacitado = ''){
		if($tipo_capacitado != ''){
			$filtro = ' AND tipo_capacitado = ?';
			$parametros = array($codigo_departamento, $codigo_municipio, $fecha1, $fecha2, $tipo_capacitado, $codigo_departamento, $codigo_municipio, $fecha1, $fecha2, $tipo_capacitado);
		}
		else{
			$filtro = '';
			$parametros = array($codigo_departamento, $codigo_municipio, $fecha1, $fecha2, $codigo_departamento, $codigo_municipio, $fecha1, $fecha2);
		}
		$query = $this->db->query('SELECT nombre_centro_educativo,
								   SUM(CASE WHEN tipo_capacitado LIKE \'capacitado\' THEN 1 ELSE 0 END) capacitados,
								   SUM(CASE WHEN tipo_capacitado LIKE \'certificado\' THEN 1 ELSE 0 END) certificados
								   FROM V_Estadisticas
								   WHERE nota_examen_calificacion >= 7.00 AND id_departamento = ? AND id_municipio = ?
								   AND fecha_examen_calificacion BETWEEN ? AND ?'.$filtro.'
								   GROUP BY nombre_centro_educativo
								   UNION
								   SELECT \'Total\' nombre_centro_educativo,
								   SUM(CASE WHEN tipo_capacitado LIKE \'capacitado\' THEN 1 ELSE 0 END) capacitados,
								   SUM(CASE WHEN tipo_capacitado LIKE \'certificado\' THEN 1 ELSE 0 END) certificados
								   FROM V_Estadisticas
								   WHERE nota_examen_calificacion >= 7.00 AND id_departamento = ? AND id_municipio = ?
								   AND fecha_examen_calificacion BETWEEN ? AND ?'.$filtro, $parametros);
		return $query->result();
	}
	
	// Consulta Estadística 4: Usuarios por Departamento, Municipio y Rango de Fechas
	// Consulta Estadística 7: Usuarios por Tipo de Capacitados, Departamento y Municipio
	function usuarios_centro_educativo($codigo_departamento, $codigo_municipio, $fecha1, $fecha2, $tipo_capacitado = ''){
		if($tipo_capacitado != ''){
			$filtro = ' AND tipo_capacitado = ?';
			$parametros = array($codigo_departamento, $codigo_municipio, $fecha1, $fecha2, $tipo_capacitado);
		}
		else{
			$filtro = '';
			$parametros = array($codigo_departamento, $codigo_municipio, $fecha1, $fecha2);
		}
		$query = $this->db->query('SELECT nombre_centro_educativo, nombre_usuario, tipo_capacitado, initcap(modalidad_usuario) modalidad_usuario
								   FROM V_Estadisticas
								   WHERE nota_examen_calificacion >= 7.00 AND id_departamento = ? AND id_municipio = ?
								   AND fecha_examen_calificacion BETWEEN ? AND ?'.$filtro, $parametros);
		return $query->result();
	}
	
	// Consulta Estadística 3: Total de Usuarios por Departamento y Rango de Fechas
	// Consulta Estadística 8: Usuarios por Departamento, Tipo de Capacitados y Fecha
	function estaditicas_departamento_fechas($fecha1, $fecha2, $tipo_capacitado = ''){
		if($tipo_capacitado != ''){
			$filtro = ' AND tipo_capacitado = ?';
			$parametros = array($fecha1, $fecha2, $tipo_capacitado, $fecha1, $fecha2, $tipo_capacitado);
		}
		else{
			$filtro = '';
			$parametros = array($fecha1, $fecha2, $fecha1, $fecha2);
		}
		$query = $this->db->query('SELECT (CASE WHEN nombre_departamento IS NULL THEN \'Sin Departamento *\' ELSE nombre_departamento END) nombre_departamento,
								   SUM(CASE WHEN tipo_capacitado LIKE \'capacitado\' THEN 1 ELSE 0 END) capacitados,
								   SUM(CASE WHEN tipo_capacitado LIKE \'certificado\' THEN 1 ELSE 0 END) certificados
								   FROM V_Estadisticas
								   WHERE nota_examen_calificacion >= 7.00 AND fecha_examen_calificacion BETWEEN ? AND ?'.$filtro.'
								   GROUP BY nombre_departamento
								   UNION
								   SELECT \'Total\' nombre_departamento,
								   SUM(CASE WHEN tipo_capacitado LIKE \'capacitado\' THEN 1 ELSE 0 END) capacitados,
								   SUM(CASE WHEN tipo_capacitado LIKE \'certificado\' THEN 1 ELSE 0 END) certificados
								   FROM V_Estadisticas
								   WHERE nota_examen_calificacion >= 7.00 AND fecha_examen_calificacion BETWEEN ? AND ?'.$filtro, $parametros);
		return $query->result();
	}
    
	// Consulta Estadística 6: Usuarios por Tipo de Capacitados, Departamento y Fecha
    function estaditicas_departamento_tipo_fechas($tipo_capacitado, $codigo_departamento, $fecha1, $fecha2){
		$query = $this->db->query('SELECT DISTINCT nombre_municipio,
								   SUM(CASE WHEN modalidad_usuario = \'tutorizado\' THEN 1 ELSE 0 END) tutorizado,
								   SUM(CASE WHEN modalidad_usuario = \'autoformacion\' THEN 1 ELSE 0 END) autoformacion
								   FROM V_Estadisticas
								   WHERE nota_examen_calificacion >= 7.00 AND tipo_capacitado = ? AND id_departamento = ?
								   AND fecha_examen_calificacion BETWEEN ? AND ?
								   GROUP BY nombre_municipio
								   UNION
								   SELECT DISTINCT \'Total\' nombre_municipio,
								   SUM(CASE WHEN modalidad_usuario = \'tutorizado\' THEN 1 ELSE 0 END) tutorizado,
								   SUM(CASE WHEN modalidad_usuario = \'autoformacion\' THEN 1 ELSE 0 END) autoformacion
								   FROM V_Estadisticas
								   WHERE nota_examen_calificacion >= 7.00 AND tipo_capacitado = ? AND id_departamento = ?
								   AND fecha_examen_calificacion BETWEEN ? AND ?',
								   array($tipo_capacitado, $codigo_departamento, $fecha1, $fecha2, $tipo_capacitado, $codigo_departamento, $fecha1, $fecha2));
		return $query->result();
	}
	
	// Consulta Estadística 9: Usuarios por Tipo de Capacitados y Centro Educativo
	function tipos_capacitados_centro_educativo($tipo_capacitado, $codigo_centro_educativo){
		$query = $this->db->query('SELECT \'Tutorizado\' modalidad_usuario, SUM(CASE WHEN modalidad_usuario = \'tutorizado\' THEN 1 ELSE 0 END) total
								   FROM V_Estadisticas
								   WHERE nota_examen_calificacion >= 7.00 AND tipo_capacitado = ? AND id_centro_educativo = ?
								   UNION
								   SELECT \'Autoformación\' modalidad_usuario, SUM(CASE WHEN modalidad_usuario = \'autoformacion\' THEN 1 ELSE 0 END) total
								   FROM V_Estadisticas
								   WHERE nota_examen_calificacion >= 7.00 AND tipo_capacitado = ? AND id_centro_educativo = ?
								   UNION
								   SELECT \'Total\' modalidad_usuario, SUM(CASE WHEN modalidad_usuario = \'tutorizado\' THEN 1 ELSE 0 END) + SUM(CASE WHEN modalidad_usuario = \'autoformacion\' THEN 1 ELSE 0 END) total
								   FROM V_Estadisticas
								   WHERE nota_examen_calificacion >= 7.00 AND tipo_capacitado = ? AND id_centro_educativo = ?',
								   array($tipo_capacitado, $codigo_centro_educativo, $tipo_capacitado, $codigo_centro_educativo, $tipo_capacitado, $codigo_centro_educativo));
		return $query->result();
	}
	
	// Consulta Estadística 10: Usuarios a Nivel Nacional
	function usuarios_nivel_nacional($tipo_capacitado, $fecha1, $fecha2){
		$query = $this->db->query('SELECT (CASE WHEN nombre_departamento IS NULL THEN \'Sin Departamento *\' ELSE nombre_departamento END) nombre_departamento, (CASE WHEN nombre_municipio IS NULL THEN \'Sin Municipio **\' ELSE nombre_municipio END) nombre_municipio,
								   SUM(CASE WHEN modalidad_usuario = \'tutorizado\' THEN 1 ELSE 0 END) tutorizado,
								   SUM(CASE WHEN modalidad_usuario = \'autoformacion\' THEN 1 ELSE 0 END) autoformacion
								   FROM V_Estadisticas
								   WHERE nota_examen_calificacion >= 7.00 AND tipo_capacitado = ? AND fecha_examen_calificacion BETWEEN ? AND ?
								   GROUP BY nombre_departamento, nombre_municipio
								   UNION
								   SELECT NULL nombre_departamento, \'Total\' nombre_municipio,
								   SUM(CASE WHEN modalidad_usuario = \'tutorizado\' THEN 1 ELSE 0 END) tutorizado,
								   SUM(CASE WHEN modalidad_usuario = \'autoformacion\' THEN 1 ELSE 0 END) autoformacion
								   FROM V_Estadisticas
								   WHERE nota_examen_calificacion >= 7.00 AND tipo_capacitado = ? AND fecha_examen_calificacion BETWEEN ? AND ?',
								   array($tipo_capacitado, $fecha1, $fecha2, $tipo_capacitado, $fecha1, $fecha2));
		return $query->result();
	}
	// Consulta Estadística 11: Usuarios por Grado Digital
	function usuarios_grado_digital($grado_digital, $fecha1, $fecha2){
		$query = $this->db->query('SELECT IF(tipo_capacitado IS NULL, \'Capacitados\', tipo_capacitado) tipo_capacitado,
								   SUM(CASE WHEN modalidad_usuario = \'tutorizado\' THEN 1 ELSE 0 END) tutorizados,
								   SUM(CASE WHEN modalidad_usuario = \'autoformacion\' THEN 1 ELSE 0 END) autoformacion
								   FROM V_EstadisticasGradoDigital
								   WHERE tipo_capacitado = \'Capacitados\' AND grado_digital = ? AND fecha_examen_calificacion BETWEEN ? AND ?
								   UNION
								   SELECT IF(tipo_capacitado IS NULL, \'Certificados\', tipo_capacitado) tipo_capacitado,
								   SUM(CASE WHEN modalidad_usuario = \'tutorizado\' THEN 1 ELSE 0 END) tutorizados,
								   SUM(CASE WHEN modalidad_usuario = \'autoformacion\' THEN 1 ELSE 0 END) autoformacion
								   FROM V_EstadisticasGradoDigital
								   WHERE tipo_capacitado = \'Certificados\' AND grado_digital = ? AND fecha_examen_calificacion BETWEEN ? AND ?
								   UNION
								   SELECT \'Total\' tipo_capacitado,
								   SUM(CASE WHEN modalidad_usuario = \'tutorizado\' THEN 1 ELSE 0 END) tutorizados,
								   SUM(CASE WHEN modalidad_usuario = \'autoformacion\' THEN 1 ELSE 0 END) autoformacion
								   FROM V_EstadisticasGradoDigital
								   WHERE grado_digital = ? AND fecha_examen_calificacion BETWEEN ? AND ?',
								   array($grado_digital, $fecha1, $fecha2, $grado_digital, $fecha1, $fecha2, $grado_digital, $fecha1, $fecha2));
		return $query->result();
	}
	
	function certificaciones_grado_digital($grado_digital, $fecha1, $fecha2){
		$query = $this->db->query('SELECT nombre_curso_categoria, nombre_completo_curso,
								   SUM(CASE WHEN modalidad_usuario = \'tutorizado\' THEN 1 ELSE 0 END) tutorizados,
								   SUM(CASE WHEN modalidad_usuario = \'autoformacion\' THEN 1 ELSE 0 END) autoformacion
								   FROM V_EstadisticasGradoDigital
								   WHERE tipo_capacitado = \'Capacitados\' AND grado_digital = ? AND fecha_examen_calificacion BETWEEN ? AND ?
								   GROUP BY 1, 2
								   UNION
								   SELECT SUBSTRING(nombre_curso_categoria, 18), nombre_completo_curso,
								   SUM(CASE WHEN modalidad_usuario = \'tutorizado\' THEN 1 ELSE 0 END) tutorizados,
								   SUM(CASE WHEN modalidad_usuario = \'autoformacion\' THEN 1 ELSE 0 END) autoformacion
								   FROM V_EstadisticasGradoDigital
								   WHERE tipo_capacitado = \'Certificados\' AND grado_digital = ? AND fecha_examen_calificacion BETWEEN ? AND ?
								   GROUP BY 1, 2
								   UNION
								   SELECT \'Total\' nombre_curso_categoria, \'Total\' nombre_completo_curso,
								   SUM(CASE WHEN modalidad_usuario = \'tutorizado\' THEN 1 ELSE 0 END) tutorizados,
								   SUM(CASE WHEN modalidad_usuario = \'autoformacion\' THEN 1 ELSE 0 END) autoformacion
								   FROM V_EstadisticasGradoDigital
								   WHERE grado_digital = ? AND fecha_examen_calificacion BETWEEN ? AND ?',
								   array($grado_digital, $fecha1, $fecha2, $grado_digital, $fecha1, $fecha2, $grado_digital, $fecha1, $fecha2));
		return $query->result();
	}
}

/* End of file estadisticas_model.php */
/* Location: ./application/models/estadisticas_model.php */