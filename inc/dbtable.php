<?php
function like_system_table(){

global $wpdb;

$charset_collate = $wpdb->get_charset_collate();
$table_name = $wpdb->prefix . "like_system"; 
$sql = "CREATE TABLE IF NOT EXISTS $table_name (
  id mediumint(9) NOT NULL AUTO_INCREMENT,
  time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  user_id mediumint(9) NOT NULL,
  post_id mediumint(9) NOT NULL,
  like_count mediumint(9) NOT NULL,
  dislike_count mediumint(9) NOT NULL,

  PRIMARY KEY  (id)
) $charset_collate;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );

}
// hook activate plugin
register_activation_hook( __FILE__, 'like_system_table' );

