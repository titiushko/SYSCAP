USE syscap;

DELIMITER $$
DROP FUNCTION IF EXISTS initcap $$
CREATE FUNCTION initcap(p_cadena char(255)) RETURNS CHAR(255) CHARSET utf8
COMMENT 'funcion que devuelve la primera letra de cada palabra en mayúsculas.'
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
COMMENT 'funcion que devuelve el identificador de un departamento a partir del nombre.'
BEGIN
	DECLARE v_id_departamento CHAR(2);
	SELECT syscap.departamentos.id_departamento INTO v_id_departamento FROM syscap.departamentos WHERE initcap(syscap.departamentos.nombre_departamento) = syscap.initcap(p_nombre_departamento);
	RETURN v_id_departamento;
END$$
DELIMITER ;

-- ------------------------------------------------------------------------------------------

DELIMITER $$
DROP FUNCTION IF EXISTS municipio $$
CREATE FUNCTION municipio(p_nombre_municipio VARCHAR(255)) RETURNS CHAR(2)
COMMENT 'funcion que devuelve el identificador de un municipio a partir del nombre.'
BEGIN
	DECLARE v_id_municipio CHAR(2);
	SELECT syscap.municipios.id_municipio INTO v_id_municipio FROM syscap.municipios WHERE initcap(syscap.municipios.nombre_municipio) = syscap.initcap(p_nombre_municipio);
	RETURN v_id_municipio;
END$$
DELIMITER ;
