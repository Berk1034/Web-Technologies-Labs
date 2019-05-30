<meta charset="UTF-8" />
<form action='lab4.php' method='post'>
		<p>Enter the filename: <input type='text' name='filename'></p>
  	<p><input type="submit" value="Enter"></p>
</form>
<?php
	if(isset($_POST['filename']) && file_exists($_POST['filename'])){#Check for filename

		$filestr = file_get_contents($_POST['filename']);#Copying all file
		echo "<i>Used Formats: DD.MM.YYYY | d.m.yy and MM/DD/YYYY | m/d/yy</i><br><br>";
		echo "<b>Original text:</b><br>";
		echo $filestr;
		echo "<br><br>";
		echo "<b>Result text:</b><br>";

		function inc_year($date){#Callback-function for incrementing the year
				if($date[5] < "09"){
					return $date[2].'0'.($date[5] + 1);
				}
				if($date[5] != "99")
		  		return $date[2].($date[5] + 1);
				else{
					$date[5] = "00";
					return $date[2].$date[5];
				}
		}

		//RegExp for DD.MM.YYYY or d.m.yy
		$filestr = preg_replace_callback('/(((([1-9]|0[1-9])|[12][0-9]|3[01])[.](([1-9]|0[1-9])|1[012])[.](19|20)?\d\d))/',
		function ($matches){#Callback-function for highlighting the date in red
			$matches[0] = preg_replace_callback('/(((\d{2}|\d).(\d{2}|\d).)((19|20)\d{2}|((0|9)\d)))/',
			"inc_year",
			$matches[0]);
			return '<font color = red>'.$matches[0].'</font>';
		},
		$filestr);

	  //RegExp for MM/DD/YYYY or m/d/yy
		echo preg_replace_callback('/((([1-9]|0[1-9])|1[012])[\/](([1-9]|0[1-9])|[12][0-9]|3[01])[\/]((19|20)?\d\d))/',
		function ($matches){#Callback-function for highlighting the date in red
			$matches[0] = preg_replace_callback('/(((\d{2}|\d)\/(\d{2}|\d)\/)(\d{4}|\d{2}))/',
			"inc_year",
			$matches[0]);
			return '<font color = red>'.$matches[0].'</font>';
		},
		$filestr);
	}else{
		echo "Enter the correct filename!";
	}
?>
