<?php

	$base = "http://www.its-xmas.co.uk/?";
	
?>

<div id="navbar">
	<div class="bar">
        <div id="countdownMobileHolder" class="handheld">
            <a href="/countdown"><span id="countdownMobile"></span></a>
        </div>
    	<?php if (!$id){ ?>
            <a href="/login/" class="link cta login" title="Login">Login</a>
            <a href="/register/" class="link cta register" title="Register">Register</a>
        <?php } else { ?>
	        <a href="/member/post/" class="link cta post" title="Post">Post</a>
        	<a href="/member/my-christmas/" class="link cta my-christmas" title="My Christmas">My Christmas<span></span></a>
		<?php } ?>    
    	<form id="searchForm" name="searchForm" method="post" action="/process/search.php">
	        <input class="title" type="text" name="searchInput" id="searchInput" placeholder="Search It's Christmas" value="<?php if (isset($search)){ echo $search; } ?>" />
            <input type="image" src="/images/icon/search.png" alt="Search" />
        </form>
        <div class="sep"></div>
        <div id="refineMenu">
            <div class="title"><div class="space">&nbsp;</div><div class="textTitle">Explore...</div><div class="control plus">+</div><div class="control minus">-</div></div>
                <form id="refine" name="refine" action="/" method="post">
                    <div class="refineRow">
                        <label>Select Category</label><?php 
                            $selectbox = true;
                            require("category.php"); 
							$mobileselect = true;							
							require("category.php"); 
                        ?>
                        <input type="hidden" id="categoryHidden" name="categoryHidden" value="<?php if (isset($searchCat)){ echo $searchCat; } ?>"/>
                   </div>
                   <div class="refineRow">
                        <label for="dateFrom">Dates</label>
                        <div id="refineDateInputs">
                            <input id="dateFrom" name="dateFrom" type="text" placeholder="dd/mm/yyyy" value="<?php if (isset($datefrom)){ echo $datefrom; } ?>" />
                            <span> - </span>
                            <input id="dateTo" name="dateTo" type="text" placeholder="dd/mm/yyyy" value="<?php if (isset($dateto)){ echo $dateto; } ?>" />
                  		</div>
                    </div>  
                    <div class="refineRow">
                        <label for="ratingFrom">Rating</label>
                        <div id="refineRating">
                            <input id="ratingFrom" name="ratingFrom" type="text" placeholder="0 - 100%" value="<?php if (isset($ratingfrom)){ echo $ratingfrom; }?>" />
                            <div id="ratingSlider"></div>
                        </div>
                    </div>
                    <div class="refineRow">
                        <label for="sort">Sort by</label>
                        <select id="sort" name="sort">
                        	<option selected value="">Select</option>
                            <option value="newest">Newest</option>
                            <option value="oldest">Oldest</option>
                            <option value="most-popular">Most popular</option>
                            <option value="least-popular">Least popular</option>
                            <option value="a-z">Alphabetical (A-Z)</option>
                           <option value="z-a">Alphabetical (Z-A)</option>
                        </select>
                    </div>
                    
                    	
                    	<?php if(isset($limitType)){ ?>
	                        <div class="refineRow buttonRow">
                                <input type="checkbox" id="limit" name="limit" value="<?php echo $limitLink ?>" />
                                <label for="limit">Limit to this <?php echo $limitType ?></label>
                            </div>	
						<?php } else if ($id) { ?>
                        	<div class="refineRow buttonRow">
                                <input type="checkbox" id="limit" name="limit" value="nice" />
                                <label for="limit">Limit to the nice list</label>
                            </div>
                        <?php } ?>
                    
                    <div class="refineRow buttonRow">
                        <label>&nbsp;</label>
                        <button>Refine</button>
                    </div>
                	</form>
                
        </div>
        <?php if ($id){ ?>
            <div class="moreOptions">My Account...</div>
            <div class="lessOptions"><span>My Account...</span>
		            <a href="/member/notifications/" class="link notifications" title="Notifications">Notifications<span></span></a>
					<a href="/member/lists/" class="link lists" title="My lists">My lists</a>
                    <a href="/member/collections/" class="link collections" title="My collections">My collections<span></span></a>
                    <a href="/member/nice-list/" class="link nice-list" title="Nice List">Nice List<span></span></a>
                    <a href="/member/naughty-list/" class="link naughty-list" title="Naughty List">Naughty List<span></span></a>
                    <a href="/member/details/" class="link" title="My Details">My details</a>
                    <a href="/member/preferences/" class="link" title="Preferences">Preferences</a>
                  
            </div>
        <?php } ?> 
        
        
        <div class="moreOptions">More...</div>
        <div class="lessOptions"><span>Less...</span>
  
        	<a href="/contact/" class="link contact" title="Contact us">Contact us<span></span></a>
            <a href="/about/" class="link" title="About It's Christmas">About</a>
            <!--<a href="/what-is-christmas/" class="link" title="What is Christmas?">What is Christmas?</a>-->
            
            <a href="/cookies/" class="link" title="Milk & Cookie Policy">Milk & Cookie Policy</a>
            <a href="/privacy/" class="link" title="Privacy Policy">Privacy Policy</a>
            <a href="/terms/" class="link" title="Terms">Terms & Conditions</a>
<!--            <a href="http://www.wildandjam.co.uk" class="link wildandjam" target="_blank">wildandjam</a>-->
        </div>
        <a href="/blog/" class="link cta" title="Post">Blog</a>
        
        <?php if ($id){ ?>
	        <a href="/logout/" class="link" title="Logout">Logout</a>
        <?php } ?>
        <div id="socialButtons">
           <a href="https://www.facebook.com/nowitschristmas" rel="me" class="hint--bottom" data-hint="Like on Facebook"><img src="/images/social/facebook.png" alt="Facebook logo" /></a>
           <a href="https://plus.google.com/118313567872545392982" rel="me publisher" class="hint--bottom" data-hint="Follow on Google+"><img src="/images/social/google.png" alt="Google+ logo" /></a>
           <a href="https://twitter.com/NowItsChristmas" rel="me" class="hint--bottom" data-hint="Follow on Twitter"><img src="/images/social/twitter.png" alt="Twitter logo"/></a>
       </div>
    </div>  
     
</div>
<?php if (isset($id)){ 

} else {
	if (isset($pageID) && $pageID != 1 && $pageID != 2 && $pageID != 3){

?>
	
        <div id="cookiePop" style="display:none;">
            <h3>Milk and Cookie Policy</h3>
            <img src="/images/milk-cookies.png" alt="Milk and Cookies" align="middle"/>
            <p>By using this website, you agree to the use of milk and cookies in accordance with this policy. </p>
            <a href="/cookies/">Read more</a>
            <span class="icon-close"></span>
        </div> 
<?php }} ?>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-TM643S"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TM643S');</script>
<!-- End Google Tag Manager -->