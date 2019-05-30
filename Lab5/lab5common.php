<?php
  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASSWORD', 'PASSWORD');
  define('DB_NAME', 'lab5_common');

  $mysqli = @new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);#Establishes a new connection to the MySQL server
  if ($mysqli->connect_errno)#Check for successful connection
  {
    echo "<b>Failed to connect to MySQL: " , mysqli_connect_error() , "</b>";
    exit();
  }else{
    echo "Successfully connected!</br>";
    if (!$mysqli->set_charset("utf8")) {#Trying to change charset to utf8
      printf("Error loading utf8 character set: %s</br>", $mysqli->error);
      exit();
    }else {
      printf("Current character set: %s</br>", $mysqli->character_set_name());

      $col1 = 'SHOW COLUMNS FROM `author registrations`';#SQL-request for getting the table cap of `author registrations`
      $res1 = $mysqli->query($col1);#Sends MySQL-query
      while($row1 = $res1->fetch_assoc()){#Retrieves the result series as an associative array.
        $columns1[]=$row1['Field'];
      }
      $res1->close();#Clear the result set

      $col2 = 'SHOW COLUMNS FROM `authors articles`';#SQL-request for getting the table cap of `authors articles`
      $res2 = $mysqli->query($col2);#Sends MySQL-query
      while($row2 = $res2->fetch_assoc()){#Retrieves the result series as an associative array.
        $columns2[]=$row2['Field'];
      }
      $res2->close();#Clear the result set

      $order = 'SELECT * FROM `author registrations`';#SQL-request for getting the table rows of `author registrations`
      $result = $mysqli->query($order);#Sends MySQL-query
      echo "</br>";
      echo "<b>Table 'author registrations': </b>";
      echo "<table border='1' width=100%><tr>";#Start a table `author registrations`
      for($i = 0; $i < sizeof($columns1); $i++){
        echo "<td><b>".strtoupper($columns1[$i])."</b></td>";
      }
      while ($row = $result->fetch_array(1)) {#Retrieves the result series as an associative array and go on next
        echo "<tr><td>" . $row['id'] . "</td><td>" . $row['name'] . "</td><td>" . $row['password'] . "</td><td>" . $row['ip_registration'] . "</td><td>" . $row['date_registration'] . "</td></tr>";#$row['index'] the index here is a field name
      }
      echo "</tr></table>";
      $result->close();#Clear the result set

      echo "</br>";
      $order = 'SELECT * FROM `authors articles`';#SQL-request for getting the table rows of `authors articles`
      $result = $mysqli->query($order);#Sends MySQL-query
      echo "<b>Table 'authors articles': </b>";
      echo "<table border='1' width=100%><tr>";#Start a table `authors articles`
      for($i = 0; $i < sizeof($columns2); $i++){
        echo "<td><b>".strtoupper($columns2[$i])."</b></td>";
      }
      while ($row = $result->fetch_array(1)) {#Retrieves the result series as an associative array and go on next
        echo "<tr><td>" . $row['id'] . "</td><td>" . $row['author_id'] . "</td><td>" . $row['title'] . "</td><td>" . $row['text'] . "</td><td>" . $row['image'] . "</td></tr>";#$row['index'] the index here is a field name
      }
      echo "</tr></table>";
      $result->close();#Clear the result set

      echo "</br>";
      $order = 'SELECT * FROM `author registrations` ORDER BY name DESC';#SQL-request for getting the table rows of `author registrations` ordered by descending
      $result = $mysqli->query($order);#Sends MySQL-query
      echo "<b>Table 'author registrations' sorted by name DESC: </b>";
      echo "<table border='1' width=100%><tr>";#Start a table `author registrations`
      for($i = 0; $i < sizeof($columns1); $i++){
        echo "<td><b>".strtoupper($columns1[$i])."</b></td>";
      }
      while ($row = $result->fetch_array(1)) {#Retrieves the result series as an associative array and go on next
        echo "<tr><td>" . $row['id'] . "</td><td>" . $row['name'] . "</td><td>" . $row['password'] . "</td><td>" . $row['ip_registration'] . "</td><td>" . $row['date_registration'] . "</td></tr>"; #$row['index'] the index here is a field name
      }
      echo "</tr></table>";
      $result->close();#Clear the result set

      echo "</br>";
      $order = 'SELECT `authors articles`.title,`author registrations`.name FROM `authors articles` INNER JOIN `author registrations` ON `author registrations`.id = `authors articles`.author_id';#SQL-request for getting the combined tables
      $result = $mysqli->query($order);#Sends MySQL-query
      echo "<b>Tables 'author registrations' and 'authors articles' combined: </b>";
      echo "<table border='1' width=100%><tr>";#Start combined tables
      echo "<td><b>NAME</b></td><td><b>TITLE</b></td>";
      while ($row = $result->fetch_array(1)) {#Retrieves the result series as an associative array and go on next
        echo "<tr><td>" . $row['name'] . "</td><td>" . $row['title'] . "</td></tr>";#$row['index'] the index here is a field name
      }
      echo "</tr></table>";
      $result->close();#Clear the result set
    }
  }
  $mysqli->close();#Close the connection
?>
