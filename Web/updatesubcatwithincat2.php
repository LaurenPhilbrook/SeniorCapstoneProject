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
	<title>Add Subcategories to a Category</title>
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
                    <h1 class="page-header">Add Subcategories to a Category</h1>
                </div>
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
			<div class="panel-heading">
<?php 
$catName = $_POST["catName"]; 
 echo "Subcategories";

?>
			</div>
			
<!-- ADD NEW BUSINESS FORM -->
<form method="POST" action="#">
	<br>
<?php
$catid = $_POST["catid"];
$url = "http://www.recycling-app-13.appspot.com/category/" . $catid;
				$info = file_get_contents($url);
				$info = json_decode($info, true);
				$length = count($info["subcategories"]);

$url2 = "http://www.recycling-app-13.appspot.com/subcategory";
				$info2 = file_get_contents($url2);
				$info2 = json_decode($info2, true);
				$length2 = count($info2);
				//var_dump($info);
				for($i = 0; $i < $length2; $i++) {
					$counter = 0;
					for($x=0; $x < $length; $x++) {
						if(strcmp($info2[$i]["id"], $info["subcategories"][$x]["id"]) == 0) {
							$x = $length;
						} else {
						$counter ++;
						}
				
					}
					if($counter == $length) {
						?>				
				<input type="checkbox" name="subcat[]" id="subcat" value="<?php
					printf("%s", $info2[$i]["id"]);?>"> <?php
					printf("%s", $info2[$i]["name"]);
					?> <br> <?php

					}
				}
?>
				
	<br>		
	<input type="submit" name="submit" value="Add"> 
</form> <br>

<?php 

if(isset($_POST["submit"])) {
	$subcat = $_POST["subcat"];
	foreach ($subcat as $subcatid) {
		//ADD SUBCAT TO CAT WITHIN DATABASE
		
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_PUT, 1);
		curl_setopt($curl, CURLOPT_URL, "http://www.recycling-app-13.appspot.com/category/" . $catid . "/subcategory/" . $subcatid);
		curl_exec($curl);
		curl_close($curl);
		
		//echo $subcatid;
		//echo "<br>";
	}

	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=mydash.php">'; 
}

?>
</div>
</div>
</div>
</div></div>
<form method="POST" action="logout.php">
<input type="submit" value="Logout" name="Logout">
</form>
<br>			
<form method="POST" action="mydash.php">
<input type="submit" name="Back" value="Return to Homepage" >
</form>
</body>
</html>