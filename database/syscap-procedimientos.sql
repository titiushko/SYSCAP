USE syscap;

DELIMITER $$
DROP PROCEDURE IF EXISTS P_AsignarCentroEducativo $$
CREATE PROCEDURE P_AsignarCentroEducativo()
COMMENT 'Procedimiento que asigna a un usuario el primer centro educativo del departamentos y el municipio del usuario.'
DETERMINISTIC
READS SQL DATA
BEGIN
	DECLARE v_id_departamento CHAR(2);
	DECLARE v_id_municipio CHAR(3);
	DECLARE v_id_centro_educativo INT(10);
	DECLARE v_termina INT DEFAULT FALSE;
	DECLARE c_usuarios CURSOR FOR
		SELECT id_departamento, id_municipio
		FROM usuarios
		WHERE id_departamento IS NOT NULL AND id_departamento != '' AND id_municipio IS NOT NULL AND id_municipio != '';
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_termina = TRUE;
	
	UPDATE usuarios SET id_departamento = '01', id_municipio = '01'
	WHERE (id_departamento IS NULL OR id_departamento = '' OR id_departamento LIKE 'nul%') OR (id_municipio IS NULL OR id_municipio = '' OR id_municipio LIKE 'nul%');

	OPEN c_usuarios;
	recorre_cursor: LOOP
		FETCH c_usuarios INTO v_id_departamento, v_id_municipio;
		
		SET v_id_centro_educativo = (SELECT id_centro_educativo FROM centros_educativos WHERE id_departamento = v_id_departamento AND id_municipio = v_id_municipio LIMIT 0, 1);
		UPDATE usuarios SET id_centro_educativo = v_id_centro_educativo WHERE id_departamento = v_id_departamento AND id_municipio = v_id_municipio;
		
		IF v_termina THEN
			LEAVE recorre_cursor;
		END IF;
		
	END LOOP;
	CLOSE c_usuarios;
	
	UPDATE usuarios SET id_centro_educativo = 1139
	WHERE id_centro_educativo IS NULL OR id_centro_educativo = '' OR id_centro_educativo LIKE 'nul%';
END$$
DELIMITER ;

CALL P_AsignarCentroEducativo();
