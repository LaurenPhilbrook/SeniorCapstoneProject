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
	<title>Add a new Business</title>
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
                    <h1 class="page-header">Add New Business</h1>
                </div>
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
			<div class="panel-heading">
				Business Information
			</div>
			
<!-- ADD NEW BUSINESS FORM -->
<form method="POST" action="#">
	<br>
	Business Name: <input type="text" name="busName"> <br><br>
	City: <input type="text" name="busCity"> <br><br>
	State: <input type="text" name="busState"> <br><br>
	Address: <input type="text" name="busAddress"><br><br>
	Zipcode: <input type="text" name="busZipcode"> <br><br>
	Phone Number: <input type="text" name="busPhoneNumber"><br><br>
	Website: <input type="text" name="busWebsite"><br><br>
	Hours: <input type="text" name="busHours"> <br>
	
	
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

if(isset($_POST["submit"])) {
	//TEST CODE	
	//echo "submit pressed";
	
	$busName = htmlspecialchars($_POST['busName']);
	$busCity = htmlspecialchars($_POST['busCity']);
	$busState = htmlspecialchars($_POST['busState']);
	$busAddress = htmlspecialchars($_POST['busAddress']);
	$busZipcode = htmlspecialchars($_POST['busZipcode']);
	$busPhoneNumber = htmlspecialchars($_POST['busPhoneNumber']);
	$busWebsite = htmlspecialchars($_POST['busWebsite']);
	$busHours = htmlspecialchars($_POST['busHours']);
	
	//json_encode($var, JSON_FORCE_OBJECT)
	$arr = array(
		"name" => $busName,
		"hours" => $busHours,
		"webpage" => $busWebsite,
		"state" => $busState,
		"zipCode" => $busZipcode,
		"streetAddress" => $busAddress,
		"phoneNumber" => $busPhoneNumber,
		"city" => $busCity
	);
	
	$vars2 = json_encode($arr);


	
	//ADD NEW BUS TO DATABASE
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, "http://www.recycling-app-13.appspot.com/business");
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $vars2);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Content-Length: ' . strlen($vars2)
		)
	);
	$result = curl_exec($curl);
	curl_close($curl);

	//$vars = json_encode(array($busName, $busCity, $busState, $busAddress, $busZipcode, $busPhoneNumber, $busWebsite, $busHours), JSON_FORCE_OBJECT);
	
	//TEST CODE
	//echo $busName;
	//var_dump($vars);
	
	//REDIRECT TO HOMEPAGE
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=mydash.php">'; 
}

?>


</body>
</html>
