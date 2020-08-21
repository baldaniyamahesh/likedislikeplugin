<?php

function wpac_dislike_btn_ajax_action() {

global $wpdb;
$table_name = $wpdb->prefix . "like_system";
require_once( ABSPATH . 'wp-admin/includes/upgrade.php');

 if(isset($_POST['uid'])&& isset($_POST['pid'])){
$post_id=$_POST['pid'];
$user_id=$_POST['uid'];

// $alredy_like_check = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE post_id=$post_id AND user_id=$user_id AND like_count=1" );
// if($alredy_like_check>0){
//    // echo "alredy like this post ";


// global $wpdb;
// $table_name = $wpdb->prefix . "like_system";
// require_once( ABSPATH . 'wp-admin/includes/upgrade.php');


// $wpdb->query("UPDATE $table_name SET 
//     like_count=0,dislike_count=1
//     WHERE post_id = '$post_id' AND user_id ='$user_id' AND like_count =1 AND dislike_count =0");

// }

// else{


$check_dislike = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE post_id=$post_id AND user_id=$user_id AND dislike_count=1" );
 

if($check_dislike>0){
	// echo "<h4>sorry you have alredy dislike again don't dislike</h4>";
}

else{

$check_alredylike= $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE post_id=$post_id AND user_id=$user_id AND like_count=1" );
  if($check_alredylike>0){

      // like update and add dislike ///////////////////////////
      global $wpdb;
$table_name = $wpdb->prefix . "like_system";
require_once( ABSPATH . 'wp-admin/includes/upgrade.php');


$wpdb->query("UPDATE $table_name SET 
    like_count=0,dislike_count=1
     WHERE post_id = '$post_id' AND user_id ='$user_id' AND like_count =1 AND dislike_count =0");
 


  }
  else
{


$wpdb->insert( 
    ''.$table_name.'', 
    array( 
        'user_id' =>$user_id, 
        'post_id' =>$post_id,
        'dislike_count'=> 1,
    ), 
    array( 
        '%d', 
        '%d', 
        '%d', 
    ) 
);
if ($wpdb->insert_id) {

  // echo "<h4>thank you for hete post!<h4>";

}
// else end of like control
}

 }

// }
 // dislike controle else end
}


}
add_action('wp_ajax_wpac_dislike_btn_ajax_action', 'wpac_dislike_btn_ajax_action');
add_action('wp_ajax_nopriv_wpac_dislike_btn_ajax_action', 'wpac_dislike_btn_ajax_action');



function dislike_count_display($content){
global $wpdb;
$table_name = $wpdb->prefix . "like_system";

$post_id=get_the_ID();
global $post;
$userid=get_current_user_id();
$postid=get_the_ID();
$post_type=get_post_type($postid);
 
 if($post_type=='post'){
$dislike_count_display = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE post_id=$post_id AND  dislike_count=1" );
// 'var_dump($like_count_display)'
// var_dump($like_count_display);
$dislike_content= "<center style='background-color:black'> This Post Dis-Like ".$dislike_count_display." Times</center>";
$content.=$dislike_content;
return $content;
 }
}
add_filter('the_content','dislike_count_display');


