<meta charset="UTF-8" />
<form action='lab3.php' method='post'>
		<p>Enter the year: <input type='text' name='year'></p>
		<p>Enter course number: <input type='text' name='course'></p>
  	<p><input type="submit" value="Enter"></p>
</form>
<p><a href="check.html">Check</a></p>
<?php

$months = array ('September','October','November','December','January','February','March','April','May','June','July','August');
$dayInMonths = array (30,31,30,31,31,28,31,30,31,30,31,31);

ob_start();#Enable buffering

if(isset($_POST['year']) && ((is_int($_POST['year']) || ctype_digit($_POST['year'])) && (int)$_POST['year'] > 0 )){#Input Validation
	if(isset($_POST['course']) && ((is_int($_POST['course']) || ctype_digit($_POST['course'])) && (int)$_POST['course'] > 0 )){#Bypassing WARNING
		echo "<h3>This is the session-year calendar for the ".$_POST['course']." course for ".$_POST['year']."-".($_POST['year'] + 1)."</h3>";
	}else{
		echo '<script language="javascript">';
		echo 'alert("There is a mistake! Please, check entered data.")';
		echo '</script>';
		echo "<h3>This is the session-year calendar for the 1 course for ".$_POST['year']."-".($_POST['year'] + 1)."</h3>";
	}
	$day_of_week = JDDayOfWeek(cal_to_jd(CAL_GREGORIAN, '09', '01', (int)$_POST['year']), 0);#Get day of the week according to the Gregorian Calendar
	if(!(($_POST['year'] + 1) % 4) && (($_POST['year'] + 1) % 100)||!(($_POST['year'] + 1) % 400))#Check if the year is leap
		$dayInMonths[5]++;
	if($day_of_week == 0){#Check what day is the 1st of September
		echo "The First of September ".$_POST['year']." is the ".($day_of_week + 7)." day of the week<br><br>";
	}else{
		echo "The First of September ".$_POST['year']." is the ".($day_of_week)." day of the week<br><br>";
	}
}else{
	if(isset($_POST['course']) && ((is_int($_POST['course']) || ctype_digit($_POST['course'])) && (int)$_POST['course'] > 0 )){#Bypassing WARNING
		echo '<script language="javascript">';
		echo 'alert("There is a mistake! Please, check entered data.")';
		echo '</script>';
		echo "<h3>This is the session-year calendar for the ".$_POST['course']." course for ".date("o")."-".(date("o") + 1)."</h3>";
	}else{
		if((!empty($_POST['year']))||(!empty($_POST['course']))||((!empty($_POST['course']))&&(!empty($_POST['year'])))){#Bypassing WARNING
			echo '<script language="javascript">';
			echo 'alert("There is a mistake! Please, check entered data.")';
			echo '</script>';
		}
		echo "<h3>This is the session-year calendar for the 1 course for ".date("o")."-".(date("o") + 1)."</h3>";
	}
	$day_of_week = JDDayOfWeek(cal_to_jd(CAL_GREGORIAN, '09', '01', date("o")), 0);#Get day of the week according to the Gregorian Calendar
	if(date("L", mktime(0,0,0,9,1,(date("o")+1))) == 1)#Check if the year is leap
		$dayInMonths[5]++;
	if($day_of_week == 0){#Check what day is the 1st of September
		echo "The First of September ".date("o")." is the ".($day_of_week + 7)." day of the week<br><br>";
	}else{
		echo "The First of September ".date("o")." is the ".($day_of_week)." day of the week<br><br>";
	}
}

#Rules of Calendar
echo "<font color = red><b>Red color = holidays</b></font><br>";
echo "<font color = blue><b>Blue color = session</b></font><br>";

if(isset($_POST['course']) && ((is_int($_POST['course']) || ctype_digit($_POST['course'])) && (int)$_POST['course'] > 0 )){#Bypassing WARNING
	$course = (int)$_POST['course'];
}else{
	$course = 1;
}
$currWeek = 1;
$currDay = 1;
$i = 0;

for ($i = 0; $i < 12; $i++){#Printing Calendar
	echo "<hr>";
	echo "<b>$months[$i]</b><br>";#Printing Month
	echo "<hr>";
	echo "<i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mon&nbsp;&nbsp;Tue&nbsp;&nbsp;Wen&nbsp;&nbsp;Thu&nbsp;&nbsp;&nbsp;Fri&nbsp;&nbsp;&nbsp;Sat&nbsp;&nbsp;&nbsp;Sun</i><br>";#Printing Days
	printFirstWeek();
	printOthersWeek($dayInMonths[$i]);
}

