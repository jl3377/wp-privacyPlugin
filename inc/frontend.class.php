<?php
/**
 * MiPrimerPlugin  
 * Clase de ejemplo que gestiona el Plugin de WordPress "MiPrimerPlugin"
 * 
 * @author José Luis Rojo Sánchez
 */

class artegraficoPrivacidad {

    protected $_data;

    /** init
     * @url https://codex.wordpress.org/Category:Actions
     * @url https://developer.wordpress.org/reference/functions/add_action/
     */
    public function init() {

        add_action( 'wp_footer', [ __CLASS__, 'addPrivacidadBar' ] );

    }
  
    /**
     * Frontend Scripts
     * @desc inclusión de Scripts a nuestro frontend
     */
    public function addScripts() {

        // frontend 
        wp_enqueue_style( 'privacidad-', _PRIVACIDAD_DIR_URL . 'assets/css/privacidadFrontend.css', [], null, false );
        wp_enqueue_script( 'privacidad-js', _PRIVACIDAD_DIR_URL . 'assets/js/privacidadFrontend.js', [], null, false );

    }

    public function getSettings() {
        
        $settings = get_option( 'aglopdgdd_content_settings' );
        return $settings;

    }

    public function addPrivacidadBar() {
       
        $_settings = $this->getSettings();

        if ($_settings["lopdgdd_activation"]) {
        echo '<div id="privacidadBar">
        <div class="privacidadTitle">'.$_settings["lopdgdd_title"].'</div>
        <div class="privacidadContent">'.$_settings["lopdgdd_description"].'</div>        
        <a href="" id="privacidadAceptar" onclick="privacidadAceptar();">Aceptar</a> | 
        <a href="'.$_settings["lopdgdd_url"].'" id="privacidadMasInformacion">Más Información</a>
        </div>';
        }

    } 

}