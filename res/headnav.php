<?php
	//Notification Query
	if (isset($id)){
		require('connect.php');
		$notificationQuery = mysqli_query($connect, "SELECT * FROM notifications WHERE notificationUserID = '$id' AND notificationRead = '0' AND notificationHidden = '0'");
		$notificationCount = mysqli_num_rows($notificationQuery);
	}
	
	//print_r($_COOKIE);
?>
<?php if ($type){ ?>
<header data-countdown="<?php echo $type; ?>">
<?php } else { ?>
<header data-countdown="days">
<?php } ?>
    <div id="altHeader">
        <a href="/">
            <span class="link-icon">
                <img src="/images/logo.png" alt="Icon" />
            </span>
            <span class="link-name">
                It's Christmas
            </span>
            <span class="link-extend" data-for="home">
                >>
            </span>
        </a>
        <span class="line">
            <span class="line"></span>
        </span>
        <a href="/posts/">
            <span class="link-icon">
                <img src="http://www.placehold.it/40x40" alt="Icon" />
            </span>
            <span class="link-name">
                Posts
            </span>
            <span class="link-extend" data-for="posts">
                >>
            </span>
        </a>
        <a href="/events/">
            <span class="link-icon">
                <img src="http://www.placehold.it/40x40" alt="Icon" />
            </span>
            <span class="link-name">
                Events
            </span>
            <span class="link-extend">
                >>
            </span>
        </a>
        <a href="/lists/">
            <span class="link-icon">
                <img src="http://www.placehold.it/40x40" alt="Icon" />
            </span>
            <span class="link-name">
                Lists
            </span>
            <span class="link-extend">
                >>
            </span>
        </a>
        <a href="/wiki/">
            <span class="link-icon">
                <img src="http://www.placehold.it/40x40" alt="Icon" />
            </span>
            <span class="link-name">
                Wiki
            </span>
        </a>
        <a href="/blog/">
            <span class="link-icon">
                <img src="http://www.placehold.it/40x40" alt="Icon" />
            </span>
            <span class="link-name">
                Blog
            </span>
        </a>
        <span class="line">
            <span class="line"></span>
        </span>
        <div id="extendNav">
            <span class="link-icon">
                <img src="http://www.placehold.it/40x40" alt="Icon" />
            </span>
            <span class="link-name">
                Expand menu
            </span>
        </div>
    </div>
    
</header>
<div class="panel" data-panel="home">
        Home
    </div>
<div class="panel" data-panel="posts">
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
    <!--<div class="headcont">
        <div class="left">
        	<a href="/" class="iCTitle" data-ref="<?php echo $_SERVER[REQUEST_URI]; ?>">
                It's Christmas
            </a>
			<div id="countdownHolder">
            	<a href="/countdown">
                    <div id="countdown">
                        <div id="countdownTimer"><?php echo $countphp; ?></div>
                    </div>
                </a>
            </div>
		</div>      
        <div class="right">
        	<?php if (isset($id)) { 
				if ($notificationCount > 0){ ?>
                	<a href="/member/notifications/">
                        <span class="navbutton selected hint--left notifications" data-hint="<?php 
                                echo $notificationCount . " new "; 
                                if ($notificationCount == '1'){
                                    echo "notification";	
                                } else {
                                    echo "notifications";
                                }
                            ?>">
                            <span></span>
                        </span>
                   	</a>
            <?php } else { ?>
            	<a href="/member/notifications/">
					<span class="navbutton notifications hint--left" data-hint="0 new notifications">
                    	<span></span>
                    </span>
            	</a>
			<?php } ?>
	            <a href="/member/my-christmas/">
            		<span class="navbutton hint--left" id="navShow" data-hint="My Christmas" title="My Christmas" >
                    	<span></span>
                	</span>
               	</a>
                
            <?php
			} else { ?>
            	<a href="/login/"><span class="navbutton hint--left" id="LoginNav" data-hint="Login" title="Login"><span></span></span></a>
            <?php } ?>
            <span class="navbutton nonHandheld hint--left" data-hint="Search" id="search" title="Search"><span></span></span>
            <span class="navbutton hint--left" data-hint="Open Navigation" id="nav" title="Open Navigation"><span></span></span>
            
        </div>
    </div>-->   
</header>