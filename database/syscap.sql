-- ============================================================================================================================================================
-- INSTRUCCIONES
-- ============================================================================================================================================================

/*
 * Usar "buscar y reemplazar" para reemplazar lo siguiente:
 * Reemplace moodle19 por el nombre de la base de datos de MOODLE con la que se comunicará la base de datos de SYSCAP.
 */

-- ============================================================================================================================================================
-- CREAR USUARIO SYSCAP
-- ============================================================================================================================================================

-- Crear el usuario
CREATE USER 'syscap'@'%' IDENTIFIED BY 'moodle$198', 'syscap'@'localhost' IDENTIFIED BY 'moodle$198', 'syscap'@'127.0.0.1' IDENTIFIED BY 'moodle$198';

-- Asignar los permiso al usuario para la base de datos SYSCAP
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, INDEX, ALTER, CREATE VIEW, EVENT, TRIGGER, SHOW VIEW, CREATE ROUTINE, ALTER ROUTINE, EXECUTE
ON syscap.* TO 'syscap'@'%', 'syscap'@'localhost', 'syscap'@'127.0.0.1'
WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;

-- Asignar los permiso al usuario para la base de datos moodle19
GRANT SELECT ON moodle19.* TO 'syscap'@'%', 'syscap'@'localhost', 'syscap'@'127.0.0.1';
GRANT UPDATE(nombre, depto, muni) ON moodle19.mdl_cat_educativa TO 'syscap'@'%', 'syscap'@'localhost', 'syscap'@'127.0.0.1';
GRANT UPDATE(username, password, firstname, lastname, email, phone1, phone2, address, city, country, tipo, dui, apellido2, deptorec, munirec, sexo, profesion, nestudio, tinstitucion, fnacimiento) ON moodle19.mdl_user TO 'syscap'@'%', 'syscap'@'localhost', 'syscap'@'127.0.0.1';

-- ============================================================================================================================================================
-- CREAR BASE DE DATOS SYSCAP
-- ============================================================================================================================================================

DROP DATABASE IF EXISTS syscap;
CREATE DATABASE IF NOT EXISTS syscap DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE syscap;

