<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Archivo de propiedades de SYSCAP.
 * Almacena propiedades de configuración de SYSCAP.
 */

/*
|--------------------------------------------------------------------------
| Carousel
|--------------------------------------------------------------------------
|
| Esta propiedad de SYSCAP o variable de configuración establece si mostrar
| o no el carrusel de imágenes en 'application/views/plantilla_pagina_view.php'.
|
| 'carousel' = TRUE; muestra el carrusel.
| 'carousel' = FALSE; no muestra el carrusel.
|
*/
$config['carousel'] = FALSE;

/*
|--------------------------------------------------------------------------
| Semilla de Encriptación de Moodle
|--------------------------------------------------------------------------
|
| Esta propiedad de SYSCAP o variable de configuración establece la semilla
| de encriptación de contraseñas que utiliza Moodle.
|
| 'semilla_moodle': debe de ser igual a $CFG->passwordsaltmain del archivo
| 					moodle/config.php.
|
*/
$config['semilla_moodle'] = 'Mtx5;;1>0EWn:,,{go%~}=aPJ#Hky';

/*
|--------------------------------------------------------------------------
| Tiempo de Conexión de Sesión
|--------------------------------------------------------------------------
|
| Esta propiedad determina el número de segundos que desea que la sesión dure.
| Por defecto son 600 segundos (10 minutos).
|
| Ajustar a cero para que no expire el tiempo de conexión de las sesiones.
|
*/
$config['sess_expiration'] = 600;


/* End of file configuracion.php */
/* Location: ./application/config/configuracion.php */