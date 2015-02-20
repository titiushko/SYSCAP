USE syscap;

-- 1. TRIGGERS TABLA USUARIOS
-- 1.1. UPDATE USUARIOS: T_BitacoraUpdateUsuarios
DELIMITER $$
DROP TRIGGER IF EXISTS T_BitacoraUpdateUsuarios $$
CREATE TRIGGER T_BitacoraUpdateUsuarios
AFTER UPDATE ON usuarios
FOR EACH ROW
BEGIN
	DECLARE v_id_usuario BIGINT(10) DEFAULT NULL;
	SELECT id_usuario into v_id_usuario FROM usuarios WHERE SUBSTRING_INDEX(USER(), '@', 1) = nombre_usuario;
	INSERT INTO bitacoras SET
		id_usuario		= v_id_usuario, 
		fecha_bitacora	= NOW(), 
		accion_bitacora	= CONCAT('UPDATE, Registro actualizado: ', OLD.nombres_usuario);
END$$
DELIMITER ;

-- 1.2. DELETE USUARIOS: T_BitacoraDeleteUsuarios
DELIMITER $$
DROP TRIGGER IF EXISTS T_BitacoraDeleteUsuarios $$
CREATE TRIGGER T_BitacoraDeleteUsuarios
BEFORE DELETE ON usuarios
FOR EACH ROW
BEGIN
	DECLARE v_id_usuario BIGINT(10) DEFAULT NULL;
	SELECT id_usuario into v_id_usuario FROM usuarios WHERE SUBSTRING_INDEX(USER(), '@', 1) = nombre_usuario;
	INSERT INTO bitacoras SET
		id_usuario		= v_id_usuario, 
		fecha_bitacora	= NOW(), 
		accion_bitacora	= CONCAT('DELETE, Registro eliminado: ', OLD.nombres_usuario);
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
	DECLARE v_id_usuario BIGINT(10) DEFAULT NULL;
	SELECT id_usuario into v_id_usuario FROM usuarios WHERE SUBSTRING_INDEX(USER(), '@', 1) = nombre_usuario;
	INSERT INTO bitacoras SET
		id_usuario		= v_id_usuario, 
		fecha_bitacora	= NOW(), 
		accion_bitacora	= CONCAT('UPDATE, Registro actualizado: ', OLD.nombre_centro_educativo);
END$$
DELIMITER ;

-- 2.2. DELETE CENTROS EDUCATIVOS: T_BitacoraDeleteCentrosEducativos
DELIMITER $$
DROP TRIGGER IF EXISTS T_BitacoraDeleteCentrosEducativos $$
CREATE TRIGGER T_BitacoraDeleteCentrosEducativos
BEFORE DELETE ON centros_educativos
FOR EACH ROW
BEGIN
	DECLARE v_id_usuario BIGINT(10) DEFAULT NULL;
	SELECT id_usuario into v_id_usuario FROM usuarios WHERE SUBSTRING_INDEX(USER(), '@', 1) = nombre_usuario;	    
	INSERT INTO bitacoras SET
		id_usuario		= v_id_usuario, 
		fecha_bitacora	= NOW(), 
		accion_bitacora	= CONCAT('DELETE, Registro eliminado: ', OLD.nombre_centro_educativo);
END$$
DELIMITER ;
