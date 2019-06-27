<?php
/* 
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 * 
 * @category   Privaciad Wordpress Plugin
 * @package    backend.class.php
 * @author     José Luis Rojo Sánchez <jose@artegrafico.net>
 * @copyright  Copyright (c) artegrafico.net (https://www.artegrafico.net/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @version    0.0.1
 *
 */

class artegraficoPrivacidad {

    protected $_debug;
    protected $_aglopdgdd_content_settings;

    public function init() {
        
        // crear menús de administración
        add_action( 'admin_menu', [ $this, 'addAdminMenu' ] );  

        // incluir scripts al backend
        add_action( 'admin_enqueue_scripts', [ $this, 'addScripts' ] );   
        add_action ('admin_init', [ $this, 'addSettingsFields' ] );

        // get settings from wp_options
        $this->_aglopdgdd_content_settings = get_option('aglopdgdd_content_settings');        
    
    }

    /**
     * Activación del Plugin
     * @desc creación de tablas personalizadas 
     * @info https://codex.wordpress.org/Class_Reference/wpdb
     */
     public function activation() {   
      
        // add options settings
        add_option( 'aglopdgdd_version', '1', '', 'yes' ); // version
        add_option( 'aglopdgdd_content_settings', '', '', 'yes' ); // name settings field || API Settings

        // add default settings from Plugin on activation
        $options = get_option('aglopdgdd_content_settings');
        // if not options ... update with default settings
        if (!$options) {
            update_option('aglopdgdd_content_settings', $this->defaultSettings());
        } 
             
    }   

    /**
     * defaultSettings from plugin
     * @return array
     */
    public function defaultSettings() {

        $defaultSettings = [
            'lopdgdd_title' => __('Tu Privacidad es importante para nosotros', 'artegrafico-lopdgdd'),
            'lopdgdd_description' => __('Tanto nuestros partners como nosotros utilizamos <strong>cookies</strong> en nuestro sitio web para personalizar contenido y publicidad, proporcionar funcionalidades a las redes sociales, o analizar nuestro tráfico. Haciendo click consientes el uso de esta tecnología en nuestra web.', 'artegrafico-lopdgdd'),
            'lopdgdd_activation' => 1
        ];
        return $defaultSettings;

    }

    /**
     * menus
     * @desc inclusión de menus y submenús al Plugin
     */
    public function addAdminMenu() {
    
        // options
        add_options_page ('Opciones de Privacidad', 'Opciones de Privacidad', 'manage_options', 'opciones-privacidad', [ $this, 'pageDashboard' ] );

    }

    /**
     * Page: dashboard
     */
    public function pageDashboard() {
    
        include _PRIVACIDAD_DIR.'admin/dashboard.php';
        
    }

    /**
     * Page: opciones
     */
    public function pageOptions(){

        include _PRIVACIDAD_DIR.'admin/options.php';

    }

    /**
     * Page: who am i
     */
    public function who_am_i() {

        include _PRIVACIDAD_DIR.'admin/who-am-i.php';

    }

