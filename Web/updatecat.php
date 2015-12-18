<!DOCTYPE html>
<?php

session_start();
if ($_SESSION['username'] == NULL){
	//header("Location: https://web.engr.oregonstate.edu/~olsenchr/SP/pages/login_page.php");
	header("Location: http://ec2-52-1-168-208.compute-1.amazonaws.com/SP/pages/login_page.php");
}

//TEST CODE
	//$url = "http://www.recycling-app-13.appspot.com/business";
	//$info = file_get_contents($url);
	//$info = json_decode($info, true);
	//$length = count($info);
	//echo $length;
	//var_dump($info[0][name]);
	//var_dump($info);

	
?>

<html lang="en">
<head>
	<title>Update Category</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	
    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Update Category</h1>
                </div>
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
			<div class="panel-heading">
				Category Information
			</div>
			
<!-- ADD NEW BUSINESS FORM -->
<form method="GET" action="#">
	<br>
<?php
$catid = $_POST["pk_cat_update"];
$url = "http://www.recycling-app-13.appspot.com/category/" . $catid;
				$info = file_get_contents($url);
				$info = json_decode($info, true);
?>
	Category Name: <input type="text" name="catName" value="<?php echo $info["name"];?> "> <br><br>
	<input type="hidden" name="catid" value="<?php echo $catid;?> ">
	<input type="submit" name="submit" value="Submit"> 
</form> <br>
	<div class="panel-heading">
				Subcategory Information Associated with Category
			</div>
<form method = "POST" action = "updatesubcatwithincat1.php">
<input type="hidden" name="catid" value="<?php echo $catid;?> ">
<input type="hidden" name="catName" value="<?php echo $info["name"];?> ">
<input type="submit" value="Remove Subcategories" name="submit1">
</form>
<br>
<form method = "POST" action = "updatesubcatwithincat2.php">
<input type="hidden" name="catid" value="<?php echo $catid;?> ">
<input type="hidden" name="catName" value="<?php echo $info["name"];?> ">
<input type="submit" value="Add Subcategories" name="submit2">				
</form>
			</div>
			</div>
			</div>
		</div>
		</div>
		
		
<form method="POST" action="logout.php">
<input type="submit" value="Logout" name="Logout">
</form>
<br>			
<form method="POST" action="mydash.php">
<input type="submit" name="Back" value="Return to Homepage" >
</form>


<!--When Submit is pressed -->
<?php 

if(isset($_GET["submit"])) {
	//TEST CODE	
	//echo "submit pressed";

	//Update Cat in Database 
 	$catName = $_GET['catName'];
	$catid = $_GET['catid'];
	//echo "Name is " . $catName;
	$catObj = array(
		'id' => $catid,
		'name' => $catName
	);
	$var = json_encode($catObj);
	
	
	
	//ADD CAT TO DATABASE 
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, "http://www.recycling-app-13.appspot.com/category");
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $var);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Content-Length: ' . strlen($var)
		)
	);
	$result = curl_exec($curl);
	curl_close($curl);
	
	
	
	
	//FOR REFERENCE
	//ADD each subcategory to the new category
/*	$subcat = $_GET["subcat"];
	foreach ($subcat as $id) {
		//add each subcategory to cat 
		//echo $id;
	} */
	
	
	
		//REDIRECT TO HOMEPAGE
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=mydash.php">'; 
	
}

?>


</body>
</html>
