//http://stackoverflow.com/questions/11259881/how-to-rotate-image-and-save-the-image


document.addEventListener('DOMContentLoaded', function (event) {

	'use strict';

	// Initialise resize library
	var resize = new window.resize();
	resize.init();

	
	// Upload photo
	var upload = function (photo, callback) {
		var formData = new FormData();
		formData.append('photo', photo);
		var request = new XMLHttpRequest();
		request.onreadystatechange = function() {
			if (request.readyState === 4) {
				callback(request.response);
			}
		}
		request.open('POST', '../../../js-upload/process.php');
		request.responseType = 'json';
		request.send(formData);
	};

	var fileSize = function (size) {
		var i = Math.floor(Math.log(size) / Math.log(1024));
		return (size / Math.pow(1024, i)).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i];
	};

	document.querySelector('form input[type=file]').addEventListener('change', function (event) {
		event.preventDefault();
		$("#loadingGifText").show();
		var files = event.target.files;
		for (var i in files) {
			if (typeof files[i] !== 'object') return false;
		
			(function () {

				var initialSize = files[i].size;

				resize.photo(files[i], 1200, 'file', function (resizedFile) {
					var resizedSize = resizedFile.size;
			
					upload(resizedFile, function (response) {
						if(response.url != ''){
							var suburl = (response.url).substring(2);
						} else {
							var obj = JSON && JSON.parse(response) || $.parseJSON(response),
								imgurl = String(obj.url),
								suburl = imgurl.substring(2);
						}
						$("input#image").attr("value",suburl);
						$(".loadingGif, #loadingGifText").hide();
						$("button").show();
					});
				});
			}());
		}

	});

});
