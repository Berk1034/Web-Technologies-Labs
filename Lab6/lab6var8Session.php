<?php
	session_start();
  $uri = (string)($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
	$addr = (string)($_SERVER['REMOTE_ADDR']);
	if (isset($_SESSION['time']) && isset($_SESSION['count']))
	{
				$_SESSION['count'] += 1;
        $_SESSION['time'][] = array($uri, date('r', time()), $addr);
	}
	else
	{
				$_SESSION['count'] = 1;
        $_SESSION['time'] = array();
        $_SESSION['time'][] = array($uri, date('r', time()), $addr);
	}
	foreach ($_SESSION['time'] as $time)
	{
        echo $time[0] . ' was visited on ' . $time[1] . ' by ' . $time[2] . '<br/>';
	}
	echo "</br><b>Totally visited " . $_SESSION["count"] . " times</b>";
?>
