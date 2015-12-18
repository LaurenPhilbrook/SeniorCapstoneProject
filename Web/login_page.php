<!DOCTYPE html>
<html lang="en">

<head>

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

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST" action="#">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="username" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <input type="submit" name="submit" value="Login" class="btn btn-lg btn-success btn-block"></input>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

<?php
//redirect if already logged in
session_start();
if ($_SESSION['username'] != NULL){
	 echo '<META HTTP-EQUIV="Refresh" Content="0; URL=ec2-52-1-168-208.compute-1.amazonaws.com/SP/pages/mydash.php">'; 

}

//runs when LOGIN submit is pressed
if (isset($_POST['submit'])) {

//makes sure all fields are completed
   if (!$_POST['username'] || !$_POST['password']) {
	echo "<br><br><h1 class='error'  name='error'><strong>Please enter both a username and password.</strong></h1>";
     die();
   }

//pass input to variables
$username = htmlspecialchars($_POST['username']);
$pass = $_POST['password']; 

//connect to db
			$dbhost = 'localhost';
			$dbname = 'olsenchr';
			$dbuser = 'olsenchr-db';
			$dbpass = '6wwVfmkYnAR8MgrY';
			$conn = mysqli_connect($dbhost, $dbuser, $dbpass)
				or die("Error connecting to database server");
			mysqli_select_db($conn, $dbname)
					or die("Error selecting database: $dbname");
//prepared statement for username auth
$query = 'SELECT password_hash, salt FROM mp_authentication WHERE (username = ?)';
$stm = mysqli_prepare($conn, $query) or die (mysqli_error($conn));
mysqli_stmt_bind_param($stm, "s", $username);
mysqli_stmt_execute($stm) or die (mysqli_error($conn));
mysqli_stmt_bind_result($stm,$pw_hash,$salt);
mysqli_stmt_fetch($stm);

$x = str_replace(' ','', ($salt . $_POST['password']));
$localhash = sha1($x);

if ($localhash == $pw_hash)
{
   //redirect
   mysqli_stmt_close($stm);
   $_SESSION['username'] = $username;
   
   //test
   print("Logging in...");

   echo '<META HTTP-EQUIV="Refresh" Content="0;   URL=http://ec2-52-1-168-208.compute-1.amazonaws.com/SP/pages/mydash.php">'; 

}
else
{

 echo "<br><br><h1 class='error' name='error'><strong>Authentication failed. Please try again.</strong></h1>";
}

//disconnect from database
mysqli_close($conn);


} ?>
	
	
</body>

</html>
