@echo off

:: Ejecutar esté script para crear la base de datos de SYSCAP y todos sus objetos de base de datos.
:: Al ejecutar el script, se solicitará la contraseña del usuario ROOT de MySQL

%MYSQL_HOME%\bin\mysql.exe -uroot --password= < %SYSCAP%\database\syscap-bd.sql
%MYSQL_HOME%\bin\mysql.exe -uroot --password= < %SYSCAP%\database\syscap-usuario.sql
%MYSQL_HOME%\bin\mysql.exe -uroot --password= < %SYSCAP%\database\syscap-funciones.sql
%MYSQL_HOME%\bin\mysql.exe -uroot --password= < %SYSCAP%\database\syscap-vistas.sql
%MYSQL_HOME%\bin\mysql.exe -uroot --password= < %SYSCAP%\database\syscap-disparadores.sql
%MYSQL_HOME%\bin\mysql.exe -uroot --password= < %SYSCAP%\database\syscap-procedimientos.sql
%MYSQL_HOME%\bin\mysql.exe -uroot --password= < %SYSCAP%\database\syscap-etl.sql
%MYSQL_HOME%\bin\mysql.exe -uroot --password= < %SYSCAP%\database\syscap-datos.sql

pause
