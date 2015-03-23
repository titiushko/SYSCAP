USE syscap;

DELIMITER $$
DROP PROCEDURE IF EXISTS P_Etl $$
CREATE PROCEDURE P_Etl()
COMMENT 'Procedimiento que ejecuta las acciones de ETL.'
DETERMINISTIC
READS SQL DATA
BEGIN
	SET @DISABLE_TRIGGERS = TRUE;
	
	/* Actualizar la base de datos de MOODLE a partir de los cambios en la base de datos de SYSCAP. */
	
	/* MDL_CAT_EDUCATIVA */
	-- actualizar los registros de moodle19.mdl_cat_educativa desde syscap.centros_educativos
	CALL P_ActualizarMoodleCatEducativa();
	
	/* MDL_USER */
	-- copiar a moodle19.mdl_user los registros de syscap.usuarios
	CALL P_ActualizarMoodleUser();
	
	/* Actualizar la base de datos de SYSCAP a partir de los cambios en la base de datos de MOODLE. */
	
	/* CENTROS_EDUCATIVOS */
	-- actualizar los registros de syscap.centros_educativos desde moodle19.mdl_cat_educativa
	CALL P_ActualizarSyscapCentrosEducativos();
	
	/* MATRICULAS */
	-- copiar a syscap.matriculas los registros de moodle19.mdl_context
	TRUNCATE matriculas;
	INSERT INTO matriculas(id_matricula, id_curso)
	SELECT moodle19.mdl_context.id, moodle19.mdl_context.instanceid
	FROM moodle19.mdl_context;
	
	/* CURSOS */
	-- copiar a syscap.cursos los registros de moodle19.mdl_course
	TRUNCATE cursos;
	INSERT INTO cursos(id_curso, nombre_completo_curso, nombre_corto_curso)
	SELECT moodle19.mdl_course.id, moodle19.mdl_course.fullname, moodle19.mdl_course.shortname
	FROM moodle19.mdl_course;
	
	/* EXAMENES */
	-- copiar a syscap.examenes los registros de moodle19.mdl_quiz
	TRUNCATE examenes;
	INSERT INTO examenes(id_examen, id_curso, nombre_examen)
	SELECT moodle19.mdl_quiz.id, moodle19.mdl_quiz.course, syscap.initcap(moodle19.mdl_quiz.name)
	FROM moodle19.mdl_quiz;
	
	/* EXAMENES_CALIFICACIONES */
	-- copiar a syscap.examenes_calificaciones los registros de moodle19.mdl_quiz_grades
	TRUNCATE examenes_calificaciones;
	INSERT INTO examenes_calificaciones(id_examen_calificacion, id_examen, id_usuario, nota_examen_calificacion, fecha_examen_calificacion)
	SELECT moodle19.mdl_quiz_grades.id, moodle19.mdl_quiz_grades.quiz, moodle19.mdl_quiz_grades.userid, moodle19.mdl_quiz_grades.grade, DATE_FORMAT(FROM_UNIXTIME(moodle19.mdl_quiz_grades.timemodified), '%Y-%m-%d')
	FROM moodle19.mdl_quiz_grades;
	
	/* ROLES */
	-- copiar a syscap.roles los registros de moodle19.mdl_role
	TRUNCATE roles;
	INSERT INTO roles(id_rol, nombre_completo_rol, nombre_corto_rol, descripcion_rol, criterio_rol)
	SELECT moodle19.mdl_role.id, syscap.initcap(moodle19.mdl_role.name), moodle19.mdl_role.shortname, moodle19.mdl_role.description, moodle19.mdl_role.sortorder
	FROM moodle19.mdl_role;
	
	/* ROLES_ASIGNADOS */
	-- copiar a syscap.roles_asignados los registros de moodle19.mdl_role_assignments
	TRUNCATE roles_asignados;
	INSERT INTO roles_asignados(id_rol_asignado, id_rol, id_matricula, id_usuario)
	SELECT moodle19.mdl_role_assignments.id, syscap.initcap(moodle19.mdl_role_assignments.roleid), moodle19.mdl_role_assignments.contextid, moodle19.mdl_role_assignments.userid
	FROM moodle19.mdl_role_assignments;
	
	/* USUARIOS */
	-- copiar a syscap.usuarios los registros de moodle19.mdl_user
	CALL P_ActualizarSyscapUsuarios();
	
	SET @DISABLE_TRIGGERS = NULL;
END$$
DELIMITER ;

-- ------------------------------------------------------------------------------------------

DELIMITER $$
DROP EVENT IF EXISTS ETL_CARGA_DATOS $$
CREATE EVENT ETL_CARGA_DATOS
	ON SCHEDULE EVERY 1 DAY STARTS '2015-03-23 00:00:00'
	ON COMPLETION NOT PRESERVE ENABLE
	DO
	CALL P_Etl();
$$
DELIMITER ;

SET GLOBAL event_scheduler = ON;
