<?php 

	$api_key = '8660f5743dc54b08050bad96eb7c3b55';

	//get the tag
	if (isset($_GET['tag']) && isset($_GET['perPage']))
	{
		$tag = $_GET['tag'];
		$perPage = $_GET['perPage'];
	}else{
		$tag = $_GET['tag'];
		$perPage = 25;
	}
	if(isset($_GET['page']))
	{
		$page = $_GET['page'];
	}else{
		$page = 1;
	}
    	  

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
	$url = 'https://api.flickr.com/services/rest/?method=flickr.photos.search&api_key='. $api_key .'&tags=' . $cleanTag .'&per_page=' . $perPage .'&page='.$page.'&tag_mode=any&format=json&nojsoncallback=1';	
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => $url,
		CURLOPT_USERAGENT => 'cURL Request'
	));

	$responsex = curl_exec($curl);
	curl_close($curl);

	$response = json_decode($responsex);

	$pArray = $response->photos->photo;
	 
	include 'objectP.php';
 	
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

	if(($_GET['page'] > 3) && ($_GET['page'] < $max) && ($_GET['page'] < $max1) && ($_GET['page'] < $max2) && ($_GET['page'] < $max3))
	{
		echo '<div class="centerx"><ul class="pagination"><li><a href="index.php?page=1&tag='.$tag.'"><span>First</span></a></li>';
		echo '<li><a href="index.php?page='. $prevp .'&tag='.$tag.'&perPage='.$perPage.'"><span>Prev</span></a></li>';
		echo '<li><a href="index.php?page='. $prev4 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$prev4.'</span></a></li>';
		echo '<li><a href="index.php?page='. $prev3 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$prev3.'</span></a></li>';
		echo '<li><a href="index.php?page='. $prev2 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$prev2.'</span></a></li>';
		echo '<li class="active"><a href="#"><span>'.$current.'</span></a></li>';
		echo '<li><a href="index.php?page='. $next2 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$next2.'</span></a></li>';
		echo '<li><a href="index.php?page='. $next3 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$next3.'</span></a></li>';
		echo '<li><a href="index.php?page='. $next4 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$next4.'</span></a></li>';	
	}
	if($_GET['page'] == 3)
	{
		echo '<div class="centerx"><ul class="pagination"><li><a href="index.php?page=1&tag='.$tag.'"><span>First</span></a></li>';
		echo '<li><a href="index.php?page='. $prevp .'&tag='.$tag.'&perPage='.$perPage.'"><span>Prev</span></a></li>';
		echo '<li><a href="index.php?page='. $prev3 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$prev3.'</span></a></li>';
		echo '<li><a href="index.php?page='. $prev2 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$prev2.'</span></a></li>';
		echo '<li class="active"><a href="#"><span>'.$current.'</span></a></li>';
		echo '<li><a href="index.php?page='. $next2 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$next2.'</span></a></li>';
		echo '<li><a href="index.php?page='. $next3 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$next3.'</span></a></li>';
		echo '<li><a href="index.php?page='. $next4 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$next4.'</span></a></li>';
	}
	if($_GET['page'] == 2)
	{
		echo '<div class="centerx"><ul class="pagination"><li><a href="index.php?page=1&tag='.$tag.'"><span>First</span></a></li>';
		echo '<li><a href="index.php?page='. $prevp .'&tag='.$tag.'&perPage='.$perPage.'"><span>Prev</span></a></li>';
		echo '<li><a href="index.php?page='. $prev2 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$prev2.'</span></a></li>';
		echo '<li class="active"><a href="#"><span>'.$current.'</span></a></li>';
		echo '<li><a href="index.php?page='. $next2 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$next2.'</span></a></li>';
		echo '<li><a href="index.php?page='. $next3 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$next3.'</span></a></li>';
		echo '<li><a href="index.php?page='. $next4 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$next4.'</span></a></li>';
	}
	if($_GET['page'] == 1)
	{
		echo '<div class="centerx"><ul class="pagination"><li class="disabled"><a href="#"><span>First</span></a></li><li class="disabled"><a href="#"><span>Prev</span></a></li>';
		echo '<li class="active"><a href="#"><span>'.$current.'</span></a></li>';
		echo '<li><a href="index.php?page='. $next2 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$next2.'</span></a></li>';
		echo '<li><a href="index.php?page='. $next3 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$next3.'</span></a></li>';
		echo '<li><a href="index.php?page='. $next4 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$next4.'</span></a></li>';
	}

	if ($_GET['page'] == $max3)
	{
		echo '<div class="centerx"><ul class="pagination"><li><a href="index.php?page=1&tag='.$tag.'"><span>First</span></a></li>';
		echo '<li><a href="index.php?page='. $prevp .'&tag='.$tag.'&perPage='.$perPage.'"><span>Prev</span></a></li>';
		echo '<li><a href="index.php?page='. $prev4 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$prev4.'</span></a></li>';
		echo '<li><a href="index.php?page='. $prev3 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$prev3.'</span></a></li>';
		echo '<li><a href="index.php?page='. $prev2 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$prev2.'</span></a></li>';
		echo '<li class="active"><a href="#"><span>'.$current.'</span></a></li>';
		echo '<li><a href="index.php?page='. $next2 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$next2.'</span></a></li>';
		echo '<li><a href="index.php?page='. $next3 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$next3.'</span></a></li>';
		echo '<li><a href="index.php?page='. $next4 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$next4.'</span></a></li>';		
	}	

	if ($_GET['page'] == $max2)
	{
		echo '<div class="centerx"><ul class="pagination"><li><a href="index.php?page=1&tag='.$tag.'"><span>First</span></a></li>';
		echo '<li><a href="index.php?page='. $prevp .'&tag='.$tag.'&perPage='.$perPage.'"><span>Prev</span></a></li>';
		echo '<li><a href="index.php?page='. $prev4 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$prev4.'</span></a></li>';
		echo '<li><a href="index.php?page='. $prev3 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$prev3.'</span></a></li>';
		echo '<li><a href="index.php?page='. $prev2 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$prev2.'</span></a></li>';
		echo '<li class="active"><a href="#"><span>'.$current.'</span></a></li>';
		echo '<li><a href="index.php?page='. $next2 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$next2.'</span></a></li>';
		echo '<li><a href="index.php?page='. $next3 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$next3.'</span></a></li>';	
	}
	
	if ($_GET['page'] == $max1)
	{
		echo '<div class="centerx"><ul class="pagination"><li><a href="index.php?page=1&tag='.$tag.'"><span>First</span></a></li>';
		echo '<li><a href="index.php?page='. $prevp .'&tag='.$tag.'&perPage='.$perPage.'"><span>Prev</span></a></li>';
		echo '<li><a href="index.php?page='. $prev4 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$prev4.'</span></a></li>';
		echo '<li><a href="index.php?page='. $prev3 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$prev3.'</span></a></li>';
		echo '<li><a href="index.php?page='. $prev2 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$prev2.'</span></a></li>';
		echo '<li class="active"><a href="#"><span>'.$current.'</span></a></li>';
		echo '<li><a href="index.php?page='. $next2 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$next2.'</span></a></li>';
	}
	
	if ($_GET['page'] == $max)
	{
		echo '<div class="centerx"><ul class="pagination"><li><a href="index.php?page=1&tag='.$tag.'"><span>First</span></a></li>';
		echo '<li><a href="index.php?page='. $prevp .'&tag='.$tag.'&perPage='.$perPage.'"><span>Prev</span></a></li>';
		echo '<li><a href="index.php?page='. $prev4 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$prev4.'</span></a></li>';
		echo '<li><a href="index.php?page='. $prev3 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$prev3.'</span></a></li>';
		echo '<li><a href="index.php?page='. $prev2 .'&tag='.$tag.'&perPage='.$perPage.'"><span>'.$prev2.'</span></a></li>';
		echo '<li class="active"><a href="#"><span>'.$current.'</span></a></li>';
		echo '<li class="disabled"><a href="#"><span>Next</span></a></li><li class="disabled"><a href="#"><span>Last</span></a></li></ul></div>';	
	}
	
	if ($_GET['page'] < $max){
		echo '<li><a href="index.php?page='. $nextp .'&tag='.$tag.'&perPage='.$perPage.'">Next</a></li>';
		echo '<li><a href="index.php?page='.$max.'&tag='.$tag.'&perPage='.$perPage.'">Last</a></li></ul></div>';
	}
	


	}

 
 ?>
