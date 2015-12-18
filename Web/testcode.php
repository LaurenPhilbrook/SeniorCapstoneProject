<?php
$url2 = "http://www.recycling-app-13.appspot.com/subcategory";
				$info2 = file_get_contents($url2);
				$info2 = json_decode($info2, true);
				$length2 = count($info2);
				//var_dump($info);
				
//loop through, placed checked where they are already a part of the category
				for($i = 0; $i < $length2; $i++) {
?>
				<input type="checkbox" name="subcat[]" id="subcat" value="<?php
					printf("%s", $info2[$i]["id"]);?>"> <?php
					printf("%s", $info2[$i]["name"]);
					?> <br> <?php
				}	
?> 