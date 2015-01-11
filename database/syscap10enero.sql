-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-01-2015 a las 07:14:53
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `syscap`
--
CREATE DATABASE IF NOT EXISTS `syscap` DEFAULT CHARACTER SET latin1 COLLATE latin1_bin;
USE `syscap`;

DELIMITER $$
--
-- Funciones
--
DROP FUNCTION IF EXISTS `departamento`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `departamento`(p_nombre_departamento VARCHAR(255)) RETURNS char(2) CHARSET latin1 COLLATE latin1_bin
    COMMENT 'Función que devuelve el identificador de un departamento a partir del nombre.'
BEGIN
	DECLARE v_id_departamento CHAR(2);
	DECLARE v_termina INT DEFAULT FALSE;
	DECLARE c_departamento CURSOR FOR
		SELECT syscap.departamentos.id_departamento
		FROM syscap.departamentos
		WHERE initcap(syscap.departamentos.nombre_departamento) = syscap.initcap(p_nombre_departamento);
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

DROP FUNCTION IF EXISTS `F_NombreCentroEducativo`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `F_NombreCentroEducativo`(p_codigo_centro_educativo BIGINT(10)) RETURNS varchar(300) CHARSET latin1 COLLATE latin1_bin
    COMMENT 'Función que devuelve el nombre de un centro educativo.'
BEGIN
	DECLARE v_nombre_centro_educativo VARCHAR(300);
	DECLARE v_termina INT DEFAULT FALSE;
	
	DECLARE c_nombre_centro_educativo CURSOR FOR
		SELECT nombre_centro_educativo
		FROM centros_educativos
		WHERE id_centro_educativo = p_codigo_centro_educativo;
	
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
END$$

DROP FUNCTION IF EXISTS `F_NombreCompletoUsuario`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `F_NombreCompletoUsuario`(p_codigo_usuario BIGINT(10)) RETURNS varchar(300) CHARSET latin1 COLLATE latin1_bin
    COMMENT 'Función que devuelve el nombre completo de un usuario.'
BEGIN
	DECLARE v_nombre_completo_usuario VARCHAR(300);
	DECLARE v_termina INT DEFAULT FALSE;
	
	DECLARE c_nombre_completo_usuario CURSOR FOR
		SELECT CONCAT(IF(nombres_usuario IS NOT NULL, nombres_usuario, ''), ' ', IF(apellido1_usuario IS NOT NULL, apellido1_usuario, ''), ' ', IF(apellido2_usuario IS NOT NULL, apellido2_usuario, '')) nombre_completo_usuario
		FROM usuarios
		WHERE id_usuario = p_codigo_usuario;
	
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_termina = TRUE;
	
	OPEN c_nombre_completo_usuario;
	recorre_cursor: LOOP
		FETCH c_nombre_completo_usuario INTO v_nombre_completo_usuario;
		
		IF v_termina THEN
			LEAVE recorre_cursor;
		END IF;
		
	END LOOP;
	CLOSE c_nombre_completo_usuario;
	
	RETURN v_nombre_completo_usuario;
END$$

DROP FUNCTION IF EXISTS `initcap`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `initcap`(p_cadena char(255)) RETURNS char(255) CHARSET utf8
    COMMENT 'Función que devuelve la primera letra de cada palabra en mayúsculas.'
BEGIN
	SET @v_string1 ='';
	SET @v_string2 ='';
	WHILE p_cadena REGEXP ' ' DO
		SELECT SUBSTRING_INDEX(p_cadena, ' ', 1) INTO @v_string2;
		SELECT SUBSTRING(p_cadena, LOCATE(' ', p_cadena) + 1) INTO p_cadena;
		SELECT CONCAT(@v_string1, ' ', CONCAT(UPPER(SUBSTRING(@v_string2, 1, 1)), LOWER(SUBSTRING(@v_string2, 2)))) INTO @v_string1;
	END WHILE;
	RETURN TRIM(CONCAT(@v_string1, ' ', CONCAT(UPPER(SUBSTRING(p_cadena, 1, 1)), LOWER(SUBSTRING(p_cadena, 2)))));
END$$

DROP FUNCTION IF EXISTS `municipio`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `municipio`(p_nombre_municipio VARCHAR(255)) RETURNS char(3) CHARSET latin1 COLLATE latin1_bin
    COMMENT 'Función que devuelve el identificador de un municipio a partir del nombre.'
