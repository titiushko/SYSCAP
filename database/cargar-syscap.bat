@echo off

:: Ejecutar esté script para crear la base de datos de SYSCAP y todos sus objetos de base de datos.
:: Al ejecutar el script, se solicitará la contraseña del usuario ROOT de MySQL

%MYSQL_HOME%\bin\mysql.exe -uroot --password= < %SYSCAP%\database\syscap.sql

pause
