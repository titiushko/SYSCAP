#!/bin/sh

mysql -h localhost -u root -p < $SYSCAP/database/syscap.sql
mysql -h localhost -u root -p < $SYSCAP/database/syscap-funciones.sql
mysql -h localhost -u root -p < $SYSCAP/database/syscap-vistas.sql
mysql -h localhost -u root -p < $SYSCAP/database/syscap-datos.sql
