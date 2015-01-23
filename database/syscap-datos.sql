USE syscap;

/* DEPARTAMENTOS */
-- copiar a syscap.departamentos los registros de moodle19.mdl_cat_deptos
TRUNCATE syscap.departamentos;
INSERT INTO syscap.departamentos(syscap.departamentos.id_departamento, syscap.departamentos.nombre_departamento)
SELECT moodle19.mdl_cat_deptos.id, syscap.initcap(moodle19.mdl_cat_deptos.deptos)
FROM moodle19.mdl_cat_deptos
WHERE moodle19.mdl_cat_deptos.id IS NOT NULL AND moodle19.mdl_cat_deptos.deptos IS NOT NULL;

/* MUNICIPIOS */
-- copiar a syscap.municipios los registros de moodle19.mdl_cat_municip
TRUNCATE syscap.municipios;
INSERT INTO syscap.municipios(syscap.municipios.id_municipio, syscap.municipios.id_departamento, syscap.municipios.nombre_municipio)
SELECT moodle19.mdl_cat_municip.id, moodle19.mdl_cat_municip.relacion, syscap.initcap(moodle19.mdl_cat_municip.opcion)
FROM moodle19.mdl_cat_municip
WHERE moodle19.mdl_cat_municip.id IS NOT NULL AND moodle19.mdl_cat_municip.relacion IS NOT NULL AND moodle19.mdl_cat_municip.opcion IS NOT NULL;

/* CENTROS_EDUCATIVOS */
-- copiar a syscap.centros_educativos los registros de moodle19.mdl_cat_educativa
TRUNCATE syscap.centros_educativos;
INSERT INTO syscap.centros_educativos(syscap.centros_educativos.id_centro_educativo, syscap.centros_educativos.codigo_centro_educativo, syscap.centros_educativos.nombre_centro_educativo, syscap.centros_educativos.id_departamento, syscap.centros_educativos.id_municipio)
SELECT moodle19.mdl_cat_educativa.row_id, moodle19.mdl_cat_educativa.codigo_entidad, syscap.initcap(moodle19.mdl_cat_educativa.nombre), syscap.departamento(moodle19.mdl_cat_educativa.depto), syscap.municipio(moodle19.mdl_cat_educativa.muni)
FROM moodle19.mdl_cat_educativa
WHERE moodle19.mdl_cat_educativa.row_id IS NOT NULL AND moodle19.mdl_cat_educativa.codigo_entidad IS NOT NULL AND moodle19.mdl_cat_educativa.nombre IS NOT NULL AND moodle19.mdl_cat_educativa.depto IS NOT NULL AND moodle19.mdl_cat_educativa.muni IS NOT NULL LIMIT 0, 2000;

/* NIVELES_ESTUDIOS */
-- copiar a syscap.niveles_estudios los registros de moodle19.mdl_cat_nestudio
TRUNCATE syscap.niveles_estudios;
INSERT INTO syscap.niveles_estudios(syscap.niveles_estudios.id_nivel_estudio, syscap.niveles_estudios.nombre_nivel_estudio)
SELECT moodle19.mdl_cat_nestudio.cod_nestudio, syscap.initcap(moodle19.mdl_cat_nestudio.descripcion)
FROM moodle19.mdl_cat_nestudio
WHERE moodle19.mdl_cat_nestudio.cod_nestudio IS NOT NULL AND moodle19.mdl_cat_nestudio.descripcion IS NOT NULL;

/* PROFESIONES */
-- copiar a syscap.profesiones los registros de moodle19.mdl_cat_profesion
TRUNCATE syscap.profesiones;
INSERT INTO syscap.profesiones(syscap.profesiones.id_profesion, syscap.profesiones.nombre_profesion)
SELECT IF(moodle19.mdl_cat_profesion.row_id < 10, CONCAT('0', moodle19.mdl_cat_profesion.row_id), moodle19.mdl_cat_profesion.row_id) row_id, syscap.initcap(moodle19.mdl_cat_profesion.descripcion)
FROM moodle19.mdl_cat_profesion
WHERE moodle19.mdl_cat_profesion.row_id IS NOT NULL AND moodle19.mdl_cat_profesion.descripcion IS NOT NULL;

