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
	<title>Add a new Subcategory</title>
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
                    <h1 class="page-header">Add New Subcategory</h1>
                </div>
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
			<div class="panel-heading">
				Subcategory Information
			</div>
			
<!-- ADD NEW BUSINESS FORM -->
<form method="GET" action="#">
	<br>
	Subcategory Name: <input type="text" name="subcatName"> <br><br>
	Businesses: <br>
		<!--make a checkbox list -->
<?php
$url = "http://www.recycling-app-13.appspot.com/business";
				$info = file_get_contents($url);
				$info = json_decode($info, true);
				$length = count($info);
				//var_dump($info);
				for($i = 0; $i < $length; $i++) {
?>
				<input type="checkbox" name="bus[]" id="bus" value="<?php
					printf("%s", $info[$i]["id"]);?>"> <?php
					printf("%s", $info[$i]["name"]);
					?> <br> <?php
				}	
?>
	
	<br>
	<input type="submit" name="submit" value="Submit"> 
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


	
	$subcatName = $_GET['subcatName'];
	$subArr = array(
		"name" => $subcatName
	);
	echo "Name is " . $subcatName;
	$var = json_encode($subArr);
	
	//ADD SUBCAT TO DATABASE 
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, "http://www.recycling-app-13.appspot.com/subcategory");
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
	
	
	//GET SUBCAT ID FROM DATABASE GIVEN NAME 
	$obj = json_decode($result);
	var_dump($obj);
	echo "<br>";
	$subid = $obj->id;
	
	//ADD each business to the new subcategory
	$bus = $_GET["bus"];
	foreach ($bus as $id) {
		//add each bus to subcat
		$curl2 = curl_init();
		curl_setopt($curl2, CURLOPT_PUT, true);
		curl_setopt($curl2, CURLOPT_URL, "http://www.recycling-app-13.appspot.com/subcategory/" . $subid . "/business/" . $id);
		curl_exec($curl2);
		curl_close($curl2);
		//echo $id;
	}
	
	
	
	
	
	//json_encode($var, JSON_FORCE_OBJECT)
	/*$arr = array(
		"name" => $busName,

	);*/
	
	//$vars2 = json_encode($arr, JSON_FORCE_OBJECT);
	//var_dump($vars2);
	
	//REDIRECT TO HOMEPAGE
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=mydash.php">'; 
}

?>


</body>
</html>
