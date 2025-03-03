<?php

namespace CHSOOPREMA;

/*
Plugin Name: SOOPREMA import
Plugin URI: https://carlos-herrera.com/producto/conector-de-inmuebles-sooprema-para-wordpress/
Description:Another plugin developed on Antonella Framework for WP
Requires PHP: ^8.0
Version: 1.1.0
Author: Carlos Herrera
Author URI: https://carlos-herrera.com
Framework: Antonella Framework for WP
Framework URI: http://antonellaframework.com
License: GPL2+
Text Domain: ch_sooprema
Domain Path: /languages
*/

defined('ABSPATH') or die(__('Lo siento por aqui no puedes pasar :)'));

/*
* Class Caller.
* cuando una clase es llamada hace un include
* al archivo con su mismo nombre
* se respeta mayusculas y minusculas
*
* @return null
*/
$loader = require __DIR__.'/vendor/autoload.php';
$antonella = new Start();