/* MATRICULAS */
-- copiar a syscap.matriculas los registros de moodle19.mdl_context
TRUNCATE syscap.matriculas;
INSERT INTO syscap.matriculas(syscap.matriculas.id_matricula, syscap.matriculas.id_curso)
SELECT moodle19.mdl_context.id, moodle19.mdl_context.instanceid
FROM moodle19.mdl_context
WHERE moodle19.mdl_context.id IS NOT NULL AND moodle19.mdl_context.instanceid IS NOT NULL;

/* CURSOS */
-- copiar a syscap.cursos los registros de moodle19.mdl_course
TRUNCATE syscap.cursos;
INSERT INTO syscap.cursos(syscap.cursos.id_curso, syscap.cursos.nombre_completo_curso, syscap.cursos.nombre_corto_curso)
SELECT moodle19.mdl_course.id, moodle19.mdl_course.fullname, moodle19.mdl_course.shortname
FROM moodle19.mdl_course
WHERE moodle19.mdl_course.id IS NOT NULL AND moodle19.mdl_course.fullname IS NOT NULL AND moodle19.mdl_course.shortname IS NOT NULL;

/* EXAMENES */
-- copiar a syscap.examenes los registros de moodle19.mdl_quiz
TRUNCATE syscap.examenes;
INSERT INTO syscap.examenes(syscap.examenes.id_examen, syscap.examenes.id_curso, syscap.examenes.nombre_examen)
SELECT moodle19.mdl_quiz.id, moodle19.mdl_quiz.course, syscap.initcap(moodle19.mdl_quiz.name)
FROM moodle19.mdl_quiz
WHERE moodle19.mdl_quiz.id IS NOT NULL AND moodle19.mdl_quiz.course IS NOT NULL AND moodle19.mdl_quiz.name IS NOT NULL;

/* EXAMENES_CALIFICACIONES */
-- copiar a syscap.examenes_calificaciones los registros de moodle19.mdl_quiz_grades
TRUNCATE syscap.examenes_calificaciones;
INSERT INTO syscap.examenes_calificaciones(syscap.examenes_calificaciones.id_examen_calificacion, syscap.examenes_calificaciones.id_examen, syscap.examenes_calificaciones.id_usuario, syscap.examenes_calificaciones.nota_examen_calificacion, syscap.examenes_calificaciones.fecha_examen_calificacion)
SELECT moodle19.mdl_quiz_grades.id, moodle19.mdl_quiz_grades.quiz, moodle19.mdl_quiz_grades.userid, moodle19.mdl_quiz_grades.grade, DATE_FORMAT(FROM_UNIXTIME(moodle19.mdl_quiz_grades.timemodified), '%Y-%m-%d')
FROM moodle19.mdl_quiz_grades
WHERE moodle19.mdl_quiz_grades.id IS NOT NULL AND moodle19.mdl_quiz_grades.quiz IS NOT NULL AND moodle19.mdl_quiz_grades.userid IS NOT NULL AND moodle19.mdl_quiz_grades.grade IS NOT NULL;

/* ROLES */
-- copiar a syscap.roles los registros de moodle19.mdl_role
TRUNCATE syscap.roles;
INSERT INTO syscap.roles(syscap.roles.id_rol, syscap.roles.nombre_completo_rol, syscap.roles.nombre_corto_rol, syscap.roles.descripcion_rol, syscap.roles.criterio_rol)
SELECT moodle19.mdl_role.id, syscap.initcap(moodle19.mdl_role.name), moodle19.mdl_role.shortname, moodle19.mdl_role.description, moodle19.mdl_role.sortorder
FROM moodle19.mdl_role
WHERE moodle19.mdl_role.id IS NOT NULL AND moodle19.mdl_role.name IS NOT NULL AND moodle19.mdl_role.shortname IS NOT NULL AND moodle19.mdl_role.description IS NOT NULL AND moodle19.mdl_role.sortorder IS NOT NULL;

/* ROLES_ASIGNADOS */
-- copiar a syscap.roles_asignados los registros de moodle19.mdl_role_assignments
TRUNCATE syscap.roles_asignados;
INSERT INTO syscap.roles_asignados(syscap.roles_asignados.id_rol_asignado, syscap.roles_asignados.id_rol, syscap.roles_asignados.id_matricula, syscap.roles_asignados.id_usuario)
SELECT moodle19.mdl_role_assignments.id, syscap.initcap(moodle19.mdl_role_assignments.roleid), moodle19.mdl_role_assignments.contextid, moodle19.mdl_role_assignments.userid
FROM moodle19.mdl_role_assignments
WHERE moodle19.mdl_role_assignments.id IS NOT NULL AND moodle19.mdl_role_assignments.roleid IS NOT NULL AND moodle19.mdl_role_assignments.contextid IS NOT NULL AND moodle19.mdl_role_assignments.userid IS NOT NULL;

