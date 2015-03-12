$(document).on("click", ".itemActions .likePost", function(){
	var $parent = $(this).parent(".itemActions"),
		postID = $parent.attr("data-id"),
		type = "like";
	
	if ($parent.attr("data-token")){
		token = $parent.attr("data-token");
	} else {
		token = false;
		window.location = "/login/";
	}
	
	$.ajax({
		type: "POST",
		url: "/res/ratePost.php",
		data: {"postID": postID, "token": token, "type": type},
		dataType: "JSON",
		timeout: 2000,
		success: function (response){
			$parent.find(".likePost").addClass("on");
			$parent.find(".dislikePost").removeClass("on");
		}, error:function(response){
			$parent.find(".likePost").addClass("on");
			$parent.find(".dislikePost").removeClass("on");
		}
	});
	
	
	
		
	/*if (window.XMLHttpRequest)
			{
			xmlhttp=new XMLHttpRequest();
			}
		else
			{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
		xmlhttp.onreadystatechange=function(response)
			{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					$parent.find(".likePost").addClass("on");
					$parent.find(".dislikePost").removeClass("on");
					console.log(response);
				}				
			}
		xmlhttp.open("POST","http://www.its-xmas.co.uk/res/ratePost.php?postID=" + postID + "&token=" + token + "&type=" + type,true);
		xmlhttp.send();*/
}).on("click", ".itemActions .dislikePost", function(){
	var $parent = $(this).parent(".itemActions"),
		postID = $parent.attr("data-id"),
		type = "dislike";

		if ($parent.attr("data-token")){
			token = $parent.attr("data-token");
		} else {
			token = false;
			 window.location = "/login/";
		}
		
	if (window.XMLHttpRequest)
		{
		xmlhttp=new XMLHttpRequest();
		}
	else
		{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	xmlhttp.onreadystatechange=function()
		{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				$parent.find(".likePost").removeClass("on");
				$parent.find(".dislikePost").addClass("on");
			}				
		}
	xmlhttp.open("POST","http://www.its-xmas.co.uk/res/ratePost.php?postID=" + postID + "&token=" + token + "&type=" + type,true);
	xmlhttp.send();
})