    /**
     * Backend Scripts
     * @desc inclusión de scripts a nuestro backend
     */
    public function addScripts() {

        // páginas del plugin
        $_pages = [
            'opciones-privacidad'
        ];       

        // cargar scripts sólo en las páginas de nuestro plugin
        if ( in_array(FILTER_INPUT(INPUT_GET, 'page'), $_pages )) {    

            wp_enqueue_style( 'privacidad', _PRIVACIDAD_DIR_URL . 'assets/css/privacidadBackend.css', [], null, false );
            wp_enqueue_style( 'bootstrap-4-3.1', '//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css', '4.3.1', null, false );

        }

    }
    /**
     * @url https://codex.wordpress.org/Settings_API
     * @url https://codex.wordpress.org/es:Referencia_de_Funciones/register_setting     * 
     */
    public function addSettingsFields() {

        //$current = isset($_GET['tab']) ? $_GET['tab'] : 'content';
        register_setting( 'aglopdgdd_content', 'aglopdgdd_content_settings' );
        add_settings_section ('aglopdgdd_content_section', '', [ $this, 'content_settings_section_callback' ], 'aglopdgdd_content');    
        add_settings_field( 'lopdgdd_title', __('Texto principal', 'artegrafico-lopdgdd'), [ $this, 'title_render' ], 'aglopdgdd_content', 'aglopdgdd_content_section' );
        add_settings_field( 'lopdgdd_url', __('URL página privacidad', 'artegrafico-lopdgdd'), [ $this, 'url_render' ], 'aglopdgdd_content', 'aglopdgdd_content_section' );
        add_settings_field( 'lopdgdd_description', __('Texto principal', 'artegrafico-lopdgdd'), [ $this, 'description_render' ], 'aglopdgdd_content', 'aglopdgdd_content_section' );
        add_settings_field( 'lopdgdd_activation', __('Activación', 'artegrafico-lopdgdd'), [ $this, 'activation_render'], 'aglopdgdd_content', 'aglopdgdd_content_section');

    }

    public function title_render() {

        if (!isset($this->_aglopdgdd_content_settings['lopdgdd_title'])) { $this->_aglopdgdd_content_settings['lopdgdd_title'] = ""; }

        // https://developer.wordpress.org/reference/functions/esc_attr/
        ?><div class='aglopdgdd_formularios'>
            <input class="widefat" type="text" name="aglopdgdd_content_settings[lopdgdd_title]" value="<?php echo esc_attr($this->_aglopdgdd_content_settings['lopdgdd_title']); ?>">
            <p class="description"><?php _e('Texto que se mostrará en el recuadro de la política de cookies', 'artegrafico-lopdgdd'); ?></p></div>
        <?php
    }    

    public function url_render() {

        if (!isset($this->_aglopdgdd_content_settings['lopdgdd_url'])) { $this->_aglopdgdd_content_settings['lopdgdd_url'] = ""; }

        ?><div class='aglopdgdd_formularios'>
            <input class="widefat" type="text" name="aglopdgdd_content_settings[lopdgdd_url]" value="<?php echo esc_attr($this->_aglopdgdd_content_settings['lopdgdd_url']); ?>">
            <p class="description"><?php _e('URL que se abrirá cuando el usuario haga click en más información', 'artegrafico-lopdgdd'); ?></p></div>
        <?php
    }        

    public function description_render() {

        if (!isset($this->_aglopdgdd_content_settings['lopdgdd_description'])) { $this->_aglopdgdd_content_settings['lopdgdd_description'] = ""; }

        ?><div class='aglopdgdd_formularios'>
        <?php wp_editor( esc_attr($this->_aglopdgdd_content_settings['lopdgdd_description']), 'aglopdgdd_content_settings[lopdgdd_description]', $settings = ['editor_height' => 300] ); ?>
        <p class="description"><?php _e('Texto ampliado que se mostrará en el recuadro de la política de cookies', 'artegrafico-lopdgdd'); ?></p></div>
        <?php

    }

    public function activation_render() {

        if (!isset($this->_aglopdgdd_content_settings['lopdgdd_activation'])) { $this->_aglopdgdd_content_settings['lopdgdd_activation'] = ""; }

	    if($this->_aglopdgdd_content_settings['lopdgdd_activation']) { $checked = ' checked="checked" '; } else { $checked = ''; }
        echo "<input ".$checked." name='aglopdgdd_content_settings[lopdgdd_activation]' type='checkbox' />";
        echo '<p class="description">'._e('Activar la alerta', 'artegrafico-lopdgdd').'</p></div>';

    }
    
    public function content_settings_section_callback() {
        echo '<h6>'.__('Configure el panel de privacidad que será visible para el usuario', 'artegrafico-lopdgdd').'</h6>';
    }    

    public function debug() {

        $_debug = [
            'directorio plugin: '._PRIVACIDAD_DIR,
            'url plugin: '._PRIVACIDAD_DIR_URL
        ];
        return $_debug;       
        
    }

}