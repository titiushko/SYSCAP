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
DROP FUNCTION IF EXISTS F_CodigoDepartamento $$
CREATE FUNCTION F_CodigoDepartamento(p_nombre_departamento VARCHAR(255)) RETURNS CHAR(2)
COMMENT 'Función que devuelve el identificador de un departamento a partir del nombre.'
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
DROP FUNCTION IF EXISTS F_NombreDepartamento $$
CREATE FUNCTION F_NombreDepartamento(p_codigo_departamento CHAR(2)) RETURNS VARCHAR(255)
COMMENT 'Función que devuelve el nombre de un departamento a partir del identificador.'
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
DROP FUNCTION IF EXISTS F_CodigoMunicipio $$
CREATE FUNCTION F_CodigoMunicipio(p_nombre_municipio VARCHAR(255)) RETURNS CHAR(3)
COMMENT 'Función que devuelve el identificador de un municipio a partir del nombre.'
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
DROP FUNCTION IF EXISTS F_NombreMunicipio $$
CREATE FUNCTION F_NombreMunicipio(p_codigo_municipio CHAR(3)) RETURNS VARCHAR(255)
COMMENT 'Función que devuelve el nombre de un municipio a partir del identificador.'
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
COMMENT 'Función que devuelve el nombre completo (todos los nombres y todos los apellidos) de un usuario.'
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
COMMENT 'Función que devuelve el nombre compacto (un nombre y un apellido) de un usuario.'
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
COMMENT 'Función que devuelve el nombre de un centro educativo.'
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
