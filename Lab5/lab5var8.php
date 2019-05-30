<?php
  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASSWORD', 'PASSWORD');
  define('DB_NAME', 'lab5');
//Main Task Function:
  function GetStudentsMarks($rows, $columnsAmount){
      foreach ($rows as $student) {
        $averageMark = ($student['WT'] + $student['CSaN'] + $student['OOP'] + $student['OSaSP'] + $student['English'])/($columnsAmount - 1);
        $marks = array(
          'WT' => $student['WT'],
          'CSaN' => $student['CSaN'],
          'OOP' => $student['OOP'],
          'OSaSP' => $student['OSaSP'],
          'English' => $student['English'],
  	     );
  //Find min and max marks
  	    $minMark = 11;
  	    $maxMark = 0;
        foreach ($marks as $mark) {
  	      if ($mark >= $maxMark)
  		      $maxMark = $mark;
  	      if ($mark <= $minMark)
  		      $minMark = $mark;
        }
  //Find Subjects with the max mark and min mark
        $maxMarkList='';
        $minMarkList='';
        foreach ($marks as $key => $value) {
  	      if($value == $maxMark)
            $maxMarkList .= $key . ' ';
  	      if($value == $minMark)
  		      $minMarkList .= $key . ' ';
        }
  //Show info about Student and his marks with the listofmarks
        echo '<h2>', $student["Surname"], '</h2>';
        echo 'Average mark: ', number_format($averageMark, 2, '.', ''), '<br>';
        echo '<a>Max mark: ', $maxMark, ' in subject: ' , $maxMarkList, ' ';
        echo '</a><br>';
        echo '<a>Min mark: ', $minMark, ' in subject: ' , $minMarkList, ' ';
        echo '</a><br>';
        echo '<hr>';
      }
    }

  $mysqli = @new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);#Establishes a new connection to the MySQL server
  if ($mysqli->connect_errno)#Check for successful connection
  {
    echo "<b>Failed to connect to MySQL: " , mysqli_connect_error() , "</b>";
    exit();
  }else{
    $order = 'SELECT * FROM `students`';#SQL-request for getting the table rows of `students`
    $result = $mysqli->query($order);#Sends MySQL-query
    $columnsAmount = $mysqli->field_count;#Returns the number of columns affected by the last query.
    while ($row = $result->fetch_array(1)) {#Retrieves the result series as an associative array and go on next
      $rows[] = $row;
    }
    $result->close();
    GetStudentsMarks($rows, $columnsAmount);
  }
  $mysqli->close();
?>
