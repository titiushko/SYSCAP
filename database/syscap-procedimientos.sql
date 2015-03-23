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

-- ------------------------------------------------------------------------------------------

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
			syscap.codigo_departamento(moodle19.mdl_cat_educativa.depto),
			syscap.codigo_municipio(moodle19.mdl_cat_educativa.muni)
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
			nombre_departamento(ce.id_departamento),
			nombre_municipio(ce.id_municipio)
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
