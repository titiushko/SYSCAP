USE syscap;

DELIMITER $$
DROP FUNCTION IF EXISTS initcap $$
CREATE FUNCTION initcap(p_cadena char(255)) RETURNS CHAR(255) CHARSET utf8
COMMENT 'Función que devuelve la primera letra de cada palabra en mayúsculas.'
DETERMINISTIC
READS SQL DATA
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