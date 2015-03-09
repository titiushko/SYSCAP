<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Archivo de propiedades de SYSCAP.
 * Almacena propiedades de configuraci�n de SYSCAP.
 */

/*
|--------------------------------------------------------------------------
| Carousel
|--------------------------------------------------------------------------
|
| Esta propiedad de SYSCAP o variable de configuraci�n establece si mostrar
| o no el carrusel de im�genes en 'application/views/plantilla_pagina_view.php'.
|
| 'carousel' = TRUE; muestra el carrusel.
| 'carousel' = FALSE; no muestra el carrusel.
|
*/
$config['carousel'] = FALSE;

/*
|--------------------------------------------------------------------------
| Semilla de Encriptaci�n de Moodle
|--------------------------------------------------------------------------
|
| Esta propiedad de SYSCAP o variable de configuraci�n establece la semilla
| de encriptaci�n de contrase�as que utiliza Moodle. 
|
| 'semilla_moodle': debe de ser igual a $CFG->passwordsaltmain del archivo
| 					moodle/config.php.
|
*/
$config['semilla_moodle'] = 'Mtx5;;1>0EWn:,,{go%~}=aPJ#Hky';

/* End of file properties.php */
/* Location: ./application/properties/properties.php */