<?php if ($id == $userID){
	$mainQuery = mysqli_query($connect, "SELECT * FROM userlistfor WHERE listID = '$listID' AND userID = '$userID'");
	$asideQuery = mysqli_query($connect, "SELECT * FROM userlistfor WHERE listID = '$listID' AND userID = '$userID'");
	$asideHandheldQuery = mysqli_query($connect, "SELECT * FROM userlistfor WHERE listID = '$listID' AND userID = '$userID'");
	$asideCount = mysqli_num_rows($asideQuery);
	$mainCount = mysqli_num_rows($mainQuery);
	$mainCount = $mainCount + 2;
	$mainWidth = $mainCount * 100;
	$mainWidthItem = 100 / $mainCount;
	$i = 1;
	
	?>
	<form id="forForm" method="post" action="/process/addto.php">
    <input type="hidden" name="listID" id="listID" value="<?php echo $listID ?>" />
    <div id="workshopMode" class="hint--bottom" data-hint="This page is still in development, so please don't throw your hot chocolate at us if it breaks">Workshop mode</div>
	<div id="listCaro">
    	
		<ul style="width:<?php echo $mainWidth ?>%;">
        <li style="width:<?php echo $mainWidthItem ?>%;">
        	<?php
				$frontQuery = mysqli_query($connect, "SELECT * FROM userlistfor WHERE listID = '$listID' AND userID = '$userID'");
				while ($front = mysqli_fetch_array($frontQuery)){ ?>
					<div class="frontPerson">
                    	<div class="frontName"><?php echo $front['userItemForPerson']; ?></div>
                    	<div class="frontBudget">Budget: £<?php echo $front['userItemForBudget']; ?></div>
                    </div>		

				<?php
                } ?>
				<div class="frontPerson">
                    	<div class="frontName">Add person</div>
                    	<div class="frontBudget">&nbsp;</div>
                    </div>	
            
            <?php
					if ($id == $userID){
						$muser = md5($userID);
						
						echo "<div id='frontfull'><div class='left'>"; 
						
						if ($private == "0"){ ?>
                    <div id="shareThisPage" class="listShare">
                        <h3>Share:</h3>
                        <span id="fblikeholder" class="facebookLike hint--bottom" data-hint="Share on Facebook"><img src="/images/social/facebook.png" /></span>
                        <a href="https://plus.google.com/share?url=www.its-xmas.co.uk/list/?listid=<?php echo $listID;?>" onClick="javascript:window.open(this.href,
                        '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="hint--bottom" data-hint="Share on Google+"><img
                        src="/images/social/google.png" alt="Share on Google+"/></a>
                        <a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());" class="hint--bottom" data-hint="Pin on Pinterest">
                            <img src="/images/social/pinterest.png" alt="Pinterest pin-it button">
                        </a>
                        <a href="https://twitter.com/share?via=NowItsChristmas&amp;text=Check out my <?php echo $listName; ?> list on It's Christmas at http://www.its-xmas.co.uk/list/?listid=<?php echo $listID;?>" target="_blank" class="hint--bottom" data-hint="Tweet page"><img src="/images/social/twitter.png" /></a>
                    </div>
        		<?php } 
						
						echo "<div class=\"listPrivacy\">";
						switch ($private){
							case "0":
								echo "<span class='open-lock privacyIcon'></span><span class='privacyContainer'><span class='privacy'>Your list is public</span> <span class='changePrivacy makePrivate'>Change?</span></span>";
								break;
							case "1":
								echo "<span class='closed-lock privacyIcon'></span><span class='privacyContainer'><span class='privacy'>Your list is private</span> <span class='changePrivacy makePublic'>Change?</span></span>";
								break;		
						}
						echo "</div>";
						if ($_REQUEST['privacystatus']){
							switch($_REQUEST['privacystatus']){
								case "success":
									echo "<p class='successMsg'>Privacy updated on this list!</p>";
									break;
								default:
									echo "<p class='errorMsg'>Unfortunately there was an error updating your privacy for the list!</p>";
									break;
								
							}						
						}
						echo "<div class='removeButton'><a href='/process/deletelist.php?listID=" . $listID . "&id=" . $muser . "'>Delete list</a></div></div>";
					}
				?>
                <div class="right">
                	<button>Save list</button>
                </div>
                </div>
        </li>
		<?php 
			while($mainA =  mysqli_fetch_array($mainQuery)){
				$forID = $mainA['userItemForID'];
				echo "<li data-personID='$forID' style='width:" . $mainWidthItem . "%;'>"; ?>
					<div class="mainPersonProfile">
                    	<div class="personIcon">
                        	<img src="/images/gift.png" alt="Gift" />
                        	<input type="hidden" id="entry<?php echo $i; ?>person" name="entry<?php echo $i; ?>person" value="<?php echo $forID; ?>" />
                        </div>
                        <div class="mainPersonProfileInput">
                        	<div class="mainPersonProfileInputRow">
                                <label for="entry<?php echo $i; ?>name">Name:</label>
                                <input type="text" id="entry<?php echo $i; ?>name" name="entry<?php echo $i; ?>name" value="<?php echo $mainA['userItemForPerson']; ?>" />
                        	</div>
                            <div class="mainPersonProfileInputRow">
                                <label for="entry<?php echo $i; ?>relationship">Relationship:</label>
                                <input type="text" id="entry<?php echo $i; ?>relationship" name="entry<?php echo $i; ?>relationship" value="<?php echo $mainA['userItemRelationship']; ?>" />
                        	</div>
                            <div class="mainPersonProfileInputRow">
                                <label for="entry<?php echo $i; ?>budget">Budget:</label>
                                <input type="text" id="entry<?php echo $i; ?>budget" name="entry<?php echo $i; ?>budget" value="£<?php echo $mainA['userItemForBudget']; ?>" />
                        	</div>
                        </div>
                        <div class="mainPersonProfileActions">
                        	<div class="removeFromList">
                            	Remove from list
                                <input type="hidden" id="entry<?php echo $i; ?>removePerson" name="entry<?php echo $i; ?>removePerson" value="0" />
                            </div>
                            <div class="addAnotherItem" data-row="<?php echo $i; ?>">Add item</div>
                        </div>
                    </div>
                    <div class="mainPersonItems">
                    	<?php 
							$itemRowQuery = "SELECT * FROM userlistforperson INNER JOIN userlistsymbol ON (userlistforperson.itemSymbol = userlistsymbol.symbolID) WHERE userID = '$id' AND userPersonForID = '$forID'";
							$itemRowCheck = mysqli_query($connect, $itemRowQuery);
							$j = 1;
							if (mysqli_num_rows($itemRowCheck) > 0){
								while ($itemRow = mysqli_fetch_array($itemRowCheck)){
									$itemID = "";
									$itemName = "";	
									$itemURL = "";	
									$itemShop = "";
									$itemSymbol = "";
									$symbolSrc = "";
									$itemPrice = "";		
									$itemNotes = "";
									
									
									
									$itemID = $itemRow['personID'];
									$itemName = $itemRow['itemName'];	
									$itemURL = $itemRow['itemURL'];	
									$itemShop = $itemRow['itemShop'];
									$itemSymbol = $itemRow['itemSymbol'];
									$symbolSrc = $itemRow['symbolSrc'];
									$itemPrice = $itemRow['itemPrice'];		
									$itemNotes = $itemRow['itemInspiration'];
									?>
									
                                    	<div class="mainPersonItem">
                                        	<input type="hidden" id="entry<?php echo $i; ?>RowID<?php echo $j; ?>" name="entry<?php echo $i; ?>RowID<?php echo $j; ?>" value="<?php echo $itemID; ?>" />
                                            <input type="hidden" id="entry<?php echo $i; ?>Remove<?php echo $j; ?>" name="entry<?php echo $i; ?>Remove<?php echo $j; ?>" value="0" class="toDeleteInput"/>
                                        	<div class="personSymbol">
                                            <?php 
												$symbolQuery = mysqli_query($connect, "SELECT * FROM userlistsymbol WHERE symbolHidden = '0'");
												if (mysqli_num_rows($symbolQuery) > 0){ ?>
                                            	<img src="/images/list/<?php echo $symbolSrc; ?>.png" class="personSymbolImg" />
                                            	<div class="personSymbolUL">
                                                    <div class="personSymbolClose">
                                                        <span class="icon-close"></span>
                                                    </div>
                                                	<ul>
                                                    	<?php
															while($symbolRow = mysqli_fetch_array($symbolQuery)){
																$symbolSrcLI = $symbolRow['symbolSrc'];
																$symbolID = $symbolRow['symbolID'];
																$symbolName = $symbolRow['symbolName'];
																?>
																
                                                                <li data-symbol="<?php echo $symbolID; ?>" data-symbolsrc="<?php echo $symbolSrcLI; ?>">
                                                                	<img src="/images/list/<?php echo $symbolSrcLI; ?>.png" alt="<?php echo $symbolName; ?>" />
                                                                </li>
                                                                
																<?php
															}
														?>                                                    
                                                    </ul>
                                                </div>
                                            	
											<?php } else { ?>
	                                            <img src="/images/list/<?php echo $symbolSrc; ?>.png" />
                                            <?php } ?>
                                            	<input type="hidden" id="entry<?php echo $i; ?>Symbol<?php echo $j; ?>" name="entry<?php echo $i; ?>Symbol<?php echo $j; ?>" value="<?php echo $itemSymbol; ?>" />
                                            </div>
                                        
                                        	<div class="personName">
                                            	<label for="entry<?php echo $i; ?>Name<?php echo $j; ?>">Item:</label>
                                            	<input type="text" id="entry<?php echo $i; ?>Name<?php echo $j; ?>" name="entry<?php echo $i; ?>Name<?php echo $j; ?>" value="<?php echo $itemName; ?>" />
                                            </div>
                                            <div class="personURL">
	                                            <label for="entry<?php echo $i; ?>URL<?php echo $j; ?>">URL:</label>
                                            	<input type="text" id="entry<?php echo $i; ?>URL<?php echo $j; ?>" name="entry<?php echo $i; ?>URL<?php echo $j; ?>" value="<?php echo $itemURL; ?>" />
                                            </div>
                                            <div class="personShop">
                                            	<label for="entry<?php echo $i; ?>Shop<?php echo $j; ?>">From:</label>
                                            	<input type="text" id="entry<?php echo $i; ?>Shop<?php echo $j; ?>" name="entry<?php echo $i; ?>Shop<?php echo $j; ?>" value="<?php echo $itemShop; ?>" />
                                            </div>
                                            <div class="personPrice">
                                            <label for="entry<?php echo $i; ?>Price<?php echo $j; ?>">Price:</label>
                                            	<input type="text" id="entry<?php echo $i; ?>Price<?php echo $j; ?>" name="entry<?php echo $i; ?>Price<?php echo $j; ?>" value="£<?php echo $itemPrice; ?>" />
                                            </div>
                                            <div class="personNotes">
	                                            <label for="entry<?php echo $i; ?>Ideas<?php echo $j; ?>">Ideas:</label>
                                            	<textarea id="entry<?php echo $i; ?>Ideas<?php echo $j; ?>" name="entry<?php echo $i; ?>Ideas<?php echo $j; ?>" ><?php echo $itemNotes; ?></textarea>
                                            </div>
                                        	<div class="personDelete">
                                                <span class="removeOption">Remove</span>
                                                <span class="marked">Marked for deletion</span>
                                             </div>
                                        </div>
                                    
                                    
                                    	
                                    
                                    <?php
									 $j = $j + 1;
								}
								
							}
							
						?>
                        <div class="mainPersonItem">
                        	<div class="personSymbol">
                        	<img src="/images/list/gift.png" class="personSymbolImg" />
                           <div class="personSymbolUL">
                           
                                <ul>
                                    <?php
										$newSymbolQuery = mysqli_query($connect, "SELECT * FROM userlistsymbol WHERE symbolHidden = '0'");
                                        while($newSymbolRow = mysqli_fetch_array($newSymbolQuery)){
                                            $newSymbolSrcLI = $newSymbolRow['symbolSrc'];
                                            $newSymbolID = $newSymbolRow['symbolID'];
                                            $newSymbolName = $newSymbolRow['symbolName'];
                                            ?>
                                            
                                            <li data-symbol="<?php echo $newSymbolID; ?>" data-symbolsrc="<?php echo $newSymbolSrcLI; ?>">
                                                <img src="/images/list/<?php echo $newSymbolSrcLI; ?>.png" alt="<?php echo $newSymbolName; ?>" />
                                            </li>
                                            
                                            <?php
                                        }
                                    ?>                                                    
                                </ul>
                            </div>
                            <input type="hidden" id="entry<?php echo $i; ?>Symbol<?php echo $j; ?>" name="entry<?php echo $i; ?>Symbol<?php echo $j; ?>" />
                        </div>
                    
                        <div class="personName">
                            <label for="entry<?php echo $i; ?>Name<?php echo $j; ?>">Item:</label>
                            <input type="text" id="entry<?php echo $i; ?>Name<?php echo $j; ?>" name="entry<?php echo $i; ?>Name<?php echo $j; ?>" />
                        </div>
                        <div class="personURL">
                            <label for="entry<?php echo $i; ?>URL<?php echo $j; ?>">URL:</label>
                            <input type="text" id="entry<?php echo $i; ?>URL<?php echo $j; ?>" name="entry<?php echo $i; ?>URL<?php echo $j; ?>" />
                        </div>
                        <div class="personShop">
                            <label for="entry<?php echo $i; ?>Shop<?php echo $j; ?>">From:</label>
                            <input type="text" id="entry<?php echo $i; ?>Shop<?php echo $j; ?>" name="entry<?php echo $i; ?>Shop<?php echo $j; ?>" />
                        </div>
                        <div class="personPrice">
                       		<label for="entry<?php echo $i; ?>Price<?php echo $j; ?>">Price:</label>
                            <input type="text" id="entry<?php echo $i; ?>Price<?php echo $j; ?>" name="entry<?php echo $i; ?>Price<?php echo $j; ?>" />
                        </div>
                        <div class="personNotes">
                            <label for="entry<?php echo $i; ?>Ideas<?php echo $j; ?>">Ideas:</label>
                            <textarea id="entry<?php echo $i; ?>Ideas<?php echo $j; ?>" name="entry<?php echo $i; ?>Ideas<?php echo $j; ?>" ></textarea>
                        </div>
    					<div class="personDelete">
                        	<span class="removeOption">Remove</span>
                            <span class="marked">Marked for deletion</span>
                         </div>
                    </div>
                </div>
                <?php
				echo "</li>";	
				$i = $i + 1;									
			}
			
			// New person 
			
			echo "<li style='width:" . $mainWidthItem . "%;'>"; ?>
					<div class="mainPersonProfile">
                    	<div class="personIcon">
                        	<img src="/images/gift.png" alt="Gift" />
                        </div>
                        <div class="mainPersonProfileInput">
                        	<div class="mainPersonProfileInputRow">
                                <label for="entry<?php echo $i; ?>name">Name:</label>
                                <input type="text" id="entry<?php echo $i; ?>name" name="entry<?php echo $i; ?>name" />
                        	</div>
                            <div class="mainPersonProfileInputRow">
                                <label for="entry<?php echo $i; ?>relationship">Relationship:</label>
                                <input type="text" id="entry<?php echo $i; ?>relationship" name="entry<?php echo $i; ?>relationship"  />
                        	</div>
                            <div class="mainPersonProfileInputRow">
                                <label for="entry<?php echo $i; ?>budget">Budget:</label>
                                <input type="text" id="entry<?php echo $i; ?>budget" name="entry<?php echo $i; ?>budget" />
                        	</div>
                        </div>
                        <div class="mainPersonProfileActions">
                            <div class="addAnotherItem" data-row="<?php echo $i; ?>">Add item</div>
                        </div>
                    </div>
                    <div class="mainPersonItems">
                    	<div class="mainPersonItem">
                        	<div class="personSymbol">
                        		<img src="/images/list/gift.png" class="personSymbolImg" />
                               <div class="personSymbolUL">
                                    <div class="personSymbolClose">
                                        <span class="icon-close"></span>
                                    </div>
                                    <ul>
                                        <?php
                                        $j = 1;
                                            $newSymbolQuery = mysqli_query($connect, "SELECT * FROM userlistsymbol WHERE symbolHidden = '0'");
                                            while($newSymbolRow = mysqli_fetch_array($newSymbolQuery)){
                                                $newSymbolSrcLI = $newSymbolRow['symbolSrc'];
                                                $newSymbolID = $newSymbolRow['symbolID'];
                                                $newSymbolName = $newSymbolRow['symbolName'];
                                                ?>
                                                
                                                <li data-symbol="<?php echo $newSymbolID; ?>" data-symbolsrc="<?php echo $newSymbolSrcLI; ?>">
                                                    <img src="/images/list/<?php echo $newSymbolSrcLI; ?>.png" alt="<?php echo $newSymbolName; ?>" />
                                                </li>
                                                
                                                <?php
                                            }
                                        ?>                                                    
                                    </ul>
                                </div>
                            	<input type="hidden" id="entry<?php echo $i; ?>Symbol<?php echo $j; ?>" name="entry<?php echo $i; ?>Symbol<?php echo $j; ?>" />
                        </div>
                    
                        <div class="personName">
                            <label for="entry<?php echo $i; ?>Name<?php echo $j; ?>">Item:</label>
                            <input type="text" id="entry<?php echo $i; ?>Name<?php echo $j; ?>" name="entry<?php echo $i; ?>Name<?php echo $j; ?>" />
                        </div>
                        <div class="personURL">
                            <label for="entry<?php echo $i; ?>URL<?php echo $j; ?>">URL:</label>
                            <input type="text" id="entry<?php echo $i; ?>URL<?php echo $j; ?>" name="entry<?php echo $i; ?>URL<?php echo $j; ?>" />
                        </div>
                        <div class="personShop">
                            <label for="entry<?php echo $i; ?>Shop<?php echo $j; ?>">From:</label>
                            <input type="text" id="entry<?php echo $i; ?>Shop<?php echo $j; ?>" name="entry<?php echo $i; ?>Shop<?php echo $j; ?>" />
                        </div>
                        <div class="personPrice">
                        <label for="entry<?php echo $i; ?>Price<?php echo $j; ?>">Price:</label>
                            <input type="text" id="entry<?php echo $i; ?>Price<?php echo $j; ?>" name="entry<?php echo $i; ?>Price<?php echo $j; ?>" />
                        </div>
                        <div class="personNotes">
                            <label for="entry<?php echo $i; ?>Ideas<?php echo $j; ?>">Ideas:</label>
                            <textarea id="entry<?php echo $i; ?>Ideas<?php echo $j; ?>" name="entry<?php echo $i; ?>Ideas<?php echo $j; ?>" ></textarea>
                        </div>
    					<div class="personDelete">
                        	<span class="removeOption">Remove</span>
                            <span class="marked">Marked for deletion</span>
                         </div>
                    </div>
                </div>
                <?php
				echo "</li>";
			
		?>
		
		</ul>
	</div>
	



	<aside id="forPerson">
		<div id="forPersonCaro">
        	<div id="prevButton" class='nonHandheld'></div>
		<?php
			
			$ulWidth = $asideCount * 150;
			echo "<div id='forCarouselHolder'>";
			echo "<ul class='nonHandheld' id='forCarousel' style='width:" . $ulWidth . "px;'>";
			echo "<li class='active'><div class='personImage'></div><div class='personName'>List home</div></li>";
			while($aw =  mysqli_fetch_array($asideQuery)){
				echo "<li data-personID='" . $aw['userItemForID'] . "'>";
					echo "<div class='personImage'></div>";
					echo "<div class='personName'>" . $aw['userItemForPerson'] . "</div>";
				echo "</li>";										
			}
			echo "<li><div class='personImage'></div><div class='personName'>Add person</div></li>";
			echo "</ul>";
			echo "</div>";
			echo "<select id='changeMobile' class='handheld' onchange=\"goChange();\">";
			echo "<option selected>Go to...</option>";
			echo "<option class='slide'>Front</option>";
			while($awhand =  mysqli_fetch_array($asideHandheldQuery)){
				echo "<option class='slide' data-personID='" . $awhand['userItemForID'] . "'>";
					echo $awhand['userItemForPerson'];
				echo "</option>";										
			}
			echo "<option>Add person</option>";
			echo "</select>";
		?>
        	<div id="nextButton" class='nonHandheld'></div>
        </div>
		<div id="saveList">
        	Save list
        </div>		
	</aside>
	</form>