file_put_contents('result.html', ob_get_contents());#Get from buffer and write to file

function printFirstWeek(){
	global $currWeek, $day_of_week, $currDay, $i, $months, $course;
	if($day_of_week == 1){#Check for New Week
		$currWeek = ($currWeek % 4) + 1;
	}
	if($day_of_week == 0){#Check for Sunday
		$day_of_week += 7;
	}

	if($day_of_week < 8){
		echo "<i>Week ",$currWeek,":</i>&nbsp;&nbsp;&nbsp;&nbsp;";
		for ($j = 0; $j < $day_of_week-1; $j++){#Make Calendar look good
			echo '&nbsp;';
			echo '&nbsp;';
			echo '&nbsp;';
			echo '&nbsp;';
			echo '&nbsp;';
			echo '&nbsp;';
			echo '&nbsp;';
			echo '&nbsp;';
			echo '&nbsp;';
		}
	}
	$currDay = 1;
	for ($j = $day_of_week; $j < 8; $j++){
		switch($course){#Calendar depends on what course is chosen
			case 1:
			case 2:
							if((($i == 4) && (($currDay > 0) && ($currDay < 26))) || (($i == 9) && (($currDay > 10) && ($currDay < 31))) || (($i == 10) && (($currDay > 0) && ($currDay < 3)))){#session for 1-2 courses
								echo"<font color = blue>";
								echo "<b>$currDay </b>";
								echo "</font>";
							}elseif((($i == 4) && (($currDay > 25) && ($currDay < 32))) || (($i == 5) && (($currDay > 0) && ($currDay < 9))) || (($i == 10) && (($currDay > 2) && ($currDay < 32)))
						|| (($i == 11) && (($currDay > 0) && ($currDay < 32)))){#holidays for 1-2 courses
								echo"<font color = red>";
								echo "<b>$currDay </b>";
								echo "</font>";
							}else{
								echo "<b>$currDay </b>";
							}
							break;
			case 3:
							if((($i == 3) && (($currDay > 21) && ($currDay < 32))) || (($i == 4) && (($currDay > 0) && ($currDay < 12))) || (($i == 8) && (($currDay > 18) && ($currDay < 32)))
						|| (($i == 9) && (($currDay > 0) && ($currDay < 8)))){#session for 3 course
								echo"<font color = blue>";
								echo "<b>$currDay </b>";
								echo "</font>";
							}elseif((($i == 4) && (($currDay > 11) && ($currDay < 26))) || (($i == 10) && (($currDay > 2) && ($currDay < 32))) || (($i == 11) && (($currDay > 0) && ($currDay < 32)))){#holidays for 3 course
								echo"<font color = red>";
								echo "<b>$currDay </b>";
								echo "</font>";
							}else{
								echo "<b>$currDay </b>";
							}
							break;
			case 4:
							if((($i == 4) && (($currDay > 4) && ($currDay < 32))) || (($i == 5) && ($currDay == 1))){#session for 4 course
								echo"<font color = blue>";
								echo "<b>$currDay </b>";
								echo "</font>";
							}elseif((($i == 5) && (($currDay > 0) && ($currDay < 30))) || (($i == 6) && (($currDay > 0) && ($currDay < 23)))){#holidays for 4 course
								echo"<font color = red>";
								echo "<b>$currDay </b>";
								echo "</font>";
   						}else{
								echo "<b>$currDay </b>";
							}
							break;
			case 5:
							if((($i == 3) && (($currDay > 21) && ($currDay < 32))) || (($i == 4) && (($currDay > 0) && ($currDay < 12))) || (($i == 6) && (($currDay > 15) && ($currDay < 23)))){#session for 5 course
								echo"<font color = blue>";
								echo "<b>$currDay </b>";
								echo "</font>";
							}elseif((($i == 4) && (($currDay > 11) && ($currDay < 26)))){#holidays for 5 course
								echo"<font color = red>";
								echo "<b>$currDay </b>";
								echo "</font>";
							}else{
								echo "<b>$currDay </b>";
							}
							break;
			default:
							echo "<b>$currDay </b>";
		}

		if($currDay < 10){#Make Calendar look good
			echo '&nbsp;';
			echo '&nbsp;';
			echo '&nbsp;';
			echo '&nbsp;';
			echo '&nbsp;';
			echo '&nbsp;';
		}else{
			echo '&nbsp;';
			echo '&nbsp;';
			echo '&nbsp;';
			echo '&nbsp;';
		}
		$currDay++;
		$day_of_week = ($day_of_week + 1) % 7;
	}
	if($day_of_week < 7){
		echo "<br>";
	}
}

