<?php require('../res/meta.php'); ?>
<title>It's Christmas | Share the Christmas Spirit</title>
<meta itemprop="title" property="og:title" content="It's Christmas | Share the Christmas Spirit" />
</head>
<body>
<?php require('../res/headnav.php'); ?>
<div id="container">
	<div id="pageHeader">
		<h1>Posts</h1>
		<?php require('../res/userPortal.php'); ?>
		<div id="breadcrumbs">
            <ul>
                <li><a href="/">Home</a></li>
                <li>Posts</li>
            </ul>
        </div>
		<div id="pageHeaderLinks">
			<?php 
				if (isset($id)){
			?>
				<a href="/member/post/">New post</a>
			<?php
				}
			?>
			<a href="#">Search posts</a>
		</div>
	</div>
	<?php 
		require('../res/connect.php');		
		if (isset($_REQUEST['category'])){
			$category = $_REQUEST['category'];
		}
		if (isset($_REQUEST['categoryHidden'])){
			$categoryH = $_REQUEST['categoryHidden'];
		}
		if (isset($_REQUEST['dateFrom'])){
			$datefrom = $_REQUEST['dateFrom'];
		}
		if (isset($_REQUEST['dateTo'])){
			$dateto = $_REQUEST['dateTo'];
		}
		if (isset($_REQUEST['ratingFrom'])){
			$ratingfrom = $_REQUEST['ratingFrom'];
		}
		if (isset($_REQUEST['date'])){
			$date = $_REQUEST['date'];
		}
		if (isset($_REQUEST['search'])){
			$search = $_REQUEST['search'];
		}
		if (isset($_REQUEST['results'])){
			$results = $_REQUEST['results'];
		}
		if (isset($_REQUEST['sort'])){
			$sort = $_REQUEST['sort'];
		}
		if (isset($_REQUEST['limit'])){
			$limit = $_REQUEST['limit'];
		}

		if (isset($_REQUEST)){
			//Category fix name to ID
			if (isset($category) || isset($categoryH)){
				if ($category == 0){
					if ($category){
						$categoryQu = mysqli_query($connect, "SELECT * FROM categories WHERE categoryName = '$category'");
						if (mysqli_num_rows($categoryQu) == 1){
							while ($catQuRow = mysqli_fetch_array($categoryQu)){
								$searchCat = $catQuRow['categoryID'];
							}
						}
					} else {
						$searchCat = $categoryH;	
					}
				} else {
					$searchCat = $category;	
				}
			}
		}
		
		//Start of Query
		//Get all public posts
		if (isset($id)){
			$query = 'SELECT * FROM posts WHERE postHidden = \'0\' AND (postPrivacy = \'0\' OR (postPrivacy = \'1\' AND userID = \'' . $id . '\'))';
		} else {
			$query = 'SELECT * FROM posts WHERE postHidden = \'0\' AND (postPrivacy = \'0\' OR (postPrivacy = \'1\'))';
		}

		//Search
		if (isset($search)){
			$searchTerms = explode(' ', $search);
			$searchBits = array();
			$query .= " AND ";
			foreach ($searchTerms as $term) {
				$term = trim($term);
				if (!empty($term)) {
					$searchBits[] = "(postTitle LIKE '%$term%')";
					$searchBits[] = "(postDesc LIKE '%$term%')";
					$searchUserBits[] = "(userName LIKE '%$term%')";
					$searchUserBits[] = "(userEmail = '$term')";
				}
			}
			$query .= implode(' OR ', $searchBits);
			$criteria = "<div class='criteria' data-type='search'><em>Search: </em><span class='criteriaResult'>" . $search . "</span><span class='criteriaRemove'><span class=\"icon-close\"></span></span></div>";
			$userSearchQ = "SELECT * FROM users INNER JOIN userdetails ON (users.userID = userdetails.userID)  WHERE userPrivate = '0' AND ";
			$userSearchQ .= implode(' OR ', $searchUserBits);
			$userSearchQ .= " ORDER BY userName ASC";
			//echo $userSearchQ;
			$userSearchQuery = mysqli_query($connect, $userSearchQ);
		}
		//if category add category
		if (isset($searchCat) && $searchCat > 0 ){
			$catCheck = mysqli_query($connect,"SELECT * FROM categories WHERE categoryID = '$searchCat' AND categoryHide = '0'");
			$catCount = mysqli_num_rows($catCheck);
			$catRow = mysqli_fetch_array($catCheck);
			$searchCatName = $catRow['categoryName'];
			
			if ($catCount == '1') {
				$query .= 	" AND categoryID = '$searchCat'";
				$criteria .= "<div class='criteria' data-type='categoryHidden'><em>Category: </em><span class='criteriaResult'>" . $searchCatName . "</span><span class='criteriaRemove'><span class=\"icon-close\"></span></span></div>";
			} else {
				echo "<h1>Unfortunately this category is disabled, or incorrect - please try again</h1>";	
			}
		}
		//Date range
		if (isset($dateto) || isset($datefrom)){
			$newDateFrom = date("Y-m-d", strtotime($datefrom));
			$newDateTo = date("Y-m-d", strtotime($dateto));
			$criteria = "";
			if (!$datefrom){

				$query .= " AND postDate < '$newDateTo'";
				$criteria .= "<div class='criteria' data-type='dateFrom'><em>From: </em><span class='criteriaResult'>" . date("d/m/Y", strtotime($datefrom)) . "</span><span class='criteriaRemove'><span class=\"icon-close\"></span></span></div>";
			} else if (!$dateto){
				$query .= " AND postDate > '$newDateFrom'";
				$criteria .= "<div class='criteria' data-type='dateTo'><em>To: </em><span class='criteriaResult'>" . date("d/m/Y", strtotime($dateto)) . "</span><span class='criteriaRemove'><span class=\"icon-close\"></span></span></div>";
			} else {
				$query .= " AND postDate BETWEEN '$newDateFrom' AND '$newDateTo'";
				$criteria .= "<div data-type='dateBoth' class='criteria'><em>Dates: </em><span class='criteriaResult'>" . date("d/m/Y", strtotime($datefrom)) . "-" . date("d/m/Y", strtotime($dateto)) . "</span><span class='criteriaRemove'><span class=\"icon-close\"></span></span></div>";
			}
			
		}
		// Rating range
		if (isset($ratingfrom) && $ratingfrom > 0){
			echo $ratingfrom;
			echo "Hello";
			echo "<br /><br /><br />";
			$ratingfrompieces = explode(" ",$ratingfrom);
			$ratingFromValue = $ratingfrompieces[0];
			$ratingToValue = substr($ratingfrompieces[2], 0 , -1);
			$query .= " AND postRating BETWEEN " . $ratingFromValue . " AND " .$ratingToValue . "";
			$criteria .= "<div class='criteria' data-type='ratingFrom'><em>Rating: </em><span class='criteriaResult'>" . $ratingFromValue . "-" . $ratingToValue . "%</span><span class='criteriaRemove'><span class=\"icon-close\"></span></span></div>";
		
		}	
		// if blocked
		if ($xUser){
			$blockQuery = mysqli_query($connect, "SELECT * FROM relationships WHERE relationshipTypeID > 4 AND (userID1 = '$id' OR userID2 = '$id')");
			if (mysqli_num_rows($blockQuery) > 0){
				while($blockRow = mysqli_fetch_array($blockQuery)){
					$uid1 = $blockRow['userID1'];
					$uid2 = $blockRow['userID2'];
					if ($id == $uid1){
						$blockUser = $uid2;	
					} else {
						$blockUser = $uid1;
					}
					$query .= " AND userID != " . $blockUser . "";
				}
			}
		}
		
		//if just nice list
		if (isset($id)){
			if (isset($limit) && $limit == "nice"){
				$niceListQuery = mysqli_query($connect, "SELECT * FROM relationships WHERE (relationshipTypeID = 2 || relationshipTypeID = 4) AND userID1 = '$id'");
				$niceList2Query = mysqli_query($connect, "SELECT * FROM relationships WHERE (relationshipTypeID = 3 || relationshipTypeID = 4) AND userID2 = '$id'");
				
				$nice1Count = mysqli_num_rows($niceListQuery);
				$nice2Count = mysqli_num_rows($niceList2Query);
				$niceCount = $nice1Count + $nice2Count;
												
				
				if ($niceCount > 0){
					$query .= " AND (";
					$number1 = 0;
					$number2 = 0;
					if ($nice1Count > 0){
						while($niceListRow = mysqli_fetch_array($niceListQuery)){
							$niceUser = $niceListRow['userID2'];
							$number1 = $number1 + 1;
							if ($number1 == $nice1Count){
								$query .= "userID = " . $niceUser;
							} else {
								$query .= "userID = " . $niceUser . " OR ";
							}
						}
						if ($nice1Count != $niceCount){
							$query .= " OR ";
							while($niceList2Row = mysqli_fetch_array($niceList2Query)){
								$niceUser = $niceList2Row['userID1'];
								$number2 = $number2 + 1;
								if ($number2 == $nice2Count){
									$query .= "userID = " . $niceUser;
								} else {
									$query .= "userID = " . $niceUser . " OR ";
								}
							}
						}
					} else {
						while($niceList2Row = mysqli_fetch_array($niceList2Query)){
							$niceUser = $niceList2Row['userID1'];
							$number2 = $number2 + 1;
							if ($number2 == $nice2Count){
								$query .= "userID = " . $niceUser;
							} else {
								$query .= "userID = " . $niceUser . " OR ";
							}
						}
					}
					
					$query .= ")";
					$criteria .= "<div class='criteria' data-type='limit'><em>Limit: </em><span class='criteriaResult'>Nice list</span><span class='criteriaRemove'><span class=\"icon-close\"></span></span></div>";
					
				}
			}
		}
		
		//if sorting

		if (isset($sort)){
			if ($sort == "most-popular"){
				$sortTitle = "postRating";
				$sortDirection = "DESC";
				$sortIt = "Most popular";
			} else if ($sort == "least-popular"){
				$sortTitle = "postRating";
				$sortDirection = "ASC";
				$sortIt = "Least popular";
			} else if ($sort == "a-z"){
				$sortTitle = "postTitle";
				$sortDirection = "ASC";
				$sortIt = "Alphabetical (A-Z)";
			} else if ($sort == "z-a"){
				$sortTitle = "postTitle";
				$sortDirection = "DESC";
				$sortIt = "Alphabetical (Z-A)";
			} else if ($sort == "oldest"){
				$sortTitle = "postDate";
				$sortDirection = "ASC";
				$sortIt = "Oldest";
			} else  {
				$sortTitle = "postDate";
				$sortDirection = "DESC";
				$sortIt = "Newest";
			}
			
			$query .= " ORDER BY $sortTitle " . $sortDirection;
			$criteria .= "<div class='criteria' data-type='sort'><em>Sort by: </em><span class='criteriaResult'>" . $sortIt . "</span><span class='criteriaRemove'><span class=\"icon-close\"></span></span></div>";
		} else {
			if (isset($query)){
				$query .= " ORDER BY postDate DESC";
			}
		}
		if (isset($_REQUEST['page'])){
			$page = $_REQUEST['page'];
		}
		require('../res/getView.php');
		
		if (isset($page)){}else{$page = 1;}
		if (isset($perPage)){}else{$perPage = 25;}
		
		$start = (($page - 1) * $perPage) + 1;
		$end = $perPage;
		//echo $query;
		if (isset($query)){
			$wholequery = $query;

			if ($start == "1"){
				$query .= " LIMIT $end";
			} else if ($perPage != "All"){
				$query .= " LIMIT $start, $end";
			}
		}
	/*	if ($id){
			$query .= " GROUP BY posts.postID";	
		}*/
		if (isset($wholequery)){
			$wholecheck = mysqli_query($connect, $wholequery);
			$wholecount = mysqli_num_rows($wholecheck);
		}
		
		if ($perPage != "All" && isset($wholecount)){

			$pages = $wholecount / $perPage;
			if (($wholecount % $perPage) > 0) {
				$pages + 1;	
			}
			if ($page > 1) {
				$prevPage = $page - 1;
				$pagination = "<a href='?page=" . $prevPage . "'> < </a>"; 
			}
			for ($i = 0; $i < $pages; $i++){
				$pageI = $i + 1;
				if ($pageI == $page){
					if (isset($pagination)){
						$pagination .=  "<span class='selected'>" . $pageI . "</span>";	
					}
				} else {
					if (isset($pagination)){
						$pagination .=  "<a href='?page=" . $pageI . "'>" . $pageI . "</a>";	
					}
				}
			}
			if ($pageI) {
				if ($page != $pageI){
					$nextPage = $page + 1;
					if (isset($pagination)){
						$pagination .= 	"<a href='?page=" . $nextPage . "'> > </a>"; 
					}
				}
			}
		} else {
			$pagination = "<span class='selected'>1</span>";
		}
		//echo $query;
		
		if (isset($criteria)){
			echo "<div id='criteriaHolder'>" . $criteria . "</div>";	
		} else { ?>
        	<!--<div id="bigSearch">
                <div id="bigSearchForm">
            		<?php require('../forms/bigsearch.php'); ?>
                </div>
            </div>-->
        <?php			
		}
		
		if (isset($query)){
			$postcheck = mysqli_query($connect, $query);
			$count = mysqli_num_rows($postcheck);
		}
		if (isset($results)){
			if ($results === "none" && $search){
				if (mysqli_num_rows($userSearchQuery) > 0){
					if (mysqli_num_rows($userSearchQuery) == 1){
						echo "<h1>Your search has matched with " . mysqli_num_rows($userSearchQuery) . " user</h1>";
					} else {
						echo "<h1>Your search has matched with " . mysqli_num_rows($userSearchQuery) . " users</h1>";
					}
				} else {
					echo "<h1 class='noResults'>Unfortunately there are no posts that match your search \"" . $search . "\"</h1>";	
				}
			} else if ($results === "none" || $count == 0){
				echo "<h1 class='noResults'>Unfortunately there are no posts that match your search</h1>";	
			} 
		} else {
			if (isset($search)){
				echo "<h1>Search results for \"" . $search . "\"</h1>";	
			}
		}
		if (isset($userSearchQuery)){
			if (mysqli_num_rows($userSearchQuery) > 0){
				echo "<div class='homeSub'>Users</div>";	
				while ($userSearchRow = mysqli_fetch_array($userSearchQuery)){
					echo "<div class='homeSubUser'><a href='/user/?uid=" . $userSearchRow['userID'] . "'>" . $userSearchRow['userName'] . "</a></div>";
				}	
				echo "<div class='homeSub'>Posts</div>";
			}
		}
		
		
		
		if (isset($count) && $count != 0) { 
        	require('../res/switchView.php');
			
		?>
<?php
		




				
			
			
			
			
			
			
			?>
			<div id="itemholder" class="<?php echo $viewName ?>">
			
			<?php 
			while($row = mysqli_fetch_assoc($postcheck)) {
				require('../res/prepPost.php');
				require('../' . $viewPath);
			}
			echo "</div>";
		} else {
			echo "<div class='errorNoItems error'>It'll be lonely this Christmas, with no posts no hold</div>";
		} 
		require_once('../res/itemFooter.php');
		require_once('../res/overlays.php');
		require('../res/gtm.php'); ?>
</div>
</body>
</html>