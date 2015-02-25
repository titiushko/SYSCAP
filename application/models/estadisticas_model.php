<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Estadisticas_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	// Consulta Estadística 1: Usuarios por Modalidad de Capacitación
	function modalidades_capacitados($fecha1, $fecha2){
		$query = $this->db->query('SELECT \'Capacitados\' tipos_capacitados,
								   SUM(CASE WHEN modalidad_usuario = \'tutorizado\' THEN 1 ELSE 0 END) tutorizados,
								   SUM(CASE WHEN modalidad_usuario = \'autoformacion\' THEN 1 ELSE 0 END) autoformacion
								   FROM V_EstadisticaModalidad
								   WHERE nota_examen_calificacion >= 7.00 AND nombre_examen LIKE \'Evaluaci%\' AND fecha_examen_calificacion BETWEEN ? AND ?
								   UNION
								   SELECT \'Certificados\' tipos_capacitados,
								   SUM(CASE WHEN modalidad_usuario = \'tutorizado\' THEN 1 ELSE 0 END) tutorizados,
								   SUM(CASE WHEN modalidad_usuario = \'autoformacion\' THEN 1 ELSE 0 END) autoformacion
								   FROM V_EstadisticaModalidad
								   WHERE nota_examen_calificacion >= 7.00 AND nombre_examen LIKE \'Examen%\' AND fecha_examen_calificacion BETWEEN ? AND ?
								   UNION
								   SELECT \'TOTAL\' tipos_capacitados,
								   SUM(CASE WHEN modalidad_usuario = \'tutorizado\' THEN 1 ELSE 0 END) tutorizados,
								   SUM(CASE WHEN modalidad_usuario = \'autoformacion\' THEN 1 ELSE 0 END) autoformacion
								   FROM V_EstadisticaModalidad
								   WHERE nota_examen_calificacion >= 7.00 AND fecha_examen_calificacion BETWEEN ? AND ?',
								   array($fecha1, $fecha2, $fecha1, $fecha2, $fecha1, $fecha2));
		return $query->result();
	}
	
	// Consulta Estadística 2: Usuarios por Departamento y Rango de Fechas
	function cantidad_usuarios_municipio($codigo_departamento, $fecha1, $fecha2){
		$query = $this->db->query('SELECT DISTINCT acentos(nombre_municipio) nombre_municipio,
								   SUM(CASE WHEN tipo_capacitado LIKE \'capacitado\' THEN 1 ELSE 0 END) capacitados,
								   SUM(CASE WHEN tipo_capacitado LIKE \'certificado\' THEN 1 ELSE 0 END) certificados
								   FROM V_EstadisticaDepartamentoFecha
								   WHERE nota_examen_calificacion >= 7.00 AND id_departamento = ? AND fecha_examen_calificacion BETWEEN ? AND ?
								   GROUP BY nombre_municipio
								   UNION
								   SELECT DISTINCT \'TOTAL\' nombre_municipio,
								   SUM(CASE WHEN tipo_capacitado LIKE \'capacitado\' THEN 1 ELSE 0 END) capacitados,
								   SUM(CASE WHEN tipo_capacitado LIKE \'certificado\' THEN 1 ELSE 0 END) certificados
								   FROM V_EstadisticaDepartamentoFecha
								   WHERE nota_examen_calificacion >= 7.00 AND id_departamento = ? AND fecha_examen_calificacion BETWEEN ? AND ?',
								   array($codigo_departamento, $fecha1, $fecha2, $codigo_departamento, $fecha1, $fecha2));
		return $query->result();
	}
	
	// Consulta Estadística 2: Usuarios por Departamento y Rango de Fechas
	function usuarios_municipio($codigo_departamento, $fecha1, $fecha2){
		$query = $this->db->query('SELECT acentos(nombre_municipio) nombre_municipio, acentos(nombre_usuario) nombre_usuario, initcap(modalidad_usuario) modalidad_usuario
								   FROM V_EstadisticaDepartamentoFecha
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
		$query = $this->db->query('SELECT acentos(nombre_centro_educativo) nombre_centro_educativo,
								   SUM(CASE WHEN nombre_examen LIKE \'Evaluaci%\' THEN 1 ELSE 0 END) capacitados,
								   SUM(CASE WHEN nombre_examen LIKE \'Examen%\' THEN 1 ELSE 0 END) certificados
								   FROM V_EstadisticaDepartamentoFecha
								   WHERE nota_examen_calificacion >= 7.00 AND id_departamento = ? AND id_municipio = ?
								   AND fecha_examen_calificacion BETWEEN ? AND ?'.$filtro.'
								   GROUP BY nombre_centro_educativo
								   UNION
								   SELECT \'TOTAL\' nombre_centro_educativo,
								   SUM(CASE WHEN nombre_examen LIKE \'Evaluaci%\' THEN 1 ELSE 0 END) capacitados,
								   SUM(CASE WHEN nombre_examen LIKE \'Examen%\' THEN 1 ELSE 0 END) certificados
								   FROM V_EstadisticaDepartamentoFecha
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
		$query = $this->db->query('SELECT acentos(nombre_centro_educativo) nombre_centro_educativo, acentos(nombre_usuario) nombre_usuario, tipo_capacitado, initcap(modalidad_usuario) modalidad_usuario
								   FROM V_EstadisticaDepartamentoFecha
								   WHERE nota_examen_calificacion >= 7.00 AND id_departamento = ? AND id_municipio = ?
								   AND fecha_examen_calificacion BETWEEN ? AND ?'.$filtro, $parametros);
		return $query->result();
	}
	
	// Consulta Estadística 3: Total de Usuarios por Departamento y Rango de Fechas
	// Consulta Estadística 8: Usuarios por Departamento, Tipo de Capacitados y Fecha
	function estaditicas_departamento_fechas($fecha1, $fecha2, $tipo_capacitado = ''){
		if($tipo_capacitado != ''){
			$filtro = ' AND tipo_capacitado = ?';
			$parametros = array($fecha1, $fecha2, $tipo_capacitado);
		}
		else{
			$filtro = '';
			$parametros = array($fecha1, $fecha2);
		}
		$query = $this->db->query('SET @indice = 0');
		$query = $this->db->query('SELECT @indice := @indice + 1 indice, acentos(nombre_departamento) nombre_departamento,
								   SUM(CASE WHEN nombre_examen LIKE \'Evaluaci%\' THEN 1 ELSE 0 END) capacitados,
								   SUM(CASE WHEN nombre_examen LIKE \'Examen%\' THEN 1 ELSE 0 END) certificados
								   FROM V_EstadisticaDepartamentoFecha
								   WHERE nota_examen_calificacion >= 7.00 AND fecha_examen_calificacion BETWEEN ? AND ?'.$filtro.'
								   GROUP BY nombre_departamento
								   ORDER BY indice', $parametros);
		return $query->result();
	}
    
	// Consulta Estadística 6: Usuarios por Tipo de Capacitados, Departamento y Fecha
    function estaditicas_departamento_tipo_fechas($tipo_capacitado, $codigo_departamento, $fecha1, $fecha2){
		$query = $this->db->query('SELECT DISTINCT acentos(nombre_municipio) nombre_municipio,
								   SUM(CASE WHEN modalidad_usuario = \'tutorizado\' THEN 1 ELSE 0 END) tutorizado,
								   SUM(CASE WHEN modalidad_usuario = \'autoformacion\' THEN 1 ELSE 0 END) autoformacion
								   FROM V_EstadisticaDepartamentoFecha
								   WHERE nota_examen_calificacion >= 7.00 AND tipo_capacitado = ? AND id_departamento = ?
								   AND fecha_examen_calificacion BETWEEN ? AND ?
								   GROUP BY nombre_municipio
								   UNION
								   SELECT DISTINCT \'TOTAL\' nombre_municipio,
								   SUM(CASE WHEN modalidad_usuario = \'tutorizado\' THEN 1 ELSE 0 END) tutorizado,
								   SUM(CASE WHEN modalidad_usuario = \'autoformacion\' THEN 1 ELSE 0 END) autoformacion
								   FROM V_EstadisticaDepartamentoFecha
								   WHERE nota_examen_calificacion >= 7.00 AND tipo_capacitado = ? AND id_departamento = ?
								   AND fecha_examen_calificacion BETWEEN ? AND ?',
								   array($tipo_capacitado, $codigo_departamento, $fecha1, $fecha2, $tipo_capacitado, $codigo_departamento, $fecha1, $fecha2));
		return $query->result();
	}
	
	// Consulta Estadística 9: Usuarios por Tipo de Capacitados y Centro Educativo
	function tipos_capacitados_centro_educativo($tipo_capacitado, $codigo_centro_educativo){
		$query = $this->db->query('SELECT \'Tutorizado\' modalidad_capacitado, SUM(CASE WHEN modalidad_usuario = \'tutorizado\' THEN 1 ELSE 0 END) total
								   FROM V_EstadisticaDepartamentoFecha
								   WHERE nota_examen_calificacion >= 7.00 AND tipo_capacitado = ? AND id_centro_educativo = ?
								   UNION
								   SELECT \'Autoformación\' modalidad_capacitado, SUM(CASE WHEN modalidad_usuario = \'autoformacion\' THEN 1 ELSE 0 END) total
								   FROM V_EstadisticaDepartamentoFecha
								   WHERE nota_examen_calificacion >= 7.00 AND tipo_capacitado = ? AND id_centro_educativo = ?
								   UNION
								   SELECT \'TOTAL\' modalidad_capacitado, SUM(CASE WHEN modalidad_usuario = \'tutorizado\' THEN 1 ELSE 0 END) + SUM(CASE WHEN modalidad_usuario = \'autoformacion\' THEN 1 ELSE 0 END) total
								   FROM V_EstadisticaDepartamentoFecha
								   WHERE nota_examen_calificacion >= 7.00 AND tipo_capacitado = ? AND id_centro_educativo = ?',
								   array($tipo_capacitado, $codigo_centro_educativo, $tipo_capacitado, $codigo_centro_educativo, $tipo_capacitado, $codigo_centro_educativo));
		return $query->result();
	}
	
	// Consulta Estadística 10: Usuarios a Nivel Nacional
	function usuarios_nivel_nacional($tipo_capacitado, $fecha1, $fecha2){
		$query = $this->db->query('SELECT acentos(nombre_departamento) nombre_departamento, acentos(nombre_municipio) nombre_municipio,
								   SUM(CASE WHEN modalidad_usuario = \'tutorizado\' THEN 1 ELSE 0 END) tutorizado,
								   SUM(CASE WHEN modalidad_usuario = \'autoformacion\' THEN 1 ELSE 0 END) autoformacion
								   FROM V_EstadisticaDepartamentoFecha
								   WHERE nota_examen_calificacion >= 7.00 AND tipo_capacitado = ? AND fecha_examen_calificacion BETWEEN ? AND ?
								   GROUP BY nombre_departamento, nombre_municipio
								   UNION
								   SELECT NULL nombre_departamento, \'TOTAL\' nombre_municipio,
								   SUM(CASE WHEN modalidad_usuario = \'tutorizado\' THEN 1 ELSE 0 END) tutorizado,
								   SUM(CASE WHEN modalidad_usuario = \'autoformacion\' THEN 1 ELSE 0 END) autoformacion
								   FROM V_EstadisticaDepartamentoFecha
								   WHERE nota_examen_calificacion >= 7.00 AND tipo_capacitado = ? AND fecha_examen_calificacion BETWEEN ? AND ?',
								   array($tipo_capacitado, $fecha1, $fecha2, $tipo_capacitado, $fecha1, $fecha2));
		return $query->result();
	}
}

/* End of file estadisticas_model.php */
/* Location: ./application/models/estadisticas_model.php */