<?php
/**
 * Plugin Name: Privacidad
 * Plugin URI: https://wwww.artegrafico.net
 * Description: Controla la Privacidad de tu sitio web
 * Author: José Luis Rojo Sánchez
 * Author URI: https://wwww.artegrafico.net
 * Version: 1.0
 * Date: 2019-07-01
 * License: GPLv2
 * Text Domain: artegrafico-lopdgdd
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// definir constantes del Plugin
define ( '_PRIVACIDAD_DIR', plugin_dir_path(__FILE__) );
define ( '_PRIVACIDAD_DIR_URL', plugin_dir_url(__FILE__) );

if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {    

    require_once( _PRIVACIDAD_DIR . 'inc/backend.class.php' );    
    $privacidadBackend = new artegraficoPrivacidad();  
    $privacidadBackend->init();
    //$privacidad->debug();

    /**
     * en activation de plugin
     * crear tablas personalizadas */
    register_activation_hook( __FILE__, [ $privacidadBackend, 'activation' ] );       

} else {

    require_once( _PRIVACIDAD_DIR . 'inc/frontend.class.php' );    
    $privacidadFrontend = new artegraficoPrivacidad();  

    // scripts frontend
    add_action( 'wp_enqueue_scripts', [ $privacidadFrontend, 'addScripts' ] ); 
    add_action( 'wp_footer', [ $privacidadFrontend, 'addPrivacidadBar' ] ); 

   

}