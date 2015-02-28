#!/bin/sh

mysql -h localhost -u root -p < $SYSCAP/database/syscap-bd.sql
mysql -h localhost -u root -p < $SYSCAP/database/syscap-usuario.sql
mysql -h localhost -u root -p < $SYSCAP/database/syscap-funciones.sql
mysql -h localhost -u root -p < $SYSCAP/database/syscap-vistas.sql
mysql -h localhost -u root -p < $SYSCAP/database/syscap-disparadores.sql
mysql -h localhost -u root -p < $SYSCAP/database/syscap-etl.sql
mysql -h localhost -u root -p < $SYSCAP/database/syscap-datos.sql
