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

/* MAPAS */
-- almacenar en syscap.mapas los registros de las coordenadas en el mapa
TRUNCATE syscap.mapas;
INSERT INTO syscap.mapas(syscap.mapas.id_mapa, syscap.mapas.longitud_mapa, syscap.mapas.latitud_mapa) VALUES
								-- Municipio, Departamento
(1, 13.9344628, -89.0239548),	-- Suchitoto, Cuscatlan
(2, 13.6914782, -89.2146939),	-- San Salvador, San Salvador
(3, 13.6405872, -88.7839214),	-- San Vicente, San Vicente
(4, 13.71045, -89.1435517),		-- Soyapango, San Salvador
(5, 13.4910976, -89.3170369),	-- Puerto De La Libertad, La Libertad
(6, 13.8150632, -89.1726215),	-- Apopa, San Salvador
(7, 13.6771271, -89.331572),	-- Nueva San Salvador, La Libertad
(8, 13.4785173, -88.1690892),	-- San Miguel, San Miguel
(9, 13.9866054, -89.6780062),	-- Chalchuapa, Santa Ana
(10, 13.9837933, -89.5628214),	-- Santa Ana, Santa Ana
(11, 13.7391679, -89.2104026),	-- Mejicanos, San Salvador
(12, 13.6247163, -87.8940153),	-- Santa Rosa De Lima, La Union
(13, 13.7103248, -89.7300196),	-- Sonsonate, Sonsonate
(14, 13.7210174, -88.938373),	-- Cojutepeque, Cuscatlan
(15, 13.7503845, -89.057579),	-- San Martin, San Salvador
(16, 13.3432736, -88.4427738),	-- Ahuachapan, Ahuachapan
(17, 13.8762505, -89.3583689),	-- San Juan Opico, La Libertad
(18, 13.9290675, -89.8436594),	-- Usulutan, Usulutan
(19, 13.5788318, -89.2671776),	-- San Jose Villanueva, La Libertad
(20, 13.7632123, -89.0487634),	-- San Bartolome Perulapia, Cuscatlan
(21, 13.6603945, -89.1769482),	-- San Marcos, San Salvador
(22, 13.7083268, -89.3482965),	-- Colon, La Libertad
(23, 13.7534692, -89.1586547),	-- Ciudad Delgado, San Salvador
(24, 13.830604, -89.2692803),	-- Quezaltepeque, La Libertad
(25, 13.4296472, -88.5936102);	-- San Agustin, Usulutan
UPDATE municipios SET id_mapa = 1 WHERE id_municipio = '188';
UPDATE municipios SET id_mapa = 2 WHERE id_municipio = '01';
UPDATE municipios SET id_mapa = 3 WHERE id_municipio = '241';
UPDATE municipios SET id_mapa = 4 WHERE id_municipio = '04';
UPDATE municipios SET id_mapa = 5 WHERE id_municipio = '58';
UPDATE municipios SET id_mapa = 6 WHERE id_municipio = '09';
UPDATE municipios SET id_mapa = 7 WHERE id_municipio = '53';
UPDATE municipios SET id_mapa = 8 WHERE id_municipio = '33';
UPDATE municipios SET id_mapa = 9 WHERE id_municipio = '21';
UPDATE municipios SET id_mapa = 10 WHERE id_municipio = '20';
UPDATE municipios SET id_mapa = 11 WHERE id_municipio = '03';
UPDATE municipios SET id_mapa = 12 WHERE id_municipio = '115';
UPDATE municipios SET id_mapa = 13 WHERE id_municipio = '98';
UPDATE municipios SET id_mapa = 14 WHERE id_municipio = '187';
UPDATE municipios SET id_mapa = 15 WHERE id_municipio = '10';
UPDATE municipios SET id_mapa = 16 WHERE id_municipio = '75';
UPDATE municipios SET id_mapa = 17 WHERE id_municipio = '56';
UPDATE municipios SET id_mapa = 18 WHERE id_municipio = '203';
UPDATE municipios SET id_mapa = 19 WHERE id_municipio = '70';
UPDATE municipios SET id_mapa = 20 WHERE id_municipio = '198';
UPDATE municipios SET id_mapa = 21 WHERE id_municipio = '06';
UPDATE municipios SET id_mapa = 22 WHERE id_municipio = '57';
UPDATE municipios SET id_mapa = 23 WHERE id_municipio = '02';
UPDATE municipios SET id_mapa = 24 WHERE id_municipio = '82';
UPDATE municipios SET id_mapa = 25 WHERE id_municipio = '54';
UPDATE departamentos SET id_mapa = 16 WHERE id_departamento = '11';
UPDATE departamentos SET id_mapa = 10 WHERE id_departamento = '02';
UPDATE departamentos SET id_mapa = 13 WHERE id_departamento = '06';
UPDATE departamentos SET id_mapa = 2 WHERE id_departamento = '01';
UPDATE departamentos SET id_mapa = 14 WHERE id_departamento = '10';
UPDATE departamentos SET id_mapa = 3 WHERE id_departamento = '13';
UPDATE departamentos SET id_mapa = 18 WHERE id_departamento = '05';
UPDATE departamentos SET id_mapa = 8 WHERE id_departamento = '03';
