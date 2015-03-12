<?php

			switch ($view){
				case "1":
					if (isset($viewSteps) && $viewSteps == 1){
						$viewPath = '../res/post/pin.php';
					} else if (isset($viewSteps) && $viewSteps == 2){
						$viewPath = '../../res/post/pin.php';
					} else {
						$viewPath = 'res/post/pin.php';
					}
					
					$viewName = 'pin';
				                      break;
				case "2":
					if (isset($viewSteps) && $viewSteps == 1){
						$viewPath = '../res/post/images.php';
					} else if (isset($viewSteps) && $viewSteps == 2){
						$viewPath = '../../res/post/images.php';
					} else {
						$viewPath = 'res/post/images.php';
					}
					$viewName = 'images';
					break;
				case "3":
					if (isset($viewSteps) && $viewSteps == 1){
						$viewPath = '../res/post/minimal.php';
					} else if (isset($viewSteps) && $viewSteps == 2){
						$viewPath = '../../res/post/minimal.php';
					} else {
						$viewPath = 'res/post/minimal.php';
					}
					$viewName = 'minimal';
					break;
				case "4":
					if (isset($viewSteps) && $viewSteps == 1){
						$viewPath = '../res/post/rows.php';
					} else if (isset($viewSteps) && $viewSteps == 2){
						$viewPath = '../../res/post/rows.php';
					} else {
						$viewPath = 'res/post/rows.php';
					}
					$viewName = 'rows';
					break;
				case "5":
					if (isset($viewSteps) && $viewSteps == 1){
						$viewPath = '../res/post/text.php';
					} else if (isset($viewSteps) && $viewSteps == 2){
						$viewPath = '../../res/post/text.php';
					} else {
						$viewPath = 'res/post/text.php';
					}
					$viewName = 'text';
					break;
				default:
					if (isset($viewSteps) && $viewSteps == 1){
						$viewPath = '../res/post/pin.php';
					} else if (isset($viewSteps) && $viewSteps == 2){
						$viewPath = '../../res/post/pin.php';
					} else {
						$viewPath = 'res/post/pin.php';
					}
					$viewName = 'pin';
					$fakeView = 1;
					break;	
			}
			if ($view == "1" or $view == "2" or $fakeView == "1"){ ?>
				<script src="/res/jquery.masonry.min.js"></script>
				<script type="text/javascript">
				$(document).ready(function(){	
					if ($('#itemholder')){
						var itemwidth = $('#itemholder').width(),
							$container = $('#itemholder');
						$container.imagesLoaded(function(){
							$container.masonry({
								itemSelector : '.item',
								columnWidth : 0,
								isAnimated: true,
								"isFitWidth": true
							});
						});
					}
				});
				
				</script>
            <?php } ?>
