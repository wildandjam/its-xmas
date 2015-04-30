$(document).ready(function(){	
	RotateImage();

	$("#extendNav").click(function(){
		$(".panel").removeClass("active");
		if ($("header").hasClass("active")){
			$("header").removeClass("active");
		} else {
			$("header").addClass("active");
		}
	});
	$("#altHeader a .link-extend").click(function(e){
		e.preventDefault();
		var panel = $(this).attr("data-for");
		if ($(this).parent("a").hasClass("active")){
			$("#altHeader a").removeClass("active");

			$(".panel").removeClass("active");
		} else {
			$(this).parent("a").addClass("active");
			$(".panel").removeClass("active");
			$(".panel[data-panel=" + panel + "").addClass("active");
		}
	});
	$("#altHeader a").click(function(e){
		var windowWidth = $(window).width();
		if (windowWidth > 0 && windowWidth < 768){
			var panelHere = $(this).find(".link-extend").attr("data-for");
			if (typeof panelHere != "undefined"){
				var thisLink = $(this).attr("href"),
					thisPage = window.location.pathname;

				if ($(".panel[data-panel=" + panelHere + "").hasClass("active")){
					$("#altHeader a, .panel").removeClass("active");
				} else {
					$("#altHeader a, .panel").removeClass("active");
					$(this).addClass("active");
					$(".panel[data-panel=" + panelHere + "").addClass("active");
				}
			
				e.preventDefault();
				return false;
		
			}
		}
	});


	$("#userPortal ul li > img").click(function(){
		$('#userPortal ul ul').toggle();
	});

	$("ul#majorlinks li").click(function(){
		var a = $(this).find("a:first"),
			ah = $(a).attr("href");
		window.location = ah;
	});
	if ($("#countdown, #countdownMobile, #countdownPage").length > 0){
		if ($("header").length == 1){
			var type = $("header").attr("data-countdown");
		} else {
			var type = "days";
		}
		CountDownTimer('12/25/2015 0:0 AM', 'countdown', type);
	}
	$("select.jquerySelect").select2();
	
	$("form#formView select").change(function(){
		$("#updateView button").addClass("active");
	});
	$('#category').on("select2-selecting", function(e) { 
		$("#categoryHidden").val(e.val);
	});
	$(".createList > ul > li").click(function(){
		$(this).find("> ul").toggle();
	});
	$("#ratingSlider").slider({
      range: true,
      min: 0,
      max: 100,
      values: [ 0, 100 ],
      slide: function( event, ui ) {
        $( "#ratingFrom" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ]  + "%");
      }
    });
	$("#dateFrom").datepicker({
      defaultDate: "+1w",
	  dateFormat: 'dd/mm/yy',
      changeMonth: true,
      onClose: function( selectedDate ) {
        $( "#dateTo" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#dateTo" ).datepicker({
      defaultDate: "+1w",
	  dateFormat: 'dd/mm/yy',
      changeMonth: true,
      onClose: function( selectedDate ) {
        $( "#dateFrom" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
	$(".listClose").click(function(){
		$(".listing").removeClass("listing");
		$("#listBox").removeClass("add");
		$("#listOverlay").removeClass("show");
	});
	$(".reportClose").click(function(){
		if ($("#itemPost").length < 1){
			$(".report").removeClass("report");
		}
		
		$("#reportBox").removeClass("add");
		$("#reportOverlay").removeClass("show");
		
	});
	$(".criteriaRemove").click(function(){
		var criteria = $(this).parents(".criteria"),
			type = $(criteria).attr("data-type");
		if (type == "category" || type == "categoryHidden"){
			$("#category, #categoryHidden").val('');
		} else {
			$("#" + type).val('');
		}
		$("form#refine button").trigger("click");
		
	});
	if (getCookie("cookies") != "read"){
		$("#cookiePop").show();
	}
	$("#cookiePop .icon-close").click(function(){
		setCookie("cookies","read", 30);
		$("#cookiePop").hide();
	});
});
function RotateImage(){
	var length = $("#itemMain .itemImg img.rotate-90").width();	
	$(this).parents("#itemMain .itemImg").css("min-height",length + 20);
	
}


//COUNTDOWN
function CountDownTimer(dt, id, type)
{
	var end = new Date(dt);

	var _second = 1000,
		_minute = _second * 60,
		_hour = _minute * 60,
		_day = _hour * 24,
		_week = _day * 7,
		timer;

	function showRemaining() {
		var now = new Date();
		var distance = end - now;
		if (distance < 0) {
			clearInterval(timer);
			document.getElementById(id).innerHTML = 'TODAY!';
			return;
		}
		var inputCountdown = '<span>in </span>';
		switch(type){
			case ("weeks"):
				var weeks = Math.floor(distance / _week),
					days = Math.floor((distance % _week) / _day),
					hours = Math.floor((distance % _day) / _hour),
					minutes = Math.floor((distance % _hour) / _minute),
					seconds = Math.floor((distance % _minute) / _second);
					
					if (weeks == 1) {
						inputCountdown += weeks + '<span> week, </span>';
					} else { 
						inputCountdown += weeks + '<span> weeks, </span>';
					}
					if (days == 1) {
						inputCountdown += days + '<span> day, </span>';
					} else { 
						inputCountdown += days + '<span> days, </span>';
					}
					if (hours == 1) { 
						inputCountdown += hours + '<span> hour, </span>';
					} else { 
						inputCountdown += hours + '<span> hours, </span>';
					}
					if (minutes == 1) {
						inputCountdown += minutes + '<span> minute, and </span>';
					} else { 
						inputCountdown += minutes + '<span> minutes, and </span>';
					}
					if (seconds == 1){
						inputCountdown += seconds + '<span> second </span>';
					} else { 
						inputCountdown += seconds + '<span> seconds </span>';
					}
				break;
			case ("days"):
				var days = Math.floor(distance / _day),
					hours = Math.floor((distance % _day) / _hour),
					minutes = Math.floor((distance % _hour) / _minute),
					seconds = Math.floor((distance % _minute) / _second);
					
					if (days == 1) {
						inputCountdown += days + '<span> day, </span>';
					} else { 
						inputCountdown += days + '<span> days, </span>';
					}
					if (hours == 1) { 
						inputCountdown += hours + '<span> hour, </span>';
					} else { 
						inputCountdown += hours + '<span> hours, </span>';
					}
					if (minutes == 1) {
						inputCountdown += minutes + '<span> minute, and </span>';
					} else { 
						inputCountdown += minutes + '<span> minutes, and </span>';
					}
					if (seconds == 1){
						inputCountdown += seconds + '<span> second </span>';
					} else { 
						inputCountdown += seconds + '<span> seconds </span>';
					}
				break;
			case ("hours"):
				var hours = Math.floor(distance / _hour),
					minutes = Math.floor((distance % _hour) / _minute),
					seconds = Math.floor((distance % _minute) / _second);
					
					if (hours == 1) { 
						inputCountdown += numberWithCommas(hours) + '<span> hour, </span>';
					} else { 
						inputCountdown += numberWithCommas(hours) + '<span> hours, </span>';
					}
					if (minutes == 1) {
						inputCountdown += minutes + '<span> minute, and </span>';
					} else { 
						inputCountdown += minutes + '<span> minutes, and </span>';
					}
					if (seconds == 1){
						inputCountdown += seconds + '<span> second </span>';
					} else { 
						inputCountdown += seconds + '<span> seconds </span>';
					}
				break;
			case ("minutes"):
				var minutes = Math.floor(distance / _minute),
					seconds = Math.floor((distance % _minute) / _second);

					if (minutes == 1) {
						inputCountdown += numberWithCommas(minutes) + '<span> minute, and </span>';
					} else { 
						inputCountdown += numberWithCommas(minutes) + '<span> minutes, and </span>';
					}
					if (seconds == 1){
						inputCountdown += seconds + '<span> second </span>';
					} else { 
						inputCountdown += seconds + '<span> seconds </span>';
					}
				break;
			case ("seconds"):
				var seconds = Math.floor(distance / _second);
					if (seconds == 1){
						inputCountdown += numberWithCommas(seconds) + '<span> second </span>';
					} else { 
						inputCountdown += numberWithCommas(seconds) + '<span> seconds </span>';
					}
				break;
		}
				
		
		

		
		
	
 		$("#countdown, #countdownMobile, #countdownPage").html(inputCountdown);
 	}
	timer = setInterval(showRemaining, 1000);
}
$(document).on("mouseenter", "#countdownHolder", function () {
	$(this).addClass("hover");
}).on("mouseleave", "#countdownHolder", function () {
	$(this).removeClass("hover");
}).on("click", "#addToListBox #openOverlay", function(){
	$(".itemActions .collection").trigger("click");
}).on("click", ".itemActions .collection", function(){
	var $parent = $(this).parent(".itemActions"),
		postID = $parent .attr("data-id"),
		userID = $parent.attr("post-user");
	if ($parent.attr("data-token")){
		$("#listBox").removeClass("already");
		token = $parent.attr("data-token");
		$("#listBox").attr({"data-token": token, "data-postID" : postID});
		$parent.parent(".item").addClass("listing");
		$("#currentCollections").html('');
			$.ajax({
				type: "POST",
				url: "/process/getcollection.php",
				data: {"postID":postID},
				dataType: "JSON",
				timeout: 2000,
				success: function (response){
					var htmlCollection = "This post is in your following collections: ";
					for ($i = 0; $i < response.response.length; $i++){
						if (response.response.length - $i == 1){
							htmlCollection += "<a href='/collection/?collectionid=" + response.response[$i].listID + "'>" + response.response[$i].listName + "</a> ";
						} else {
							htmlCollection += "<a href='/collection/?collectionid=" + response.response[$i].listID + "'>" + response.response[$i].listName + "</a>, ";
						}
					}
					$("#currentCollections").html(htmlCollection);
					$("#listBox").addClass("already");
				}
			});
		$("#listOverlay").addClass("show");
	} else {
		token = false;
		window.location = "/login/";
	}
}).on("click", "#listOverlay", function(e){
	if (e.target.id === "listOverlay"){
		$(".listing").removeClass("listing");
		$("#listBox").removeClass("add");
		$("#listOverlay").removeClass("show");
	}

}).on("click", "#listBox .button", function(){
	var postID = $("#listBox").attr("data-postID"),
		userID = $("#listBox").attr("data-token"),	
		listID = $("#listBox select option:selected").attr("value");
		console.log(postID);
		console.log(userID);
		console.log(listID);

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
			$(".listing.item").find(".collection").addClass("on");
			$(".listing.item").removeClass("listing");
			$("#listOverlay").removeClass("show");
		}	
	}
	xmlhttp.open("POST","http://www.its-xmas.co.uk/process/addtolist.php?listID=" + listID + "&postID=" + postID + "&userID=" + userID,true);
	xmlhttp.send();
	
}).on("click", "#listBox #getOtherLists", function(){
	var postID = $("#listBox").attr("data-postid");
	document.location = "/collection/?postid=" + postID;

}).on("click", ".itemActions .report", function(){
	var $parent = $(this).parent(".itemActions");
	if ($parent.attr("data-token")){
		$("input#reporterID").val($parent.attr("data-token"));
		$("input#reportedPost").val($parent.attr("data-id"));
		$("input#reportedPoster").val($parent.attr("data-userid"));
		$("#reportOverlay").addClass("show");
	} else {
		token = false;
		window.location = "/login/";
	}
	
}).on("click", "#reportOverlay", function(e){
	if (e.target.id === "reportOverlay"){
		if ($("#itemPost").length < 1){
			$(".report").removeClass("report");
		}
		
		$("#reportBox").removeClass("add");
		$("#reportOverlay").removeClass("show");
	}

}).on("click","#addEdit", function(e){
	e.preventDefault();
	$("#itemSide").addClass("editMode");
}).on("click","#addComment", function(){
	$("#comments").removeClass("hide");
	$("#comments").find("input").eq(0).focus();
}).on("click","#nav", function(){
	if ($(this).hasClass("blognav")){
		$("#blogBody #page #content .container .navmenu").toggleClass("show");
	} else {
		$("#container #navbar").toggleClass("navopen");
	}
}).on("click","#search", function(){
	$("#container #navbar").addClass("navopen");
	$("#container #navbar input").eq(0).focus();
}).on("click", ".title .space, .title .textTitle, .title .control", function(){
	$(this).parents(".title").toggleClass("showOptions");
}).on("click", "#refineMenu .title", function(){
	$("#refineMenu form").toggleClass("active");
}).on("click","ul.navUL", function(){
	$(this).find(" > li").toggleClass("chosen");
}).on("click","#navbar .moreOptions", function(){
	$(this).addClass("hide");
	$(this).next(".lessOptions").addClass("show");
}).on("click","#navbar .lessOptions", function(){
	$(this).prev(".moreOptions").removeClass("hide");
	$(this).removeClass("show");
}).on("click", "#changeView", function() {
	$("#optionFooter").toggleClass("active");
}).on("click","ul li.link > ul > li", function(){
	var value = $(this).attr("data-value"),
		category = $(this).parents("ul.navUL").attr("id");
	newURL(category,value);
}).on("change","ul li.link > ul > li select option", function(){
	alert(22);
	var value = $(this).val(),
		category = $(this).parents("ul.navUL").attr("id");
	newURL(category,value);
});

function querystring(key) {
   var re=new RegExp('(?:\\?|&)'+key+'=(.*?)(?=&|$)','gi');
   var r=[], m;
   while ((m=re.exec(document.location.search)) != null) r.push(m[1]);
   return r;
}

function newURL(option, choice){
	var category = $(".navUL#ratingFrom").attr("category"),
			ratingFrom = $(".navUL#ratingFrom").attr("data-value"),
			dateFrom = $(".navUL#dateFrom").attr("data-value");



	switch(option){
		case "category":
			var category = choice;
					path = "http://www.its-xmas.co.uk/?category=" + choice;
			if (ratingFrom != "empty"){
				path += "&ratingFrom=" + ratingFrom;
			}
			if (dateFrom != "empty"){
				path += "&dateFrom=" + dateFrom;
			}
			break;
		case "ratingFrom":
		default:
			alert("no choice");
			break;
	}
	window.location = path;
	
}
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "; expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + expires;
	
	
}
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) != -1) return c.substring(name.length,c.length);
    }
    return "";
}

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}