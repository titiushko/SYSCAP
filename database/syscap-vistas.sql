DELIMITER $$
DROP VIEW IF EXISTS V_UsuariosCursosExamenesCalificaciones $$
CREATE VIEW V_UsuariosCursosExamenesCalificaciones AS
SELECT
	u.nombre_usuario u_nombre_usuario,
	u.id_tipo_usuario u_id_tipo_usuario,
	tu.nombre_tipo_usuario tu_nombre_tipo_usuario,
	u.nombres_usuario u_nombres_usuario,
	u.apellido1_usuario u_apellido1_usuario,
	u.apellido2_usuario u_apellido2_usuario,
	u.id_profesion u_id_profesion,
	p.nombre_profesion p_nombre_profesion,
	u.id_nivel_estudio u_id_nivel_estudio,
	ne.nombre_nivel_estudio ne_nombre_nivel_estudio,
	u.id_centro_educativo u_id_centro_educativo,
	ce.nombre_centro_educativo ce_nombre_centro_educativo,
    u.id_departamento u_id_departamento,
    d.nombre_departamento d_nombre_departamento,
    u.id_municipio u_id_municipio,
    m.nombre_municipio m_nombre_municipio,
    u.modalidad_usuario u_modalidad_usuario,
	ec.nota_examen_calificacion ec_nota_examen_calificacion,
	e.nombre_examen e_nombre_examen,
	c.nombre_completo_curso c_nombre_completo_curso,
    c.nombre_corto_curso c_nombre_corto_curso
FROM
	usuarios u LEFT JOIN examenes_calificaciones ec ON(u.id_usuario = ec.id_usuario)
	LEFT JOIN examenes e ON(ec.id_examen = e.id_examen)
	LEFT JOIN cursos c ON(e.id_curso = c.id_curso)
	LEFT JOIN tipos_usuarios tu ON(u.id_tipo_usuario = tu.id_tipo_usuario)
	LEFT JOIN profesiones p ON(u.id_profesion = p.id_profesion)
	LEFT JOIN niveles_estudios ne ON(u.id_nivel_estudio = ne.id_nivel_estudio)
	LEFT JOIN centros_educativos ce ON(u.id_centro_educativo = ce.id_centro_educativo)
    LEFT JOIN departamentos d ON(u.id_departamento = d.id_departamento)
    LEFT JOIN municipios m ON(u.id_municipio = m.id_municipio);
$$
DELIMITER ;