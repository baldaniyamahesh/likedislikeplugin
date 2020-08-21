<?php
function add_button_like_dislike($content){
global $post;
$userid=get_current_user_id();
$postid=get_the_ID();
$post_type=get_post_type($postid);
 
 if($post_type==='post'){

 $like_lebel=get_option('wpac_like_btn_label','Like');
$dislike_lebel=get_option('wpac_dislike_btn_label','DisLike');
 $wrap_start='<div class="wrap_like_syatem" style="text-align:center;border:1px solid grey; padding:10px;">';

global $wpdb;
$table_name = $wpdb->prefix . "like_system";
global $post;

$like_color= $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE post_id=$postid AND  like_count=0 AND user_id=$userid"  );
if($like_color>0){
 
 $like_btn='<a href="javascript:;" onclick="like_button_fun('.$postid.','.$userid.')" class="wp_btn_ikesystem system_like_btn" style="color:black; font-size:30px;padding:50px;"><i class="fas fa-thumbs-up fa-lg" aria-hidden="true"></i>'.$like_lebel.'</a>';
 }
 else{
   $like_btn='<a href="javascript:;" onclick="like_button_fun('.$postid.','.$userid.')" class="wp_btn_ikesystem system_like_btn" style="color:black; font-size:30px;padding:50px;"><i class="fas fa-thumbs-up fa-lg" aria-hidden="true"></i>'.$like_lebel.'</a>';	
 }
$dislike_color= $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE post_id=$postid AND  dislike_count=0 AND user_id=$userid"  );
if($dislike_color){
 $dislike_btn='<a href="javascript:;" onclick="dislike_button_fun('.$postid.','.$userid.')" class="wp_btn_likesystem system_dislike_btn" style="color:black; font-size:30px;padding:50px;"><i class="fas fa-thumbs-down fa-lg" aria-hidden="true"></i>'.$dislike_lebel.'</a>';
 }
else{
	$dislike_btn='<a href="javascript:;" onclick="dislike_button_fun('.$postid.','.$userid.')" class="wp_btn_likesystem system_dislike_btn" style="color:black; font-size:30px;padding:50px;"><i class="fas fa-thumbs-down fa-lg" aria-hidden="true"></i>'.$dislike_lebel.'</a>';
}
 
//  $dislike_color= $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE post_id=$postid AND  dislike_count=0 AND user_id=$userid");
// if($dislike_color){



 $wrap_end='</div>';


$response_ajax='<div id="wpacAjaxResponse" class="ajax-response" style="display:none;"><span></span></div>';

$content .=$wrap_start; 
$content .=$like_btn;
$content .=$dislike_btn;
$content .=$wrap_end;
$content .=$response_ajax;
return $content;
} 

}
add_action('the_content','add_button_like_dislike');