function printOthersWeek(){
	global $currWeek, $day_of_week, $currDay, $dayInMonths, $i, $course;
	while(true){
		$currWeek = ($currWeek % 4) + 1;
		echo "<i>Week ",$currWeek,":</i>&nbsp;&nbsp;&nbsp;&nbsp;";
		for ($j = 0; $j < 7; $j++){
			switch($course){#Calendar depends on what course is chosen
				case 1:
				case 2:
								if((($i == 4) && (($currDay > 0) && ($currDay < 26))) || (($i == 9) && (($currDay > 10) && ($currDay < 31))) || (($i == 10) && (($currDay > 0) && ($currDay < 3)))){#session for 1-2 courses
									echo"<font color = blue>";
									echo "<b>$currDay </b>";
									echo "</font>";
								}elseif((($i == 4) && (($currDay > 25) && ($currDay < 32))) || (($i == 5) && (($currDay > 0) && ($currDay < 9))) || (($i == 10) && (($currDay > 2) && ($currDay < 32)))
							|| (($i == 11) && (($currDay > 0) && ($currDay < 32)))){#holidays for 1-2 courses
									echo"<font color = red>";
									echo "<b>$currDay </b>";
									echo "</font>";
								}else{
									echo "<b>$currDay </b>";
								}
								break;
				case 3:
								if((($i == 3) && (($currDay > 21) && ($currDay < 32))) || (($i == 4) && (($currDay > 0) && ($currDay < 12))) || (($i == 8) && (($currDay > 18) && ($currDay < 32)))
							|| (($i == 9) && (($currDay > 0) && ($currDay < 8)))){#session for 3 course
									echo"<font color = blue>";
									echo "<b>$currDay </b>";
									echo "</font>";
								}elseif((($i == 4) && (($currDay > 11) && ($currDay < 26))) || (($i == 10) && (($currDay > 2) && ($currDay < 32))) || (($i == 11) && (($currDay > 0) && ($currDay < 32)))){#holidays for 3 course
									echo"<font color = red>";
									echo "<b>$currDay </b>";
									echo "</font>";
								}else{
									echo "<b>$currDay </b>";
								}
								break;
				case 4:
								if((($i == 4) && (($currDay > 4) && ($currDay < 32))) || (($i == 5) && ($currDay == 1))){#session for 4 course
									echo"<font color = blue>";
									echo "<b>$currDay </b>";
									echo "</font>";
								}elseif((($i == 5) && (($currDay > 0) && ($currDay < 30))) || (($i == 6) && (($currDay > 0) && ($currDay < 23)))){#holidays for 4 course
									echo"<font color = red>";
									echo "<b>$currDay </b>";
									echo "</font>";
								}else{
									echo "<b>$currDay </b>";
								}
								break;
				case 5:
								if((($i == 3) && (($currDay > 21) && ($currDay < 32))) || (($i == 4) && (($currDay > 0) && ($currDay < 12))) || (($i == 6) && (($currDay > 15) && ($currDay < 23)))){#session for 5 course
									echo"<font color = blue>";
									echo "<b>$currDay </b>";
									echo "</font>";
								}elseif((($i == 4) && (($currDay > 11) && ($currDay < 26)))){#holidays for 5 course
									echo"<font color = red>";
									echo "<b>$currDay </b>";
									echo "</font>";
								}else{
									echo "<b>$currDay </b>";
								}
								break;
				default:
								echo "<b>$currDay </b>";
			}

			if($currDay < 10){#Make Calendar look good
				echo '&nbsp;';
				echo '&nbsp;';
				echo '&nbsp;';
				echo '&nbsp;';
				echo '&nbsp;';
				echo '&nbsp;';
			}else{
				echo '&nbsp;';
				echo '&nbsp;';
				echo '&nbsp;';
				echo '&nbsp;';
			}
			$currDay++;
			$day_of_week = ($day_of_week % 7) + 1;
			if($currDay > $dayInMonths[$i])#No more days in current Month
				break;
		}
		echo "<br>";
		if($currDay > $dayInMonths[$i])#No more days in current Month
			break;
	}
}
?>
