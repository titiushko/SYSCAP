<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Estadisticas_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	// Consulta Estadística 1: Usuarios por Modalidad de Capacitación
	function modalidades_capacitados($fecha1, $fecha2){
		$filtro = ($fecha1 != '' && $fecha2 != '') ? 'AND fecha_examen_calificacion BETWEEN ? AND ?' : '';
		$query = $this->db->query('SELECT \'Capacitados\' tipos_capacitados,
								   SUM(CASE WHEN modalidad_usuario = \'tutorizado\' THEN 1 ELSE 0 END) tutorizados,
								   SUM(CASE WHEN modalidad_usuario = \'autoformacion\' THEN 1 ELSE 0 END) autoformacion
								   FROM V_EstadisticaModalidad
								   WHERE nota_examen_calificacion >= 7.00 AND nombre_examen LIKE \'Evaluaci%\' '.$filtro.'
								   UNION
								   SELECT \'Certificados\' tipos_capacitados,
								   SUM(CASE WHEN modalidad_usuario = \'tutorizado\' THEN 1 ELSE 0 END) tutorizados,
								   SUM(CASE WHEN modalidad_usuario = \'autoformacion\' THEN 1 ELSE 0 END) autoformacion
								   FROM V_EstadisticaModalidad
								   WHERE nota_examen_calificacion >= 7.00 AND nombre_examen LIKE \'Examen%\' '.$filtro.'
								   UNION
								   SELECT \'TOTAL\' tipos_capacitados,
								   SUM(CASE WHEN modalidad_usuario = \'tutorizado\' THEN 1 ELSE 0 END) tutorizados,
								   SUM(CASE WHEN modalidad_usuario = \'autoformacion\' THEN 1 ELSE 0 END) autoformacion
								   FROM V_EstadisticaModalidad
								   WHERE nota_examen_calificacion >= 7.00 '.$filtro,
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
		$filtro = $tipo_capacitado != '' ? ' AND tipo_capacitado = ?' : '';
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
								   AND fecha_examen_calificacion BETWEEN ? AND ?'.$filtro,
								   array($codigo_departamento, $codigo_municipio, $fecha1, $fecha2, $tipo_capacitado, $codigo_departamento, $codigo_municipio, $fecha1, $fecha2, $tipo_capacitado));
		return $query->result();
	}
	
	// Consulta Estadística 4: Usuarios por Departamento, Municipio y Rango de Fechas
	// Consulta Estadística 7: Usuarios por Tipo de Capacitados, Departamento y Municipio
	function usuarios_centro_educativo($codigo_departamento, $codigo_municipio, $fecha1, $fecha2, $tipo_capacitado = ''){
		$filtro = $tipo_capacitado != '' ? ' AND tipo_capacitado = ?' : '';
		$query = $this->db->query('SELECT acentos(nombre_centro_educativo) nombre_centro_educativo, acentos(nombre_usuario) nombre_usuario, tipo_capacitado, modalidad_usuario
								   FROM V_EstadisticaDepartamentoFecha
								   WHERE nota_examen_calificacion >= 7.00 AND id_departamento = ? AND id_municipio = ?
								   AND fecha_examen_calificacion BETWEEN ? AND ?'.$filtro,
								   array($codigo_departamento, $codigo_municipio, $fecha1, $fecha2, $tipo_capacitado));
		return $query->result();
	}
    
    function lista_usuarios_centro_educativo($codigo_departamento, $codigo_municipio, $fecha1, $fecha2, $tipo_capacitado = '', $nombre_centro_educativo=''){
		$filtro = $tipo_capacitado != '' ? ' AND tipo_capacitado = ?' : '';
		$query = $this->db->query('SELECT acentos(nombre_centro_educativo) nombre_centro_educativo, acentos(nombre_usuario) nombre_usuario, tipo_capacitado, modalidad_usuario
								   FROM V_EstadisticaDepartamentoFecha
								   WHERE nota_examen_calificacion >= 7.00 AND id_departamento = ? AND id_municipio = ?
								   AND fecha_examen_calificacion BETWEEN ? AND ?'.$filtro.' AND acentos(nombre_centro_educativo) = ?',
								   array($codigo_departamento, $codigo_municipio, $fecha1, $fecha2, $tipo_capacitado, $nombre_centro_educativo));
		return $query->result();
	}
	
	// Consulta Estadística 3: Total de Usuarios por Departamento y Rango de Fechas
	// Consulta Estadística 8: Usuarios por Departamento, Tipo de Capacitados y Fecha
	function estaditicas_departamento_fechas($fecha1, $fecha2, $tipo_capacitado = ''){
		$filtro = '';
		if($fecha1 != '' && $fecha2 != ''){
			$filtro = 'AND fecha_examen_calificacion BETWEEN ? AND ?';
		}
		if($tipo_capacitado != ''){
			$tipo_capacitado .= '%';
			$filtro .= ' AND nombre_examen LIKE ?';
		}
		$query = $this->db->query('SET @indice = 0');
		$query = $this->db->query('SELECT @indice := @indice + 1 indice, acentos(nombre_departamento) nombre_departamento,
								   SUM(CASE WHEN nombre_examen LIKE \'Evaluaci%\' THEN 1 ELSE 0 END) capacitados,
								   SUM(CASE WHEN nombre_examen LIKE \'Examen%\' THEN 1 ELSE 0 END) certificados
								   FROM V_EstadisticaDepartamentoFecha
								   WHERE nota_examen_calificacion >= 7.00 '.$filtro.'
								   GROUP BY nombre_departamento
								   ORDER BY indice', array($fecha1, $fecha2, $tipo_capacitado));
		return $query->result();
	}
    
	// Consulta Estadística 6: Usuarios por Tipo de Capacitados, Departamento y Fecha
    function estaditicas_departamento_tipo_fechas($tipo_capacitado, $codigo_departamento, $fecha1, $fecha2){
		$tipo_capacitado = $tipo_capacitado != '' ? $tipo_capacitado : '%';
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
	function tipos_capacitados_centro_educativo($tipo_capacitado = '', $codigo_centro_educativo = ''){
		$tipo_capacitado = $tipo_capacitado != '' ? $tipo_capacitado.'%' : $tipo_capacitado;
		$query = $this->db->query('SELECT \'Tutorizado\' modalidad_capacitado, SUM(CASE WHEN modalidad_usuario = \'tutorizado\' THEN 1 ELSE 0 END) total
								   FROM V_EstadisticaDepartamentoFecha
								   WHERE nota_examen_calificacion >= 7.00 AND nombre_examen LIKE ? AND id_centro_educativo = ?
								   UNION
								   SELECT \'Autoformación\' modalidad_capacitado, SUM(CASE WHEN modalidad_usuario = \'autoformacion\' THEN 1 ELSE 0 END) total
								   FROM V_EstadisticaDepartamentoFecha
								   WHERE nota_examen_calificacion >= 7.00 AND nombre_examen LIKE ? AND id_centro_educativo = ?
								   UNION
								   SELECT \'TOTAL\' modalidad_capacitado, SUM(CASE WHEN modalidad_usuario = \'tutorizado\' THEN 1 ELSE 0 END) + SUM(CASE WHEN modalidad_usuario = \'autoformacion\' THEN 1 ELSE 0 END) total
								   FROM V_EstadisticaDepartamentoFecha
								   WHERE nota_examen_calificacion >= 7.00 AND nombre_examen LIKE ? AND id_centro_educativo = ?',
								   array($tipo_capacitado, $codigo_centro_educativo, $tipo_capacitado, $codigo_centro_educativo, $tipo_capacitado, $codigo_centro_educativo));
		return $query->result();
	}
	
	// Consulta Estadística 10: Usuarios a Nivel Nacional
/*
	function usuarios_nivel_nacional($id_tipo_capacitados, $codigo_departamento, $codigo_municipio, $fecha1, $fecha2){
		$sql ='';
		$query = $this->db->query('set @row_num = 0');
		$tipo_resultado= '';
		//set @row_num = 0;
		$sql = 'select @row_num := @row_num + 1 as row_number,
				a.nombre_centro_educativo,
				sum(case when a.modalidad_usuario =  \'tutorizado\' then 1 else 0 end ) tutorizado,
				sum(case when a.modalidad_usuario =  \'autoformacion\' then 1 else 0 end ) autoformacion 
		from V_EstadisticaDepartamentoFecha a
		where a.nota_examen_calificacion >= 7.00 
		and a.nombre_examen like \'?%\'
		and a.id_departamento = ?
		and a.id_municipio = ?
		and a.fecha_examen_calificacion between ? and ?
		group by a.nombre_centro_educativo
		union 
		select @row_num := @row_num + 1 as row_number,
			   \'TOTAL\' as nombre_centro_educativo,
			   sum(case when a.modalidad_usuario = \'tutorizado\' then 1 else 0 end ) tutorizado,
			   sum(case when a.modalidad_usuario = \'autoformacion\' then 1 else 0 end ) autoformacion 
		from V_EstadisticaDepartamentoFecha a 
		where a.nota_examen_calificacion >= 7.00
		and a.nombre_examen like \'?%\'
		and a.id_departamento = $codigo_departamento
		and a.id_municipio = $codigo_municipio
		and a.fecha_examen_calificacion between ? and ?';
		$query = $this->db->query($sql, array($id_tipo_capacitados, $codigo_departamento, $codigo_municipio, $fecha1, $fecha2, $id_tipo_capacitados, $fecha1, $fecha2));
		return $query->result();
	}
    */
    
    function usuarios_nivel_nacional($id_tipo_capacitados,$id_departamento,$id_municipio,$fecha_ini,$fecha_fin){
		$sql ='';
		$query = $this->db->query('set @row_num = 0');

		$sql = "select @row_num := @row_num + 1 as row_number,
				a.nombre_centro_educativo,
				sum(case when a.modalidad_usuario =  'tutorizado' then 1 else 0 end ) tutorizado,
				sum(case when a.modalidad_usuario =  'autoformacion' then 1 else 0 end ) autoformacion 
		from v_estadisticadepartamentofecha a
		where a.nota_examen_calificacion >= 7.00 
		and a.nombre_examen like '".$id_tipo_capacitados."%'
		and a.id_departamento = $id_departamento
		and a.id_municipio = $id_municipio
		and a.fecha_examen_calificacion between '".$fecha_ini."' and '".$fecha_fin."'
		group by a.nombre_centro_educativo";
		/*
		union 
		select '' as row_number,
			   'TOTAL' as nombre_centro_educativo,
			   sum(case when a.modalidad_usuario = 'tutorizado' then 1 else 0 end ) tutorizado,
			   sum(case when a.modalidad_usuario = 'autoformacion' then 1 else 0 end ) autoformacion 
		from v_estadisticadepartamentofecha a 
		where a.nota_examen_calificacion >= 7.00
		and a.nombre_examen like '".$id_tipo_capacitados."%'
		and a.id_departamento = $id_departamento
		and a.id_municipio = $id_municipio
		and a.fecha_examen_calificacion between '".$fecha_ini."' and '".$fecha_fin."'";
		*/
		$query = $this->db->query($sql);
		return $query->result();
	}
}

/* End of file estadisticas_model.php */
/* Location: ./application/models/estadisticas_model.php */