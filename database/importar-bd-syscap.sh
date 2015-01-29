#!/bin/sh

mysql -h localhost -u root -p < /home/tito/www/syscap/database/syscap.sql
mysql -h localhost -u root -p < /home/tito/www/syscap/database/syscap-funciones.sql
mysql -h localhost -u root -p < /home/tito/www/syscap/database/syscap-vistas.sql
mysql -h localhost -u root -p < /home/tito/www/syscap/database/syscap-datos.sql
