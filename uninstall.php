<?php
// si este fichero no es ejecutado por Wordpress, exit()
if (!defined('WP_UNINSTALL_PLUGIN')) { die; }

// borrar opciones
delete_option( 'artegrafico-privacidad');
 
// for site options in Multisite
//delete_site_option($option_name);
 
// drop a custom database table
global $wpdb;
$table = $wpdb->prefix . 'artegrafico_privacidad';
$sql = 'DROP TABLE IF EXISTS '.$table;  
$wpdb->query($sql);