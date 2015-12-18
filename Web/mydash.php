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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
					$("#bus").hide();
					$("#cat").hide();
					$("#sub").hide();
			$("#buttons input").change(function() {
				if($("input[name=rad]:checked").val() == "busrad") {
					$("#bus").show();
					$("#cat").hide();
					$("#sub").hide();
				} 
				else if($("input[name=rad]:checked").val() == "catrad") {
					$("#bus").hide();
					$("#cat").show();
					$("#sub").hide();
				} 
				else if($("input[name=rad]:checked").val() == "subrad") {
					$("#bus").hide();
					$("#cat").hide();
					$("#sub").show();
				} else {
					$("#bus").hide();
					$("#cat").hide();
					$("#sub").hide();
				}
			
		});
	});
	</script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin 2 - Bootstrap Admin Theme</title>
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
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!--<a class="navbar-brand" href="index.html">-->SB Admin v2.0<!--</a>-->
            </div>
            <!-- /.navbar-header -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tables</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
						<div class="panel-heading">
							Add New Information
						</div>
<!--new business/cat/sub-->
<form method="POST" action="newbus.php">
<input type="submit" name="submitnewbus" value="Add Business">
</form>
<br>
<form method="POST" action="newcat.php">
<input type="submit" name="submitnewcat" value="Add Category">
</form>
<br>
<form method="POST" action="newsubcat.php">
<input type="submit" name="submitnewsubcat" value="Add Subcategory">
</form>
<br>
                        <div class="panel-heading">
                            DataTables Advanced Tables
                        </div>
<!-- buttons -->
<form method="POST" action="#" id="buttons">
<input type="radio" name="rad" value="busrad">
Choose a Business
<select name="bus" id="bus">
	<option value="any">Any</option>
	<!--call API to fill in business names-->
	<?php
		$url = "http://www.recycling-app-13.appspot.com/business";
		$info = file_get_contents($url);
		$info = json_decode($info, true);
		$length = count($info);
		//var_dump($info);
		for($i = 0; $i < $length; $i++) {
			?>
			<option value="<?php printf("%s", $info[$i]["id"]);?>">
			<?php printf("%s", $info[$i]["name"]);?> 
			</option>
<?php } ?>
</select> <br>
<input type="radio" name="rad" value="catrad">
Choose a Category
<select name="cat" id="cat">
	<option value="any">Show All Categories</option>
	<!--call API to fill in category names-->
<?php
		$url = "http://www.recycling-app-13.appspot.com/category";
		$info = file_get_contents($url);
		$info = json_decode($info, true);
		$length = count($info);
		//var_dump($info);
		for($i = 0; $i < $length; $i++) {
			?>
			<option value="<?php printf("%s", $info[$i]["id"]);?>">
			<?php printf("%s", $info[$i]["name"]);?> 
			</option>
<?php } ?>	
</select></br>
<input type="radio" name="rad" value="subrad">
Choose a Subcategory
<select name="sub" id="sub">
	<option value="any">Show All Subcategories</option>
	<!--call API to fill in subcategory names-->
