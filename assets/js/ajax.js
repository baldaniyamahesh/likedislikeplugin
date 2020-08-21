function like_button_fun(postId,userId){

var post_id=postId;
var user_id=userId;
// var user_ID=userId;
// alert(userId)
  jQuery.ajax({
		url : wpac_ajax_url.ajax_url,
		type : 'post',
		data : {
			action : 'wpac_like_btn_ajax_action',
			pid : post_id,
			uid : user_id
		},
		success : function( response ) {
            jQuery("#wpacAjaxResponse span").html(response);
            window.location.reload();
		}
	});

}

function dislike_button_fun(postId,userId){

console.log("dislike work sucessfully");
var post_id=postId;
var user_id=userId;
console.log('dislike is work sucessfully');
// var user_ID=userId;
// alert(userId)
  jQuery.ajax({
		url : wpac_ajax_url.ajax_url,
		type : 'post',
		data : {
			action : 'wpac_dislike_btn_ajax_action',
			pid : post_id,
			uid : user_id
		},
		success : function( response ) {
            jQuery("#wpacAjaxResponse span").html(response);
		    window.location.reload();
		}
	});

}