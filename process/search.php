<?php 
	$searchInput = $_REQUEST['searchInput'];
	$searchBig = $_REQUEST['bigSearchInput'];
	
	if ($searchInput){
		$search = $searchInput;
	} else if ($searchBig) {
		$search = $searchBig;
	} else {
		$search = false;	
	}
	require('../res/connect.php');
	
	if ($search){
	
		//$searchQuery = mysqli_query($connect, "SELECT * FROM posts WHERE (postTitle LIKE '%" . $search . "%')");
		$searchTerms = explode(' ', $search);
		$searchBits = array();
		foreach ($searchTerms as $term) {
			$term = trim($term);
			if (!empty($term)) {
				$searchBits[] = "(postTitle LIKE '%$term%')";
				$searchBits[] = "(postDesc LIKE '%$term%')";
			}
		}
		$searchInnerQuery = "SELECT * FROM posts WHERE ".implode(' OR ', $searchBits)."";
		echo $searchInnerQuery;
		$searchQuery = mysqli_query($connect, $searchInnerQuery);
		$searchCount = mysqli_num_rows($searchQuery);
		if ($searchCount < 1){
			foreach ($searchTerms as $termtag) {
				$termtag = trim($termtag);
				if (!empty($termtag)) {
					$tagBits[] = "tag LIKE '%$termtag%'";
				}
			}
			$tagQuery = mysqli_query($connect, "SELECT * FROM tags WHERE ".implode(' AND ', $tagBits)."");	
			$tagCount = mysqli_num_rows($tagQuery);
			if ($tagCount > 1){
				$searchCount = $tagCount;		
			} else if ($tagCount == 1) {
				$searchCount = $tagCount;
				while($tagRow = mysqli_fetch_array($tagQuery)){
					$postID = $tagRow['postID'];
						
				}
			}
		} else if ($searchCount == 1){
			while ($searchRow = mysqli_fetch_array($searchQuery)){
				$postID = $searchRow['postID'];	
			}
		}
		
		if ($searchCount >= "1"){
			header("Location: http://www.its-xmas.co.uk/?search=" .$search. "");
		} else {
			header("Location: http://www.its-xmas.co.uk/?search=" .$search. "&results=none");
		}
	} else {
		header("Location: http://www.its-xmas.co.uk/");
	}

?>