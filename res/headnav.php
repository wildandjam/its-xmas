<?php
	//Notification Query
	if ($xUser == true){
		$notificationQuery = mysqli_query($connect, "SELECT * FROM notifications WHERE notificationUserID = '$id' AND notificationRead = '0' AND notificationHidden = '0'");
		$notificationCount = mysqli_num_rows($notificationQuery);
	}
?>
<?php if (isset($type)){ ?>
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
                <img src="/images/icon/posts.png" alt="Posts" />
            </span>
            <span class="link-name">
                Posts
            </span>
            <span class="link-extend" data-for="posts">
                >>
            </span>
        </a>
        <a href="/events/">
            <span class="link-icon events">
                <?php echo date("j"); ?>
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
                <img src="/images/icon/lists.png" alt="Lists" />
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
                <img src="/images/icon/wiki.png" alt="Wiki" />
            </span>
            <span class="link-name">
                Wiki
            </span>
        </a>
        <a href="/blog/">
            <span class="link-icon">
                <img src="/images/icon/snowflake.png" alt="Snowflake" />
            </span>
            <span class="link-name">
                Blog
            </span>
            <span class="link-extend" data-for="blog">
                >>
            </span>
        </a>
        <span class="line">
            <span class="line"></span>
        </span>
        <div id="extendNav">
            <span class="link-icon">
                <img src="/images/icon/expand.png" alt="Toggle menu size" />
            </span>
            <span class="link-name">
                Hide menu
            </span>
        </div>
    </div>
</header>
<div class="panel" data-panel="home">
<?php if (isset($id)){ ?>
    <ul class="links">
        <li>
            <a href="/member/my-christmas/">
                My Christmas
            </a>
        </li> 
        <li>
            <hr />
        </li>
<?php } else { ?>
    <ul class="links">
        <li>
            <a href="/login/">
                Login
            </a>
        </li>   
        <li>
            <a href="/register/">
                Register
            </a>
        </li>  
        <li>
            <hr />
        </li>
<?php } ?>
        <li>
            <a href="/about/">
                About
            </a>
        </li>
        <li>
            <a href="/contact/">
                Contact
            </a>
        </li>
        <li>
            <hr />
        </li>
    </ul>
    <ul class="legal">
        <li>
            <a href="/cookies/">
                Milk & Cookie Policy
            </a>
        </li>
        <li>
            <a href="/privacy/">
                Privacy Policy
            </a>
        </li>
        <li>
            <a href="/terms/">
                Terms and Conditions
            </a>
        </li>
    </ul>
</div>
<div class="panel" data-panel="posts">
    <ul class="links">
        <li>
            <a href="/posts/">View all posts</a>
        </li>
        <li><hr /></li>
    </ul>
    <form id="refine" name="refine" action="/posts/" method="post">
        <div class="refineRow">
            <label>Select Category</label><?php 
                $selectbox = true;
                require("category.php"); 
                $mobileselect = true;                           
                require("category.php"); 
                $mobileselect = false; 
                $selectbox = false;
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
    <?php } else if (isset($xUser) && $xUser === true) { ?>
        <div class="refineRow buttonRow">
            <input type="checkbox" id="limit" name="limit" value="nice" />
            <label for="limit">Limit to the nice list</label>
        </div>
    <?php } ?>
        <div class="refineRow buttonRow">
            <label class="nonHandheld">&nbsp;</label>
            <button>Refine</button>
        </div>
    </form>
</div>
<div class="panel" data-panel="blog">
    <ul class="links">
        <li><a href="/blog/">Blog home</a></li>
        <li><hr /></li>
        <li><a href="/blog/topics/best-of/">Best of</a></li>
        <li><a href="/blog/topics/decorations/">Decorations</a></li>
        <li><a href="/blog/topics/diy-crafts/">DIY/Crafts</a></li>
        <li><a href="/blog/topics/gifts/">Gifts</a></li>
        <li><a href="/blog/topics/recipes/">Recipes</a></li>
        <li><a href="/blog/topics/shopping/">Shopping</a></li>
    </ul>
</div>
