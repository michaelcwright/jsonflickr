<?php if (!isset($_SESSION)) { session_start();}?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Flickr API search</title>
<link rel="stylesheet" href="style.css" />
<link rel="stylesheet" href="css/bootstrap.css" />
<link rel="stylesheet" href="css/bootstrap-theme.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

</head>

<body>
<div class="containerv">

<br />

<div class="searchx">
<form method="post" id="form1"action="index.php?page=1">
	<p><h1><span class="lettera">flick</span><span class="letterc">r</span></h1><span class="undertitle">by mike</span></p>

	    <label for="exampleInputEmail1">Search</label>
			<input type="text" class="form-control" name="tag" placeholder="Enter search">
			<br />
	<label for="exampleInputEmail1">Number per page:</label>	
	<select id="pageNumber" name="pageNumber" class="form-control">
	  <option value="25"<?php 
	if(empty($_SESSION['perPage']) && empty($_GET['perPage']))
		{
			echo "selected";
		}
	if (isset($_SESSION['perPage']))
		{
			if($_SESSION['perPage'] == 25)
			echo "selected";
		}
	elseif(isset($_GET['perPage'])){
			if($_GET['perPage'] == 25)
			echo "selected";
		}?>>25</option>
	  <option value="100" <?php  	
	if (isset($_SESSION['perPage']))
		{
			if($_SESSION['perPage'] == 100)
			echo "selected";
		}
	elseif(isset($_GET['perPage'])){
			if($_GET['perPage'] == 100)
			echo "selected";
		}?>>100</option>
	  <option value="250" <?php  	
	if (isset($_SESSION['perPage']))
		{
			if($_SESSION['perPage'] == 250)
			echo "selected";
		}
	elseif(isset($_GET['perPage']))
		{
			if($_GET['perPage'] == 250)
			echo "selected";
		}?>>250</option>
	</select> <br />
		<p><button type="submit" class="btn btn-default" value="search">Submit</button></p>
</form>
</div>
<br />


	
<?php 
	if(isset($_GET['page']))
	{
	    if($_GET['page'] == 1)
	    {	    
		if(isset($_POST['tag']) && isset($_POST['pageNumber']))
		{
		    $_SESSION['tag'] = $_POST['tag'];
		    $_SESSION['perPage'] = $_POST['pageNumber'];
		    include 'search.php';
		}
		elseif(isset($_GET['tag']) && isset($_GET['page']))
		{
			$tag = $_GET['tag'];
			$page = $_GET['page'];
			include 'search.php';
		}
	    }else{

		    include 'search.php';
	    }
	}

?>

</div>


</body>



</html>