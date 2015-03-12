<?php //card  ?>

<!--<div id="modeChoice">
    <span class="spanTitle">Mode:</span>
    <span id="basicMode">Basic</span>
    <span id="advancedMode">Advanced</span>
    <span id="ideasMode">Ideas</span>
</div>-->
<div id="updateListUpper" class="handheld">Update list</div>

<?php


if ($id == $userID){
    // if user is the owner	
?>

<form id="cardList" name="cardList" method="post" action="/process/addtocardlist.php">
     <input type="hidden" id="listID" name="listID" value="<?php echo $listID; ?>" />                         
    <div class="fauxTable" id="cardTable">
        <div class="fauxTableHeader">
            <div class="fauxCell fauxCell30 basic ideas">
                To
            </div>
           <div class="fauxCell fauxCell30 basic ideas">
                Relationship 
            </div>
            <div class="fauxCell fauxCell10 ideas">
                Type of card
            </div>
            <div class="fauxCell fauxCell10">
                Link to card
            </div>
            <div class="fauxCell fauxCell10 basic ideas">
                Price
            </div>
            <div class="fauxCell fauxCell5">
                Purchased?
            </div>
            <div class="fauxCell fauxCell5">
                Delivered?
            </div>
            <div class="fauxCell fauxCell5">
                Received?
            </div>
            <div class="fauxCell fauxCell5 basic ideas">
                &nbsp;
            </div>
        </div>
        <?php 
            //query card table
            $totalCost = 0.00;
            $cardQuery = mysqli_query($connect, "SELECT * FROM userlistcard WHERE listID='$listID' AND userID='$userID'");
            if (mysqli_num_rows($cardQuery) > 0){
                while($c = mysqli_fetch_array($cardQuery)){ 
                    $rowNo = 1;
                    $totalCost = $totalCost + $c['cardPrice'];
                ?>
                    <div class="fauxTableRow" data-rowNo="<?php echo $rowNo; ?>">
                        <div class="fauxCell fauxCell30 basic ideas">
                            <label for="entry<?php echo $rowNo; ?>Name" class="handheld">To</label>
                            <input type="text" id="entry<?php echo $rowNo; ?>Name" name="entry<?php echo $rowNo; ?>Name" value="<?php echo $c['cardReceiver']; ?>" />
                        </div>
                        <div class="fauxCell fauxCell30 basic ideas">
                            <label for="entry<?php echo $rowNo; ?>Relationship" class="handheld">Relationship</label>
                            <input type="text" id="entry<?php echo $rowNo; ?>Relationship" name="entry<?php echo $rowNo; ?>Relationship" value="<?php echo $c['cardRelationship']; ?>" />
                        </div>
                        <div class="fauxCell fauxCell10 ideas">
                            <label for="entry<?php echo $rowNo; ?>CardType" class="handheld">Card Type</label>
                            <input type="text" id="entry<?php echo $rowNo; ?>CardType" name="entry<?php echo $rowNo; ?>CardType" value="<?php echo $c['cardType']; ?>" />
                            
                        </div>
                        <div class="fauxCell fauxCell10">
                            <label for="entry<?php echo $rowNo; ?>Url" class="handheld">Link URL (Web address)</label>
                            <input type="text" id="entry<?php echo $rowNo; ?>Url" name="entry<?php echo $rowNo; ?>Url" value="<?php echo $c['cardURL']; ?>" />
                        </div>
                        <div class="fauxCell fauxCell10 basic ideas">
                            <label for="entry<?php echo $rowNo; ?>Price" class="handheld">Price</label>
                            <input type="text" id="entry<?php echo $rowNo; ?>Price" name="entry<?php echo $rowNo; ?>Price" placeholder="<?php echo $c['cardPrice']; ?>" />
                        </div>
                        <div class="fauxCell fauxCell5">
                            <label for="entry<?php echo $rowNo; ?>purchased" class="handheld">Has it been purchased?</label>
                            <?php if ($c['cardPurchased'] == '1'){ ?>
                                <input type="checkbox" id="entry<?php echo $rowNo; ?>purchased" name="entry<?php echo $rowNo; ?>purchased" value="<?php echo $c['cardPurchased']; ?>" checked />
                            <?php } else { ?>
                                <input type="checkbox" id="entry<?php echo $rowNo; ?>purchased" name="entry<?php echo $rowNo; ?>purchased" value="<?php echo $c['cardPurchased']; ?>" />
                            <?php } ?>
                        </div>
                        <div class="fauxCell fauxCell5">
                            <label for="entry<?php echo $rowNo; ?>delivered" class="handheld">Has it been delivered?</label>
                            <?php if ($c['cardDelivered'] == '1'){ ?>
                                <input type="checkbox" id="entry<?php echo $rowNo; ?>delivered" name="entry<?php echo $rowNo; ?>delivered" value="<?php echo $c['cardDelivered']; ?>" checked />
                            <?php } else { ?>
                                <input type="checkbox" id="entry<?php echo $rowNo; ?>delivered" name="entry<?php echo $rowNo; ?>delivered" value="<?php echo $c['cardDelivered']; ?>" />
                            <?php } ?>
                        </div>
                        <div class="fauxCell fauxCell5">
                            <label for="entry<?php echo $rowNo; ?>received" class="handheld">Have you received one?</label>
                            <?php if ($c['cardReceived'] == '1'){ ?>
                                <input type="checkbox" id="entry<?php echo $rowNo; ?>received" name="entry<?php echo $rowNo; ?>received" value="<?php echo $c['cardReceived']; ?>" checked />
                            <?php } else { ?>
                                <input type="checkbox" id="entry<?php echo $rowNo; ?>received" name="entry<?php echo $rowNo; ?>received" value="<?php echo $c['cardReceived']; ?>" />
                            <?php } ?>
                            <input type="hidden" id="entry<?php echo $rowNo; ?>id" name="entry<?php echo $rowNo; ?>id" value="<?php echo $c['cardID']; ?>" />
                        </div>
                        <div class="fauxCell fauxCell5 basic ideas">
                            <a class="removeButton" href="/process/removefromcardlist.php?listid=<?php echo $listID; ?>&cardid=<?php echo $c['cardID']; ?>">REMOVE</a>
                        </div>
                    </div>
            <?php }
                $rowNo = $rowNo + 1;
            } else {
                // No entries
                
                $rowNo = 1;
            }
        ?>
        
        
        
        <div class="fauxTableRow" data-rowNo="<?php echo $rowNo; ?>">
            <div class="fauxCell fauxCell30 basic ideas">
                <label for="entry<?php echo $rowNo; ?>Name" class="handheld">To</label>
                <input type="text" id="entry<?php echo $rowNo; ?>Name" name="entry<?php echo $rowNo; ?>Name" placeholder="Name"/>
            </div>
            <div class="fauxCell fauxCell30 basic ideas">
                <label for="entry<?php echo $rowNo; ?>Relationship" class="handheld">Relationship</label>
                <input type="text" id="entry<?php echo $rowNo; ?>Relationship" name="entry<?php echo $rowNo; ?>Relationship"  placeholder="Relationship"/>
            </div>
            <div class="fauxCell fauxCell10 ideas">
                <label for="entry<?php echo $rowNo; ?>CardType" class="handheld">Type of card</label>
                <input type="text" id="entry<?php echo $rowNo; ?>CardType" name="entry<?php echo $rowNo; ?>CardType" placeholder="Card Type"/>
            </div>
            <div class="fauxCell fauxCell10">
            <label for="entry<?php echo $rowNo; ?>Url" class="handheld">Link URL</label>
                <input type="text" id="entry<?php echo $rowNo; ?>Url" name="entry<?php echo $rowNo; ?>Url" placeholder="Card URL"/>
            </div>
            <div class="fauxCell fauxCell10 basic ideas">
                <label for="entry<?php echo $rowNo; ?>Price" class="handheld">Price</label>
                <input type="text" id="entry<?php echo $rowNo; ?>Price" name="entry<?php echo $rowNo; ?>Price"  placeholder="Price"/>
            </div>
            <div class="fauxCell fauxCell5">
                <label for="entry<?php echo $rowNo; ?>purchased" class="handheld">Has it been purchased?</label>
                <input type="checkbox" id="entry<?php echo $rowNo; ?>purchased" name="entry<?php echo $rowNo; ?>purchased" />
            </div>
            <div class="fauxCell fauxCell5">
                <label for="entry<?php echo $rowNo; ?>delivered" class="handheld">Has it been delivered?</label>
                <input type="checkbox" id="entry<?php echo $rowNo; ?>delivered" name="entry<?php echo $rowNo; ?>delivered" />
            </div>
            <div class="fauxCell fauxCell5">
                <label for="entry<?php echo $rowNo; ?>received" class="handheld">Have you received one?</label>
                <input type="checkbox" id="entry<?php echo $rowNo; ?>received" name="entry<?php echo $rowNo; ?>received" />

            </div>
            <div class="fauxCell5 basic ideas">
                &nbsp;
            </div>
        </div>
	</div>
    <div class="fauxTable">
        <div class="fauxTableRow">
        	<div class="fauxCell basic emptyCell">
            	&nbsp;
            </div>
            <div class="fauxCell basic emptyCell">
            	&nbsp;
            </div>
            <div class="fauxCell basic">
            	<div class="infoBox" id="totalCost">
                  Total Cost: £<span><?php echo $totalCost; ?></span>
                </div>
            </div>
            <div class="fauxCell fauxCell5 basic">
            	<div class="addCardRow">
                    Add +
                </div>
            </div>
    	</div>
        <div class="fauxTableRow emptyRow">
        	<div class="fauxCell basic">
            	&nbsp;
            </div>
            <div class="fauxCell basic">
            	&nbsp;
            </div>
            <div class="fauxCell basic">
            	&nbsp;
            </div>
            <div class="fauxCell fauxCell5 basic">
            	&nbsp;
            </div>
    	</div>
         <div class="fauxTableRow">
        	<div class="fauxCell basic">
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
            </div>
            <div class="fauxCell basic">
            	&nbsp;
            </div>
            <div class="fauxCell fauxCellDouble basic">
            	<input type="hidden" id="listMode" name="listMode" value="<?php echo $listMode; ?>" />
			    <button class="clearBoth">Update list</button>
            </div>
    	</div>
        <div class="fauxTableRow">
        	<div class="fauxCell basic actions">
            	<?php
					if ($id == $userID){
						$muser = md5($userID);
						
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
						echo "<div class='removeButton'><a href='/process/deletelist.php?listID=" . $listID . "&id=" . $muser . "'>Delete list</a></div>";
					}
				?>
            </div>
            <div class="fauxCell basic">
            	&nbsp;
            </div>
            <div class="fauxCell basic">
            	&nbsp;
            </div>
            <div class="fauxCell fauxCell5 basic">
            	&nbsp;
            </div>
    	</div>
    </div>

</form>
<?php } else { 
    //Not user 
    
    //query card table
    $cardQuery = mysqli_query($connect, "SELECT * FROM userlistcard WHERE listID='$listID' AND userID='$userID'");
    if (mysqli_num_rows($cardQuery) > 0){ ?>
    <div class="fauxTable cardList" id="cardTable">
        <div class="fauxTableHeader">
            <div class="fauxCell fauxCell30 basic ideas">
                To
            </div>
           <div class="fauxCell fauxCell30 basic ideas">
                Relationship
            </div>
            <div class="fauxCell fauxCell10 basic ideas">
                Price
            </div>

           
        </div>
        <?php 
            
                while($c = mysqli_fetch_array($cardQuery)){ 
                    $rowNo = 1;
                ?>
                    <div class="fauxTableRow" data-rowNo="<?php echo $rowNo; ?>">
                        <div class="fauxCell fauxCell30 basic ideas">
                            <span class="handheld">To</span>
                            <span><?php echo $c['cardReceiver']; ?></span>
                        </div>
                        <div class="fauxCell fauxCell30 basic ideas">
                            <span class="handheld">Relationship</span>
                           <span><?php echo $c['cardRelationship']; ?></span>
                        </div>
                      
                        <div class="fauxCell fauxCell10 basic ideas">
                            <span class="handheld">Price</span>
                            <span>£<?php echo $c['cardPrice']; ?></span>
                        </div>
                    </div>
             <?php }
            } else {
                echo "<p>This list is currently empty</p>";
            }
    echo "</div>";
} 
?>
<script type="text/javascript">
	$(function(){
	
		showBasic();
		
		$("#updateListUpper").click(function(){
			$("form#cardList button").trigger("click");
		});
		
		$(".addCardRow").click(function(){
			var rowNo = ($("#cardTable .fauxTableRow").length) + 1;
			var cardRowHTML = '<div class="fauxTableRow" data-rowNo="' + rowNo + '">' +
                               		'<div class="fauxCell fauxCell30 basic ideas"><label for="entry' + rowNo + 'Name" class="handheld">To</label><input type="text" id="entry' + rowNo + 'Name" name="entry' + rowNo + 'Name" placeholder="Name"/></div>' +
                                   	'<div class="fauxCell fauxCell30 basic ideas"><label for="entry' + rowNo + 'Relationship" class="handheld">Relationship</label><input type="text" id="entry' + rowNo + 'Relationship" name="entry' + rowNo + 'Relationship" placeholder="Relationship"/></div>' +
									'<div class="fauxCell fauxCell10 basic ideas"><label for="entry' + rowNo + 'Price" class="handheld">Price</label><input type="text" id="entry' + rowNo + 'Price" name="entry' + rowNo + 'Price" placeholder="Price" /></div>' +
									'<div class="fauxCell fauxCell5 basic">&nbsp;</div>';
                                    
			$("#cardTable").append(cardRowHTML);
			$("#modeChoice .selected").trigger("click");
			
		});
		$(".fauxCell input[id$=Price]").blur(function(){
			var totalCost = "0.00";
			$(".fauxCell input[id$=Price]").each(function(){
				var rowPrice;
				if ($(this).val() == '' || $(this).val() == '0'){
					if ($(this).attr("placeholder") == '' || typeof($(this.attr("placeholder"))) == "undefined"){
						rowPrice = '0';
						console.log("empty");
					} else {
						rowPrice = $(this).attr("placeholder");
					}
				} else {
					rowPrice = $(this).val();	
				}
				console.log("Price " + rowPrice);
				
			});
			totalCost = Math.floor(totalCost + rowPrice);
			console.log(totalCost);
		});
		$(".toggleIcon").click(function(){
			var parent = $(this).parents(".topRow"),
				child = $(parent).find(".fauxHide");
			
			if (child.css("display") == "none"){
				$(child).css("display","table");
			} else {
				$(child).hide();
			}
				
			
		});
		$(document).on("click", ".addItemRow", function(){
			var $row = $(this).parents(".fauxTableRow").eq(0),
				rowID = $row.attr("data-itemRow"),
				personID = $row.attr("data-personRow");
				
				rowID = parseInt(rowID) + 1;
				rowInfo = '<div class="fauxTableRow" data-itemRow="' + rowID +'" data-personRow="'+personID+'"> ' +
							'<div class="fauxCell basic"><label for="entry' + personID +'Row'+rowID+'Item" class="handheld">Item</label><input type="text" id="entry' + personID +'Row'+rowID+'Item" name="entry' + personID +'Row'+rowID+'Item" placeholder="Item" title="Item" /></div>' +
							'<div class="fauxCell"><label for="entry' + personID +'Row'+rowID+'URL" class="handheld">URL</label><input type="text" id="entry' + personID +'Row'+rowID+'URL" name="entry' + personID +'Row'+rowID+'URL" placeholder="URL" placeholder="URL" /></div>' +
							'<div class="fauxCell"><label for="entry' + personID +'Row'+rowID+'Shop" class="handheld">From</label><input type="text" id="entry' + personID +'Row'+rowID+'Shop" name="entry' + personID +'Row'+rowID+'Shop" placeholder="From" placeholder="From" /></div>' +
							'<div class="fauxCell basic"><label for="entry' + personID +'Row'+rowID+'Price" class="handheld">Price</label><input type="text" id="entry' + personID +'Row'+rowID+'Price" name="entry' + personID +'Row'+rowID+'Price" placeholder="Price" placeholder="Price"/></div>' +
							'<div class="fauxCell"><label for="entry' + personID +'Row'+rowID+'Bought" class="handheld">Bought</label><input type="checkbox" id="entry' + personID +'Row'+rowID+'Bought" name="entry' + personID +'Row'+rowID+'Bought" value="0" /></div>' +
							'<div class="fauxCell"><label for="entry' + personID +'Row'+rowID+'Wrapped" class="handheld">Wrapped</label><input type="checkbox" id="entry' + personID +'Row'+rowID+'Wrapped" name="entry' + personID +'Row'+rowID+'Wrapped" value="0" /></div>' +
							'<div class="fauxCell"><label for="entry' + personID +'Row'+rowID+'Delivered" class="handheld">Delivered</label><input type="checkbox" id="entry' + personID +'Row'+rowID+'Delivered" name="entry' + personID +'Row'+rowID+'Delivered" value="0" /></div><div class="fauxCell basic"><div class="addItemRow">+</div></div></div>';
	
			
			
			
			$row.parent(".fauxTable").append(rowInfo);	
		});
		
		
		$("#basicMode").click(function(){
			showBasic();
		});
		$("#advancedMode").click(function(){
			showAdvanced();
		});
		$("#ideasMode").click(function(){
			showIdeas();
		});
	});

function showBasic(){
	$("#basicMode, #advancedMode, #ideasMode").removeClass("selected");
	$("#basicMode").addClass("selected");
	$(".fauxCell").not(".fauxCell.notHide").hide();
	$(".basic").show();
	$("input#listMode").val(1);
	if ($(".cardList").length != 0){
		$(".cardList").addClass("basicMode");
		$(".cardList").removeClass("ideasMode");
	}
}
function showAdvanced(){
	$("#basicMode, #advancedMode, #ideasMode").removeClass("selected");
	$("#advancedMode").addClass("selected");
	$(".fauxCell").show();
	$("input#listMode").val(2);
	if ($(".cardList").length != 0){
		$(".cardList").removeClass("basicMode");
		$(".cardList").removeClass("ideasMode");
	}
}
function showIdeas(){
	$("#basicMode, #advancedMode, #ideasMode").removeClass("selected");
	$("#ideasMode").addClass("selected");
	$(".fauxCell").not(".fauxCell.notHide").hide();
	$(".ideas").show();
	$("input#listMode").val(3);
	if ($(".cardList").length != 0){
		$(".cardList").removeClass("basicMode");
		$(".cardList").addClass("ideasMode");
	}
}
</script>