CREATE TABLE IF NOT EXISTS departamentos(
	id_departamento VARCHAR(2) NOT NULL COMMENT 'Identificador de un departamento. Los valores de este campo se obtendran del campo <id> de Moodle usando ETL.',
	nombre_departamento VARCHAR(255) NOT NULL COMMENT 'Nombre completo de un departamento. Los valores de este campo se obtendran del campo <deptos> de Moodle usando ETL.',
	id_mapa BIGINT(10) COMMENT 'Identificador de una coordenada para ubicar a un departamento en el mapa.',
	PRIMARY KEY(id_departamento)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT 'Catalogo de nombres de los departamentos de El Salvador. Los registros de esta tabla se obtendran de la tabla <mdl_cat_deptos> de Moodle usando ETL.';

CREATE TABLE IF NOT EXISTS centros_educativos(
	id_centro_educativo INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador de un centro educativo. Los valores de este campo se obtendran del campo <row_id> de Moodle usando ETL.',
	codigo_centro_educativo VARCHAR(5) NOT NULL COMMENT 'Codigo de un centro educativo. Los valores de este campo se obtendran del campo <codigo_entidad> de Moodle usando ETL.',
	nombre_centro_educativo VARCHAR(150) DEFAULT NULL COMMENT 'Nombre completo de un centro educativo. Los valores de este campo se obtendran del campo <nombre> de Moodle usando ETL.',
	id_departamento VARCHAR(2) NOT NULL COMMENT 'Identificador del departamento al que pertenece un centro educativo. Los valores de este campo se obtendran del campo <depto> de Moodle usando ETL.',
	id_municipio VARCHAR(3) NOT NULL COMMENT 'Identificador del municipio al que pertenece un centro educativo. Los valores de este campo se obtendran del campo <muni> de Moodle usando ETL.',
	id_mapa BIGINT(10) COMMENT 'Identificador de una coordenada para ubicar a un centro educativo en el mapa.',
	PRIMARY KEY(id_centro_educativo)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT 'Catalogo de centros educativos. Los registros de esta tabla se obtendran de la tabla <mdl_cat_educativa> de Moodle usando ETL.' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS municipios(
	id_municipio VARCHAR(3) NOT NULL COMMENT 'Identificador de un municipio. Los valores de este campo se obtendran del campo <id> de Moodle usando ETL.',
	id_departamento VARCHAR(2) NOT NULL COMMENT 'Identificador del departamento al que pertenece un municipio. Los valores de este campo se obtendran del campo <relacion> de Moodle usando ETL.',
	nombre_municipio VARCHAR(255) NOT NULL COMMENT 'Nombre completo de un municipio. Los valores de este campo se obtendran del campo <opcion> de Moodle usando ETL.',
	id_mapa BIGINT(10) COMMENT 'Identificador de una coordenada para ubicar a un municipio en el mapa.',
	PRIMARY KEY(id_municipio)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT 'Catalogo de nombres de los municipios de El Salvador. Los registros de esta tabla se obtendran de la tabla <mdl_cat_municip> de Moodle usando ETL.';

CREATE TABLE IF NOT EXISTS niveles_estudios(
	id_nivel_estudio INT(4) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador de un nivel de estudio. Los valores de este campo se obtendran del campo <cod_nestudio> de Moodle usando ETL.',
	nombre_nivel_estudio VARCHAR(100) NOT NULL COMMENT 'Nombre completo de un nivel de estudio. Los valores de este campo se obtendran del campo <descripcion> de Moodle usando ETL.',
	PRIMARY KEY(id_nivel_estudio)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT 'Catalogo de niveles de estudios. Los registros de esta tabla se obtendran de la tabla <mdl_cat_nestudio> de Moodle usando ETL.' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS profesiones(
	id_profesion VARCHAR(3) NOT NULL COMMENT 'Identificador de una profesion. Los valores de este campo se obtendran del campo <cod_profesion> de Moodle usando ETL.',
	nombre_profesion VARCHAR(100) NOT NULL COMMENT 'Nombre completo de una profesion. Los valores de este campo se obtendran del campo <descripcion> de Moodle usando ETL.',
	PRIMARY KEY(id_profesion)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT 'Catalogo de nombres de las profesiones. Los registros de esta tabla se obtendran de la tabla <mdl_cat_profesion> de Moodle usando ETL.';

CREATE TABLE IF NOT EXISTS cursos_categorias(
	id_curso_categoria BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la categoria de cursos. Los valores de este campo se obtendran del campo <id> de Moodle usando ETL.',
	nombre_curso_categoria VARCHAR(255) NOT NULL COMMENT 'Nombre completo de la categoria de cursos. Los valores de este campo se obtendran del campo <name> de Moodle usando ETL.',
	padre_curso_categoria BIGINT(10) UNSIGNED NOT NULL COMMENT 'Identificador de la categoria padre a la que pertenece una categoria. Los valores de este campo se obtendran del campo <parent> de Moodle usando ETL.',
	PRIMARY KEY (id_curso_categoria)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT 'Informacion las categorias de los cursos. Los registros de esta tabla se obtendran de la tabla <mdl_course_categories> de Moodle usando ETL.' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS cursos(
	id_curso BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador de un curso. Los valores de este campo se obtendran del campo <id> de Moodle usando ETL.',
	id_curso_categoria BIGINT(10) UNSIGNED NOT NULL COMMENT 'Identificador de la categoria a la que pertenece un curso. Los valores de este campo se obtendran del campo <category> de Moodle usando ETL.',
	nombre_completo_curso VARCHAR(255) NOT NULL COMMENT 'Nombre completo de un curso. Los valores de este campo se obtendran del campo <fullname> de Moodle usando ETL.',
	nombre_corto_curso VARCHAR(100) NOT NULL COMMENT 'Nombre corto de un curso. Los valores de este campo se obtendran del campo <shortname> de Moodle usando ETL.',
	PRIMARY KEY(id_curso)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT 'Informacion central de los cursos. Los registros de esta tabla se obtendran de la tabla <mdl_course> de Moodle usando ETL.' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS matriculas(
	id_matricula BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador de una matricula. Los valores de este campo se obtendran del campo <id> de Moodle usando ETL.',
	id_curso BIGINT(10) UNSIGNED NOT NULL COMMENT 'Identificador del curso al que pertenece una matricula. Los valores de este campo se obtendran del campo <instanceid> de Moodle usando ETL.',
	PRIMARY KEY(id_matricula)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT 'Informacion de las matriculas de usuarios con mdl_course. Los registros de esta tabla se obtendran de la tabla <mdl_context> de Moodle usando ETL.' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS examenes(
	id_examen BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador de un examen. Los valores de este campo se obtendran del campo <id> de Moodle usando ETL.',
	id_curso BIGINT(10) UNSIGNED NOT NULL COMMENT 'Identificador del curso al que pertenece un examen. Los valores de este campo se obtendran del campo <course> de Moodle usando ETL.',
	nombre_examen VARCHAR(255) NOT NULL COMMENT 'Nombre completo de un examen. Los valores de este campo se obtendran del campo <name> de Moodle usando ETL.',
	PRIMARY KEY(id_examen)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT 'Informacion principal de cada examen. Los registros de esta tabla se obtendran de la tabla <mdl_quiz> de Moodle usando ETL.' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS examenes_calificaciones(
	id_examen_calificacion BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la calificacion un examen final. Los valores de este campo se obtendran del campo <id> de Moodle usando ETL.',
	id_examen BIGINT(10) UNSIGNED NOT NULL COMMENT 'Identificador del examen al que pertenece la calificacion un examen final. Los valores de este campo se obtendran del campo <quiz> de Moodle usando ETL.',
	id_usuario BIGINT(10) UNSIGNED NOT NULL COMMENT 'Identificador del usuario al que pertenece la calificacion un examen final. Los valores de este campo se obtendran del campo <userid> de Moodle usando ETL.',
	nota_examen_calificacion DOUBLE NOT NULL COMMENT 'Calificacion de un examen final. Los valores de este campo se obtendran del campo <grade> de Moodle usando ETL.',
	fecha_examen_calificacion DATE NULL DEFAULT NULL COMMENT 'Fecha de un examen final. Los valores de este campo se obtendran del campo <timemodified> de Moodle usando ETL.',
	PRIMARY KEY(id_examen_calificacion)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT 'Informacion de las calificaciones de cada examen final. Los registros de esta tabla se obtendran de la tabla <mdl_quiz_grades> de Moodle usando ETL.' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS roles(
	id_rol BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador de un rol de Moodle. Los valores de este campo se obtendran del campo <id> de Moodle usando ETL.',
	nombre_completo_rol VARCHAR(255) NOT NULL COMMENT 'Nombre completo de un rol de Moodle. Los valores de este campo se obtendran del campo <name> de Moodle usando ETL.',
	nombre_corto_rol VARCHAR(100) NOT NULL COMMENT 'Nombre corto de un rol de Moodle. Los valores de este campo se obtendran del campo <shortname> de Moodle usando ETL.',
	descripcion_rol TEXT NOT NULL COMMENT 'Descripcion de un rol de Moodle. Los valores de este campo se obtendran del campo <description> de Moodle usando ETL.',
	PRIMARY KEY(id_rol)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT 'Catalogo de roles de Moodle. Los registros de esta tabla se obtendran de la tabla <mdl_role> de Moodle usando ETL.' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS roles_asignados(
	id_rol_asignado BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador de un rol asignado. Los valores de este campo se obtendran del campo <id> de Moodle usando ETL.',
	id_rol BIGINT(10) UNSIGNED NOT NULL COMMENT 'Identificador del rol de Moodle al que pertenece un rol asignado. Los valores de este campo se obtendran del campo <roleid> de Moodle usando ETL.',
	id_matricula BIGINT(10) UNSIGNED NOT NULL COMMENT 'Identificador de la matricula al que pertenece un rol asignado. Los valores de este campo se obtendran del campo <contextid> de Moodle usando ETL.',
	id_usuario BIGINT(10) UNSIGNED NOT NULL COMMENT 'Identificador del usuario al que pertenece un rol asignado. Los valores de este campo se obtendran del campo <userid> de Moodle usando ETL.',
	PRIMARY KEY(id_rol_asignado)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT 'Informacion de la asignacion de roles o funciones a diferentes matriculas o contexts. Los registros de esta tabla se obtendran de la tabla <mdl_role_assignments> de Moodle usando ETL.' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS usuarios(
	id_usuario BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador de un usuario. Los valores de este campo se obtendran del campo <id> de Moodle usando ETL.',
	nombre_usuario VARCHAR(100) NOT NULL COMMENT 'Nombre corto o Alias de un usuario. Los valores de este campo se obtendran del campo <username> de Moodle usando ETL.',
	contrasena_usuario VARCHAR(32) NOT NULL COMMENT 'Contraseña de un usuario. Los valores de este campo se obtendran del campo <password> de Moodle usando ETL.',
	id_tipo_usuario INT(4) NOT NULL COMMENT 'Identificador del tipo de usuario al que pertenece un usuario. Los valores de este campo se obtendran del campo <tipo> de Moodle usando ETL.',
	nombres_usuario VARCHAR(100) NOT NULL COMMENT 'Nombres completos de un usuario. Los valores de este campo se obtendran del campo <firstname> de Moodle usando ETL.',
	apellido1_usuario VARCHAR(100) NOT NULL COMMENT 'Primer Apellido de un usuario. Los valores de este campo se obtendran del campo <lastname> de Moodle usando ETL.',
	apellido2_usuario VARCHAR(100) DEFAULT NULL COMMENT 'Segundo Apellido de un usuario. Los valores de este campo se obtendran del campo <apellido2> de Moodle usando ETL.',
	dui_usuario VARCHAR(10) DEFAULT NULL COMMENT 'Numero del documento unico de identidad de un usuario. Los valores de este campo se obtendran del campo <dui> de Moodle usando ETL.',
	sexo_usuario CHAR(2) NOT NULL COMMENT 'Genero de un usuario. Los valores de este campo se obtendran del campo <sexo> de Moodle usando ETL.',
	id_profesion VARCHAR(3) DEFAULT NULL COMMENT 'Identificador de la profesion de un usuario. Los valores de este campo se obtendran del campo <profesion> de Moodle usando ETL.',
	id_nivel_estudio INT(4) DEFAULT NULL COMMENT 'Identificador del nivel de estudio al que pertenece un usuario. Los valores de este campo se obtendran del campo <nestudio> de Moodle usando ETL.',
	correo_electronico_usuario VARCHAR(100) NOT NULL COMMENT 'Correo electronico principal de un usuario. Los valores de este campo se obtendran del campo <email> de Moodle usando ETL.',
	telefono1_usuario VARCHAR(12) DEFAULT NULL COMMENT 'Numero telefonico principal de un usuario. Los valores de este campo se obtendran del campo <phone1> de Moodle usando ETL.',
	telefono2_usuario VARCHAR(12) DEFAULT NULL COMMENT 'Numero telefonico secundario de un usuario. Los valores de este campo se obtendran del campo <phone2> de Moodle usando ETL.',
	id_centro_educativo INT(10) DEFAULT NULL COMMENT 'Identificador del centro educativo al que pertenece un usuario. Los valores de este campo se obtendran del campo <tinstitucion> de Moodle usando ETL.',
	id_departamento VARCHAR(2) NOT NULL COMMENT 'Identificador del departamento al que pertenece un usuario. Los valores de este campo se obtendran del campo <deptorec> de Moodle usando ETL.',
	id_municipio VARCHAR(3) NOT NULL COMMENT 'Identificador del municipio al que pertenece un usuario. Los valores de este campo se obtendran del campo <munirec> de Moodle usando ETL.',
	pais_usuario VARCHAR(2) DEFAULT NULL COMMENT 'Codigo de pais al que pertenece un usuario. Los valores de este campo se obtendran del campo <country> de Moodle usando ETL.',
	direccion_usuario VARCHAR(200) DEFAULT NULL COMMENT 'Direccion del domicilio de un usuario. Los valores de este campo se obtendran del campo <address> de Moodle usando ETL.',
	ciudad_usuario VARCHAR(20) NOT NULL COMMENT 'Nombre de la ciudad a la que pertenece un usuario. Los valores de este campo se obtendran del campo <city> de Moodle usando ETL.',
	fecha_nacimiento_usuario DATE DEFAULT NULL COMMENT 'Fecha de nacimiento de un usuario. Los valores de este campo se obtendran del campo <fnacimiento> de Moodle usando ETL.',
	modalidad_usuario VARCHAR(30) DEFAULT NULL COMMENT 'Modalidad de capacitacion de un usuario. Los valores de este campo se obtendran del campo <auth> de Moodle usando ETL.',
	PRIMARY KEY(id_usuario)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT 'Informacion de usuarios. Los registros de esta tabla se obtendran de la tabla <mdl_user> de Moodle usando ETL.' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS bitacoras(
	id_bitacora BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador de bitacora.',
	id_usuario BIGINT(10) UNSIGNED COMMENT 'Identificador del registro de la tabla usuarios sobre el cual se realiza la accion.',
	id_centro_educativo INT(10) UNSIGNED COMMENT 'Identificador del registro de la tabla centros_educativos sobre el cual se realiza la accion.',
	usuario_bitacora VARCHAR(100) NOT NULL COMMENT 'Nombre del usuario de base de datos que realiza la accion.',
	fecha_bitacora DATETIME NOT NULL COMMENT 'Fecha actual del servidor cuando se realiza la accion.',
	accion_bitacora TEXT NOT NULL COMMENT 'Comentario de la accion realizada.',
	PRIMARY KEY(id_bitacora)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT 'Informacion de las acciones realizadas por los usuarios.' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS tipos_usuarios(
	id_tipo_usuario INT(4) UNSIGNED NOT NULL AUTO_INCREMENT,
	nombre_tipo_usuario VARCHAR(255),
	PRIMARY KEY(id_tipo_usuario)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT 'Catalogo de los tipos de usuarios.' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS mapas(
	id_mapa BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador de una coordenada en el mapa.',
	longitud_mapa DOUBLE NOT NULL COMMENT 'Posicion en el eje X de una coordenada del mapa.',
	latitud_mapa DOUBLE NOT NULL COMMENT 'Posicion en el eje Y de una coordenada del mapa.',
	PRIMARY KEY(id_mapa)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT 'Coordenadas de puntos en el mapa.' AUTO_INCREMENT=1;

ALTER TABLE bitacoras ADD CONSTRAINT fk_bitacoras_usuarios
FOREIGN KEY(id_usuario) REFERENCES usuarios(id_usuario);

ALTER TABLE bitacoras ADD CONSTRAINT fk_bitacoras_centros_educativos
FOREIGN KEY(id_centro_educativo) REFERENCES centros_educativos(id_centro_educativo);

ALTER TABLE centros_educativos ADD CONSTRAINT fk_centros_educativos_departamentos
FOREIGN KEY(id_departamento) REFERENCES departamentos(id_departamento);

ALTER TABLE centros_educativos ADD CONSTRAINT fk_centros_educativos_mapas
FOREIGN KEY(id_mapa) REFERENCES mapas(id_mapa);

ALTER TABLE centros_educativos ADD CONSTRAINT fk_centros_educativos_municipios
FOREIGN KEY(id_municipio) REFERENCES municipios(id_municipio);

ALTER TABLE departamentos ADD CONSTRAINT fk_departamentos_mapas
FOREIGN KEY(id_mapa) REFERENCES mapas(id_mapa);

ALTER TABLE cursos_categorias ADD CONSTRAINT fk_cursos_categorias_cursos_categorias
FOREIGN KEY(padre_curso_categoria) REFERENCES cursos_categorias(id_curso_categoria);

ALTER TABLE cursos ADD CONSTRAINT fk_cursos_cursos_categorias
FOREIGN KEY(id_curso_categoria) REFERENCES cursos_categorias(id_curso_categoria);

ALTER TABLE matriculas ADD CONSTRAINT fk_matriculas_cursos
FOREIGN KEY(id_curso) REFERENCES cursos(id_curso);

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

-- ============================================================================================================================================================
-- CREAR FUNCIONES SYSCAP
-- ============================================================================================================================================================

USE syscap;

DELIMITER $$
DROP FUNCTION IF EXISTS initcap $$
CREATE FUNCTION initcap(p_cadena CHAR(255)) RETURNS CHAR(255) CHARSET utf8
COMMENT 'Funcion que devuelve la primera letra de cada palabra en mayusculas.'
DETERMINISTIC
READS SQL DATA
BEGIN
	SET @v_string1 = '';
	SET @v_string2 = '';
	WHILE p_cadena REGEXP ' ' DO
		SELECT REPLACE(REPLACE(REPLACE(p_cadena, '    ', ' '), '   ', ' '), '  ', ' ') INTO p_cadena;
		SELECT SUBSTRING_INDEX(p_cadena, ' ', 1) INTO @v_string2;
		SELECT SUBSTRING(p_cadena, LOCATE(' ', p_cadena) + 1) INTO p_cadena;
		SELECT CONCAT(@v_string1, ' ', CONCAT(UPPER(SUBSTRING(@v_string2, 1, 1)), LOWER(SUBSTRING(@v_string2, 2)))) INTO @v_string1;
	END WHILE;
	RETURN TRIM(CONCAT(@v_string1, ' ', CONCAT(UPPER(SUBSTRING(p_cadena, 1, 1)), LOWER(SUBSTRING(p_cadena, 2)))));
END$$
DELIMITER ;

-- ------------------------------------------------------------------------------------------

DELIMITER $$
DROP FUNCTION IF EXISTS codigo_departamento $$
CREATE FUNCTION F_CodigoDepartamento(p_nombre_departamento VARCHAR(255)) RETURNS CHAR(2)
COMMENT 'Funcion que devuelve el identificador de un departamento a partir del nombre.'
DETERMINISTIC
READS SQL DATA
BEGIN
	DECLARE v_id_departamento CHAR(2) DEFAULT '';
	DECLARE v_termina INT DEFAULT FALSE;
	DECLARE c_departamento CURSOR FOR
		SELECT id_departamento FROM departamentos WHERE initcap(nombre_departamento) = initcap(p_nombre_departamento);
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_termina = TRUE;
	
	OPEN c_departamento;
	recorre_cursor: LOOP
		FETCH c_departamento INTO v_id_departamento;
		
		IF v_termina THEN
			LEAVE recorre_cursor;
		END IF;
		
	END LOOP;
	CLOSE c_departamento;
	
	RETURN v_id_departamento;
END$$
DELIMITER ;

-- ------------------------------------------------------------------------------------------

DELIMITER $$
DROP FUNCTION IF EXISTS nombre_departamento $$
CREATE FUNCTION F_NombreDepartamento(p_codigo_departamento CHAR(2)) RETURNS VARCHAR(255)
COMMENT 'Funcion que devuelve el nombre de un departamento a partir del identificador.'
DETERMINISTIC
READS SQL DATA
BEGIN
	DECLARE v_nombre_departamento VARCHAR(255) DEFAULT '';
	DECLARE v_termina INT DEFAULT FALSE;
	DECLARE c_departamento CURSOR FOR
		SELECT UPPER(nombre_departamento) FROM departamentos WHERE id_departamento = p_codigo_departamento;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_termina = TRUE;
	
	OPEN c_departamento;
	recorre_cursor: LOOP
		FETCH c_departamento INTO v_nombre_departamento;
		
		IF v_termina THEN
			LEAVE recorre_cursor;
		END IF;
		
	END LOOP;
	CLOSE c_departamento;
	
	RETURN v_nombre_departamento;
END$$
DELIMITER ;

-- ------------------------------------------------------------------------------------------

DELIMITER $$
DROP FUNCTION IF EXISTS codigo_municipio $$
CREATE FUNCTION F_CodigoMunicipio(p_nombre_municipio VARCHAR(255)) RETURNS CHAR(3)
COMMENT 'Funcion que devuelve el identificador de un municipio a partir del nombre.'
DETERMINISTIC
READS SQL DATA
BEGIN
	DECLARE v_id_municipio CHAR(3) DEFAULT '';
	DECLARE v_termina INT DEFAULT FALSE;
	DECLARE c_municipio CURSOR FOR
		SELECT id_municipio FROM municipios WHERE initcap(nombre_municipio) = initcap(p_nombre_municipio);
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_termina = TRUE;
	
	OPEN c_municipio;
	recorre_cursor: LOOP
		FETCH c_municipio INTO v_id_municipio;
		
		IF v_termina THEN
			LEAVE recorre_cursor;
		END IF;
		
	END LOOP;
	CLOSE c_municipio;
	
	RETURN v_id_municipio;
END$$
DELIMITER ;

-- ------------------------------------------------------------------------------------------

DELIMITER $$
DROP FUNCTION IF EXISTS nombre_municipio $$
CREATE FUNCTION F_NombreMunicipio(p_codigo_municipio CHAR(3)) RETURNS VARCHAR(255)
COMMENT 'Funcion que devuelve el nombre de un municipio a partir del identificador.'
DETERMINISTIC
READS SQL DATA
BEGIN
	DECLARE v_nombre_municipio VARCHAR(255) DEFAULT '';
	DECLARE v_termina INT DEFAULT FALSE;
	DECLARE c_municipio CURSOR FOR
		SELECT UPPER(nombre_municipio) FROM municipios WHERE id_municipio = p_codigo_municipio;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_termina = TRUE;
	
	OPEN c_municipio;
	recorre_cursor: LOOP
		FETCH c_municipio INTO v_nombre_municipio;
		
		IF v_termina THEN
			LEAVE recorre_cursor;
		END IF;
		
	END LOOP;
	CLOSE c_municipio;
	
	RETURN v_nombre_municipio;
END$$
DELIMITER ;

-- ------------------------------------------------------------------------------------------

DELIMITER $$
DROP FUNCTION IF EXISTS F_NombreCompletoUsuario $$
CREATE FUNCTION F_NombreCompletoUsuario(p_codigo_usuario BIGINT(10)) RETURNS VARCHAR(305)
NOT DETERMINISTIC
SQL SECURITY DEFINER
COMMENT 'Funcion que devuelve el nombre completo (todos los nombres y todos los apellidos) de un usuario.'
DETERMINISTIC
READS SQL DATA
BEGIN
	DECLARE v_nombre_completo_usuario VARCHAR(305);
	DECLARE v_nombres_usuario VARCHAR(100);
	DECLARE v_apellido1_usuario VARCHAR(100);
	DECLARE v_apellido2_usuario VARCHAR(100);
	DECLARE v_termina INT DEFAULT FALSE;
	DECLARE c_nombre_completo_usuario CURSOR FOR
		SELECT
			IF(nombres_usuario IS NOT NULL, nombres_usuario, '') nombres_usuario,
			IF(apellido1_usuario IS NOT NULL, apellido1_usuario, '') apellido1_usuario,
			IF(apellido2_usuario IS NOT NULL, apellido2_usuario, '') apellido2_usuario
		FROM usuarios
		WHERE id_usuario = p_codigo_usuario;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_termina = TRUE;
	
	OPEN c_nombre_completo_usuario;
	recorre_cursor: LOOP
		FETCH c_nombre_completo_usuario
		INTO v_nombres_usuario, v_apellido1_usuario, v_apellido2_usuario;
		
		IF v_apellido1_usuario = v_apellido2_usuario THEN
			SET v_nombre_completo_usuario = (SELECT CONCAT(IF(v_nombres_usuario IS NOT NULL, v_nombres_usuario, ''), ' ', IF(v_apellido1_usuario IS NOT NULL, v_apellido1_usuario, '')) nombre_completo_usuario);
		ELSE
			SET v_nombre_completo_usuario = (SELECT CONCAT(IF(v_nombres_usuario IS NOT NULL, v_nombres_usuario, ''), ' ', IF(v_apellido1_usuario IS NOT NULL, v_apellido1_usuario, ''), ' ', IF(v_apellido2_usuario IS NOT NULL, v_apellido2_usuario, '')) nombre_completo_usuario);
		END IF;
		
		IF v_termina THEN
			LEAVE recorre_cursor;
		END IF;
		
	END LOOP;
	CLOSE c_nombre_completo_usuario;
	
	RETURN v_nombre_completo_usuario;
END;
$$
DELIMITER ;

-- ------------------------------------------------------------------------------------------

DELIMITER $$
DROP FUNCTION IF EXISTS F_NombreCompactoUsuario $$
CREATE FUNCTION F_NombreCompactoUsuario(p_codigo_usuario BIGINT(10)) RETURNS VARCHAR(205)
NOT DETERMINISTIC
SQL SECURITY DEFINER
COMMENT 'Funcion que devuelve el nombre compacto (un nombre y un apellido) de un usuario.'
DETERMINISTIC
READS SQL DATA
BEGIN
	DECLARE v_nombre_compacto_usuario VARCHAR(205);
	DECLARE v_nombres_usuario VARCHAR(100);
	DECLARE v_apellido1_usuario VARCHAR(100);
	DECLARE v_termina INT DEFAULT FALSE;
	DECLARE c_nombre_compacto_usuario CURSOR FOR
		SELECT
			IF(LOCATE(' ', nombres_usuario) > 0, SUBSTRING(nombres_usuario, 1, LOCATE(' ', nombres_usuario) - 1), nombres_usuario) nombres_usuario,
			IF(LOCATE(' ', apellido1_usuario) > 0, SUBSTRING(apellido1_usuario, 1, LOCATE(' ', apellido1_usuario) - 1), apellido1_usuario) apellido1_usuario
		FROM usuarios
		WHERE id_usuario = p_codigo_usuario;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_termina = TRUE;
	
	OPEN c_nombre_compacto_usuario;
	recorre_cursor: LOOP
		FETCH c_nombre_compacto_usuario
		INTO v_nombres_usuario, v_apellido1_usuario;
		
		SET v_nombre_compacto_usuario = (SELECT CONCAT(v_nombres_usuario, ' ', v_apellido1_usuario));
		
		IF v_termina THEN
			LEAVE recorre_cursor;
		END IF;
		
	END LOOP;
	CLOSE c_nombre_compacto_usuario;
	
	RETURN v_nombre_compacto_usuario;
END;
$$
DELIMITER ;

-- ------------------------------------------------------------------------------------------

DELIMITER $$
DROP FUNCTION IF EXISTS F_NombreCentroEducativo $$
CREATE FUNCTION F_NombreCentroEducativo(p_codigo_centro_educativo BIGINT(10)) RETURNS VARCHAR(150)
DETERMINISTIC
READS SQL DATA
COMMENT 'Funcion que devuelve el nombre de un centro educativo.'
BEGIN
	DECLARE v_nombre_centro_educativo VARCHAR(150);
	DECLARE v_termina INT DEFAULT FALSE;
	DECLARE c_nombre_centro_educativo CURSOR FOR
		SELECT nombre_centro_educativo FROM centros_educativos WHERE id_centro_educativo = p_codigo_centro_educativo;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_termina = TRUE;
	
	OPEN c_nombre_centro_educativo;
	recorre_cursor: LOOP
		FETCH c_nombre_centro_educativo INTO v_nombre_centro_educativo;
		
		IF v_termina THEN
			LEAVE recorre_cursor;
		END IF;
		
	END LOOP;
	CLOSE c_nombre_centro_educativo;
	
	RETURN v_nombre_centro_educativo;
END;
$$
DELIMITER ;

-- ============================================================================================================================================================
-- CREAR PROCEDIMIENTOS SYSCAP
-- ============================================================================================================================================================

DELIMITER $$
DROP PROCEDURE IF EXISTS P_ActualizarSyscapCentrosEducativos $$
CREATE PROCEDURE P_ActualizarSyscapCentrosEducativos()
COMMENT 'Procedimiento que actualiza la tabla syscap.centros_educativos a partir de los cambios en la tabla de moodle19.mdl_cat_educativa.'
DETERMINISTIC
READS SQL DATA
BEGIN
	DECLARE v_resultado INT;
	DECLARE v_id_centro_educativo INT(10);
	DECLARE v_codigo_centro_educativo VARCHAR(5);
	DECLARE v_nombre_centro_educativo VARCHAR(150);
	DECLARE v_id_departamento VARCHAR(2);
	DECLARE v_id_municipio VARCHAR(3);
	DECLARE v_termina INT DEFAULT FALSE;
	DECLARE c_centros_educativos CURSOR FOR
		SELECT
			moodle19.mdl_cat_educativa.row_id,
			moodle19.mdl_cat_educativa.codigo_entidad,
			syscap.initcap(moodle19.mdl_cat_educativa.nombre),
			syscap.F_CodigoDepartamento(moodle19.mdl_cat_educativa.depto),
			syscap.F_CodigoMunicipio(moodle19.mdl_cat_educativa.muni)
		FROM
			moodle19.mdl_cat_educativa;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_termina = TRUE;

	OPEN c_centros_educativos;
	recorre_cursor: LOOP
		FETCH c_centros_educativos
		INTO v_id_centro_educativo, v_codigo_centro_educativo, v_nombre_centro_educativo, v_id_departamento, v_id_municipio;
		IF (SELECT COUNT(*) FROM centros_educativos WHERE id_centro_educativo = v_id_centro_educativo) THEN
			SET v_resultado = (SELECT COUNT(*)
				FROM centros_educativos
				WHERE
					id_centro_educativo = v_id_centro_educativo AND
					codigo_centro_educativo = v_codigo_centro_educativo AND
					nombre_centro_educativo = v_nombre_centro_educativo AND
					id_departamento = v_id_departamento AND
					id_municipio = v_id_municipio);
			IF v_resultado = FALSE THEN
				UPDATE centros_educativos
				SET
					nombre_centro_educativo = v_nombre_centro_educativo,
					id_departamento = v_id_departamento,
					id_municipio = v_id_municipio
				WHERE
					id_centro_educativo = v_id_centro_educativo AND
					codigo_centro_educativo = v_codigo_centro_educativo;
			END IF;
		ELSE
			INSERT INTO centros_educativos(id_centro_educativo, codigo_centro_educativo, nombre_centro_educativo, id_departamento, id_municipio)
			VALUES(v_id_centro_educativo, v_codigo_centro_educativo, v_nombre_centro_educativo, v_id_departamento, v_id_municipio);
		END IF;
		IF v_termina THEN
			LEAVE recorre_cursor;
		END IF;
	END LOOP;
	CLOSE c_centros_educativos;
END$$
DELIMITER ;

-- ------------------------------------------------------------------------------------------

DELIMITER $$
DROP PROCEDURE IF EXISTS P_ActualizarSyscapUsuarios $$
CREATE PROCEDURE P_ActualizarSyscapUsuarios()
COMMENT 'Procedimiento que actualiza la tabla syscap.usuarios a partir de los cambios en la tabla de moodle19.mdl_user.'
DETERMINISTIC
READS SQL DATA
BEGIN
	DECLARE v_resultado INT;
	DECLARE v_id_usuario BIGINT(10);
	DECLARE v_nombre_usuario VARCHAR(100);
	DECLARE v_contrasena_usuario VARCHAR(32);
	DECLARE v_id_tipo_usuario INT(4);
	DECLARE v_nombres_usuario VARCHAR(100);
	DECLARE v_apellido1_usuario VARCHAR(100);
	DECLARE v_apellido2_usuario VARCHAR(100);
	DECLARE v_dui_usuario VARCHAR(10);
	DECLARE v_sexo_usuario CHAR(2);
	DECLARE v_id_profesion VARCHAR(3);
	DECLARE v_id_nivel_estudio INT(4);
	DECLARE v_correo_electronico_usuario VARCHAR(100);
	DECLARE v_telefono1_usuario VARCHAR(12);
	DECLARE v_telefono2_usuario VARCHAR(12);
	DECLARE v_id_centro_educativo INT(10);
	DECLARE v_id_departamento VARCHAR(2);
	DECLARE v_id_municipio VARCHAR(3);
	DECLARE v_pais_usuario VARCHAR(2);
	DECLARE v_direccion_usuario VARCHAR(200);
	DECLARE v_ciudad_usuario VARCHAR(20);
	DECLARE v_fecha_nacimiento_usuario DATE;
	DECLARE v_modalidad_usuario VARCHAR(30);
	DECLARE v_termina INT DEFAULT FALSE;
	DECLARE c_usuarios CURSOR FOR
		SELECT
			moodle19.mdl_user.id,
			moodle19.mdl_user.username,
			moodle19.mdl_user.password,
			moodle19.mdl_user.tipo,
			syscap.initcap(moodle19.mdl_user.firstname),
			syscap.initcap(moodle19.mdl_user.lastname),
			syscap.initcap(moodle19.mdl_user.apellido2),
			moodle19.mdl_user.dui,
			moodle19.mdl_user.sexo,
			moodle19.mdl_user.profesion,
			moodle19.mdl_user.nestudio,
			moodle19.mdl_user.email,
			moodle19.mdl_user.phone1,
			moodle19.mdl_user.phone2,
			moodle19.mdl_user.tinstitucion,
			moodle19.mdl_user.deptorec,
			moodle19.mdl_user.munirec,
			moodle19.mdl_user.country,
			syscap.initcap(moodle19.mdl_user.address),
			syscap.initcap(moodle19.mdl_user.city),
			moodle19.mdl_user.fnacimiento,
			IF(moodle19.mdl_user.auth = 'manual', 'tutorizado', IF(moodle19.mdl_user.auth = 'email', 'autoformacion', NULL)) auth
		FROM moodle19.mdl_user;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_termina = TRUE;
	
	OPEN c_usuarios;
	recorre_cursor: LOOP
		FETCH c_usuarios
		INTO v_id_usuario, v_nombre_usuario, v_contrasena_usuario, v_id_tipo_usuario, v_nombres_usuario, v_apellido1_usuario, v_apellido2_usuario, v_dui_usuario, v_sexo_usuario, v_id_profesion, v_id_nivel_estudio, v_correo_electronico_usuario, v_telefono1_usuario, v_telefono2_usuario, v_id_centro_educativo, v_id_departamento, v_id_municipio, v_pais_usuario, v_direccion_usuario, v_ciudad_usuario, v_fecha_nacimiento_usuario, v_modalidad_usuario;
		IF (SELECT COUNT(*) FROM usuarios WHERE id_usuario = v_id_usuario) THEN
			SET v_resultado = (SELECT COUNT(*)
				FROM usuarios
				WHERE
					id_usuario = v_id_usuario AND
					nombre_usuario = v_nombre_usuario AND
					contrasena_usuario = v_contrasena_usuario AND
					id_tipo_usuario = v_id_tipo_usuario AND
					nombres_usuario = v_nombres_usuario AND
					apellido1_usuario = v_apellido1_usuario AND
					apellido2_usuario = v_apellido2_usuario AND
					dui_usuario = v_dui_usuario AND
					sexo_usuario = v_sexo_usuario AND
					id_profesion = v_id_profesion AND
					id_nivel_estudio = v_id_nivel_estudio AND
					correo_electronico_usuario = v_correo_electronico_usuario AND
					telefono1_usuario = v_telefono1_usuario AND
					telefono2_usuario = v_telefono2_usuario AND
					id_centro_educativo = v_id_centro_educativo AND
					id_departamento = v_id_departamento AND
					id_municipio = v_id_municipio AND
					pais_usuario = v_pais_usuario AND
					direccion_usuario = v_direccion_usuario AND
					ciudad_usuario = v_ciudad_usuario AND
					fecha_nacimiento_usuario = v_fecha_nacimiento_usuario AND
					modalidad_usuario = v_modalidad_usuario);
			IF v_resultado = FALSE THEN
				UPDATE usuarios
				SET
					nombre_usuario = v_nombre_usuario,
					contrasena_usuario = v_contrasena_usuario,
					id_tipo_usuario = v_id_tipo_usuario,
					nombres_usuario = v_nombres_usuario,
					apellido1_usuario = v_apellido1_usuario,
					apellido2_usuario = v_apellido2_usuario,
					dui_usuario = v_dui_usuario,
					sexo_usuario = v_sexo_usuario,
					id_profesion = v_id_profesion,
					id_nivel_estudio = v_id_nivel_estudio,
					correo_electronico_usuario = v_correo_electronico_usuario,
					telefono1_usuario = v_telefono1_usuario,
					telefono2_usuario = v_telefono2_usuario,
					id_centro_educativo = v_id_centro_educativo,
					id_departamento = v_id_departamento,
					id_municipio = v_id_municipio,
					pais_usuario = v_pais_usuario,
					direccion_usuario = v_direccion_usuario,
					ciudad_usuario = v_ciudad_usuario,
					fecha_nacimiento_usuario = v_fecha_nacimiento_usuario,
					modalidad_usuario = v_modalidad_usuario
				WHERE
					id_usuario = v_id_usuario;
			END IF;
		ELSE
			INSERT INTO usuarios(id_usuario, nombre_usuario, contrasena_usuario, id_tipo_usuario, nombres_usuario, apellido1_usuario, apellido2_usuario, dui_usuario, sexo_usuario, id_profesion, id_nivel_estudio, correo_electronico_usuario, telefono1_usuario, telefono2_usuario, id_centro_educativo, id_departamento, id_municipio, pais_usuario, direccion_usuario, ciudad_usuario, fecha_nacimiento_usuario, modalidad_usuario)
			VALUES(v_id_usuario, v_nombre_usuario, v_contrasena_usuario, v_id_tipo_usuario, v_nombres_usuario, v_apellido1_usuario, v_apellido2_usuario, v_dui_usuario, v_sexo_usuario, v_id_profesion, v_id_nivel_estudio, v_correo_electronico_usuario, v_telefono1_usuario, v_telefono2_usuario, v_id_centro_educativo, v_id_departamento, v_id_municipio, v_pais_usuario, v_direccion_usuario, v_ciudad_usuario, v_fecha_nacimiento_usuario, v_modalidad_usuario);
		END IF;
		IF v_termina THEN
			LEAVE recorre_cursor;
		END IF;
	END LOOP;
	CLOSE c_usuarios;
END$$
DELIMITER ;

-- ------------------------------------------------------------------------------------------

DELIMITER $$
DROP PROCEDURE IF EXISTS P_ActualizarMoodleCatEducativa $$
CREATE PROCEDURE P_ActualizarMoodleCatEducativa()
COMMENT 'Procedimiento que actualiza la tabla moodle19.mdl_cat_educativa a partir de los cambios en la tabla de syscap.centros_educativos.'
DETERMINISTIC
READS SQL DATA
BEGIN
	DECLARE v_resultado INT;
	DECLARE v_id_centro_educativo INT(10);
	DECLARE v_codigo_centro_educativo VARCHAR(5);
	DECLARE v_nombre_centro_educativo VARCHAR(150);
	DECLARE v_nombre_departamento VARCHAR(25);
	DECLARE v_nombre_municipio VARCHAR(50);
	DECLARE v_termina INT DEFAULT FALSE;
	DECLARE c_bitacoras CURSOR FOR
		SELECT
			ce.id_centro_educativo,
			ce.codigo_centro_educativo,
			UPPER(ce.nombre_centro_educativo),
			F_NombreDepartamento(ce.id_departamento),
			F_NombreMunicipio(ce.id_municipio)
		FROM bitacoras b INNER JOIN centros_educativos ce ON b.id_centro_educativo = ce.id_centro_educativo
		WHERE DATE_FORMAT(b.fecha_bitacora, '%Y-%m-%d') = DATE_FORMAT(NOW(), '%Y-%m-%d');
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_termina = TRUE;

	OPEN c_bitacoras;
	recorre_cursor: LOOP
		FETCH c_bitacoras
		INTO v_id_centro_educativo, v_codigo_centro_educativo, v_nombre_centro_educativo, v_nombre_departamento, v_nombre_municipio;
		SET v_resultado = (SELECT COUNT(*)
			FROM moodle19.mdl_cat_educativa
			WHERE
				moodle19.mdl_cat_educativa.row_id = v_id_centro_educativo AND
				moodle19.mdl_cat_educativa.codigo_entidad = v_codigo_centro_educativo AND
				moodle19.mdl_cat_educativa.nombre = v_nombre_centro_educativo AND
				moodle19.mdl_cat_educativa.depto = v_nombre_departamento AND
				moodle19.mdl_cat_educativa.muni = v_nombre_municipio);
		IF v_resultado = FALSE THEN
			UPDATE moodle19.mdl_cat_educativa
			SET
				moodle19.mdl_cat_educativa.nombre = v_nombre_centro_educativo,
				moodle19.mdl_cat_educativa.depto = v_nombre_departamento,
				moodle19.mdl_cat_educativa.muni = v_nombre_municipio
			WHERE
				moodle19.mdl_cat_educativa.row_id = v_id_centro_educativo AND
				moodle19.mdl_cat_educativa.codigo_entidad = v_codigo_centro_educativo;
		END IF;
		IF v_termina THEN
			LEAVE recorre_cursor;
		END IF;
	END LOOP;
	CLOSE c_bitacoras;
END$$
DELIMITER ;

-- ------------------------------------------------------------------------------------------

DELIMITER $$
DROP PROCEDURE IF EXISTS P_ActualizarMoodleUser $$
CREATE PROCEDURE P_ActualizarMoodleUser()
COMMENT 'Procedimiento que actualiza la tabla moodle19.mdl_user a partir de los cambios en la tabla de syscap.usuarios.'
DETERMINISTIC
READS SQL DATA
BEGIN
	DECLARE v_resultado INT;
	DECLARE v_id_usuario BIGINT(10);
	DECLARE v_nombre_usuario VARCHAR(100);
	DECLARE v_contrasena_usuario VARCHAR(32);
	DECLARE v_id_tipo_usuario INT(4);
	DECLARE v_nombres_usuario VARCHAR(100);
	DECLARE v_apellido1_usuario VARCHAR(100);
	DECLARE v_apellido2_usuario VARCHAR(100);
	DECLARE v_dui_usuario VARCHAR(10);
	DECLARE v_sexo_usuario CHAR(2);
	DECLARE v_id_profesion VARCHAR(3);
	DECLARE v_id_nivel_estudio INT(4);
	DECLARE v_correo_electronico_usuario VARCHAR(100);
	DECLARE v_telefono1_usuario VARCHAR(12);
	DECLARE v_telefono2_usuario VARCHAR(12);
	DECLARE v_id_centro_educativo INT(10);
	DECLARE v_id_departamento VARCHAR(2);
	DECLARE v_id_municipio VARCHAR(3);
	DECLARE v_pais_usuario VARCHAR(2);
	DECLARE v_direccion_usuario VARCHAR(200);
	DECLARE v_ciudad_usuario VARCHAR(20);
	DECLARE v_fecha_nacimiento_usuario DATE;
	DECLARE v_modalidad_usuario VARCHAR(30);
	DECLARE v_termina INT DEFAULT FALSE;
	DECLARE c_bitacoras CURSOR FOR
		SELECT
			u.id_usuario,
			u.nombre_usuario,
			u.contrasena_usuario,
			u.id_tipo_usuario,
			u.nombres_usuario,
			u.apellido1_usuario,
			u.apellido2_usuario,
			u.dui_usuario,
			u.sexo_usuario,
			u.id_profesion,
			u.id_nivel_estudio,
			u.correo_electronico_usuario,
			u.telefono1_usuario,
			u.telefono2_usuario,
			u.id_centro_educativo,
			u.id_departamento,
			u.id_municipio,
			u.pais_usuario,
			u.direccion_usuario,
			u.ciudad_usuario,
			u.fecha_nacimiento_usuario,
			IF(modalidad_usuario = 'tutorizado', 'manual', IF(modalidad_usuario = 'autoformacion', 'email', NULL)) modalidad_usuario
		FROM bitacoras b INNER JOIN usuarios u ON b.id_usuario = u.id_usuario
		WHERE DATE_FORMAT(b.fecha_bitacora, '%Y-%m-%d') = DATE_FORMAT(NOW(), '%Y-%m-%d');
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_termina = TRUE;

	OPEN c_bitacoras;
	recorre_cursor: LOOP
		FETCH c_bitacoras
		INTO v_id_usuario, v_nombre_usuario, v_contrasena_usuario, v_id_tipo_usuario, v_nombres_usuario, v_apellido1_usuario, v_apellido2_usuario, v_dui_usuario, v_sexo_usuario, v_id_profesion, v_id_nivel_estudio, v_correo_electronico_usuario, v_telefono1_usuario, v_telefono2_usuario, v_id_centro_educativo, v_id_departamento, v_id_municipio, v_pais_usuario, v_direccion_usuario, v_ciudad_usuario, v_fecha_nacimiento_usuario, v_modalidad_usuario;
		SET v_resultado = (SELECT COUNT(*)
			FROM moodle19.mdl_user
			WHERE
				moodle19.mdl_user.id = v_id_usuario AND
				moodle19.mdl_user.username = v_nombre_usuario AND
				moodle19.mdl_user.password = v_contrasena_usuario AND
				moodle19.mdl_user.tipo = v_id_tipo_usuario AND
				syscap.initcap(moodle19.mdl_user.firstname) = v_nombres_usuario AND
				syscap.initcap(moodle19.mdl_user.lastname) = v_apellido1_usuario AND
				syscap.initcap(moodle19.mdl_user.apellido2) = v_apellido2_usuario AND
				moodle19.mdl_user.dui = v_dui_usuario AND
				moodle19.mdl_user.sexo = v_sexo_usuario AND
				moodle19.mdl_user.profesion = v_id_profesion AND
				moodle19.mdl_user.nestudio = v_id_nivel_estudio AND
				moodle19.mdl_user.email = v_correo_electronico_usuario AND
				moodle19.mdl_user.phone1 = v_telefono1_usuario AND
				moodle19.mdl_user.phone2 = v_telefono2_usuario AND
				moodle19.mdl_user.tinstitucion = v_id_centro_educativo AND
				moodle19.mdl_user.deptorec = v_id_departamento AND
				moodle19.mdl_user.munirec = v_id_municipio AND
				moodle19.mdl_user.country = v_pais_usuario AND
				syscap.initcap(moodle19.mdl_user.address) = v_direccion_usuario AND
				syscap.initcap(moodle19.mdl_user.city) = v_ciudad_usuario AND
				moodle19.mdl_user.fnacimiento = v_fecha_nacimiento_usuario AND
				moodle19.mdl_user.auth = v_modalidad_usuario);
		IF v_resultado = FALSE THEN
			UPDATE moodle19.mdl_user
			SET
				moodle19.mdl_user.username = v_nombre_usuario,
				moodle19.mdl_user.password = v_contrasena_usuario,
				moodle19.mdl_user.tipo = v_id_tipo_usuario,
				moodle19.mdl_user.firstname = v_nombres_usuario,
				moodle19.mdl_user.lastname = v_apellido1_usuario,
				moodle19.mdl_user.apellido2 = v_apellido2_usuario,
				moodle19.mdl_user.dui = v_dui_usuario,
				moodle19.mdl_user.sexo = v_sexo_usuario,
				moodle19.mdl_user.profesion = v_id_profesion,
				moodle19.mdl_user.nestudio = v_id_nivel_estudio,
				moodle19.mdl_user.email = v_correo_electronico_usuario,
				moodle19.mdl_user.phone1 = v_telefono1_usuario,
				moodle19.mdl_user.phone2 = v_telefono2_usuario,
				moodle19.mdl_user.tinstitucion = v_id_centro_educativo,
				moodle19.mdl_user.deptorec = v_id_departamento,
				moodle19.mdl_user.munirec = v_id_municipio,
				moodle19.mdl_user.country = v_pais_usuario,
				moodle19.mdl_user.address = v_direccion_usuario,
				moodle19.mdl_user.city = v_ciudad_usuario,
				moodle19.mdl_user.fnacimiento = v_fecha_nacimiento_usuario,
				moodle19.mdl_user.auth = v_modalidad_usuario
			WHERE
				moodle19.mdl_user.id = v_id_usuario;
		END IF;
		IF v_termina THEN
			LEAVE recorre_cursor;
		END IF;
	END LOOP;
	CLOSE c_bitacoras;
END$$
DELIMITER ;

-- ============================================================================================================================================================
-- CARGAR DATOS DE MOODLE A SYSCAP
-- ============================================================================================================================================================

USE syscap;

/* DEPARTAMENTOS */
-- copiar a syscap.departamentos los registros de moodle19.mdl_cat_deptos
TRUNCATE syscap.departamentos;
INSERT INTO syscap.departamentos(syscap.departamentos.id_departamento, syscap.departamentos.nombre_departamento)
SELECT moodle19.mdl_cat_deptos.id, syscap.initcap(moodle19.mdl_cat_deptos.deptos)
FROM moodle19.mdl_cat_deptos;

/* MUNICIPIOS */
-- copiar a syscap.municipios los registros de moodle19.mdl_cat_municip
TRUNCATE syscap.municipios;
INSERT INTO syscap.municipios(syscap.municipios.id_municipio, syscap.municipios.id_departamento, syscap.municipios.nombre_municipio)
SELECT moodle19.mdl_cat_municip.id, moodle19.mdl_cat_municip.relacion, syscap.initcap(moodle19.mdl_cat_municip.opcion)
FROM moodle19.mdl_cat_municip;

/* CENTROS_EDUCATIVOS */
-- copiar a syscap.centros_educativos los registros de moodle19.mdl_cat_educativa
TRUNCATE syscap.centros_educativos;
INSERT INTO syscap.centros_educativos(syscap.centros_educativos.id_centro_educativo, syscap.centros_educativos.codigo_centro_educativo, syscap.centros_educativos.nombre_centro_educativo, syscap.centros_educativos.id_departamento, syscap.centros_educativos.id_municipio)
SELECT moodle19.mdl_cat_educativa.row_id, moodle19.mdl_cat_educativa.codigo_entidad, syscap.initcap(moodle19.mdl_cat_educativa.nombre), syscap.F_CodigoDepartamento(moodle19.mdl_cat_educativa.depto), syscap.F_CodigoMunicipio(moodle19.mdl_cat_educativa.muni)
FROM moodle19.mdl_cat_educativa;

/* NIVELES_ESTUDIOS */
-- copiar a syscap.niveles_estudios los registros de moodle19.mdl_cat_nestudio
TRUNCATE syscap.niveles_estudios;
INSERT INTO syscap.niveles_estudios(syscap.niveles_estudios.id_nivel_estudio, syscap.niveles_estudios.nombre_nivel_estudio)
SELECT moodle19.mdl_cat_nestudio.cod_nestudio, syscap.initcap(moodle19.mdl_cat_nestudio.descripcion)
FROM moodle19.mdl_cat_nestudio;

/* PROFESIONES */
-- copiar a syscap.profesiones los registros de moodle19.mdl_cat_profesion
TRUNCATE syscap.profesiones;
INSERT INTO syscap.profesiones(syscap.profesiones.id_profesion, syscap.profesiones.nombre_profesion)
SELECT IF(moodle19.mdl_cat_profesion.row_id < 10, CONCAT('0', moodle19.mdl_cat_profesion.row_id), moodle19.mdl_cat_profesion.row_id) row_id, syscap.initcap(moodle19.mdl_cat_profesion.descripcion)
FROM moodle19.mdl_cat_profesion;

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
FROM moodle19.mdl_course;

/* MATRICULAS */
-- copiar a syscap.matriculas los registros de moodle19.mdl_context
TRUNCATE syscap.matriculas;
INSERT INTO syscap.matriculas(syscap.matriculas.id_matricula, syscap.matriculas.id_curso)
SELECT moodle19.mdl_context.id, moodle19.mdl_context.instanceid
FROM moodle19.mdl_context;

/* EXAMENES */
-- copiar a syscap.examenes los registros de moodle19.mdl_quiz
TRUNCATE syscap.examenes;
INSERT INTO syscap.examenes(syscap.examenes.id_examen, syscap.examenes.id_curso, syscap.examenes.nombre_examen)
SELECT moodle19.mdl_quiz.id, moodle19.mdl_quiz.course, syscap.initcap(moodle19.mdl_quiz.name)
FROM moodle19.mdl_quiz;

/* EXAMENES_CALIFICACIONES */
-- copiar a syscap.examenes_calificaciones los registros de moodle19.mdl_quiz_grades
TRUNCATE syscap.examenes_calificaciones;
INSERT INTO syscap.examenes_calificaciones(syscap.examenes_calificaciones.id_examen_calificacion, syscap.examenes_calificaciones.id_examen, syscap.examenes_calificaciones.id_usuario, syscap.examenes_calificaciones.nota_examen_calificacion, syscap.examenes_calificaciones.fecha_examen_calificacion)
SELECT moodle19.mdl_quiz_grades.id, moodle19.mdl_quiz_grades.quiz, moodle19.mdl_quiz_grades.userid, moodle19.mdl_quiz_grades.grade, DATE_FORMAT(FROM_UNIXTIME(moodle19.mdl_quiz_grades.timemodified), '%Y-%m-%d')
FROM moodle19.mdl_quiz_grades;

/* ROLES */
-- copiar a syscap.roles los registros de moodle19.mdl_role
TRUNCATE syscap.roles;
INSERT INTO syscap.roles(syscap.roles.id_rol, syscap.roles.nombre_completo_rol, syscap.roles.nombre_corto_rol, syscap.roles.descripcion_rol)
SELECT moodle19.mdl_role.id, syscap.initcap(moodle19.mdl_role.name), moodle19.mdl_role.shortname, moodle19.mdl_role.description
FROM moodle19.mdl_role;

/* ROLES_ASIGNADOS */
-- copiar a syscap.roles_asignados los registros de moodle19.mdl_role_assignments
TRUNCATE syscap.roles_asignados;
INSERT INTO syscap.roles_asignados(syscap.roles_asignados.id_rol_asignado, syscap.roles_asignados.id_rol, syscap.roles_asignados.id_matricula, syscap.roles_asignados.id_usuario)
SELECT moodle19.mdl_role_assignments.id, syscap.initcap(moodle19.mdl_role_assignments.roleid), moodle19.mdl_role_assignments.contextid, moodle19.mdl_role_assignments.userid
FROM moodle19.mdl_role_assignments;

/* USUARIOS */
-- copiar a syscap.usuarios los registros de moodle19.mdl_user
TRUNCATE syscap.usuarios;
INSERT INTO syscap.usuarios(syscap.usuarios.id_usuario, syscap.usuarios.nombre_usuario, syscap.usuarios.contrasena_usuario, syscap.usuarios.id_tipo_usuario, syscap.usuarios.nombres_usuario, syscap.usuarios.apellido1_usuario, syscap.usuarios.apellido2_usuario, syscap.usuarios.dui_usuario, syscap.usuarios.sexo_usuario, syscap.usuarios.id_profesion, syscap.usuarios.id_nivel_estudio, syscap.usuarios.correo_electronico_usuario, syscap.usuarios.telefono1_usuario, syscap.usuarios.telefono2_usuario, syscap.usuarios.id_centro_educativo, syscap.usuarios.id_departamento, syscap.usuarios.id_municipio, syscap.usuarios.pais_usuario, syscap.usuarios.direccion_usuario, syscap.usuarios.ciudad_usuario, syscap.usuarios.fecha_nacimiento_usuario, syscap.usuarios.modalidad_usuario)
SELECT moodle19.mdl_user.id, moodle19.mdl_user.username, moodle19.mdl_user.password, moodle19.mdl_user.tipo, syscap.initcap(moodle19.mdl_user.firstname), syscap.initcap(moodle19.mdl_user.lastname), syscap.initcap(moodle19.mdl_user.apellido2), moodle19.mdl_user.dui, moodle19.mdl_user.sexo, moodle19.mdl_user.profesion, moodle19.mdl_user.nestudio, moodle19.mdl_user.email, moodle19.mdl_user.phone1, moodle19.mdl_user.phone2, moodle19.mdl_user.tinstitucion, moodle19.mdl_user.deptorec, moodle19.mdl_user.munirec, moodle19.mdl_user.country, syscap.initcap(moodle19.mdl_user.address), syscap.initcap(moodle19.mdl_user.city), moodle19.mdl_user.fnacimiento, IF(moodle19.mdl_user.auth = 'manual', 'tutorizado', IF(moodle19.mdl_user.auth = 'email', 'autoformacion', NULL)) auth
FROM moodle19.mdl_user;

/* TIPOS_USUARIOS */
-- copiar a syscap.tipos_usuarios los registros de la lista desplegable del formulario inscripcion de usuarios de EducaContinua
TRUNCATE syscap.tipos_usuarios;
INSERT INTO syscap.tipos_usuarios(syscap.tipos_usuarios.id_tipo_usuario, syscap.tipos_usuarios.nombre_tipo_usuario) VALUES
(1, 'Ciudadano en General'),
(2, 'Estudiante de Básica'),
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
(78, 13.921947, -89.8449174),	-- Centro Escolar Alfredo Espino
(79, 13.6878632, -89.1868767),	-- Escuela De Educacion Parvularia San Jacinto
(80, 13.714436, -89.205852),	-- Instituto Nacional Albert Camus
(81, 13.7384192, -89.2206226),	-- Centro Escolar General Francisco Morazan
(82, 13.700678, -89.180982),	-- Centro Escolar Accion Civica Militar
(83, 13.713366, -89.180338),	-- Instituto Nacional General Francisco Menendez
(84, 13.687911, -89.185976),	-- Instituto Nacional De Comercio
(85, 13.7354, -89.196336),		-- Escuela De Educacion Parvularia  Comunidad El Prado
(86, 13.6693496, -89.2090322),	-- Centro Escolar Canton San Cristobal
(87, 13.7354, -89.196336),		-- Escuela De Educacion Parvularia Colonia Centro America
(88, 13.7240354, -89.1248218),	-- Centro Escolar El Progreso
(89, 13.717931, -89.167772),	-- Centro Escolar Juana Lopez
(90, 13.8278963,-89.2777986);	-- Centro Escolar  Juan Ramon Jimenez

-- actualizar syscap.municipios los registros de las coordenadas en el mapa
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

-- actualizar syscap.departamentos los registros de las coordenadas en el mapa
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

-- actualizar syscap.centros_educativos los registros de las coordenadas en el mapa
UPDATE centros_educativos SET id_mapa = 26 WHERE id_centro_educativo = 1;
UPDATE centros_educativos SET id_mapa = 27 WHERE id_centro_educativo = 3;
UPDATE centros_educativos SET id_mapa = 28 WHERE id_centro_educativo = 4;
UPDATE centros_educativos SET id_mapa = 78 WHERE id_centro_educativo = 2;
UPDATE centros_educativos SET id_mapa = 79 WHERE id_centro_educativo = 148;
UPDATE centros_educativos SET id_mapa = 80 WHERE id_centro_educativo = 1128;
UPDATE centros_educativos SET id_mapa = 81 WHERE id_centro_educativo = 1134;
UPDATE centros_educativos SET id_mapa = 82 WHERE id_centro_educativo = 1135;
UPDATE centros_educativos SET id_mapa = 83 WHERE id_centro_educativo = 1139;
UPDATE centros_educativos SET id_mapa = 84 WHERE id_centro_educativo = 1141;
UPDATE centros_educativos SET id_mapa = 85 WHERE id_centro_educativo = 1146;
UPDATE centros_educativos SET id_mapa = 86 WHERE id_centro_educativo = 1163;
UPDATE centros_educativos SET id_mapa = 87 WHERE id_centro_educativo = 1164;
UPDATE centros_educativos SET id_mapa = 88 WHERE id_centro_educativo = 1170;
UPDATE centros_educativos SET id_mapa = 89 WHERE id_centro_educativo = 1177;
UPDATE centros_educativos SET id_mapa = 90 WHERE id_centro_educativo = 1180;

-- ============================================================================================================================================================
-- CREAR VISTAS SYSCAP
-- ============================================================================================================================================================

USE syscap;

DELIMITER $$
DROP VIEW IF EXISTS V_UsuariosCursosExamenesCalificaciones $$
CREATE VIEW V_UsuariosCursosExamenesCalificaciones AS
SELECT
	u.id_usuario u_id_usuario,
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
	ec.id_usuario ec_id_usuario,
	ec.nota_examen_calificacion ec_nota_examen_calificacion,
	ec.fecha_examen_calificacion ec_fecha_examen_calificacion,
	e.nombre_examen e_nombre_examen,
	c.nombre_completo_curso c_nombre_completo_curso,
    c.nombre_corto_curso c_nombre_corto_curso
FROM
	usuarios u LEFT JOIN examenes_calificaciones ec ON u.id_usuario = ec.id_usuario
	LEFT JOIN examenes e ON ec.id_examen = e.id_examen
	LEFT JOIN cursos c ON e.id_curso = c.id_curso
	LEFT JOIN tipos_usuarios tu ON u.id_tipo_usuario = tu.id_tipo_usuario
	LEFT JOIN profesiones p ON u.id_profesion = p.id_profesion
	LEFT JOIN niveles_estudios ne ON u.id_nivel_estudio = ne.id_nivel_estudio
	LEFT JOIN centros_educativos ce ON u.id_centro_educativo = ce.id_centro_educativo
    LEFT JOIN departamentos d ON u.id_departamento = d.id_departamento
    LEFT JOIN municipios m ON u.id_municipio = m.id_municipio;
$$
DELIMITER ;

-- ------------------------------------------------------------------------------------------

DELIMITER $$
DROP VIEW IF EXISTS V_Estadisticas $$
CREATE VIEW V_Estadisticas AS
SELECT
	u.id_usuario,
	F_NombreCompletoUsuario(u.id_usuario) nombre_usuario,
	u.sexo_usuario,
	u.id_tipo_usuario,
	u.modalidad_usuario,
	IF(e.nombre_examen LIKE 'Evaluaci%', 'Capacitado', 'Certificado') tipo_capacitado,
	ec.nota_examen_calificacion,
	e.nombre_examen,
	ec.fecha_examen_calificacion,
	d.id_departamento,
	d.nombre_departamento,
	m.id_municipio,
	m.nombre_municipio,
	ce.id_centro_educativo,
	ce.nombre_centro_educativo,
	IF(cc.padre_curso_categoria = 26, 1, IF(cc.padre_curso_categoria = 23, 2, IF(cc.padre_curso_categoria = 24, 3, IF(cc.padre_curso_categoria = 25, 4, NULL)))) grado_digital,
	cc.nombre_curso_categoria,
	c.nombre_completo_curso
FROM usuarios u LEFT JOIN examenes_calificaciones ec ON u.id_usuario = ec.id_usuario
	LEFT JOIN examenes e ON ec.id_examen = e.id_examen
	LEFT JOIN departamentos d ON u.id_departamento = d.id_departamento
	LEFT JOIN municipios m ON u.id_municipio = m.id_municipio
	LEFT JOIN centros_educativos ce ON u.id_centro_educativo = ce.id_centro_educativo
	LEFT JOIN roles_asignados ra ON u.id_usuario = ra.id_usuario
	LEFT JOIN matriculas ma ON ra.id_matricula = ma.id_matricula
	LEFT JOIN cursos c ON ma.id_curso = c.id_curso
	LEFT JOIN cursos_categorias cc ON c.id_curso_categoria = cc.id_curso_categoria
WHERE ec.nota_examen_calificacion > 7.00;
$$
DELIMITER ;

-- ============================================================================================================================================================
-- CREAR DISPARADORES SYSCAP
-- ============================================================================================================================================================

USE syscap;

DELIMITER $$
DROP TRIGGER IF EXISTS T_BitacoraUpdateUsuarios $$
CREATE TRIGGER T_BitacoraUpdateUsuarios
AFTER UPDATE ON usuarios
FOR EACH ROW
BEGIN
	DECLARE v_accion_bitacora TEXT DEFAULT ' ';
	IF @DISABLE_TRIGGERS IS NULL THEN
		IF IF(OLD.nombre_usuario IS NULL, 'NULL', OLD.nombre_usuario) <> IF(NEW.nombre_usuario IS NULL, 'NULL', NEW.nombre_usuario) THEN
			SET v_accion_bitacora = CONCAT(v_accion_bitacora, 'nombre_usuario: ', IF(OLD.nombre_usuario IS NULL, 'NULL', OLD.nombre_usuario), ' -> ', IF(NEW.nombre_usuario IS NULL, 'NULL', NEW.nombre_usuario), ', ');
		END IF;
		IF IF(OLD.contrasena_usuario IS NULL, 'NULL', OLD.contrasena_usuario) <> IF(NEW.contrasena_usuario IS NULL, 'NULL', NEW.contrasena_usuario) THEN
			SET v_accion_bitacora = CONCAT(v_accion_bitacora, 'contrasena_usuario: ', IF(OLD.contrasena_usuario IS NULL, 'NULL', OLD.contrasena_usuario), ' -> ', IF(NEW.contrasena_usuario IS NULL, 'NULL', NEW.contrasena_usuario), ', ');
		END IF;
		IF IF(OLD.id_tipo_usuario IS NULL, 'NULL', OLD.id_tipo_usuario) <> IF(NEW.id_tipo_usuario IS NULL, 'NULL', NEW.id_tipo_usuario) THEN
			SET v_accion_bitacora = CONCAT(v_accion_bitacora, 'id_tipo_usuario: ', IF(OLD.id_tipo_usuario IS NULL, 'NULL', OLD.id_tipo_usuario), ' -> ', IF(NEW.id_tipo_usuario IS NULL, 'NULL', NEW.id_tipo_usuario), ', ');
		END IF;
		IF IF(OLD.nombres_usuario IS NULL, 'NULL', OLD.nombres_usuario) <> IF(NEW.nombres_usuario IS NULL, 'NULL', NEW.nombres_usuario) THEN
			SET v_accion_bitacora = CONCAT(v_accion_bitacora, 'nombres_usuario: ', IF(OLD.nombres_usuario IS NULL, 'NULL', OLD.nombres_usuario), ' -> ', IF(NEW.nombres_usuario IS NULL, 'NULL', NEW.nombres_usuario), ', ');
		END IF;
		IF IF(OLD.apellido1_usuario IS NULL, 'NULL', OLD.apellido1_usuario) <> IF(NEW.apellido1_usuario IS NULL, 'NULL', NEW.apellido1_usuario) THEN
			SET v_accion_bitacora = CONCAT(v_accion_bitacora, 'apellido1_usuario: ', IF(OLD.apellido1_usuario IS NULL, 'NULL', OLD.apellido1_usuario), ' -> ', IF(NEW.apellido1_usuario IS NULL, 'NULL', NEW.apellido1_usuario), ', ');
		END IF;
		IF IF(OLD.apellido2_usuario IS NULL, 'NULL', OLD.apellido2_usuario) <> IF(NEW.apellido2_usuario IS NULL, 'NULL', NEW.apellido2_usuario) THEN
			SET v_accion_bitacora = CONCAT(v_accion_bitacora, 'apellido2_usuario: ', IF(OLD.apellido2_usuario IS NULL, 'NULL', OLD.apellido2_usuario), ' -> ', IF(NEW.apellido2_usuario IS NULL, 'NULL', NEW.apellido2_usuario), ', ');
		END IF;
		IF IF(OLD.dui_usuario IS NULL, 'NULL', OLD.dui_usuario) <> IF(NEW.dui_usuario IS NULL, 'NULL', NEW.dui_usuario) THEN
			SET v_accion_bitacora = CONCAT(v_accion_bitacora, 'dui_usuario: ', IF(OLD.dui_usuario IS NULL, 'NULL', OLD.dui_usuario), ' -> ', IF(NEW.dui_usuario IS NULL, 'NULL', NEW.dui_usuario), ', ');
		END IF;
		IF IF(OLD.sexo_usuario IS NULL, 'NULL', OLD.sexo_usuario) <> IF(NEW.sexo_usuario IS NULL, 'NULL', NEW.sexo_usuario) THEN
			SET v_accion_bitacora = CONCAT(v_accion_bitacora, 'sexo_usuario: ', IF(OLD.sexo_usuario IS NULL, 'NULL', OLD.sexo_usuario), ' -> ', IF(NEW.sexo_usuario IS NULL, 'NULL', NEW.sexo_usuario), ', ');
		END IF;
		IF IF(OLD.id_profesion IS NULL, 'NULL', OLD.id_profesion) <> IF(NEW.id_profesion IS NULL, 'NULL', NEW.id_profesion) THEN
			SET v_accion_bitacora = CONCAT(v_accion_bitacora, 'id_profesion: ', IF(OLD.id_profesion IS NULL, 'NULL', OLD.id_profesion), ' -> ', IF(NEW.id_profesion IS NULL, 'NULL', NEW.id_profesion), ', ');
		END IF;
		IF IF(OLD.id_nivel_estudio IS NULL, 'NULL', OLD.id_nivel_estudio) <> IF(NEW.id_nivel_estudio IS NULL, 'NULL', NEW.id_nivel_estudio) THEN
			SET v_accion_bitacora = CONCAT(v_accion_bitacora, 'id_nivel_estudio: ', IF(OLD.id_nivel_estudio IS NULL, 'NULL', OLD.id_nivel_estudio), ' -> ', IF(NEW.id_nivel_estudio IS NULL, 'NULL', NEW.id_nivel_estudio), ', ');
		END IF;
		IF IF(OLD.correo_electronico_usuario IS NULL, 'NULL', OLD.correo_electronico_usuario) <> IF(NEW.correo_electronico_usuario IS NULL, 'NULL', NEW.correo_electronico_usuario) THEN
			SET v_accion_bitacora = CONCAT(v_accion_bitacora, 'correo_electronico_usuario: ', IF(OLD.correo_electronico_usuario IS NULL, 'NULL', OLD.correo_electronico_usuario), ' -> ', IF(NEW.correo_electronico_usuario IS NULL, 'NULL', NEW.correo_electronico_usuario), ', ');
		END IF;
		IF IF(OLD.telefono1_usuario IS NULL, 'NULL', OLD.telefono1_usuario) <> IF(NEW.telefono1_usuario IS NULL, 'NULL', NEW.telefono1_usuario) THEN
			SET v_accion_bitacora = CONCAT(v_accion_bitacora, 'telefono1_usuario: ', IF(OLD.telefono1_usuario IS NULL, 'NULL', OLD.telefono1_usuario), ' -> ', IF(NEW.telefono1_usuario IS NULL, 'NULL', NEW.telefono1_usuario), ', ');
		END IF;
		IF IF(OLD.telefono2_usuario IS NULL, 'NULL', OLD.telefono2_usuario) <> IF(NEW.telefono2_usuario IS NULL, 'NULL', NEW.telefono2_usuario) THEN
			SET v_accion_bitacora = CONCAT(v_accion_bitacora, 'telefono2_usuario: ', IF(OLD.telefono2_usuario IS NULL, 'NULL', OLD.telefono2_usuario), ' -> ', IF(NEW.telefono2_usuario IS NULL, 'NULL', NEW.telefono2_usuario), ', ');
		END IF;
		IF IF(OLD.id_centro_educativo IS NULL, 'NULL', OLD.id_centro_educativo) <> IF(NEW.id_centro_educativo IS NULL, 'NULL', NEW.id_centro_educativo) THEN
			SET v_accion_bitacora = CONCAT(v_accion_bitacora, 'id_centro_educativo: ', IF(OLD.id_centro_educativo IS NULL, 'NULL', OLD.id_centro_educativo), ' -> ', IF(NEW.id_centro_educativo IS NULL, 'NULL', NEW.id_centro_educativo), ', ');
		END IF;
		IF IF(OLD.id_departamento IS NULL, 'NULL', OLD.id_departamento) <> IF(NEW.id_departamento IS NULL, 'NULL', NEW.id_departamento) THEN
			SET v_accion_bitacora = CONCAT(v_accion_bitacora, 'id_departamento: ', IF(OLD.id_departamento IS NULL, 'NULL', OLD.id_departamento), ' -> ', IF(NEW.id_departamento IS NULL, 'NULL', NEW.id_departamento), ', ');
		END IF;
		IF IF(OLD.id_municipio IS NULL, 'NULL', OLD.id_municipio) <> IF(NEW.id_municipio IS NULL, 'NULL', NEW.id_municipio) THEN
			SET v_accion_bitacora = CONCAT(v_accion_bitacora, 'id_municipio: ', IF(OLD.id_municipio IS NULL, 'NULL', OLD.id_municipio), ' -> ', IF(NEW.id_municipio IS NULL, 'NULL', NEW.id_municipio), ', ');
		END IF;
		IF IF(OLD.pais_usuario IS NULL, 'NULL', OLD.pais_usuario) <> IF(NEW.pais_usuario IS NULL, 'NULL', NEW.pais_usuario) THEN
			SET v_accion_bitacora = CONCAT(v_accion_bitacora, 'pais_usuario: ', IF(OLD.pais_usuario IS NULL, 'NULL', OLD.pais_usuario), ' -> ', IF(NEW.pais_usuario IS NULL, 'NULL', NEW.pais_usuario), ', ');
		END IF;
		IF IF(OLD.direccion_usuario IS NULL, 'NULL', OLD.direccion_usuario) <> IF(NEW.direccion_usuario IS NULL, 'NULL', NEW.direccion_usuario) THEN
			SET v_accion_bitacora = CONCAT(v_accion_bitacora, 'direccion_usuario: ', IF(OLD.direccion_usuario IS NULL, 'NULL', OLD.direccion_usuario), ' -> ', IF(NEW.direccion_usuario IS NULL, 'NULL', NEW.direccion_usuario), ', ');
		END IF;
		IF IF(OLD.ciudad_usuario IS NULL, 'NULL', OLD.ciudad_usuario) <> IF(NEW.ciudad_usuario IS NULL, 'NULL', NEW.ciudad_usuario) THEN
			SET v_accion_bitacora = CONCAT(v_accion_bitacora, 'ciudad_usuario: ', IF(OLD.ciudad_usuario IS NULL, 'NULL', OLD.ciudad_usuario), ' -> ', IF(NEW.ciudad_usuario IS NULL, 'NULL', NEW.ciudad_usuario), ', ');
		END IF;
		IF IF(OLD.fecha_nacimiento_usuario IS NULL, 'NULL', OLD.fecha_nacimiento_usuario) <> IF(NEW.fecha_nacimiento_usuario IS NULL, 'NULL', NEW.fecha_nacimiento_usuario) THEN
			SET v_accion_bitacora = CONCAT(v_accion_bitacora, 'fecha_nacimiento_usuario: ', IF(OLD.fecha_nacimiento_usuario IS NULL, 'NULL', OLD.fecha_nacimiento_usuario), ' -> ', IF(NEW.fecha_nacimiento_usuario IS NULL, 'NULL', NEW.fecha_nacimiento_usuario), ', ');
		END IF;
		IF IF(OLD.modalidad_usuario IS NULL, 'NULL', OLD.modalidad_usuario) <> IF(NEW.modalidad_usuario IS NULL, 'NULL', NEW.modalidad_usuario) THEN
			SET v_accion_bitacora = CONCAT(v_accion_bitacora, 'modalidad_usuario: ', IF(OLD.modalidad_usuario IS NULL, 'NULL', OLD.modalidad_usuario), ' -> ', IF(NEW.modalidad_usuario IS NULL, 'NULL', NEW.modalidad_usuario));
		END IF;
		IF v_accion_bitacora <> ' ' THEN
			INSERT INTO bitacoras SET
				id_usuario			= OLD.id_usuario,
				id_centro_educativo	= NULL,
				usuario_bitacora	= SUBSTRING_INDEX(USER(), '@', 1),
				fecha_bitacora		= NOW(),
				accion_bitacora		= CONCAT('UPDATE TABLE usuarios.', v_accion_bitacora);
		END IF;
	END IF;
END$$
DELIMITER ;

-- ------------------------------------------------------------------------------------------

DELIMITER $$
DROP TRIGGER IF EXISTS T_BitacoraUpdateCentrosEducativos $$
CREATE TRIGGER T_BitacoraUpdateCentrosEducativos
AFTER UPDATE ON centros_educativos
FOR EACH ROW
BEGIN
	DECLARE v_accion_bitacora TEXT DEFAULT ' ';
	IF @DISABLE_TRIGGERS IS NULL THEN
		IF IF(OLD.nombre_centro_educativo IS NULL, 'NULL', OLD.nombre_centro_educativo) <> IF(NEW.nombre_centro_educativo IS NULL, 'NULL', NEW.nombre_centro_educativo) THEN
			SET v_accion_bitacora = CONCAT(v_accion_bitacora, 'nombre_centro_educativo: ', IF(OLD.nombre_centro_educativo IS NULL, 'NULL', OLD.nombre_centro_educativo), ' -> ', IF(NEW.nombre_centro_educativo IS NULL, 'NULL', NEW.nombre_centro_educativo), ', ');
		END IF;
		IF IF(OLD.id_departamento IS NULL, 'NULL', OLD.id_departamento) <> IF(NEW.id_departamento IS NULL, 'NULL', NEW.id_departamento) THEN
			SET v_accion_bitacora = CONCAT(v_accion_bitacora, 'id_departamento: ', IF(OLD.id_departamento IS NULL, 'NULL', OLD.id_departamento), ' -> ', IF(NEW.id_departamento IS NULL, 'NULL', NEW.id_departamento), ', ');
		END IF;
		IF IF(OLD.id_municipio IS NULL, 'NULL', OLD.id_municipio) <> IF(NEW.id_municipio IS NULL, 'NULL', NEW.id_municipio) THEN
			SET v_accion_bitacora = CONCAT(v_accion_bitacora, 'id_municipio: ', IF(OLD.id_municipio IS NULL, 'NULL', OLD.id_municipio), ' -> ', IF(NEW.id_municipio IS NULL, 'NULL', NEW.id_municipio), ', ');
		END IF;
		IF IF(OLD.id_mapa IS NULL, 'NULL', OLD.id_mapa) <> IF(NEW.id_mapa IS NULL, 'NULL', NEW.id_mapa) THEN
			SET v_accion_bitacora = CONCAT(v_accion_bitacora, 'id_mapa: ', IF(OLD.id_mapa IS NULL, 'NULL', OLD.id_mapa), ' -> ', IF(NEW.id_mapa IS NULL, 'NULL', NEW.id_mapa));
		END IF;
		IF v_accion_bitacora <> ' ' THEN
			INSERT INTO bitacoras SET
				id_usuario			= NULL,
				id_centro_educativo	= OLD.id_centro_educativo,
				usuario_bitacora	= SUBSTRING_INDEX(USER(), '@', 1),
				fecha_bitacora		= NOW(),
				accion_bitacora		= CONCAT('UPDATE TABLE centros_educativos.', v_accion_bitacora);
		END IF;
	END IF;
END$$
DELIMITER ;

-- ============================================================================================================================================================
-- CREAR ETL SYSCAP
-- ============================================================================================================================================================

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
	-- actualizar los registros de moodle19.mdl_user desde syscap.usuarios
	CALL P_ActualizarMoodleUser();
	
	/* Actualizar la base de datos de SYSCAP a partir de los cambios en la base de datos de MOODLE. */
	
	/* CENTROS_EDUCATIVOS */
	-- actualizar los registros de syscap.centros_educativos desde moodle19.mdl_cat_educativa
	CALL P_ActualizarSyscapCentrosEducativos();
	
	/* CURSOS_CATEGORIAS */
	-- copiar a syscap.cursos_categorias los registros de moodle19.mdl_course_categories
	TRUNCATE cursos_categorias;
	INSERT INTO cursos_categorias(id_curso_categoria, nombre_curso_categoria, padre_curso_categoria)
	SELECT moodle19.mdl_course_categories.id, moodle19.mdl_course_categories.name, moodle19.mdl_course_categories.parent
	FROM moodle19.mdl_course_categories;
	
	/* CURSOS */
	-- copiar a syscap.cursos los registros de moodle19.mdl_course
	TRUNCATE cursos;
	INSERT INTO cursos(id_curso, nombre_completo_curso, nombre_corto_curso)
	SELECT moodle19.mdl_course.id, moodle19.mdl_course.fullname, moodle19.mdl_course.shortname
	FROM moodle19.mdl_course;
	
	/* MATRICULAS */
	-- copiar a syscap.matriculas los registros de moodle19.mdl_context
	TRUNCATE matriculas;
	INSERT INTO matriculas(id_matricula, id_curso)
	SELECT moodle19.mdl_context.id, moodle19.mdl_context.instanceid
	FROM moodle19.mdl_context;
	
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
	INSERT INTO roles(id_rol, nombre_completo_rol, nombre_corto_rol, descripcion_rol)
	SELECT moodle19.mdl_role.id, syscap.initcap(moodle19.mdl_role.name), moodle19.mdl_role.shortname, moodle19.mdl_role.description
	FROM moodle19.mdl_role;
	
	/* ROLES_ASIGNADOS */
	-- copiar a syscap.roles_asignados los registros de moodle19.mdl_role_assignments
	TRUNCATE roles_asignados;
	INSERT INTO roles_asignados(id_rol_asignado, id_rol, id_matricula, id_usuario)
	SELECT moodle19.mdl_role_assignments.id, syscap.initcap(moodle19.mdl_role_assignments.roleid), moodle19.mdl_role_assignments.contextid, moodle19.mdl_role_assignments.userid
	FROM moodle19.mdl_role_assignments;
	
	/* USUARIOS */
	-- actualizar los registros de syscap.usuarios desde moodle19.mdl_user
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
