<?php header('Access-Control-Allow-Origin:*'); ?>
<!DOCTYPE html>
<html>
<head>
<?php
	$id = $_POST['pk_cat_delete'];
	//echo $id;
	
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
	/*var x = 'http://www.recycling-app-13.appspot.com/business/' + '<?php echo $id?>';
	console.log(x);
	$.ajax ({
		url: 'http://www.recycling-app-13.appspot.com/business/' + '<?php echo $id?>',
		type: 'DELETE',
		dataType: 'json',
		success: function(response) {
			window.location.href="http://ec2-52-1-168-208.compute-1.amazonaws.com/SP/pages/mydash.php";
		}
	}); */


</script>
</head>
<body>
	Deleting Category...  


<?php 
	//   /category/{id}
	//DELETE CAT BY ID (ABOVE) FROM DATABASE 
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
	curl_setopt($curl, CURLOPT_URL, "http://www.recycling-app-13.appspot.com/category/" . $id);
	curl_exec($curl);
	curl_close($curl);
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=mydash.php">'; 
?>

</body>
</html>