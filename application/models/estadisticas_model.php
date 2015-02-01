<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Estadisticas_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function modalidades_capacitados($tipo_resultado = ''){
		if($tipo_resultado == 'certificados'){
			$sql = 'select sum(case when a.modalidad_usuario = \'tutorizado\' then 1 else 0 end ) tutorizado,
	                sum(case when a.modalidad_usuario = \'autoformacion\' then 1 else 0 end ) autoformacion 
					from v_estadisticamodalidad a where a.nota_examen_calificacion >= 7.00 
                    and a.nombre_examen like \'Examen%\'';
		}
		if($tipo_resultado == 'capacitados'){
			$sql = 'select sum(case when a.modalidad_usuario = \'tutorizado\' then 1 else 0 end ) tutorizado,
	                sum(case when a.modalidad_usuario = \'autoformacion\' then 1 else 0 end ) autoformacion 
					from v_estadisticamodalidad a where a.nota_examen_calificacion >= 7.00 
                    and a.nombre_examen like \'Evaluaci%\'';
		}
		if($tipo_resultado == 'total'){
			$sql = 'select sum(case when a.modalidad_usuario = \'tutorizado\' then 1 else 0 end ) tutorizado,
	                sum(case when a.modalidad_usuario = \'autoformacion\' then 1 else 0 end ) autoformacion 
					from v_estadisticamodalidad a where a.nota_examen_calificacion >= 7.00';
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function cantidad_usuarios_municipio($id_departamento, $fecha1, $fecha2){
		if($id_departamento == '' && $fecha1 == '' && $fecha2 == ''){
			$query = $this->db->query('SELECT * FROM V_UsuariosTotalDepartamento');
		}
		else{
			$query = $this->db->query('SELECT capacitados.nombre_municipio nombre_municipio, capacitados.total capacitados, (CASE WHEN certificados.total IS NULL THEN 0 ELSE certificados.total END) certificados
									   FROM (SELECT nombre_municipio, total FROM V_UsuariosCapacitadosDepartamento WHERE id_departamento = ? AND fecha_examen_calificacion BETWEEN ? AND ?) capacitados
									   LEFT JOIN (SELECT nombre_municipio, total FROM V_UsuariosCertificadosDepartamento WHERE id_departamento = ? AND fecha_examen_calificacion BETWEEN ? AND ?) certificados
									   ON capacitados.nombre_municipio = certificados.nombre_municipio
									   UNION
									   SELECT \'TOTAL\' nombre_municipio, SUM(capacitados.total) capacitados, SUM(CASE WHEN certificados.total IS NULL THEN 0 ELSE certificados.total END) certificados
									   FROM (SELECT nombre_municipio, total FROM V_UsuariosCapacitadosDepartamento WHERE id_departamento = ? AND fecha_examen_calificacion BETWEEN ? AND ?) capacitados
									   LEFT JOIN (SELECT nombre_municipio, total FROM V_UsuariosCertificadosDepartamento WHERE id_departamento = ? AND fecha_examen_calificacion BETWEEN ? AND ?) certificados
									   ON capacitados.nombre_municipio = certificados.nombre_municipio',
									  array($id_departamento, $fecha1, $fecha2, $id_departamento, $fecha1, $fecha2, $id_departamento, $fecha1, $fecha2, $id_departamento, $fecha1, $fecha2));
		}
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
					sum(case when a.nombre_examen like \'Evaluaci%\' then 1 else 0 end ) capacitados,
					sum(case when a.nombre_examen like \'Examen%\' then 1 else 0 end ) certificados
					from v_estadisticadepartamentofecha a where a.nota_examen_calificacion >= 7.00 
					group by nombre_municipio order by row_number)
					union(
					select @row_num := @row_num + 1 as row_number,
					"TOTAL"as nombre_centro_educativo,
					sum(case when a.nombre_examen like \'Evaluaci%\' then 1 else 0 end ) capacitados,
					sum(case when a.nombre_examen like \'Examen%\' then 1 else 0 end ) certificados
					from v_estadisticadepartamentofecha a where a.nota_examen_calificacion >= 7.00 
					)';
		}
		
		if($tipo_resultado == 'grafica'){
			$sql = '(select @row_num := @row_num + 1 as row_number, nombre_centro_educativo ,
					sum(case when a.nombre_examen like \'Evaluaci%\' then 1 else 0 end ) capacitados,
					sum(case when a.nombre_examen like \'Examen%\' then 1 else 0 end ) certificados
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
	
	function estaditicas_departamento_fechas($tipo_resultado = ''){
		if($tipo_resultado == 'tabla'){
		  $query = $this->db->query('set @row_num = 0');
          $sql = 'select @row_num := @row_num + 1 as row_number,
                    	   nombre_departamento,
                    	   sum(case when a.nombre_examen like \'Evaluaci%\' then 1 else 0 end ) capacitados,
                    	   sum(case when a.nombre_examen like \'Examen%\' then 1 else 0 end ) certificados 
                    from v_estadisticadepartamentofecha a where a.nota_examen_calificacion >= 7.00 
                    group by nombre_departamento order by row_number';
		}
		
		$query = $this->db->query($sql);
		return $query->result();
	}
    
    function estaditicas_departamento_tipo_fechas($tipo_resultado = ''){
		$query = $this->db->query('set @row_num = 0');
		$sql = 'select @row_num := @row_num + 1 as row_number,
					nombre_municipio,
                    sum(case when a.nombre_examen like \'Evaluaci%\' then 1 else 0 end ) capacitados,
                    sum(case when a.nombre_examen like \'Examen%\' then 1 else 0 end ) certificados
                    from v_estadisticadepartamentofecha a where a.nota_examen_calificacion >= 7.00  
                    group by nombre_municipio order by row_number';
		
		$query = $this->db->query($sql);
		return $query->result();
	}
        
	function centro_educativo_capacitado($tipo_resultado = ''){
				
		if($tipo_resultado == 'certificados'){
		
		$sql = " select sum(case when a.modalidad_usuario = 'tutorizado' then 1 else 0 end ) tutorizado,
            	    sum(case when a.modalidad_usuario = 'autoformacion' then 1 else 0 end ) autoformacion 
                    from v_estadisticadepartamentofecha a
                    where a.nota_examen_calificacion >= 7.00 
                    and a.nombre_examen like 'Examen%'
                    and a.nombre_centro_educativo='Centro Escolar  Isidro Menendez'";
		}
		if($tipo_resultado == 'capacitados'){
		
		$sql = " select sum(case when a.modalidad_usuario = 'tutorizado' then 1 else 0 end ) tutorizado,
                    sum(case when a.modalidad_usuario = 'autoformacion' then 1 else 0 end ) autoformacion 
					from v_estadisticadepartamentofecha a
                    where a.nota_examen_calificacion >= 7.00 
                    and a.nombre_examen like 'Evaluaci%'
                    and a.nombre_centro_educativo='Centro Escolar  Isidro Menendez'";
        }           
    	if($tipo_resultado == 'total'){		
		$sql = " select sum(case when a.modalidad_usuario = 'tutorizado' then 1 else 0 end ) tutorizado,
	                sum(case when a.modalidad_usuario = 'autoformacion' then 1 else 0 end ) autoformacion 
					from v_estadisticadepartamentofecha a 
                    where a.nota_examen_calificacion >= 7.00
                    and a.nombre_centro_educativo='Centro Escolar  Isidro Menendez'";           
        }                     
		$query = $this->db->query($sql);
		return $query->result();
	}
 // CONSULTA ESTADISTICA 10 
	function usuarios_nivel_nacional($id_tipo_capacitados,$id_departamento,$id_municipio,$fecha_ini,$fecha_fin){
		$sql ='';
		$query = $this->db->query('set @row_num = 0');
		$tipo_resultado= '';
		//set @row_num = 0;
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
		group by a.nombre_centro_educativo
		union 
		select @row_num := @row_num + 1 as row_number,
			   'TOTAL' as nombre_centro_educativo,
			   sum(case when a.modalidad_usuario = 'tutorizado' then 1 else 0 end ) tutorizado,
			   sum(case when a.modalidad_usuario = 'autoformacion' then 1 else 0 end ) autoformacion 
		from v_estadisticadepartamentofecha a 
		where a.nota_examen_calificacion >= 7.00
		and a.nombre_examen like '".$id_tipo_capacitados."%'
		and a.id_departamento = $id_departamento
		and a.id_municipio = $id_municipio
		and a.fecha_examen_calificacion between '".$fecha_ini."' and '".$fecha_fin."'";
		
		$query = $this->db->query($sql);
		return $query->result();
	}
    
}

/* End of file estadisticas_model.php */
/* Location: ./application/models/estadisticas_model.php */