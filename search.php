<?php 
	require_once('FirePHP.class.php');
	ob_start();
	$api_key = '5f1c750205bb27a91b5adabe177e5e9a';
	
	//get the tag
	if (isset($_GET['tag']) && isset($_GET['perPage']))
	{
		$tag = $_GET['tag'];
		$perPage = $_GET['perPage'];
	}else{
		$tag = $_SESSION['tag'];
		$perPage = $_SESSION['perPage'];
	}
	$page = $_GET['page'];
	
	//sets up for pagination
	if($perPage == 25)
	{
		$max = 161;
	}
	if($perPage == 100)
	{
		$max = 41;
	}
	if($perPage == 250)
	{
		$max = 17;
	}
	$max3 = $max - 3;
	$max2 = $max - 2;
	$max1 = $max - 1;
	$cleanTag = cleanUp($tag);
	
	//cleans up tag
	function cleanUp($tag) 
	{
	    $tag = strtolower($tag);
	    $tag = preg_replace("/[^a-z0-9_\s-]/", "", $tag);
	    $tag = preg_replace("/[\s-]+/", " ", $tag);
	    $tag = preg_replace("/[\s_]/", ",", $tag);
	    return $tag;
	}
	//flickr allows only 4000 photos to be returned
	if($_GET['page'] <= $max){
	//if stat:fail code:100 (this is a bug and the key needs to be switched)
	//5f1c750205bb27a91b5adabe177e5e9a
	//51b857396625437cea5a13da621222b6
	
	$url = 'http://api.flickr.com/services/rest/?method=flickr.photos.search&api_key='. $api_key .'&tags=' . $cleanTag .'&per_page=' . $perPage .'&page='.$page.'&tag_mode=any&format=json&nojsoncallback=1';


	//get json object and sends to php variable
	$response = json_decode(file_get_contents($url));
	
	//sends response to object and display on website
	$pArray = $response->photos->photo;
	include 'objectP.php';
 
	//firephp
	$firephp = FirePHP::getInstance(true);
	$firephp->log($response, 'Iterators');
	$firephp->log($pArray, 'Iterators');
	
	//start pagination
	$prevp = $page - 1;
	$nextp = $page + 1;
	$next = $page + 1;
	
	if(isset($_GET['page'])){
	$current = $_GET['page'];
	$next2 = $current + 1;
	$next3 = $current + 2;
	$next4 = $current + 3;
	$prev2 = $current - 1;
	$prev3 = $current - 2;
	$prev4 = $current - 3;
	}

	if (isset($_SESSION['tag']))
	{
	if(($_GET['page'] > 3) && ($_GET['page'] < $max) && ($_GET['page'] < $max1) && ($_GET['page'] < $max2) && ($_GET['page'] < $max3))
	{
		echo '<div class="centerx"><a href="index.php?page=1&tag='.$tag.'">First</a>';
		echo '<a href="index.php?page='. $prevp .'&tag='.$tag.'&perPage='.$perPage.'">Prev</a>';
		echo '<a href="index.php?page='. $prev4 .'&tag='.$tag.'&perPage='.$perPage.'">'.$prev4.'</a>';
		echo '<a href="index.php?page='. $prev3 .'&tag='.$tag.'&perPage='.$perPage.'">'.$prev3.'</a>';
		echo '<a href="index.php?page='. $prev2 .'&tag='.$tag.'&perPage='.$perPage.'">'.$prev2.'</a>';
		echo '<span class="spacingfix"><b>'.$current.'</span></b>';
		echo '<a href="index.php?page='. $next2 .'&tag='.$tag.'&perPage='.$perPage.'">'.$next2.'</a>';
		echo '<a href="index.php?page='. $next3 .'&tag='.$tag.'&perPage='.$perPage.'">'.$next3.'</a>';
		echo '<a href="index.php?page='. $next4 .'&tag='.$tag.'&perPage='.$perPage.'">'.$next4.'</a>';
	}
	if($_GET['page'] == 3)
	{
		echo '<div class="centerx"><a href="index.php?page=1&tag='.$tag.'">First</a>';
		echo '<a href="index.php?page='. $prevp .'&tag='.$tag.'&perPage='.$perPage.'">Prev</a>';
		echo '<a href="index.php?page='. $prev3 .'&tag='.$tag.'&perPage='.$perPage.'">'.$prev3.'</a>';
		echo '<a href="index.php?page='. $prev2 .'&tag='.$tag.'&perPage='.$perPage.'">'.$prev2.'</a>';
		echo '<span class="spacingfix"><b>'.$current.'</span></b>';
		echo '<a href="index.php?page='. $next2 .'&tag='.$tag.'&perPage='.$perPage.'">'.$next2.'</a>';
		echo '<a href="index.php?page='. $next3 .'&tag='.$tag.'&perPage='.$perPage.'">'.$next3.'</a>';
		echo '<a href="index.php?page='. $next4 .'&tag='.$tag.'&perPage='.$perPage.'">'.$next4.'</a>';
	}
	if($_GET['page'] == 2)
	{
		echo '<div class="centerx"><a href="index.php?page=1&tag='.$tag.'">First</a>';
		echo '<a href="index.php?page='. $prevp .'&tag='.$tag.'&perPage='.$perPage.'">Prev</a>';
		echo '<a href="index.php?page='. $prev2 .'&tag='.$tag.'&perPage='.$perPage.'">'.$prev2.'</a>';
		echo '<span class="spacingfix"><b>'.$current.'</span></b>';
		echo '<a href="index.php?page='. $next2 .'&tag='.$tag.'&perPage='.$perPage.'">'.$next2.'</a>';
		echo '<a href="index.php?page='. $next3 .'&tag='.$tag.'&perPage='.$perPage.'">'.$next3.'</a>';
		echo '<a href="index.php?page='. $next4 .'&tag='.$tag.'&perPage='.$perPage.'">'.$next4.'</a>';
	}
	if($_GET['page'] == 1)
	{
		echo '<div class="centerx">First Prev ';
		echo '<span class="spacingfix"><b>'.$current.'</span></b>';
		echo '<a href="index.php?page='. $next2 .'&tag='.$tag.'&perPage='.$perPage.'">'.$next2.'</a>';
		echo '<a href="index.php?page='. $next3 .'&tag='.$tag.'&perPage='.$perPage.'">'.$next3.'</a>';
		echo '<a href="index.php?page='. $next4 .'&tag='.$tag.'&perPage='.$perPage.'">'.$next4.'</a>';
	}

	if ($_GET['page'] == $max3)
	{
		echo '<div class="centerx"><a href="index.php?page=1&tag='.$tag.'">First</a>';
		echo '<a href="index.php?page='. $prevp .'&tag='.$tag.'&perPage='.$perPage.'">Prev</a>';
		echo '<a href="index.php?page='. $prev4 .'&tag='.$tag.'&perPage='.$perPage.'">'.$prev4.'</a>';
		echo '<a href="index.php?page='. $prev3 .'&tag='.$tag.'&perPage='.$perPage.'">'.$prev3.'</a>';
		echo '<a href="index.php?page='. $prev2 .'&tag='.$tag.'&perPage='.$perPage.'">'.$prev2.'</a>';
		echo '<span class="spacingfix"><b>'.$current.'</span></b>';
		echo '<a href="index.php?page='. $next2 .'&tag='.$tag.'&perPage='.$perPage.'">'.$next2.'</a>';
		echo '<a href="index.php?page='. $next3 .'&tag='.$tag.'&perPage='.$perPage.'">'.$next3.'</a>';
		echo '<a href="index.php?page='. $next4 .'&tag='.$tag.'&perPage='.$perPage.'">'.$next4.'</a>';		
	}	

	if ($_GET['page'] == $max2)
	{
		echo '<div class="centerx"><a href="index.php?page=1&tag='.$tag.'">First</a>';
		echo '<a href="index.php?page='. $prevp .'&tag='.$tag.'&perPage='.$perPage.'">Prev</a>';
		echo '<a href="index.php?page='. $prev4 .'&tag='.$tag.'&perPage='.$perPage.'">'.$prev4.'</a>';
		echo '<a href="index.php?page='. $prev3 .'&tag='.$tag.'&perPage='.$perPage.'">'.$prev3.'</a>';
		echo '<a href="index.php?page='. $prev2 .'&tag='.$tag.'&perPage='.$perPage.'">'.$prev2.'</a>';
		echo '<span class="spacingfix"><b>'.$current.'</span></b>';
		echo '<a href="index.php?page='. $next2 .'&tag='.$tag.'&perPage='.$perPage.'">'.$next2.'</a>';
		echo '<a href="index.php?page='. $next3 .'&tag='.$tag.'&perPage='.$perPage.'">'.$next3.'</a>';		
	}
	
	if ($_GET['page'] == $max1)
	{
		echo '<div class="centerx"><a href="index.php?page=1&tag='.$tag.'">First</a>';
		echo '<a href="index.php?page='. $prevp .'&tag='.$tag.'&perPage='.$perPage.'">Prev</a>';
		echo '<a href="index.php?page='. $prev4 .'&tag='.$tag.'&perPage='.$perPage.'">'.$prev4.'</a>';
		echo '<a href="index.php?page='. $prev3 .'&tag='.$tag.'&perPage='.$perPage.'">'.$prev3.'</a>';
		echo '<a href="index.php?page='. $prev2 .'&tag='.$tag.'&perPage='.$perPage.'">'.$prev2.'</a>';
		echo '<span class="spacingfix"><b>'.$current.'</span></b>';
		echo '<a href="index.php?page='. $next2 .'&tag='.$tag.'&perPage='.$perPage.'">'.$next2.'</a>';	
	}
	
	if ($_GET['page'] == $max)
	{
		echo '<div class="centerx"><a href="index.php?page=1&tag='.$tag.'">First</a>';
		echo '<a href="index.php?page='. $prevp .'&tag='.$tag.'&perPage='.$perPage.'">Prev</a>';
		echo '<a href="index.php?page='. $prev4 .'&tag='.$tag.'&perPage='.$perPage.'">'.$prev4.'</a>';
		echo '<a href="index.php?page='. $prev3 .'&tag='.$tag.'&perPage='.$perPage.'">'.$prev3.'</a>';
		echo '<a href="index.php?page='. $prev2 .'&tag='.$tag.'&perPage='.$perPage.'">'.$prev2.'</a>';
		echo '<span class="spacingfix"><b>'.$current.'</span></b>';
		echo ' Next Last</div>';	
	}
	
	if ($_GET['page'] < $max){
		echo '<a href="index.php?page='. $nextp .'&tag='.$tag.'&perPage='.$perPage.'">Next</a>';
		echo '<a href="index.php?page='.$max.'&tag='.$tag.'&perPage='.$perPage.'">Last</a></div>';
	}
	
	}

	}

 
 ?>
