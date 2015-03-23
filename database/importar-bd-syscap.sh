#!/bin/sh

# Ejecutar esté script para crear la base de datos de SYSCAP y todos sus objetos de base de datos.
# Al ejecutar el script, se solicitará la contraseña del usuario ROOT de MySQL

mysql -h localhost -u root -p < $SYSCAP/database/syscap-bd.sql
mysql -h localhost -u root -p < $SYSCAP/database/syscap-usuario.sql
mysql -h localhost -u root -p < $SYSCAP/database/syscap-funciones.sql
mysql -h localhost -u root -p < $SYSCAP/database/syscap-vistas.sql
mysql -h localhost -u root -p < $SYSCAP/database/syscap-disparadores.sql
mysql -h localhost -u root -p < $SYSCAP/database/syscap-procedimientos.sql
mysql -h localhost -u root -p < $SYSCAP/database/syscap-etl.sql
mysql -h localhost -u root -p < $SYSCAP/database/syscap-datos.sql
