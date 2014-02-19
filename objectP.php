<?php

$count = 0;
$count2 = 0;

	if($perPage == 25)
	{
		echo "<div class='results'><div class='rowcount'>";
		$column = 4;
	}
	if($perPage == 100)
	{
		echo "<div class='results2'><div class='rowcount'>";
		$column = 19;
	}
	if($perPage == 250)
	{
		echo "<div class='results3'><div class='rowcount'>";
		$column = 49;
	}
	
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
		
	     
		echo "<div class='cont'><img title='".$title."' src='".$photo_url."'></img></div><div class='imgp'>
			<a target='_blank' href='http://www.flickr.com/photos/".$user_id."'><div class='user_icon'></div></a>
				<a target='_blank' href='http://www.flickr.com/photos/".$user_id."/".$photo_id."'><div class='cam_icon'></div></a></div>";
		$count++;
		if($count == 5)
		{
			$count = 0;

			if($count2 < $column)
			{
				echo "</div><div class='rowcount'>";
			}
			if($count2 == $column)
			{
				echo "</div><br />";
			}
			$count2++;
		}
	
	}
echo "</div></div>";	
?>