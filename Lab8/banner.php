<?php

  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASSWORD', 'PASSWORD');
  define('DB_NAME', 'lab8');

  $mysqli = @new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);#Establishes a new connection to the MySQL server
  if ($mysqli->connect_errno)#Check for successful connection
  {
    echo "<b>Failed to connect to MySQL: " , mysqli_connect_error() , "</b>";
    exit();
  }else{
    $order = 'SELECT * FROM `statistics`';#SQL-request for getting the table rows of `students`
    $result = $mysqli->query($order);#Sends MySQL-query
    $columnsAmount = $mysqli->field_count;#Returns the number of columns affected by the last query.
    while ($row = $result->fetch_array(1)) {#Retrieves the result series as an associative array and go on next
      $rows[] = $row;
    }
    $result->close();
    //Randomising the banner
    srand((double)microtime() * 1000000);
    $pos = rand(0, count($rows) - 1);

    echo '<!DOCTYPE html>
          <html lang="en">
          <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>ImageCounter</title>
          </head>
          <body>
            <h1>Hello, i will count it;)</h1>
            <img src="' . $rows[$pos]['IMG'] . '" id="' . $rows[$pos]['ID'] . '">
            <h2>
              Total views: ';
    echo $rows[$pos]['VIEWS'] . "</h2>";#Total views for randomised banner
    $update = $mysqli->query("UPDATE `statistics` SET VIEWS = VIEWS + 1 WHERE ID = '" . $rows[$pos]['ID'] . "'");#Incrementing the views for randomized banner
    echo'</body>
        </html>';
  }
  $mysqli->close();#Close the connection
?>