<?php
		$url = "http://www.recycling-app-13.appspot.com/subcategory";
		$info = file_get_contents($url);
		$info = json_decode($info, true);
		$length = count($info);
		//var_dump($info);
		for($i = 0; $i < $length; $i++) {
			?>
			<option value="<?php printf("%s", $info[$i]["id"]);?>">
			<?php printf("%s", $info[$i]["name"]);?> 
			</option>
<?php } ?>	
</select>
</br>
<input type="submit" value="submit" name="submit">
</form>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
<!--API calls-->
<?php
if(isset($_POST['del'])) {
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
	curl_setopt($curl, CURLOPT_URL, "http://www.recycling-app-13.appspot.com/business/80");
	curl_exec($curl);
	curl_close($curl);
}
if(isset($_POST['test'])) {
	$data = array(
		"name" =>  date(DATE_RSS),
		"phoneNumber" => "1",
		"streetAddress" => "1",
		"city" => "Corvallis",
		"state" => "OR",
		"zipCode" => "99999",
		"hours" => "1",
		"webpage" => "http://www.google.com"
	);
	$data_string = json_encode($data);
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, "http://www.recycling-app-13.appspot.com/business");
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Content-Length: ' . strlen($data_string)
		)
	);
	$result = curl_exec($curl);
	curl_close($curl);
	print $result;
}
if(isset($_POST['submit'])) {
	//echo "<p>hit</p>";
	//switch on radio 
	switch($_POST['rad']){
		//if bus selected
		case("busrad"):
			echo "<thead>";
                echo "<tr>";
					echo "<th>Update</th>";
                    echo "<th>Hours</th>";
                    echo "<th>City</th>";
                    echo "<th>Address</th>";
                    echo "<th>Phone Number</th>";
                    echo "<th>Name</th>";
					echo "<th>State</th>";
					echo "<th>Website</th>";
					echo "<th>ID</th>";
					echo "<th>Zipcode</th>";
                echo "</tr>";
            echo "</thead>";
			echo "<tbody>";
			//if any selected
			if ($_POST['bus'] == "any"){
				//call /business
				$url = "http://www.recycling-app-13.appspot.com/business";
				$info = file_get_contents($url);
				$info = json_decode($info, true);
				$length = count($info);
				//var_dump($info);
				for($i = 0; $i < $length; $i++) {
					echo "<tr>";
					echo "<td>";
					?>
					<form method = "POST" action="update.php">
						<input type="submit" name="action" value="Edit"/>
						<input type="hidden" name="pk_bus_update" value="<?php echo $info[$i]['id']?>">
					</form>
					<form method = "POST" action="delete.php">
						<input type="submit" name="action" value="Remove"/>
						<input type="hidden" name="pk_bus_delete" value="<?php echo $info[$i]['id']?>">
					</form>
					<?php
					echo "</td>";
					echo "<td>";
					printf("%s", $info[$i]["hours"]);
					echo "</td>";
					echo "<td>";
					printf("%s", $info[$i]["city"]);
					echo "</td>";
					echo "<td>";
					printf("%s", $info[$i]["streetAddress"]);
					echo "</td>";
					echo "<td>";
					printf("%s", $info[$i]["Phone Number"]);
					echo "</td>";
					echo "<td>";
					printf("%s", $info[$i]["name"]);
					echo "</td>";
					echo "<td>";
					printf("%s", $info[$i]["state"]);
					echo "</td>";
					echo "<td>";
					printf("%s", $info[$i]["webpage"]);
					echo "</td>";
					echo "<td>";
					printf("%s", $info[$i]["id"]);
					echo "</td>";
					echo "<td>";
					printf("%s", $info[$i]["zipCode"]);
					echo "</td>";
					echo "</tr>";
				}	
				echo "</tbody>";
				break;
			}else{
			//else 
				//call /business/id
				$id = $_POST['bus'];
				$url = "http://www.recycling-app-13.appspot.com/business/" . $id;
				//var_dump($url);
				$info = file_get_contents($url);
				$info = json_decode($info, true);
								echo "<tr>";
					echo "<td>";
					?>
					<form method = "POST" action="update.php">
						<input type="submit" name="action" value="Edit"/>
						<input type="hidden" name="pk_bus_update" value="<?php echo $info['id']?>">
					</form>
					<form method = "POST" action="delete.php">
						<input type="submit" name="action" value="Remove"/>
						<input type="hidden" name="pk_bus_delete" value="<?php echo $info['id']?>">
					</form>
					<?php
					echo "</td>";
					echo "<td>";
					printf("%s", $info["hours"]);
					echo "</td>";
					echo "<td>";
					printf("%s", $info["city"]);
					echo "</td>";
					echo "<td>";
					printf("%s", $info["streetAddress"]);
					echo "</td>";
					echo "<td>";
					printf("%s", $info["Phone Number"]);
					echo "</td>";
					echo "<td>";
					printf("%s", $info["name"]);
					echo "</td>";
					echo "<td>";
					printf("%s", $info["state"]);
					echo "</td>";
					echo "<td>";
					printf("%s", $info["webpage"]);
					echo "</td>";
					echo "<td>";
					printf("%s", $info["id"]);
					echo "</td>";
					echo "<td>";
					printf("%s", $info["zipCode"]);
					echo "</td>";
					echo "</tr>";
				
				echo "</tbody>";
				break;
			}
		//if cat selectd
		case("catrad"):
			echo "<thead>";
                echo "<tr>";
					echo "<th>Update</th>";
                    echo "<th>ID</th>";
                    echo "<th>Name</th>";
                echo "</tr>";
            echo "</thead>";
			echo "<tbody>";
			//if any selected
			if($_POST['cat'] == "any"){
				//call /category
				$url = "http://www.recycling-app-13.appspot.com/category";
				$info = file_get_contents($url);
				$info = json_decode($info, true);
				$length = count($info);
				//var_dump($info);
				for($i = 0; $i < $length; $i++) {
					echo "<tr>";
					echo "<td>";
					?>
					<form method = "POST" action="updatecat.php">
						<input type="submit" name="action" value="Edit"/>
						<input type="hidden" name="pk_cat_update" value="<?php echo $info[$i]['id']?>">
					</form>
					<form method = "POST" action="deletecat.php">
						<input type="submit" name="action" value="Remove"/>
						<input type="hidden" name="pk_cat_delete" value="<?php echo $info[$i]['id']?>">
					</form>
					<?php
					echo "</td>";
					echo "<td>";
					printf("%s", $info[$i]["id"]);
					echo "</td>";
					echo "<td>";
					printf("%s", $info[$i]["name"]);
					echo "</td>";
					echo "</tr>";
				}	
				echo "</tbody>";
				break;
			}else{
			//else
				//call /category/id
				$id = $_POST['cat'];
				$url = "http://www.recycling-app-13.appspot.com/category/" . $id;
				//var_dump($url);
				$info = file_get_contents($url);
				$info = json_decode($info, true);
				//TEST
				$catName = $info["name"];
				echo $catName . " Subcategories";
				$length = count($info["subcategories"]);
				//var_dump($info);
				for($i = 0; $i < $length; $i++) {
					echo "<tr>";
					echo "<td>";
					?>
					<form method = "POST" action="updatesubcat.php">
						<input type="submit" name="action" value="Edit"/>
						<input type="hidden" name="pk_subcat_update" value="<?php echo $info["subcategories"][$i]['id'];?>">
					</form>
					<form method = "POST" action="deletesubcatfromcat.php">
						
						<input type="hidden" name="catid" value="<?php echo $id;?>">
						<input type="hidden" name="pk_subcat_delete" value="<?php echo $info["subcategories"][$i]['id'];?>">
						<input type="submit" name="action" value="Remove from Category"/>
					</form>
					<?php
					echo "</td>";
					echo "<td>";
					printf("%s", $info["subcategories"][$i]["id"]);
					echo "</td>";
					echo "<td>";
					printf("%s", $info["subcategories"][$i]["name"]);
					echo "</td>";
					echo "</tr>";
				}	
				echo "</tbody>";
				break;
			}
		//if sub selected 
		case("subrad");
			//if any selected
			if($_POST['sub'] == "any"){
			echo "<thead>";
               echo "<tr>";
					echo "<th>Update</th>";
                    echo "<th>ID</th>";
                    echo "<th>Name</th>";
                echo "</tr>";
            echo "</thead>";
			echo "<tbody>";
				//call /subcategory
				$url = "http://www.recycling-app-13.appspot.com/subcategory";
				$info = file_get_contents($url);
				$info = json_decode($info, true);
				$length = count($info);
				//var_dump($info);
				for($i = 0; $i < $length; $i++) {
					echo "<tr>";
					echo "<td>";
					?>
					<form method = "POST" action="updatesubcat.php">
						<input type="hidden" name="pk_subcat_update" value="<?php echo $info[$i]['id']?>">
						<input type="submit" name="action" value="Edit"/>
						
					</form>
					<form method = "POST" action="deletesubcat.php">
						<input type="hidden" name="pk_subcat_delete" value="<?php echo $info[$i]['id']?>">
						<input type="submit" name="action" value="Remove"/>
						
					</form>
					<?php
					echo "</td>";
					echo "<td>";
					printf("%s", $info[$i]["id"]);
					echo "</td>";
					echo "<td>";
					printf("%s", $info[$i]["name"]);
					echo "</td>";
					echo "</tr>";
				}	
				echo "</tbody>";
				break;
			}else{
			//else
				echo "<thead>";
                echo "<tr>";
					echo "<th>Update</th>";
                    echo "<th>Hours</th>";
                    echo "<th>City</th>";
                    echo "<th>Address</th>";
                    echo "<th>Phone Number</th>";
                    echo "<th>Name</th>";
					echo "<th>State</th>";
					echo "<th>Website</th>";
					echo "<th>ID</th>";
					echo "<th>Zipcode</th>";
                echo "</tr>";
            echo "</thead>";
			echo "<tbody>";
			//call /subcategory/id
				$id = $_POST['sub'];
				$url = "http://www.recycling-app-13.appspot.com/subcategory/" . $id;
				//var_dump($url);
				$info = file_get_contents($url);
				$info = json_decode($info, true);
				$length = count($info["businesses"]);
				//var_dump($info);
				$subcatName = $info["name"];
				echo "Business under subcategory " . $subcatName;
				for($i = 0; $i < $length; $i++) {
					echo "<tr>";
					echo "<td>";
					?>
					<form method = "POST" action="update.php">
						<input type="submit" name="action" value="Edit"/>
						<input type="hidden" name="pk_bus_update" value="<?php echo $info["businesses"][$i]['id']?>">
					</form>
					<form method = "POST" action="deletebusfromsubcat.php">
						<input type="submit" name="action" value="Remove from Subcategory"/>
						<input type="hidden" name="subid" value="<?php echo $id;?>">
						<input type="hidden" name="pk_bus_delete" value="<?php echo $info["businesses"][$i]['id']?>">
					</form>
					<?php
					echo "</td>";
					echo "<td>";
					printf("%s", $info["businesses"][$i]["hours"]);
					echo "</td>";
					echo "<td>";
					printf("%s", $info["businesses"][$i]["city"]);
					echo "</td>";
					echo "<td>";
					printf("%s", $info["businesses"][$i]["streetAddress"]);
					echo "</td>";
					echo "<td>";
					printf("%s", $info["businesses"][$i]["Phone Number"]);
					echo "</td>";
					echo "<td>";
					printf("%s", $info["businesses"][$i]["name"]);
					echo "</td>";
					echo "<td>";
					printf("%s", $info["businesses"][$i]["state"]);
					echo "</td>";
					echo "<td>";
					printf("%s", $info["businesses"][$i]["webpage"]);
					echo "</td>";
					echo "<td>";
					printf("%s", $info["businesses"][$i]["id"]);
					echo "</td>";
					echo "<td>";
					printf("%s", $info["businesses"][$i]["zipCode"]);
					echo "</td>";
					echo "</tr>";
				}	
				echo "</tbody>";				
				break;
			}
		default: die;
	}
}
?>
<!--END API CALLS-->   
                            </table>
                            </div>
							</div>
</div>
</div>
<!-- Logout button -->
<form method="POST" action="logout.php">
<input type="submit" value="Logout" name="Logout">
</form>
							</body>
							</html>
