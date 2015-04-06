/*
-- Ver si el usuario tiene permisos asignados
SHOW GRANTS FOR 'syscap'@'%';
SHOW GRANTS FOR 'syscap'@'localhost';
SHOW GRANTS FOR 'syscap'@'127.0.0.1';

-- Quitar todos los permisos al usuario
REVOKE ALL ON *.* FROM 'syscap'@'%', 'syscap'@'localhost', 'syscap'@'127.0.0.1';

-- Eliminar el usuario
DROP USER 'syscap'@'%', 'syscap'@'localhost', 'syscap'@'127.0.0.1';
*/

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