BEGIN
	DECLARE v_id_municipio CHAR(3);
	DECLARE v_termina INT DEFAULT FALSE;
	DECLARE c_municipio CURSOR FOR
		SELECT syscap.municipios.id_municipio
		FROM syscap.municipios
		WHERE initcap(syscap.municipios.nombre_municipio) = syscap.initcap(p_nombre_municipio);
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacoras`
--

DROP TABLE IF EXISTS `bitacoras`;
CREATE TABLE IF NOT EXISTS `bitacoras` (
  `id_bitacora` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` bigint(10) unsigned NOT NULL,
  `fecha_bitacora` datetime NOT NULL,
  `accion_bitacora` varchar(255) NOT NULL,
  PRIMARY KEY (`id_bitacora`),
  KEY `fk_bitacoras_usuarios` (`id_usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Información de las acciones realizadas por los usuarios.' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centros_educativos`
--

DROP TABLE IF EXISTS `centros_educativos`;
CREATE TABLE IF NOT EXISTS `centros_educativos` (
  `id_centro_educativo` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador de un centro educativo. Los valores de esté campo se obtendrán del campo <row_id> de Moodle usando ETL.',
  `codigo_centro_educativo` varchar(5) NOT NULL COMMENT 'Código de un centro educativo. Los valores de esté campo se obtendrán del campo <codigo_entidad> de Moodle usando ETL.',
  `nombre_centro_educativo` varchar(150) DEFAULT NULL COMMENT 'Nombre completo de un centro educativo. Los valores de esté campo se obtendrán del campo <nombre> de Moodle usando ETL.',
  `id_departamento` varchar(2) NOT NULL COMMENT 'Identificador del departamento al que pertenece un centro educativo. Los valores de esté campo se obtendrán del campo <depto> de Moodle usando ETL.',
  `id_municipio` varchar(3) NOT NULL COMMENT 'Identificador del municipio al que pertenece un centro educativo. Los valores de esté campo se obtendrán del campo <muni> de Moodle usando ETL.',
  PRIMARY KEY (`id_centro_educativo`),
  KEY `fk_centros_educativos_departamentos` (`id_departamento`),
  KEY `fk_centros_educativos_municipios` (`id_municipio`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Catálogo de centros educativos. Los registros de está tabla se obtendrán de la tabla <mdl_cat_educativa> de Moodle usando ETL.' AUTO_INCREMENT=2001 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

DROP TABLE IF EXISTS `cursos`;
CREATE TABLE IF NOT EXISTS `cursos` (
  `id_curso` bigint(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador de  un curso. Los valores de esté campo se obtendrán del campo <id> de Moodle usando ETL.',
  `nombre_completo_curso` varchar(255) NOT NULL COMMENT 'Nombre completo de un curso. Los valores de esté campo se obtendrán del campo <fullname> de Moodle usando ETL.',
  `nombre_corto_curso` varchar(100) NOT NULL COMMENT 'Nombre corto de un curso. Los valores de esté campo se obtendrán del campo <shortname> de Moodle usando ETL.',
  PRIMARY KEY (`id_curso`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Información central de los cursos. Los registros de está tabla se obtendrán de la tabla <mdl_course> de Moodle usando ETL.' AUTO_INCREMENT=40 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
CREATE TABLE IF NOT EXISTS `departamentos` (
  `id_departamento` varchar(2) NOT NULL COMMENT 'Identificador de un departamento. Los valores de esté campo se obtendrán del campo <id> de Moodle usando ETL.',
  `nombre_departamento` varchar(255) NOT NULL COMMENT 'Nombre completo de un departamento. Los valores de esté campo se obtendrán del campo <deptos> de Moodle usando ETL.',
  PRIMARY KEY (`id_departamento`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Catálogo de nombres de los departamentos de El Salvador. Los registros de está tabla se obtendrán de la tabla <mdl_cat_deptos> de Moodle usando ETL.';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examenes`
--

DROP TABLE IF EXISTS `examenes`;
CREATE TABLE IF NOT EXISTS `examenes` (
  `id_examen` bigint(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador de  un examen. Los valores de esté campo se obtendrán del campo <id> de Moodle usando ETL.',
  `id_curso` bigint(10) unsigned NOT NULL COMMENT 'Identificador del curso al que pertenece un examen. Los valores de esté campo se obtendrán del campo <course> de Moodle usando ETL.',
  `nombre_examen` varchar(255) NOT NULL COMMENT 'Nombre completo de un examen. Los valores de esté campo se obtendrán del campo <name> de Moodle usando ETL.',
  PRIMARY KEY (`id_examen`),
  KEY `fk_examenes_cursos` (`id_curso`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Información principal de cada examen. Los registros de está tabla se obtendrán de la tabla <mdl_quiz> de Moodle usando ETL.' AUTO_INCREMENT=23 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examenes_calificaciones`
--

DROP TABLE IF EXISTS `examenes_calificaciones`;
CREATE TABLE IF NOT EXISTS `examenes_calificaciones` (
  `id_examen_calificacion` bigint(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la calificación un examen final. Los valores de esté campo se obtendrán del campo <id> de Moodle usando ETL.',
  `id_examen` bigint(10) unsigned NOT NULL COMMENT 'Identificador del examen al que pertenece la calificación un examen final. Los valores de esté campo se obtendrán del campo <quiz> de Moodle usando ETL.',
  `id_usuario` bigint(10) unsigned NOT NULL COMMENT 'Identificador del usuario al que pertenece la calificación un examen final. Los valores de esté campo se obtendrán del campo <userid> de Moodle usando ETL.',
  `nota_examen_calificacion` double NOT NULL COMMENT 'Calificación de un examen final. Los valores de esté campo se obtendrán del campo <grade> de Moodle usando ETL.',
  `fecha_examen_calificacion` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_examen_calificacion`),
  KEY `fk_examenes_calificaciones_usuarios` (`id_usuario`),
  KEY `fk_examenes_calificaciones_examenes` (`id_examen`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Información de las calificaciones de cada examen final. Los registros de está tabla se obtendrán de la tabla <mdl_quiz_grades> de Moodle usando ETL.' AUTO_INCREMENT=1046 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriculas`
--

DROP TABLE IF EXISTS `matriculas`;
CREATE TABLE IF NOT EXISTS `matriculas` (
  `id_matricula` bigint(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador de  una matricula. Los valores de esté campo se obtendrán del campo <id> de Moodle usando ETL.',
  `id_curso` bigint(10) unsigned NOT NULL COMMENT 'Identificador del curso al que pertenece una matricula. Los valores de esté campo se obtendrán del campo <instanceid> de Moodle usando ETL.',
  PRIMARY KEY (`id_matricula`),
  KEY `fk_matriculas_cursos` (`id_curso`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Información de las matriculas de usuarios con mdl_course. Los registros de está tabla se obtendrán de la tabla <mdl_context> de Moodle usando ETL.' AUTO_INCREMENT=3025 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

DROP TABLE IF EXISTS `municipios`;
CREATE TABLE IF NOT EXISTS `municipios` (
  `id_municipio` varchar(3) NOT NULL COMMENT 'Identificador de un municipio. Los valores de esté campo se obtendrán del campo <id> de Moodle usando ETL.',
  `id_departamento` varchar(2) NOT NULL COMMENT 'Identificador del departamento al que pertenece un municipio. Los valores de esté campo se obtendrán del campo <relacion> de Moodle usando ETL.',
  `nombre_municipio` varchar(255) NOT NULL COMMENT 'Nombre completo de un municipio. Los valores de esté campo se obtendrán del campo <opcion> de Moodle usando ETL.',
  PRIMARY KEY (`id_municipio`),
  KEY `fk_municipios_departamentos` (`id_departamento`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Catálogo de nombres de los municipios de El Salvador. Los registros de está tabla se obtendrán de la tabla <mdl_cat_municip> de Moodle usando ETL.';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles_estudios`
--

DROP TABLE IF EXISTS `niveles_estudios`;
CREATE TABLE IF NOT EXISTS `niveles_estudios` (
  `id_nivel_estudio` int(4) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador de un nivel de estudio. Los valores de esté campo se obtendrán del campo <cod_nestudio> de Moodle usando ETL.',
  `nombre_nivel_estudio` varchar(100) NOT NULL COMMENT 'Nombre completo de un nivel de estudio. Los valores de esté campo se obtendrán del campo <descripcion> de Moodle usando ETL.',
  PRIMARY KEY (`id_nivel_estudio`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Catálogo de niveles de estudios. Los registros de está tabla se obtendrán de la tabla <mdl_cat_nestudio> de Moodle usando ETL.' AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesiones`
--

DROP TABLE IF EXISTS `profesiones`;
CREATE TABLE IF NOT EXISTS `profesiones` (
  `id_profesion` varchar(3) NOT NULL COMMENT 'Identificador de una profesión. Los valores de esté campo se obtendrán del campo <cod_profesion> de Moodle usando ETL.',
  `nombre_profesion` varchar(100) NOT NULL COMMENT 'Nombre completo de una profesión. Los valores de esté campo se obtendrán del campo <descripcion> de Moodle usando ETL.',
  PRIMARY KEY (`id_profesion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Catálogo de nombres de las profesiones. Los registros de está tabla se obtendrán de la tabla <mdl_cat_profesion> de Moodle usando ETL.';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id_rol` bigint(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador de un rol de Moodle. Los valores de esté campo se obtendrán del campo <id> de Moodle usando ETL.',
  `nombre_completo_rol` varchar(255) NOT NULL COMMENT 'Nombre completo de un rol de Moodle. Los valores de esté campo se obtendrán del campo <name> de Moodle usando ETL.',
  `nombre_corto_rol` varchar(100) NOT NULL COMMENT 'Nombre corto de un rol de Moodle. Los valores de esté campo se obtendrán del campo <shortname> de Moodle usando ETL.',
  `descripcion_rol` text NOT NULL COMMENT 'Descripción de un rol de Moodle. Los valores de esté campo se obtendrán del campo <description> de Moodle usando ETL.',
  `criterio_rol` bigint(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Criterio de un rol de Moodle. Los valores de esté campo se obtendrán del campo <sortorder> de Moodle usando ETL.',
  PRIMARY KEY (`id_rol`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Catálogo de roles de Moodle. Los registros de está tabla se obtendrán de la tabla <mdl_role> de Moodle usando ETL.' AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles_asignados`
--

DROP TABLE IF EXISTS `roles_asignados`;
CREATE TABLE IF NOT EXISTS `roles_asignados` (
  `id_rol_asignado` bigint(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador de un rol asignado. Los valores de esté campo se obtendrán del campo <id> de Moodle usando ETL.',
  `id_rol` bigint(10) unsigned NOT NULL COMMENT 'Identificador del rol de Moodle al que pertenece un rol asignado. Los valores de esté campo se obtendrán del campo <roleid> de Moodle usando ETL.',
  `id_matricula` bigint(10) unsigned NOT NULL COMMENT 'Identificador de la matricula al que pertenece un rol asignado. Los valores de esté campo se obtendrán del campo <contextid> de Moodle usando ETL.',
  `id_usuario` bigint(10) unsigned NOT NULL COMMENT 'Identificador del usuario al que pertenece un rol asignado. Los valores de esté campo se obtendrán del campo <userid> de Moodle usando ETL.',
  PRIMARY KEY (`id_rol_asignado`),
  KEY `fk_roles_asignados_roles` (`id_rol`),
  KEY `fk_roles_asignados_usuarios` (`id_usuario`),
  KEY `fk_roles_asignados_matriculas` (`id_matricula`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Información de la asignación de roles o funciones a diferentes matriculas o contexts. Los registros de está tabla se obtendrán de la tabla <mdl_role_assignments> de Moodle usando ETL.' AUTO_INCREMENT=5015 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_usuarios`
--

DROP TABLE IF EXISTS `tipos_usuarios`;
CREATE TABLE IF NOT EXISTS `tipos_usuarios` (
  `id_tipo_usuario` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_tipo_usuario` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Catálogo de los tipos de usuarios.' AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` bigint(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador de un usuario. Los valores de esté campo se obtendrán del campo <id> de Moodle usando ETL.',
  `nombre_usuario` varchar(100) NOT NULL COMMENT 'Nombre corto o Alias de un usuario. Los valores de esté campo se obtendrán del campo <username> de Moodle usando ETL.',
  `contrasena_usuario` varchar(32) NOT NULL COMMENT 'Contraseña de un usuario. Los valores de esté campo se obtendrán del campo <password> de Moodle usando ETL.',
  `id_tipo_usuario` int(4) NOT NULL COMMENT 'Identificador del tipo de usuario al que pertenece un usuario. Los valores de esté campo se obtendrán del campo <tipo> de Moodle usando ETL.',
  `nombres_usuario` varchar(100) NOT NULL COMMENT 'Nombres completos de un usuario. Los valores de esté campo se obtendrán del campo <firstname> de Moodle usando ETL.',
  `apellido1_usuario` varchar(100) NOT NULL COMMENT 'Primer Apellido de un usuario. Los valores de esté campo se obtendrán del campo <lastname> de Moodle usando ETL.',
  `apellido2_usuario` varchar(100) DEFAULT NULL COMMENT 'Segundo Apellido de un usuario. Los valores de esté campo se obtendrán del campo <apellido2> de Moodle usando ETL.',
  `dui_usuario` varchar(10) DEFAULT NULL COMMENT 'Número del documento único de identidad de un usuario. Los valores de esté campo se obtendrán del campo <dui> de Moodle usando ETL.',
  `sexo_usuario` char(2) NOT NULL COMMENT 'Genero de un usuario. Los valores de esté campo se obtendrán del campo <sexo> de Moodle usando ETL.',
  `id_profesion` varchar(3) DEFAULT NULL COMMENT 'Identificador de la profesión de un usuario. Los valores de esté campo se obtendrán del campo <profesion> de Moodle usando ETL.',
  `id_nivel_estudio` int(4) DEFAULT NULL COMMENT 'Identificador del nivel de estudio al que pertenece un usuario. Los valores de esté campo se obtendrán del campo <nestudio> de Moodle usando ETL.',
  `correo_electronico_usuario` varchar(100) NOT NULL COMMENT 'Correo electrónico principal de un usuario. Los valores de esté campo se obtendrán del campo <email> de Moodle usando ETL.',
  `telefono1_usuario` varchar(12) DEFAULT NULL COMMENT 'Número telefónico principal de un usuario. Los valores de esté campo se obtendrán del campo <phone1> de Moodle usando ETL.',
  `telefono2_usuario` varchar(12) DEFAULT NULL COMMENT 'Número telefónico secundario de un usuario. Los valores de esté campo se obtendrán del campo <phone2> de Moodle usando ETL.',
  `id_centro_educativo` int(10) DEFAULT NULL COMMENT 'Identificador del centro educativo al que pertenece un usuario. Los valores de esté campo se obtendrán del campo <tinstitucion> de Moodle usando ETL.',
  `id_departamento` varchar(2) NOT NULL COMMENT 'Identificador del departamento al que pertenece un usuario. Los valores de esté campo se obtendrán del campo <deptorec> de Moodle usando ETL.',
  `id_municipio` varchar(3) NOT NULL COMMENT 'Identificador del municipio al que pertenece un usuario. Los valores de esté campo se obtendrán del campo <munirec> de Moodle usando ETL.',
  `pais_usuario` varchar(2) DEFAULT NULL COMMENT 'Código de país al que pertenece un usuario. Los valores de esté campo se obtendrán del campo <country> de Moodle usando ETL.',
  `direccion_usuario` varchar(200) DEFAULT NULL COMMENT 'Dirección del domicilio de un usuario. Los valores de esté campo se obtendrán del campo <address> de Moodle usando ETL.',
  `ciudad_usuario` varchar(20) NOT NULL COMMENT 'Nombre de la ciudad a la que pertenece un usuario. Los valores de esté campo se obtendrán del campo <city> de Moodle usando ETL.',
  `fecha_nacimiento_usuario` date DEFAULT NULL COMMENT 'Fecha de nacimiento de un usuario. Los valores de esté campo se obtendrán del campo <fnacimiento> de Moodle usando ETL.',
  `modalidad_usuario` varchar(30) DEFAULT NULL COMMENT 'Modalidad de capacitación de un usuario. Los valores de esté campo se obtendrán del campo <auth> de Moodle usando ETL.',
  PRIMARY KEY (`id_usuario`),
  KEY `fk_usuarios_centros_educativos` (`id_centro_educativo`),
  KEY `fk_usuarios_niveles_estudios` (`id_nivel_estudio`),
  KEY `fk_usuarios_tipos_usuarios` (`id_tipo_usuario`),
  KEY `fk_usuarios_departamentos` (`id_departamento`),
  KEY `fk_usuarios_municipios` (`id_municipio`),
  KEY `fk_usuarios_profesiones` (`id_profesion`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Información de usuarios. Los registros de está tabla se obtendrán de la tabla <mdl_user> de Moodle usando ETL.' AUTO_INCREMENT=2209 ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_estadisticadepartamentofecha`
--
DROP VIEW IF EXISTS `v_estadisticadepartamentofecha`;
CREATE TABLE IF NOT EXISTS `v_estadisticadepartamentofecha` (
`nombres_usuario` varchar(100)
,`apellido1_usuario` varchar(100)
,`apellido2_usuario` varchar(100)
,`nota_examen_calificacion` double
,`modalidad_usuario` varchar(30)
,`nombre_examen` varchar(255)
,`tipo_capacitado` varchar(11)
,`fecha_examen_calificacion` timestamp
,`id_departamento` varchar(2)
,`nombre_departamento` varchar(255)
,`nombre_municipio` varchar(255)
,`nombre_centro_educativo` varchar(150)
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_estadisticamodalidad`
--
DROP VIEW IF EXISTS `v_estadisticamodalidad`;
CREATE TABLE IF NOT EXISTS `v_estadisticamodalidad` (
`nota_examen_calificacion` double
,`modalidad_usuario` varchar(30)
,`nombre_examen` varchar(255)
,`fecha_examen_calificacion` timestamp
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_usuarioscursosexamenescalificaciones`
--
DROP VIEW IF EXISTS `v_usuarioscursosexamenescalificaciones`;
CREATE TABLE IF NOT EXISTS `v_usuarioscursosexamenescalificaciones` (
`u_id_usuario` bigint(10) unsigned
,`u_nombre_usuario` varchar(100)
,`u_id_tipo_usuario` int(4)
,`tu_nombre_tipo_usuario` varchar(255)
,`u_nombres_usuario` varchar(100)
,`u_apellido1_usuario` varchar(100)
,`u_apellido2_usuario` varchar(100)
,`u_id_profesion` varchar(3)
,`p_nombre_profesion` varchar(100)
,`u_id_nivel_estudio` int(4)
,`ne_nombre_nivel_estudio` varchar(100)
,`u_id_centro_educativo` int(10)
,`ce_nombre_centro_educativo` varchar(150)
,`u_id_departamento` varchar(2)
,`d_nombre_departamento` varchar(255)
,`u_id_municipio` varchar(3)
,`m_nombre_municipio` varchar(255)
,`u_modalidad_usuario` varchar(30)
,`ec_id_usuario` bigint(10) unsigned
,`ec_nota_examen_calificacion` double
,`e_nombre_examen` varchar(255)
,`c_nombre_completo_curso` varchar(255)
,`c_nombre_corto_curso` varchar(100)
);
-- --------------------------------------------------------

--
-- Estructura para la vista `v_estadisticadepartamentofecha`
--
DROP TABLE IF EXISTS `v_estadisticadepartamentofecha`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_estadisticadepartamentofecha` AS select `u`.`nombres_usuario` AS `nombres_usuario`,`u`.`apellido1_usuario` AS `apellido1_usuario`,`u`.`apellido2_usuario` AS `apellido2_usuario`,`ec`.`nota_examen_calificacion` AS `nota_examen_calificacion`,`u`.`modalidad_usuario` AS `modalidad_usuario`,`e`.`nombre_examen` AS `nombre_examen`,(case when (`e`.`nombre_examen` like 'Evaluaci%') then 'Capacitado' else 'Certificado' end) AS `tipo_capacitado`,`ec`.`fecha_examen_calificacion` AS `fecha_examen_calificacion`,`d`.`id_departamento` AS `id_departamento`,`d`.`nombre_departamento` AS `nombre_departamento`,`m`.`nombre_municipio` AS `nombre_municipio`,`ce`.`nombre_centro_educativo` AS `nombre_centro_educativo` from (((((`usuarios` `u` join `examenes_calificaciones` `ec` on((`u`.`id_usuario` = `ec`.`id_usuario`))) join `examenes` `e` on((`ec`.`id_examen` = `e`.`id_examen`))) join `departamentos` `d` on((`u`.`id_departamento` = convert(`d`.`id_departamento` using utf8)))) join `municipios` `m` on((`u`.`id_municipio` = convert(`m`.`id_municipio` using utf8)))) join `centros_educativos` `ce` on((`u`.`id_centro_educativo` = `ce`.`id_centro_educativo`)));

-- --------------------------------------------------------

--
-- Estructura para la vista `v_estadisticamodalidad`
--
DROP TABLE IF EXISTS `v_estadisticamodalidad`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_estadisticamodalidad` AS select `ec`.`nota_examen_calificacion` AS `nota_examen_calificacion`,`u`.`modalidad_usuario` AS `modalidad_usuario`,`e`.`nombre_examen` AS `nombre_examen`,`ec`.`fecha_examen_calificacion` AS `fecha_examen_calificacion` from ((`usuarios` `u` join `examenes_calificaciones` `ec` on((`u`.`id_usuario` = `ec`.`id_usuario`))) join `examenes` `e` on((`ec`.`id_examen` = `e`.`id_examen`)));

-- --------------------------------------------------------

--
-- Estructura para la vista `v_usuarioscursosexamenescalificaciones`
--
DROP TABLE IF EXISTS `v_usuarioscursosexamenescalificaciones`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_usuarioscursosexamenescalificaciones` AS select `u`.`id_usuario` AS `u_id_usuario`,`u`.`nombre_usuario` AS `u_nombre_usuario`,`u`.`id_tipo_usuario` AS `u_id_tipo_usuario`,`tu`.`nombre_tipo_usuario` AS `tu_nombre_tipo_usuario`,`u`.`nombres_usuario` AS `u_nombres_usuario`,`u`.`apellido1_usuario` AS `u_apellido1_usuario`,`u`.`apellido2_usuario` AS `u_apellido2_usuario`,`u`.`id_profesion` AS `u_id_profesion`,`p`.`nombre_profesion` AS `p_nombre_profesion`,`u`.`id_nivel_estudio` AS `u_id_nivel_estudio`,`ne`.`nombre_nivel_estudio` AS `ne_nombre_nivel_estudio`,`u`.`id_centro_educativo` AS `u_id_centro_educativo`,`ce`.`nombre_centro_educativo` AS `ce_nombre_centro_educativo`,`u`.`id_departamento` AS `u_id_departamento`,`d`.`nombre_departamento` AS `d_nombre_departamento`,`u`.`id_municipio` AS `u_id_municipio`,`m`.`nombre_municipio` AS `m_nombre_municipio`,`u`.`modalidad_usuario` AS `u_modalidad_usuario`,`ec`.`id_usuario` AS `ec_id_usuario`,`ec`.`nota_examen_calificacion` AS `ec_nota_examen_calificacion`,`e`.`nombre_examen` AS `e_nombre_examen`,`c`.`nombre_completo_curso` AS `c_nombre_completo_curso`,`c`.`nombre_corto_curso` AS `c_nombre_corto_curso` from (((((((((`usuarios` `u` left join `examenes_calificaciones` `ec` on((`u`.`id_usuario` = `ec`.`id_usuario`))) left join `examenes` `e` on((`ec`.`id_examen` = `e`.`id_examen`))) left join `cursos` `c` on((`e`.`id_curso` = `c`.`id_curso`))) left join `tipos_usuarios` `tu` on((`u`.`id_tipo_usuario` = `tu`.`id_tipo_usuario`))) left join `profesiones` `p` on((`u`.`id_profesion` = convert(`p`.`id_profesion` using utf8)))) left join `niveles_estudios` `ne` on((`u`.`id_nivel_estudio` = `ne`.`id_nivel_estudio`))) left join `centros_educativos` `ce` on((`u`.`id_centro_educativo` = `ce`.`id_centro_educativo`))) left join `departamentos` `d` on((`u`.`id_departamento` = convert(`d`.`id_departamento` using utf8)))) left join `municipios` `m` on((`u`.`id_municipio` = convert(`m`.`id_municipio` using utf8))));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
