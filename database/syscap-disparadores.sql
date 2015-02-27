USE syscap;

-- 1. TRIGGERS TABLA USUARIOS
-- 1.1. UPDATE USUARIOS: T_BitacoraUpdateUsuarios
DELIMITER $$
DROP TRIGGER IF EXISTS T_BitacoraUpdateUsuarios $$
CREATE TRIGGER T_BitacoraUpdateUsuarios
AFTER UPDATE ON usuarios
FOR EACH ROW
BEGIN
	DECLARE v_accion_bitacora TEXT DEFAULT ' ';
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
	INSERT INTO bitacoras SET
		id_usuario			= OLD.id_usuario,
		id_centro_educativo	= NULL,
		usuario_bitacora	= SUBSTRING_INDEX(USER(), '@', 1),
		fecha_bitacora		= NOW(),
		accion_bitacora		= CONCAT('UPDATE TABLE usuarios.', v_accion_bitacora);
END$$
DELIMITER ;

-- 2. TRIGGERS TABLA CENTROS EDUCATIVOS
-- 2.1. UPDATE CENTROS EDUCATIVOS: T_BitacoraUpdateCentrosEducativos
DELIMITER $$
DROP TRIGGER IF EXISTS T_BitacoraUpdateCentrosEducativos $$
CREATE TRIGGER T_BitacoraUpdateCentrosEducativos
AFTER UPDATE ON centros_educativos
FOR EACH ROW
BEGIN
	DECLARE v_accion_bitacora TEXT DEFAULT ' ';
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
	INSERT INTO bitacoras SET
		id_usuario			= NULL,
		id_centro_educativo	= OLD.id_centro_educativo,
		usuario_bitacora	= SUBSTRING_INDEX(USER(), '@', 1),
		fecha_bitacora		= NOW(),
		accion_bitacora		= CONCAT('UPDATE TABLE centros_educativos.', v_accion_bitacora);
END$$
DELIMITER ;
