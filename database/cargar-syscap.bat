@echo off
%MYSQL_HOME%\bin\mysql.exe -uroot --password= < %SYSCAP%\database\syscap.sql
pause
