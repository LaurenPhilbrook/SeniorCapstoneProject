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
	<title>Remove Businesses from Subcategory</title>
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
                    <h1 class="page-header">Remove Businesses from Subcategory</h1>
                </div>
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
			<div class="panel-heading">
<?php 
$subName = $_POST["subName"]; 
 echo "Businesses within " . $subName;

?>
			</div>
			
<!-- ADD NEW BUSINESS FORM -->
<form method="POST" action="#">
	<br>
<?php
$subid = $_POST["subid"];
$url = "http://www.recycling-app-13.appspot.com/subcategory/" . $subid;
				$info = file_get_contents($url);
				$info = json_decode($info, true);
				$length = count($info["businesses"]);
				//var_dump($info);
				for($i = 0; $i < $length; $i++) {
					echo "<input type='checkbox' name='bus[]' id='bus' value='" . $info["businesses"][$i]["id"] . "' checked='true'> " . $info["businesses"][$i]["name"];
					
					echo "<br>";
				}
				?>
	<br>		
	<input type="submit" name="submit" value="Remove"> 
</form> <br>

<?php 

if(isset($_POST["submit"])) {
	$bus = $_POST["bus"];
	foreach ($bus as $busid) {
		//REMOVE BUS FROM SUBCAT WITHIN DATABASE
		
		
		// /subcategory/subid/business/id
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_setopt($curl, CURLOPT_URL, "http://www.recycling-app-13.appspot.com/subcategory/" . $subid . "/business/" . $busid);
		curl_exec($curl);
		curl_close($curl);
		
		//echo $busid;
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