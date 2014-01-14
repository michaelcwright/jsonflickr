<?php

foreach($pArray as $photo)
	{
 
		$farm_id = $photo->farm;
		$server_id = $photo->server;
		$photo_id = $photo->id;
		$user_id = $photo->owner;
		$secret_id = $photo->secret;
		$size = 'q';	 
		$title = $photo->title;
		
		$photo_url = 'http://farm'.$farm_id.'.staticflickr.com/'.$server_id.'/'.$photo_id.'_'.$secret_id.'_'.$size.'.'.'jpg';
		 
		echo "<a href='http://www.flickr.com/photos/".$user_id."'><img title='".$title."' src='".$photo_url."' /></a>";
	
	}	
?>