/* USUARIOS */
-- copiar a syscap.usuarios los registros de moodle19.mdl_user
TRUNCATE syscap.usuarios;
INSERT INTO syscap.usuarios(syscap.usuarios.id_usuario, syscap.usuarios.nombre_usuario, syscap.usuarios.contrasena_usuario, syscap.usuarios.id_tipo_usuario, syscap.usuarios.nombres_usuario, syscap.usuarios.apellido1_usuario, syscap.usuarios.apellido2_usuario, syscap.usuarios.dui_usuario, syscap.usuarios.sexo_usuario, syscap.usuarios.id_profesion, syscap.usuarios.id_nivel_estudio, syscap.usuarios.correo_electronico_usuario, syscap.usuarios.telefono1_usuario, syscap.usuarios.telefono2_usuario, syscap.usuarios.id_centro_educativo, syscap.usuarios.id_departamento, syscap.usuarios.id_municipio, syscap.usuarios.pais_usuario, syscap.usuarios.direccion_usuario, syscap.usuarios.ciudad_usuario, syscap.usuarios.fecha_nacimiento_usuario, syscap.usuarios.modalidad_usuario)
SELECT moodle19.mdl_user.id, moodle19.mdl_user.username, moodle19.mdl_user.password, moodle19.mdl_user.tipo, initcap(moodle19.mdl_user.firstname), initcap(moodle19.mdl_user.lastname), initcap(moodle19.mdl_user.apellido2), moodle19.mdl_user.dui, moodle19.mdl_user.sexo, moodle19.mdl_user.profesion, moodle19.mdl_user.nestudio, moodle19.mdl_user.email, moodle19.mdl_user.phone1, moodle19.mdl_user.phone2, moodle19.mdl_user.tinstitucion, moodle19.mdl_user.deptorec, moodle19.mdl_user.munirec, moodle19.mdl_user.country, initcap(moodle19.mdl_user.address), initcap(moodle19.mdl_user.city), moodle19.mdl_user.fnacimiento, IF(moodle19.mdl_user.auth = 'manual', 'tutorizado', IF(moodle19.mdl_user.auth = 'email', 'autoformacion', NULL)) auth
FROM moodle19.mdl_user
/*WHERE moodle19.mdl_user.id IS NOT NULL AND moodle19.mdl_user.username IS NOT NULL AND moodle19.mdl_user.password IS NOT NULL AND moodle19.mdl_user.tipo IS NOT NULL AND moodle19.mdl_user.firstname IS NOT NULL AND moodle19.mdl_user.lastname IS NOT NULL AND moodle19.mdl_user.apellido2 IS NOT NULL AND moodle19.mdl_user.dui IS NOT NULL AND moodle19.mdl_user.sexo IS NOT NULL AND moodle19.mdl_user.profesion IS NOT NULL AND moodle19.mdl_user.nestudio IS NOT NULL AND moodle19.mdl_user.email IS NOT NULL AND moodle19.mdl_user.phone1 IS NOT NULL AND moodle19.mdl_user.phone2 IS NOT NULL AND moodle19.mdl_user.tinstitucion IS NOT NULL AND moodle19.mdl_user.deptorec IS NOT NULL AND moodle19.mdl_user.munirec IS NOT NULL AND moodle19.mdl_user.country IS NOT NULL AND moodle19.mdl_user.address IS NOT NULL AND moodle19.mdl_user.city IS NOT NULL AND moodle19.mdl_user.fnacimiento IS NOT NULL*/;

/* TIPOS_USUARIOS */
-- copiar a syscap.tipos_usuarios los registros de la lista desplegable del formulario inscripcion de usuarios de EducaContinua
TRUNCATE syscap.tipos_usuarios;
INSERT INTO syscap.tipos_usuarios(syscap.tipos_usuarios.id_tipo_usuario, syscap.tipos_usuarios.nombre_tipo_usuario) VALUES
(1, 'Ciudadano en General'),
(2, 'Estudiante de Basica'),
(3, 'Estudiante de Media'),
(4, 'Estudiante Universitario'),
(5, 'Docente de Básica'),
(6, 'Docente de Media'),
(7, 'Docente Tecnólogo'),
(8, 'Docente Universitario');