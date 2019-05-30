<?php
	if (!isset($_COOKIE["date"]))
	{
		$arr = array();
		$arr[] = time();
		$str = implode(" | ", $arr);
		setcookie("date", $str, time() + 3600);
	}
	else
	{
		$str = $_COOKIE["date"];
		$arr = explode(" | ", $str);
		$arr[count($arr)] =  (String)time();
		setcookie("date", implode(" | ", $arr), time() + 3600);
	}
	for ($i = 0; $i < count($arr); $i++)
	{
		echo "<b>Visited on " . date('r', $arr[$i]) . "</b></br>";
	}
	echo "<hr>";
	echo "<b>Totally visited for " . count($arr) . " times</b>";
?>
