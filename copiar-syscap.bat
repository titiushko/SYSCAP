@echo off
mode con cols=90 lines=30
:inicio
cls
echo COPIAR LOS ARCHIVOS DEL SISTEMA PARA PUBLICAR SYSCAP
echo.
:: set /p unidad_disco=Seleccionar unidad: 
set unidad_disco=C
if not defined unidad_disco goto inicio
cls
if not exist %unidad_disco%:\nul goto no_unidad
echo COPIAR LOS ARCHIVOS DEL SISTEMA PARA PUBLICAR SYSCAP
echo.
echo Unidad seleccionada %unidad_disco%:\
if not exist %unidad_disco%:\syscap\nul goto no_syscap
rd %unidad_disco%:\syscap /S /Q
:no_syscap
md %unidad_disco%:\syscap
echo.
echo Copiando de %cd%\application a %unidad_disco%:\syscap\application
xcopy application %unidad_disco%:\syscap\application /E /I /Q /Y
echo.
echo Copiando de %cd%\libraries a %unidad_disco%:\syscap\libraries
xcopy libraries %unidad_disco%:\syscap\libraries /E /I /Q /Y
echo.
echo Copiando de %cd%\system a %unidad_disco%:\syscap\system
xcopy system %unidad_disco%:\syscap\system /E /I /Q /Y
echo.
echo Copiando de %cd% a %unidad_disco%:\syscap
xcopy *.* %unidad_disco%:\syscap /E /I /Q /Y /EXCLUDE:no-copiar
goto fin
:no_unidad
echo COPIAR LOS ARCHIVOS DEL SISTEMA PARA PUBLICAR SYSCAP
echo.
echo Unidad %unidad_disco%:\ no existe
goto inicio
:fin
echo.
echo Se copiaron los archivos del sistema en %unidad_disco%:\syscap
echo.
echo Presionar una tecla para salir...
pause>nul
exit