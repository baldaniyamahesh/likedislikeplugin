<?php
/**
 * Plugin Name:       My First Plugin
 * Description:       Pluig in Learn Basic.
 * Version:           1.0.0
 * Author:            Baldaniya Mayur
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       my-basics-plugin
 * Domain Path:       My First Plugin
 */

// If this file is called directly, abort.
if (!defined( 'WPINC' )) {
    die;
}

//Define Constants
if ( !defined('WPAC_PLUGIN_VERSION')) {
    define('WPAC_PLUGIN_VERSION', '1.0.0');
}
if ( !defined('WPAC_PLUGIN_DIR')) {
    define('WPAC_PLUGIN_DIR', plugin_dir_url( __FILE__ ));
}


//Include Scripts & Styles
require plugin_dir_path( __FILE__ ). 'inc/scripts.php';



//Settings Page HTML
require plugin_dir_path( __FILE__ ). 'inc/settings.php';

// create table for like system
// require plugin_dir_path( __FILE__ ). 'inc/dbtable.php';
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



// create button content using filter in wordpress
require plugin_dir_path( __FILE__ ). 'inc/btncontent.php';

// like count 
require plugin_dir_path( __FILE__ ). 'inc/likeaction.php';


// dislike count in wordpress//////////////////////////////////

require plugin_dir_path( __FILE__ ). 'inc/dislike.php';

?>
