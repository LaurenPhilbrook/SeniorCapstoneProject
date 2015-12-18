<?php header('Access-Control-Allow-Origin:*'); ?>
<!DOCTYPE html>
<html>
<head>
<?php
	$catid = $_POST['catid'];
	$subid = $_POST['pk_subcat_delete'];
	var_dump($_POST);
	
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
	Deleting Subcategory from Category...  


<?php 
	//   /category/{catid}/subcategory/{subid}
	//DELETE SUBCAT BY ID (ABOVE) FROM CAT WITHIN DATABASE 
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
	curl_setopt($curl, CURLOPT_URL, "http://www.recycling-app-13.appspot.com/category/" . $catid . "/subcategory/" . $subid);
	curl_exec($curl);
	curl_close($curl);

	//print $catid . " + " . $subid;
	
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=mydash.php">'; 
?>

</body>
</html>