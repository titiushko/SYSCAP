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

/* CURSOS_CATEGORIAS */
-- copiar a syscap.cursos_categorias los registros de moodle19.mdl_course_categories
TRUNCATE syscap.cursos_categorias;
INSERT INTO syscap.cursos_categorias(syscap.cursos_categorias.id_curso_categoria, syscap.cursos_categorias.nombre_curso_categoria, syscap.cursos_categorias.padre_curso_categoria)
SELECT moodle19.mdl_course_categories.id, moodle19.mdl_course_categories.name, moodle19.mdl_course_categories.parent
FROM moodle19.mdl_course_categories;

/* CURSOS */
-- copiar a syscap.cursos los registros de moodle19.mdl_course
TRUNCATE syscap.cursos;
INSERT INTO syscap.cursos(syscap.cursos.id_curso, syscap.cursos.id_curso_categoria, syscap.cursos.nombre_completo_curso, syscap.cursos.nombre_corto_curso)
SELECT moodle19.mdl_course.id, moodle19.mdl_course.category, moodle19.mdl_course.fullname, moodle19.mdl_course.shortname
FROM moodle19.mdl_course
WHERE moodle19.mdl_course.id IS NOT NULL AND moodle19.mdl_course.fullname IS NOT NULL AND moodle19.mdl_course.shortname IS NOT NULL;