<?php
} else { //Not user



} ?>
<script type="text/javascript" src="/res/js/jquery.jcarousel.min.js"></script>
<!--<script type="text/javascript" src="/res/js/jquery.touchSwipe.min.js"></script>-->
<script type="text/javascript">
	$(function(){
		$("#listCaro").jcarousel();
		$("#forCarouselHolder").jcarousel();
		$("#forPersonCaro #nextButton").click(function(){
			$('#forCarouselHolder').jcarousel('scroll', '+=1');
		});
		$("#forPersonCaro #prevButton").click(function(){
			$('#forCarouselHolder').jcarousel('scroll', '-=1');
		});
		$(".touch input, .touch textarea").focus(function(){
			$("header, aside#forPerson").hide();
		});
		$(".touch input, .touch textarea").blur(function(){
			$("header, aside#forPerson").show();
		});
		$("input, textarea").focus(function(){
			$("body").attr("data-edit","edited");
		});
		
		window.onbeforeunload = function(event) {
			if ($("body").attr("data-edit") == "edited"){
				return "Leaving this page will reset the wizard";	
			}			
		};
		/*$(".touch #listCaro").swipe({
			swipe: function (event, direction, distance, duration, fingerCount) {
				if (direction === 'left') {
					$('#listCaro').jcarousel('scroll', '+=1');
				} else if (direction === 'right') {
					$('#listCaro').jcarousel('scroll', '-=1');
				}
			},
			excludedElements: [],
			allowPageScroll: "vertical"
		});*/
		


		
		
		
		
		$("aside#forPerson, .frontPerson, .personSymbolUL ul li, .personSymbol > img, .personSymbolClose, .personDelete, .removeFromList").click(function(){});
		$("#saveList").click(function(){
			$("body").attr("data-edit","");
			$("#forForm").submit();
		});
		
		//Bottom carousel
		$(document).on("click", "aside#forPerson ul li", function(){
			var	number = $("aside#forPerson ul li").index(this);
			$("aside#forPerson ul li").removeClass("active");
			$(this).addClass("active");
			//console.log(number);
			$("#listCaro").jcarousel('scroll', number);
		});
		
		//Front page
		$(document).on("click", ".frontPerson", function(){
			var	number = ($(".frontPerson").index(this)) + 1;
			$("aside#forPerson ul li").removeClass("active");
			$("aside#forPerson ul li").eq(number).addClass("active");
			//console.log(number);
			$("#listCaro").jcarousel('scroll', number);
		});
		
		//Open symbol box
		$(document).on("click", ".personSymbolUL ul li", function(){
			var divParent = $(this).parents(".personSymbolUL"),
				symbolSrc = $(this).attr("data-symbolsrc"),
				symbolID = $(this).attr("data-symbol"),
				newURL = "/images/list/" + symbolSrc + ".png";
			$(divParent).next("input[type=hidden]").val(symbolID);
			$(divParent).removeClass("active");
			$(this).parents(".mainPersonItem").find("img.personSymbolImg").attr("src", newURL);

		});
		//Close symbol box
		$(document).on("click", ".personSymbolClose", function(){
			$(this).parents(".personSymbolUL").removeClass("active");
		});
		//Choose symbol
		$(document).on("click", ".personSymbolImg", function(){
			$(this).next(".personSymbolUL").addClass("active");
		});
		$(document).on("click", ".addAnotherItem", function(){
			var main = $(this).parents(".mainPersonProfile").next(".mainPersonItems"),
				count = $(main).find(".mainPersonItem").length,
				num = count + 1,
				i = $(this).attr("data-row");
				console.log(i);
			var	liHTML = '<div class="mainPersonItem"><div class="personSymbol"><img src="/images/list/gift.png" class="personSymbolImg" /><input type="hidden" id="entry' + i + 'Symbol' + num + '" name="entry' + i + 'Symbol' + num + '" />' +
			'</div><div class="personName"><label for="entry' + i + 'Name' + num + '">Item:</label><input type="text" id="entry' + i + 'Name' + num + '" name="entry' + i + 'Name' + num + '" /></div>' +
            '<div class="personURL"><label for="entry' + i + 'URL' + num + '">URL:</label><input type="text" id="entry' + i + 'URL' + num + '" name="entry' + i + 'URL' + num + '" /></div>' +
			'<div class="personShop"><label for="entry' + i + 'Shop' + num + '">From:</label><input type="text" id="entry' + i + 'Shop' + num + '" name="entry' + i + 'Shop' + num + '" /></div><div class="personPrice"><label for="entry' + i + 'Price' + num + '">Price:</label><input type="text" id="entry' + i + 'Price' + num + '" name="entry' + i + 'Price' + num + '" /></div><div class="personNotes">' +
			'<label for="entry' + i + 'Ideas' + num + '">Ideas:</label><textarea id="entry' + i + 'Shop' + num + '" name="entry' + i + 'Shop' + num + '" ></textarea></div><div class="personDelete"><span class="removeOption">Remove</span><span class="marked">Marked for deletion</span></div></div>';
			$(main).append(liHTML);
			
		});
	});
	$(document).on("click", ".personDelete", function(){
		var parent = $(this).parents(".mainPersonItem");
		if ($(parent).hasClass("toDelete")){
			$(parent).removeClass("toDelete");
			$(parent).find(".toDeleteInput").val(0);
		} else {
			$(parent).addClass("toDelete");
			$(parent).find(".toDeleteInput").val(1);
		}
	});
	$(document).on("click", ".removeFromList", function(){
		if ($(this).hasClass("toDelete")){
			$(this).removeClass("toDelete");
			$(this).find("input").val(0);
			$(this).parents("li").removeClass("delete");
		} else {
			$(this).addClass("toDelete");
			$(this).find("input").val(1);
			$(this).parents("li").addClass("delete");
		}
	});
	function goChange(){
		var	number = ($("#changeMobile")[0].selectedIndex)-1;
		console.log(number);
		$("#listCaro").jcarousel('scroll', number);
		/*$("aside#forPerson ul li").removeClass("active");
		$("aside#forPerson ul li").eq(number).addClass("active");
		if (number == 1){
			$(".removeButton,#shareThisPage").toggle();	
		} else {
			$(".removeButton,#shareThisPage").toggle();	
		}
		$("#listCaro").jcarousel('scroll', number);*/
	}

</script>