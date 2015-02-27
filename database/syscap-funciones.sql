USE syscap;

DELIMITER $$
DROP FUNCTION IF EXISTS initcap $$
CREATE FUNCTION initcap(p_cadena CHAR(255)) RETURNS CHAR(255) CHARSET utf8
COMMENT 'Función que devuelve la primera letra de cada palabra en mayúsculas.'
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
DROP FUNCTION IF EXISTS departamento $$
CREATE FUNCTION departamento(p_nombre_departamento VARCHAR(255)) RETURNS CHAR(2)
COMMENT 'Función que devuelve el identificador de un departamento a partir del nombre.'
DETERMINISTIC
READS SQL DATA
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
DELIMITER ;

-- ------------------------------------------------------------------------------------------

DELIMITER $$
DROP FUNCTION IF EXISTS municipio $$
CREATE FUNCTION municipio(p_nombre_municipio VARCHAR(255)) RETURNS CHAR(3)
COMMENT 'Función que devuelve el identificador de un municipio a partir del nombre.'
DETERMINISTIC
READS SQL DATA
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

-- ------------------------------------------------------------------------------------------

DELIMITER $$
DROP FUNCTION IF EXISTS F_NombreCompletoUsuario $$
CREATE FUNCTION F_NombreCompletoUsuario(p_codigo_usuario BIGINT(10)) RETURNS VARCHAR(300)
NOT DETERMINISTIC
SQL SECURITY DEFINER
COMMENT 'Función que devuelve el nombre completo de un usuario.'
DETERMINISTIC
READS SQL DATA
BEGIN
	DECLARE v_nombre_completo_usuario VARCHAR(300);
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
DROP FUNCTION IF EXISTS F_NombreCentroEducativo $$
CREATE FUNCTION F_NombreCentroEducativo(p_codigo_centro_educativo BIGINT(10)) RETURNS VARCHAR(300)
DETERMINISTIC
READS SQL DATA
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
END;
$$
DELIMITER ;

-- ------------------------------------------------------------------------------------------

DELIMITER $$
DROP FUNCTION IF EXISTS acentos $$
CREATE FUNCTION acentos(p_cadena CHAR(255)) RETURNS CHAR(255) CHARSET utf8
COMMENT 'Función que corrige los problemas de tildes.'
DETERMINISTIC
READS SQL DATA
BEGIN
	DECLARE v_cadena CHAR(255);
	
	SET v_cadena = p_cadena;
	SET v_cadena = REPLACE(v_cadena, 'Ã', 'Á');
	SET v_cadena = REPLACE(v_cadena, 'ã¡', 'á');
	SET v_cadena = REPLACE(v_cadena, 'ã©', 'é');
	SET v_cadena = REPLACE(v_cadena, 'í¨', 'é');
	SET v_cadena = REPLACE(v_cadena, 'í‰', 'é');
	SET v_cadena = REPLACE(v_cadena, 'í¨', 'é');
	SET v_cadena = REPLACE(v_cadena, 'ã¬', 'í');
	SET v_cadena = REPLACE(v_cadena, 'ã', 'í');
	SET v_cadena = REPLACE(v_cadena, 'ã²', 'ó');
	SET v_cadena = REPLACE(v_cadena, 'ã³', 'ó');
	SET v_cadena = REPLACE(v_cadena, 'í³', 'ó');
	SET v_cadena = REPLACE(v_cadena, 'í²', 'ó');
	SET v_cadena = REPLACE(v_cadena, 'íº', 'ú');
	SET v_cadena = REPLACE(v_cadena, 'í¹', 'ú');
	SET v_cadena = REPLACE(v_cadena, 'ã‘', 'ñ');
	SET v_cadena = REPLACE(v_cadena, 'í‘', 'ñ');
	SET v_cadena = REPLACE(v_cadena, 'í±', 'ñ');
	SET v_cadena = REPLACE(v_cadena, 'ã±', 'ñ');
	
	RETURN v_cadena;
END$$
DELIMITER ;