/* MATRICULAS */
-- copiar a syscap.matriculas los registros de moodle19.mdl_context
TRUNCATE syscap.matriculas;
INSERT INTO syscap.matriculas(syscap.matriculas.id_matricula, syscap.matriculas.id_curso)
SELECT moodle19.mdl_context.id, moodle19.mdl_context.instanceid
FROM moodle19.mdl_context
WHERE moodle19.mdl_context.id IS NOT NULL AND moodle19.mdl_context.instanceid IS NOT NULL;

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
SELECT moodle19.mdl_user.id, moodle19.mdl_user.username, moodle19.mdl_user.password, moodle19.mdl_user.tipo, syscap.initcap(moodle19.mdl_user.firstname), syscap.initcap(moodle19.mdl_user.lastname), syscap.initcap(moodle19.mdl_user.apellido2), moodle19.mdl_user.dui, moodle19.mdl_user.sexo, moodle19.mdl_user.profesion, moodle19.mdl_user.nestudio, moodle19.mdl_user.email, moodle19.mdl_user.phone1, moodle19.mdl_user.phone2, moodle19.mdl_user.tinstitucion, moodle19.mdl_user.deptorec, moodle19.mdl_user.munirec, moodle19.mdl_user.country, syscap.initcap(moodle19.mdl_user.address), syscap.initcap(moodle19.mdl_user.city), moodle19.mdl_user.fnacimiento, IF(moodle19.mdl_user.auth = 'manual', 'tutorizado', IF(moodle19.mdl_user.auth = 'email', 'autoformacion', NULL)) auth
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
(1, 13.9344628, -89.0239548),	-- Suchitoto, Cuscatlan
(2, 13.6914782, -89.2146939),	-- San Salvador, San Salvador
(3, 13.6405872, -88.7839214),	-- San Vicente, San Vicente
(4, 13.71045, -89.1435517),		-- Soyapango, San Salvador
(5, 13.4910976, -89.3170369),	-- Puerto De La Libertad, La Libertad
(6, 13.8150632, -89.1726215),	-- Apopa, San Salvador
(7, 13.6771271, -89.331572),	-- Nueva San Salvador (Santa Tecla), La Libertad
(8, 13.4785173, -88.1690892),	-- San Miguel, San Miguel
(9, 13.9866054, -89.6780062),	-- Chalchuapa, Santa Ana
(10, 13.9837933, -89.5628214),	-- Santa Ana, Santa Ana
(11, 13.7391679, -89.2104026),	-- Mejicanos, San Salvador
(12, 13.6247163, -87.8940153),	-- Santa Rosa De Lima, La Union
(13, 13.7103248, -89.7300196),	-- Sonsonate, Sonsonate
(14, 13.7210174, -88.938373),	-- Cojutepeque, Cuscatlan
(15, 13.7503845, -89.057579),	-- San Martin, San Salvador
(16, 13.3432736, -88.4427738),	-- Usulutan, Usulutan
(17, 13.8762505, -89.3583689),	-- San Juan Opico, La Libertad
(18, 13.9290675, -89.8436594),	-- Ahuachapan, Ahuachapan
(19, 13.5788318, -89.2671776),	-- San Jose Villanueva, La Libertad
(20, 13.7632123, -89.0487634),	-- San Bartolome Perulapia, Cuscatlan
(21, 13.6603945, -89.1769482),	-- San Marcos, San Salvador
(22, 13.7083268, -89.3482965),	-- Colon, La Libertad
(23, 13.7534692, -89.1586547),	-- Ciudad Delgado, San Salvador
(24, 13.830604, -89.2692803),	-- Quezaltepeque, La Libertad
(25, 13.4296472, -88.5936102),	-- San Agustin, Usulutan
(26, 13.9153632, -89.8470068),	-- Centro Escolar Isidro Menendez
(27, 13.924497, -89.85044),		-- Centro Escolar Alejandro De Humboldt
(28, 13.917568, -89.846442),	-- Centro Escolar Primero De Julio De 1823
(29, 14.0227061, -88.9209365),	-- Chalatenango, Chalatenango
(30, 13.5090328, -88.8731075),	-- Zacatecoluca, La Paz
(31, 13.872746, -88.6322237),	-- Sensuntepeque, Cabañas
(32, 13.6908134, -88.0992366),	-- San Francisco Gotera, Morazan
(33, 13.3376152, -87.8486967),	-- La Union, La Union
(34, 13.8388186, -88.8543641),	-- Ilobasco, Cabañas
(35, 13.6440684, -88.8700175),	-- Verapaz, San Vicente
(36, 13.7033274, -89.4616417),	-- Tepecoyo, La Libertad
(37, 13.6700494, -88.7782622),	-- Apastepeque, San Vicente
(38, 13.6859592, -88.7881394),	-- San Esteban Catarina, San Vicente
(39, 13.8882866, -88.9599466),	-- Cinquera, Cabañas
(40, 13.6902395, -89.111048),	-- Ilopango, San Salvador
(41, 13.540327, -88.7766337),	-- Tecoluca, San Vicente
(42, 13.3561997, -87.9968499),	-- El Carmen, La Union
(43, 13.7191032, -88.8560915),	-- Santo Domingo, San Vicente
(44, 13.767689, -89.0363788),	-- San Pedro Perulapan, Cuscatlan
(45, 13.6693079, -89.2510443),	-- Antiguo Cuscatlan, La Libertad
(46, 13.8529346, -88.9062595),	-- Tejutepeque, Cabañas
(47, 13.7390616, -89.7117913),	-- Sonzacate, Sonsonate
(48, 13.5034846, -88.9241625),	-- San Rafael Obrajuelo, La Paz
(49, 13.9673659, -89.6343613),	-- San Sebastian Salitrillo, Santa Ana
(50, 14.1357432, -89.0269803),	-- San Rafael, Chalatenango
(51, 14.3272925, -89.4471216),	-- Metapan, Santa Ana
(52, 13.6511232, -88.8118866),	-- San Cayetano Istepeque, San Vicente
(53, 13.3799176, -88.3526877),	-- San Rafael Oriente, San Miguel
(54, 13.3475727, -88.387413),	-- Ereguayquin, Usulutan
(55, 13.8872399, -88.901788),	-- Jutiapa, Cabañas
(56, 13.975112, -89.7089481),	-- El Refugio, Ahuachapan
(57, 13.6398752, -89.1421438),	-- Santo Tomas, San Salvador
(58, 13.9743259, -89.7551734),	-- Atiquizaya, Ahuachapan
(59, 13.9756324, -89.3404341),	-- San Pablo Tacachico, La Libertad
(60, 13.4326377, -87.9615212),	-- San Alejo, La Union
(61, 13.9572532, -89.1843324),	-- Aguilares, San Salvador
(62, 13.9557878, -88.1571722),	-- Perquin, Morazan
(63, 13.6134522, -88.0274425),	-- Jocoro, Morazan
(64, 13.81907, -89.4307709),	-- Ciudad Arce, La Libertad
(65, 13.5418708, -89.037881),	-- San Pedro Masahuat, La Paz
(66, 13.7527084, -89.1836323),	-- Cuscatancingo, San Salvador
(67, 13.4952292, -89.0262235),	-- Rosario De La Paz, La Paz
(68, 13.6779925, -89.4360307),	-- Jayaque, La Libertad
(69, 13.5700108, -89.1152572),	-- Olocuilta, La Paz
(70, 13.3236884, -88.5616066),	-- Jiquilisco, Usulutan
(71, 14.1297502, -89.2908239),	-- Nueva Concepcion, Chalatenango
(72, 13.734299, -88.8851023),	-- San Rafael Cedros, Cuscatlan
(73, 13.7109085, -89.7590841),	-- San Antonio Del Monte, Sonsonate
(74, 13.6408958, -89.119057),	-- Santiago Texacuangos, San Salvador
(75, 13.5327463, -88.2550471),	-- Moncagua, San Miguel
(76, 13.7804787, -89.7387114),	-- Nahuizalco, Sonsonate
(77, 13.6193623, -89.7934429),	-- San Julian, Sonsonate
(79, 13.921947, -89.8449174),	-- Centro Escolar Alfredo Espino
(80, 13.6878632, -89.1868767),	-- Escuela De Educacion Parvularia San Jacinto
(81, 13.714436, -89.205852),	-- Instituto Nacional Albert Camus
(82, 13.7384192, -89.2206226),	-- Centro Escolar General Francisco Morazan
(83, 13.700678, -89.180982),	-- Centro Escolar Accion Civica Militar
(84, 13.713366, -89.180338),	-- Instituto Nacional General Francisco Menendez
(85, 13.687911, -89.185976),	-- Instituto Nacional De Comercio
(86, 13.7354, -89.196336),		-- Escuela De Educacion Parvularia  Comunidad El Prado
(87, 13.6693496, -89.2090322),	-- Centro Escolar Canton San Cristobal
(88, 13.7354, -89.196336),		-- Escuela De Educacion Parvularia Colonia Centro America
(89, 13.7240354, -89.1248218),	-- Centro Escolar El Progreso
(90, 13.717931, -89.167772),	-- Centro Escolar Juana Lopez
(91, 13.8278963,-89.2777986);	-- Centro Escolar  Juan Ramon Jimenez
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
UPDATE municipios SET id_mapa = 24 WHERE id_municipio = '54';
UPDATE municipios SET id_mapa = 25 WHERE id_municipio = '82';
UPDATE municipios SET id_mapa = 29 WHERE id_municipio = '154';
UPDATE municipios SET id_mapa = 30 WHERE id_municipio = '132';
UPDATE municipios SET id_mapa = 31 WHERE id_municipio = '254';
UPDATE municipios SET id_mapa = 32 WHERE id_municipio = '215';
UPDATE municipios SET id_mapa = 33 WHERE id_municipio = '114';
UPDATE municipios SET id_mapa = 34 WHERE id_municipio = '255';
UPDATE municipios SET id_mapa = 35 WHERE id_municipio = '249';
UPDATE municipios SET id_mapa = 36 WHERE id_municipio = '64';
UPDATE municipios SET id_mapa = 37 WHERE id_municipio = '244';
UPDATE municipios SET id_mapa = 38 WHERE id_municipio = '245';
UPDATE municipios SET id_mapa = 39 WHERE id_municipio = '261';
UPDATE municipios SET id_mapa = 40 WHERE id_municipio = '07';
UPDATE municipios SET id_mapa = 41 WHERE id_municipio = '242';
UPDATE municipios SET id_mapa = 42 WHERE id_municipio = '119';
UPDATE municipios SET id_mapa = 43 WHERE id_municipio = '251';
UPDATE municipios SET id_mapa = 44 WHERE id_municipio = '189';
UPDATE municipios SET id_mapa = 45 WHERE id_municipio = '59';
UPDATE municipios SET id_mapa = 46 WHERE id_municipio = '259';
UPDATE municipios SET id_mapa = 47 WHERE id_municipio = '105';
UPDATE municipios SET id_mapa = 48 WHERE id_municipio = '141';
UPDATE municipios SET id_mapa = 49 WHERE id_municipio = '27';
UPDATE municipios SET id_mapa = 50 WHERE id_municipio = '168';
UPDATE municipios SET id_mapa = 51 WHERE id_municipio = '22';
UPDATE municipios SET id_mapa = 52 WHERE id_municipio = '252';
UPDATE municipios SET id_mapa = 53 WHERE id_municipio = '39';
UPDATE municipios SET id_mapa = 54 WHERE id_municipio = '92';
UPDATE municipios SET id_mapa = 55 WHERE id_municipio = '258';
UPDATE municipios SET id_mapa = 56 WHERE id_municipio = '214';
UPDATE municipios SET id_mapa = 57 WHERE id_municipio = '14';
UPDATE municipios SET id_mapa = 58 WHERE id_municipio = '204';
UPDATE municipios SET id_mapa = 59 WHERE id_municipio = '61';
UPDATE municipios SET id_mapa = 60 WHERE id_municipio = '117';
UPDATE municipios SET id_mapa = 61 WHERE id_municipio = '12';
UPDATE municipios SET id_mapa = 62 WHERE id_municipio = '236';
UPDATE municipios SET id_mapa = 63 WHERE id_municipio = '216';
UPDATE municipios SET id_mapa = 64 WHERE id_municipio = '55';
UPDATE municipios SET id_mapa = 65 WHERE id_municipio = '135';
UPDATE municipios SET id_mapa = 66 WHERE id_municipio = '05';
UPDATE municipios SET id_mapa = 67 WHERE id_municipio = '140';
UPDATE municipios SET id_mapa = 68 WHERE id_municipio = '62';
UPDATE municipios SET id_mapa = 69 WHERE id_municipio = '136';
UPDATE municipios SET id_mapa = 70 WHERE id_municipio = '76';
UPDATE municipios SET id_mapa = 71 WHERE id_municipio = '155';
UPDATE municipios SET id_mapa = 72 WHERE id_municipio = '192';
UPDATE municipios SET id_mapa = 73 WHERE id_municipio = '106';
UPDATE municipios SET id_mapa = 74 WHERE id_municipio = '15';
UPDATE municipios SET id_mapa = 75 WHERE id_municipio = '40';
UPDATE municipios SET id_mapa = 76 WHERE id_municipio = '102';
UPDATE municipios SET id_mapa = 77 WHERE id_municipio = '104';
UPDATE departamentos SET id_mapa = 2 WHERE id_departamento = '01';
UPDATE departamentos SET id_mapa = 3 WHERE id_departamento = '13';
UPDATE departamentos SET id_mapa = 7 WHERE id_departamento = '04';
UPDATE departamentos SET id_mapa = 8 WHERE id_departamento = '03';
UPDATE departamentos SET id_mapa = 10 WHERE id_departamento = '02';
UPDATE departamentos SET id_mapa = 13 WHERE id_departamento = '06';
UPDATE departamentos SET id_mapa = 14 WHERE id_departamento = '10';
UPDATE departamentos SET id_mapa = 16 WHERE id_departamento = '05';
UPDATE departamentos SET id_mapa = 18 WHERE id_departamento = '11';
UPDATE departamentos SET id_mapa = 29 WHERE id_departamento = '09';
UPDATE departamentos SET id_mapa = 30 WHERE id_departamento = '08';
UPDATE departamentos SET id_mapa = 31 WHERE id_departamento = '14';
UPDATE departamentos SET id_mapa = 32 WHERE id_departamento = '12';
UPDATE departamentos SET id_mapa = 33 WHERE id_departamento = '07';
UPDATE centros_educativos SET id_mapa = 26 WHERE id_centro_educativo = 1;
UPDATE centros_educativos SET id_mapa = 27 WHERE id_centro_educativo = 3;
UPDATE centros_educativos SET id_mapa = 28 WHERE id_centro_educativo = 4;
UPDATE centros_educativos SET id_mapa = 79 WHERE id_centro_educativo = 2;
UPDATE centros_educativos SET id_mapa = 80 WHERE id_centro_educativo = 148;
UPDATE centros_educativos SET id_mapa = 81 WHERE id_centro_educativo = 1128;
UPDATE centros_educativos SET id_mapa = 82 WHERE id_centro_educativo = 1134;
UPDATE centros_educativos SET id_mapa = 83 WHERE id_centro_educativo = 1135;
UPDATE centros_educativos SET id_mapa = 84 WHERE id_centro_educativo = 1139;
UPDATE centros_educativos SET id_mapa = 85 WHERE id_centro_educativo = 1141;
UPDATE centros_educativos SET id_mapa = 86 WHERE id_centro_educativo = 1146;
UPDATE centros_educativos SET id_mapa = 87 WHERE id_centro_educativo = 1163;
UPDATE centros_educativos SET id_mapa = 88 WHERE id_centro_educativo = 1164;
UPDATE centros_educativos SET id_mapa = 89 WHERE id_centro_educativo = 1170;
UPDATE centros_educativos SET id_mapa = 90 WHERE id_centro_educativo = 1177;
UPDATE centros_educativos SET id_mapa = 91 WHERE id_centro_educativo = 1180;
