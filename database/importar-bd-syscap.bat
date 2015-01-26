@echo off
%MYSQL_HOME%\bin\mysql.exe -uroot --password= < %SYSCAP%\database\syscap.sql
%MYSQL_HOME%\bin\mysql.exe -uroot --password= < %SYSCAP%\database\syscap-funciones.sql
%MYSQL_HOME%\bin\mysql.exe -uroot --password= < %SYSCAP%\database\syscap-vistas.sql
%MYSQL_HOME%\bin\mysql.exe -uroot --password= < %SYSCAP%\database\syscap-datos.sql
pause