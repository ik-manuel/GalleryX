$(document).ready(function(){

let user_href;
let user_href_splitted;
let user_id;
let image_src;
let image_src_splitted;
let image_name;
let photo_id;


$(".modal_thumbnails").click(function(){
	$("#set_user_image").prop('disabled', false);

	user_href = $("#user-id").prop('href');
	user_href_splitted = user_href.split('=');
	user_id = user_href_splitted[user_href_splitted.length - 1];

	image_src = $(this).prop('src');
	image_src_splitted = image_src.split('/');
	image_name = image_src_splitted[image_src_splitted.length - 1];

	photo_id = $(this).attr('data');

	$.ajax({
		url: "includes/ajax_code.php",
		data: {photo_id: photo_id},
		type: "POST",
		success: function(data){
			if(!data.error){
				$("#modal_sidebar").html(data);
			}
		}

	});
	

});


$("#set_user_image").click(function(){

	$.ajax({
		url:"includes/ajax_code.php",
		data: {image_name: image_name, user_id: user_id},
		type: "POST",
		success: function(data){
           if(!data.error){
           	$(".user_image_box a img").prop('src', data);
           }
		}

	});


});


// The edit photo sidebar Toggle event
$(".info-box-header").click(function(){

$(".inside").slideToggle('fast');
$("#toggle").toggleClass("glyphicon glyphicon-menu-down, glyphicon glyphicon-menu-up");


});


//  The DELETE Confirm Notification
$(".delete_link").click(function(){

return confirm("Are you sure you want to delete this data");


});




});