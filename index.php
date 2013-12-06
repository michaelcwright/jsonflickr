<?php if (!isset($_SESSION)) { session_start();}?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Flickr API testing</title>
<link rel="stylesheet" href="style.css" />
<link rel="stylesheet" href="css/bootstrap.css" />
<link rel="stylesheet" href="css/bootstrap-theme.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">


<!---------------------- FIRST ROW ---------------------------->
<div class="row">
<div class="col-md-12">
<br />

<form method="post" action="index.php?page=1">
<p><h2>Search</h2></p>
<input type="text" name="tag" >
<br /><br />
<input type="submit" value="search">
</form>

<?php 
	if(isset($_GET['page']))
	{
	    if($_GET['page'] == 1)
	    {	    
		    $_SESSION['tag'] = $_POST['tag'];
		    include 'search.php';
	    }else{
		    include 'search.php';
	    }
	}

?>



</div>
</div>
</div>


</body>



</html>