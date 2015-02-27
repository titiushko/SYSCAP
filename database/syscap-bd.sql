DROP DATABASE IF EXISTS syscap;
CREATE DATABASE IF NOT EXISTS syscap DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE syscap;

CREATE TABLE IF NOT EXISTS departamentos(
	id_departamento VARCHAR(2) NOT NULL COMMENT 'Identificador de un departamento. Los valores de esté campo se obtendrán del campo <id> de Moodle usando ETL.',
	nombre_departamento VARCHAR(255) NOT NULL COMMENT 'Nombre completo de un departamento. Los valores de esté campo se obtendrán del campo <deptos> de Moodle usando ETL.',
	id_mapa BIGINT(10) COMMENT 'Identificador de una coordenada para ubicar a un departamento en el mapa.',
	PRIMARY KEY(id_departamento)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT 'Catálogo de nombres de los departamentos de El Salvador. Los registros de está tabla se obtendrán de la tabla <mdl_cat_deptos> de Moodle usando ETL.';

CREATE TABLE IF NOT EXISTS centros_educativos(
	id_centro_educativo INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador de un centro educativo. Los valores de esté campo se obtendrán del campo <row_id> de Moodle usando ETL.',
	codigo_centro_educativo VARCHAR(5) NOT NULL COMMENT 'Código de un centro educativo. Los valores de esté campo se obtendrán del campo <codigo_entidad> de Moodle usando ETL.',
	nombre_centro_educativo VARCHAR(150) DEFAULT NULL COMMENT 'Nombre completo de un centro educativo. Los valores de esté campo se obtendrán del campo <nombre> de Moodle usando ETL.',
	id_departamento VARCHAR(2) NOT NULL COMMENT 'Identificador del departamento al que pertenece un centro educativo. Los valores de esté campo se obtendrán del campo <depto> de Moodle usando ETL.',
	id_municipio VARCHAR(3) NOT NULL COMMENT 'Identificador del municipio al que pertenece un centro educativo. Los valores de esté campo se obtendrán del campo <muni> de Moodle usando ETL.',
	id_mapa BIGINT(10) COMMENT 'Identificador de una coordenada para ubicar a un centro educativo en el mapa.',
	PRIMARY KEY(id_centro_educativo)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT 'Catálogo de centros educativos. Los registros de está tabla se obtendrán de la tabla <mdl_cat_educativa> de Moodle usando ETL.' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS municipios(
	id_municipio VARCHAR(3) NOT NULL COMMENT 'Identificador de un municipio. Los valores de esté campo se obtendrán del campo <id> de Moodle usando ETL.',
	id_departamento VARCHAR(2) NOT NULL COMMENT 'Identificador del departamento al que pertenece un municipio. Los valores de esté campo se obtendrán del campo <relacion> de Moodle usando ETL.',
	nombre_municipio VARCHAR(255) NOT NULL COMMENT 'Nombre completo de un municipio. Los valores de esté campo se obtendrán del campo <opcion> de Moodle usando ETL.',
	id_mapa BIGINT(10) COMMENT 'Identificador de una coordenada para ubicar a un municipio en el mapa.',
	PRIMARY KEY(id_municipio)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT 'Catálogo de nombres de los municipios de El Salvador. Los registros de está tabla se obtendrán de la tabla <mdl_cat_municip> de Moodle usando ETL.';

CREATE TABLE IF NOT EXISTS niveles_estudios(
	id_nivel_estudio INT(4) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador de un nivel de estudio. Los valores de esté campo se obtendrán del campo <cod_nestudio> de Moodle usando ETL.',
	nombre_nivel_estudio VARCHAR(100) NOT NULL COMMENT 'Nombre completo de un nivel de estudio. Los valores de esté campo se obtendrán del campo <descripcion> de Moodle usando ETL.',
	PRIMARY KEY(id_nivel_estudio)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT 'Catálogo de niveles de estudios. Los registros de está tabla se obtendrán de la tabla <mdl_cat_nestudio> de Moodle usando ETL.' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS profesiones(
  id_profesion VARCHAR(3) NOT NULL COMMENT 'Identificador de una profesión. Los valores de esté campo se obtendrán del campo <cod_profesion> de Moodle usando ETL.',
  nombre_profesion VARCHAR(100) NOT NULL COMMENT 'Nombre completo de una profesión. Los valores de esté campo se obtendrán del campo <descripcion> de Moodle usando ETL.',
  PRIMARY KEY(id_profesion)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT 'Catálogo de nombres de las profesiones. Los registros de está tabla se obtendrán de la tabla <mdl_cat_profesion> de Moodle usando ETL.';

CREATE TABLE IF NOT EXISTS matriculas(
	id_matricula BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador de  una matricula. Los valores de esté campo se obtendrán del campo <id> de Moodle usando ETL.',
	id_curso BIGINT(10) UNSIGNED NOT NULL COMMENT 'Identificador del curso al que pertenece una matricula. Los valores de esté campo se obtendrán del campo <instanceid> de Moodle usando ETL.',
	PRIMARY KEY(id_matricula)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT 'Información de las matriculas de usuarios con mdl_course. Los registros de está tabla se obtendrán de la tabla <mdl_context> de Moodle usando ETL.' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS cursos(
	id_curso BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador de  un curso. Los valores de esté campo se obtendrán del campo <id> de Moodle usando ETL.',
	nombre_completo_curso VARCHAR(255) NOT NULL COMMENT 'Nombre completo de un curso. Los valores de esté campo se obtendrán del campo <fullname> de Moodle usando ETL.',
	nombre_corto_curso VARCHAR(100) NOT NULL COMMENT 'Nombre corto de un curso. Los valores de esté campo se obtendrán del campo <shortname> de Moodle usando ETL.',
	PRIMARY KEY(id_curso)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT 'Información central de los cursos. Los registros de está tabla se obtendrán de la tabla <mdl_course> de Moodle usando ETL.' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS examenes(
	id_examen BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador de  un examen. Los valores de esté campo se obtendrán del campo <id> de Moodle usando ETL.',
	id_curso BIGINT(10) UNSIGNED NOT NULL COMMENT 'Identificador del curso al que pertenece un examen. Los valores de esté campo se obtendrán del campo <course> de Moodle usando ETL.',
	nombre_examen VARCHAR(255) NOT NULL COMMENT 'Nombre completo de un examen. Los valores de esté campo se obtendrán del campo <name> de Moodle usando ETL.',
	PRIMARY KEY(id_examen)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT 'Información principal de cada examen. Los registros de está tabla se obtendrán de la tabla <mdl_quiz> de Moodle usando ETL.' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS examenes_calificaciones(
	id_examen_calificacion BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la calificación un examen final. Los valores de esté campo se obtendrán del campo <id> de Moodle usando ETL.',
	id_examen BIGINT(10) UNSIGNED NOT NULL COMMENT 'Identificador del examen al que pertenece la calificación un examen final. Los valores de esté campo se obtendrán del campo <quiz> de Moodle usando ETL.',
	id_usuario BIGINT(10) UNSIGNED NOT NULL COMMENT 'Identificador del usuario al que pertenece la calificación un examen final. Los valores de esté campo se obtendrán del campo <userid> de Moodle usando ETL.',
	nota_examen_calificacion DOUBLE NOT NULL COMMENT 'Calificación de un examen final. Los valores de esté campo se obtendrán del campo <grade> de Moodle usando ETL.',
	fecha_examen_calificacion DATE NULL DEFAULT NULL COMMENT 'Fecha de un examen final. Los valores de esté campo se obtendrán del campo <timemodified> de Moodle usando ETL.',
	PRIMARY KEY(id_examen_calificacion)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT 'Información de las calificaciones de cada examen final. Los registros de está tabla se obtendrán de la tabla <mdl_quiz_grades> de Moodle usando ETL.' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS roles(
	id_rol BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador de un rol de Moodle. Los valores de esté campo se obtendrán del campo <id> de Moodle usando ETL.',
	nombre_completo_rol VARCHAR(255) NOT NULL COMMENT 'Nombre completo de un rol de Moodle. Los valores de esté campo se obtendrán del campo <name> de Moodle usando ETL.',
	nombre_corto_rol VARCHAR(100) NOT NULL COMMENT 'Nombre corto de un rol de Moodle. Los valores de esté campo se obtendrán del campo <shortname> de Moodle usando ETL.',
	descripcion_rol TEXT NOT NULL COMMENT 'Descripción de un rol de Moodle. Los valores de esté campo se obtendrán del campo <description> de Moodle usando ETL.',
	criterio_rol BIGINT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Criterio de un rol de Moodle. Los valores de esté campo se obtendrán del campo <sortorder> de Moodle usando ETL.',
	PRIMARY KEY(id_rol)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT 'Catálogo de roles de Moodle. Los registros de está tabla se obtendrán de la tabla <mdl_role> de Moodle usando ETL.' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS roles_asignados(
	id_rol_asignado BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador de un rol asignado. Los valores de esté campo se obtendrán del campo <id> de Moodle usando ETL.',
	id_rol BIGINT(10) UNSIGNED NOT NULL COMMENT 'Identificador del rol de Moodle al que pertenece un rol asignado. Los valores de esté campo se obtendrán del campo <roleid> de Moodle usando ETL.',
	id_matricula BIGINT(10) UNSIGNED NOT NULL COMMENT 'Identificador de la matricula al que pertenece un rol asignado. Los valores de esté campo se obtendrán del campo <contextid> de Moodle usando ETL.',
	id_usuario BIGINT(10) UNSIGNED NOT NULL COMMENT 'Identificador del usuario al que pertenece un rol asignado. Los valores de esté campo se obtendrán del campo <userid> de Moodle usando ETL.',
	PRIMARY KEY(id_rol_asignado)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT 'Información de la asignación de roles o funciones a diferentes matriculas o contexts. Los registros de está tabla se obtendrán de la tabla <mdl_role_assignments> de Moodle usando ETL.' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS usuarios(
	id_usuario BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador de un usuario. Los valores de esté campo se obtendrán del campo <id> de Moodle usando ETL.',
	nombre_usuario VARCHAR(100) NOT NULL COMMENT 'Nombre corto o Alias de un usuario. Los valores de esté campo se obtendrán del campo <username> de Moodle usando ETL.',
	contrasena_usuario VARCHAR(32) NOT NULL COMMENT 'Contraseña de un usuario. Los valores de esté campo se obtendrán del campo <password> de Moodle usando ETL.',
	id_tipo_usuario INT(4) NOT NULL COMMENT 'Identificador del tipo de usuario al que pertenece un usuario. Los valores de esté campo se obtendrán del campo <tipo> de Moodle usando ETL.',
	nombres_usuario VARCHAR(100) NOT NULL COMMENT 'Nombres completos de un usuario. Los valores de esté campo se obtendrán del campo <firstname> de Moodle usando ETL.',
	apellido1_usuario VARCHAR(100) NOT NULL COMMENT 'Primer Apellido de un usuario. Los valores de esté campo se obtendrán del campo <lastname> de Moodle usando ETL.',
	apellido2_usuario VARCHAR(100) DEFAULT NULL COMMENT 'Segundo Apellido de un usuario. Los valores de esté campo se obtendrán del campo <apellido2> de Moodle usando ETL.',
	dui_usuario VARCHAR(10) DEFAULT NULL COMMENT 'Número del documento único de identidad de un usuario. Los valores de esté campo se obtendrán del campo <dui> de Moodle usando ETL.',
	sexo_usuario CHAR(2) NOT NULL COMMENT 'Genero de un usuario. Los valores de esté campo se obtendrán del campo <sexo> de Moodle usando ETL.',
	id_profesion VARCHAR(3) DEFAULT NULL COMMENT 'Identificador de la profesión de un usuario. Los valores de esté campo se obtendrán del campo <profesion> de Moodle usando ETL.',
	id_nivel_estudio INT(4) DEFAULT NULL COMMENT 'Identificador del nivel de estudio al que pertenece un usuario. Los valores de esté campo se obtendrán del campo <nestudio> de Moodle usando ETL.',
	correo_electronico_usuario VARCHAR(100) NOT NULL COMMENT 'Correo electrónico principal de un usuario. Los valores de esté campo se obtendrán del campo <email> de Moodle usando ETL.',
	telefono1_usuario VARCHAR(12) DEFAULT NULL COMMENT 'Número telefónico principal de un usuario. Los valores de esté campo se obtendrán del campo <phone1> de Moodle usando ETL.',
	telefono2_usuario VARCHAR(12) DEFAULT NULL COMMENT 'Número telefónico secundario de un usuario. Los valores de esté campo se obtendrán del campo <phone2> de Moodle usando ETL.',
	id_centro_educativo INT(10) DEFAULT NULL COMMENT 'Identificador del centro educativo al que pertenece un usuario. Los valores de esté campo se obtendrán del campo <tinstitucion> de Moodle usando ETL.',
	id_departamento VARCHAR(2) NOT NULL COMMENT 'Identificador del departamento al que pertenece un usuario. Los valores de esté campo se obtendrán del campo <deptorec> de Moodle usando ETL.',
	id_municipio VARCHAR(3) NOT NULL COMMENT 'Identificador del municipio al que pertenece un usuario. Los valores de esté campo se obtendrán del campo <munirec> de Moodle usando ETL.',
	pais_usuario VARCHAR(2) DEFAULT NULL COMMENT 'Código de país al que pertenece un usuario. Los valores de esté campo se obtendrán del campo <country> de Moodle usando ETL.',
	direccion_usuario VARCHAR(200) DEFAULT NULL COMMENT 'Dirección del domicilio de un usuario. Los valores de esté campo se obtendrán del campo <address> de Moodle usando ETL.',
	ciudad_usuario VARCHAR(20) NOT NULL COMMENT 'Nombre de la ciudad a la que pertenece un usuario. Los valores de esté campo se obtendrán del campo <city> de Moodle usando ETL.',
	fecha_nacimiento_usuario DATE DEFAULT NULL COMMENT 'Fecha de nacimiento de un usuario. Los valores de esté campo se obtendrán del campo <fnacimiento> de Moodle usando ETL.',
	modalidad_usuario VARCHAR(30) DEFAULT NULL COMMENT 'Modalidad de capacitación de un usuario. Los valores de esté campo se obtendrán del campo <auth> de Moodle usando ETL.',
	PRIMARY KEY(id_usuario)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT 'Información de usuarios. Los registros de está tabla se obtendrán de la tabla <mdl_user> de Moodle usando ETL.' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS bitacoras(
	id_bitacora BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador de bitacora.',
	id_usuario BIGINT(10) UNSIGNED COMMENT 'Identificador del registro de la tabla usuarios sobre el cual se realiza la acción.',
	id_centro_educativo INT(10) UNSIGNED COMMENT 'Identificador del registro de la tabla centros_educativos sobre el cual se realiza la acción.',
	usuario_bitacora VARCHAR(100) NOT NULL COMMENT 'Nombre del usuario de base de datos que realiza la acción.',
	fecha_bitacora DATETIME NOT NULL COMMENT 'Fecha actual del servidor cuando se realiza la acción.',
	accion_bitacora TEXT NOT NULL COMMENT 'Comentario de la acción realizada.',
	PRIMARY KEY(id_bitacora)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT 'Información de las acciones realizadas por los usuarios.' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS tipos_usuarios(
	id_tipo_usuario INT(4) UNSIGNED NOT NULL AUTO_INCREMENT,
	nombre_tipo_usuario VARCHAR(255),
	PRIMARY KEY(id_tipo_usuario)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT 'Catálogo de los tipos de usuarios.' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS mapas(
	id_mapa BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador de una coordenada en el mapa.',
	longitud_mapa DOUBLE NOT NULL COMMENT 'Posición en el eje X de una coordenada del mapa.',
	latitud_mapa DOUBLE NOT NULL COMMENT 'Posición en el eje Y de una coordenada del mapa.',
	PRIMARY KEY(id_mapa)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT 'Coordenadas de puntos en el mapa.' AUTO_INCREMENT=1;

ALTER TABLE bitacoras ADD CONSTRAINT fk_bitacoras_usuarios
FOREIGN KEY(id_usuario) REFERENCES usuarios(id_usuario);

ALTER TABLE centros_educativos ADD CONSTRAINT fk_centros_educativos_departamentos
FOREIGN KEY(id_departamento) REFERENCES departamentos(id_departamento);

ALTER TABLE centros_educativos ADD CONSTRAINT fk_centros_educativos_mapas
FOREIGN KEY(id_mapa) REFERENCES mapas(id_mapa);

ALTER TABLE centros_educativos ADD CONSTRAINT fk_centros_educativos_municipios
FOREIGN KEY(id_municipio) REFERENCES municipios(id_municipio);

ALTER TABLE departamentos ADD CONSTRAINT fk_departamentos_mapas
FOREIGN KEY(id_mapa) REFERENCES mapas(id_mapa);

ALTER TABLE matriculas ADD CONSTRAINT fk_matriculas_cursos
FOREIGN KEY(id_curso) REFERENCES cursos(id_curso) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE examenes ADD CONSTRAINT fk_examenes_cursos
FOREIGN KEY(id_curso) REFERENCES cursos(id_curso);

ALTER TABLE examenes_calificaciones ADD CONSTRAINT fk_examenes_calificaciones_usuarios
FOREIGN KEY(id_usuario) REFERENCES usuarios(id_usuario);

ALTER TABLE examenes_calificaciones ADD CONSTRAINT fk_examenes_calificaciones_examenes
FOREIGN KEY(id_examen) REFERENCES examenes(id_examen);

ALTER TABLE municipios ADD CONSTRAINT fk_municipios_departamentos
FOREIGN KEY(id_departamento) REFERENCES departamentos(id_departamento);

ALTER TABLE municipios ADD CONSTRAINT fk_municipios_mapas
FOREIGN KEY(id_mapa) REFERENCES mapas(id_mapa);

ALTER TABLE roles_asignados ADD CONSTRAINT fk_roles_asignados_roles
FOREIGN KEY(id_rol) REFERENCES roles(id_rol);

ALTER TABLE roles_asignados ADD CONSTRAINT fk_roles_asignados_usuarios
FOREIGN KEY(id_usuario) REFERENCES usuarios(id_usuario);

ALTER TABLE roles_asignados ADD CONSTRAINT fk_roles_asignados_matriculas
FOREIGN KEY(id_matricula) REFERENCES matriculas(id_matricula);

ALTER TABLE usuarios ADD CONSTRAINT fk_usuarios_centros_educativos
FOREIGN KEY(id_centro_educativo) REFERENCES centros_educativos(id_centro_educativo);

ALTER TABLE usuarios ADD CONSTRAINT fk_usuarios_niveles_estudios
FOREIGN KEY(id_nivel_estudio) REFERENCES niveles_estudios(id_nivel_estudio);

ALTER TABLE usuarios ADD CONSTRAINT fk_usuarios_tipos_usuarios
FOREIGN KEY(id_tipo_usuario) REFERENCES tipos_usuarios(id_tipo_usuario);

ALTER TABLE usuarios ADD CONSTRAINT fk_usuarios_departamentos
FOREIGN KEY(id_departamento) REFERENCES departamentos(id_departamento);

ALTER TABLE usuarios ADD CONSTRAINT fk_usuarios_municipios
FOREIGN KEY(id_municipio) REFERENCES municipios(id_municipio);

ALTER TABLE usuarios ADD CONSTRAINT fk_usuarios_profesiones
FOREIGN KEY(id_profesion) REFERENCES profesiones(id_profesion);