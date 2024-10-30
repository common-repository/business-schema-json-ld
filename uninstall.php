<?php
/*
  Uninstall script for Business Schema JSON-LD
  - delete the plugin settings from "wp_settings" table
  - delete all the custom meta data 
*/

 
$option_name = 'bs_settings';
delete_option($option_name);

global $wpdb;
$wpdb->delete("wp_postmeta", array('meta_key' => 'bs_products_name'));
$wpdb->delete("wp_postmeta", array('meta_key' => 'bs_products_description'));
$wpdb->delete("wp_postmeta", array('meta_key' => 'bs_products_image_url'));
$wpdb->delete("wp_postmeta", array('meta_key' => 'bs_products_brand'));
?>