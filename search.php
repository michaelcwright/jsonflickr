<?php 
	require_once('FirePHP.class.php');
	ob_start();
	$api_key = '5f1c750205bb27a91b5adabe177e5e9a';
	if (isset($_GET['tag']))
	{
	 $tag = $_GET['tag'];
	}else{
	$tag = $_SESSION['tag'];
	}
	$perPage = '25';
	$page = $_GET['page'];
	$url = 'http://api.flickr.com/services/rest/?method=flickr.photos.search&api_key='. $api_key .'&tags=' . $tag .'&per_page=' . $perPage .'&page='.$page.'&tag_mode=any&format=json&nojsoncallback=1';;


	$response = json_decode(file_get_contents($url));
	$pArray = $response->photos->photo;
	
	include 'objectP.php'; 

	$firephp = FirePHP::getInstance(true);
	$firephp->log($response, 'Iterators');
	$firephp->log($pArray, 'Iterators');
	$x = 0;
	$nextp = $page + 1;
	$prevp = $page - 1;
	if (isset($_GET['tag']))
	{
	echo '<p><h2><a href="index.php?page='. $prevp .'&tag='.$tag.'">Prev</a></h2>';
	}else{
	echo '<p><h2><a href="index.php?page='. $prevp .'&tag='.$_SESSION['tag'].'">Prev</a></h2>';
	}
	if (isset($_GET['tag']))
	{
	echo '<h2><a href="index.php?page='. $nextp .'&tag='.$tag.'">Next</a></h2></p>';
	}else{
	echo '<h2><a href="index.php?page='. $nextp .'&tag='.$_SESSION['tag'].'">Next</a></h2></p>';
	} 
 
 ?>
