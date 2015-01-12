<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Estadisticas_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function modalidades_capacitados($tipo_resultado = ''){
		if($tipo_resultado == 'certificados'){
			$sql = 'select sum(case when a.modalidad_usuario = \'tutorizado\' then 1 else 0 end ) tutorizado,
	                sum(case when a.modalidad_usuario = \'autoformacion\' then 1 else 0 end ) autoformacion 
					from v_estadisticamodalidad a where a.nota_examen_calificacion >= 7.00 and a.nombre_examen like \'Examen%\'';
		}
		if($tipo_resultado == 'capacitados'){
			$sql = 'select sum(case when a.modalidad_usuario = \'tutorizado\' then 1 else 0 end ) tutorizado,
	                sum(case when a.modalidad_usuario = \'autoformacion\' then 1 else 0 end ) autoformacion 
					from v_estadisticamodalidad a where a.nota_examen_calificacion >= 7.00 and a.nombre_examen like \'Evaluaci%\'';
		}
		if($tipo_resultado == 'total'){
			$sql = 'select sum(case when a.modalidad_usuario = \'tutorizado\' then 1 else 0 end ) tutorizado,
	                sum(case when a.modalidad_usuario = \'autoformacion\' then 1 else 0 end ) autoformacion 
					from v_estadisticamodalidad a where a.nota_examen_calificacion >= 7.00';
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function cantidad_usuarios_municipio($id_departamento){
		/* 
		$this->db->select('m.nombre_municipio, COUNT(u.id_municipio) total');
		$this->db->from('usuarios u');
		$this->db->join('municipios m', 'u.id_municipio = m.id_municipio', 'inner');
		$this->db->where('u.id_departamento', $id_departamento);
		$this->db->order_by('m.nombre_municipio', 'asc');
		$query = $this->db->get();
		 */
		$query = $this->db->query('SELECT m.nombre_municipio, COUNT(u.id_municipio) total
								   FROM usuarios u INNER JOIN municipios m ON(u.id_municipio = m.id_municipio)
								   WHERE u.id_departamento = ?
								   GROUP BY m.nombre_municipio', array($id_departamento));
		return $query->result();
	}
	
	function usuarios_municipio($id_departamento){
		$query = $this->db->query('SELECT m.nombre_municipio, F_NombreCompletoUsuario(u.id_usuario) nombre_usuario, initcap(u.modalidad_usuario) modalidad_usuario
								   FROM usuarios u INNER JOIN municipios m ON(u.id_municipio = m.id_municipio)
								   WHERE u.id_departamento = ?
								   ORDER BY 1', array($id_departamento));
		return $query->result();
	}
	
	function usuarios_departamento_municipio($tipo_resultado = ''){
		if($tipo_resultado == 'tabla'){
			$sql = '(select @row_num := @row_num + 1 as row_number, nombre_centro_educativo ,
					sum(case when a.nombre_examen like \'Evaluaci%\' then 1 else 0 end ) certificados,
					sum(case when a.nombre_examen like \'Examen%\' then 1 else 0 end ) capacitados
					from v_estadisticadepartamentofecha a where a.nota_examen_calificacion >= 7.00 
					group by nombre_municipio order by row_number)
					union(
					select @row_num := @row_num + 1 as row_number,
					"TOTAL"as nombre_centro_educativo,
					sum(case when a.nombre_examen like \'Evaluaci%\' then 1 else 0 end ) certificados,
					sum(case when a.nombre_examen like \'Examen%\' then 1 else 0 end ) capacitados
					from v_estadisticadepartamentofecha a where a.nota_examen_calificacion >= 7.00 
					)';
		}
		
		if($tipo_resultado == 'grafica'){
			$sql = '(select @row_num := @row_num + 1 as row_number, nombre_centro_educativo ,
					sum(case when a.nombre_examen like \'Evaluaci%\' then 1 else 0 end ) certificados,
					sum(case when a.nombre_examen like \'Examen%\' then 1 else 0 end ) capacitados
					from v_estadisticadepartamentofecha a where a.nota_examen_calificacion >= 7.00 
					group by nombre_municipio order by row_number)
					';
		}
		
		if($tipo_resultado == 'listado'){
			$sql = '(select  nombres_usuario,apellido1_usuario,apellido2_usuario,tipo_capacitado,modalidad_usuario
					from v_estadisticadepartamentofecha
					where nombre_departamento=\'San Salvador\'
					and nombre_municipio=\'San Salvador\'
					and nombre_centro_educativo=\'Centro Escolar  Isidro Menendez\')
					';
		}
		
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function estaditicas_depertamento_fechas($tipo_resultado = ''){
		if($tipo_resultado == 'tabla'){
		  $query = $this->db->query('set @row_num = 0');
          $sql = 'select @row_num := @row_num + 1 as row_number,
                    	   nombre_departamento,
                    	   sum(case when a.nombre_examen like \'Evaluaci%\' then 1 else 0 end ) certificados,
                    	   sum(case when a.nombre_examen like \'Examen%\' then 1 else 0 end ) capacitados
                    from v_estadisticadepartamentofecha a where a.nota_examen_calificacion >= 7.00 
                    group by nombre_departamento order by row_number';
		}
		
		$query = $this->db->query($sql);
		return $query->result();
	}
    
    function estaditicas_depertamento_tipo_fechas($tipo_resultado = ''){
		if($tipo_resultado == 'tabla'){
		  $query = $this->db->query('set @row_num = 0');
          $sql = 'select @row_num := @row_num + 1 as row_number,
                    	   nombre_municipio,
                    	   sum(case when a.nombre_examen like \'Evaluaci%\' then 1 else 0 end ) certificados,
                    	   sum(case when a.nombre_examen like \'Examen%\' then 1 else 0 end ) capacitados
                    from v_estadisticadepartamentofecha a where a.nota_examen_calificacion >= 7.00 
                    group by nombre_municipio order by row_number';
		}
		
		$query = $this->db->query($sql);
		return $query->result();
	}
    
}

/* End of file estadisticas_model.php */
/* Location: ./application/models/estadisticas_model.php */