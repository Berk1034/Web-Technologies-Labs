<h1>Common task:</h1>
<p>On the screen display the menu links with the names (for example, "About the Company", "Services", "Price", "Contacts"). When you click on a link, the background color around the active link changes and remains changed. All code on one page. Do not use javascript. Use GET requests.</p>
<ul>
  <li><a class=Refresh href="./SumOfNum.php?p=refresh">RefreshALL</a></li>
  <li><a class=News href="./SumOfNum.php?p=newsclicked">News</a></li>
  <li><a class=Gallery href="./SumOfNum.php?p=galleryclicked">Gallery</a></li>
  <li><a class=Chat href="./SumOfNum.php?p=chatclicked">Chat</a></li>
  <li><a class=Contacts href="./SumOfNum.php?p=contactsclicked">Contacts</a></li>
</ul>

<?php
if ((isset($_GET['p']) == TRUE)){#Is any link clicked?
  if ($_GET['p'] == 'refresh'){
    echo '<style type="text/css">
     a {
      background-color: none;
     }
    </style>';
  } elseif ($_GET['p'] == 'newsclicked') {
    echo '<style type="text/css">
     a.News {
      background-color: #55efc4;
      color: red;
     }
    </style>';
  } elseif ($_GET['p'] == 'galleryclicked') {
    echo '<style type="text/css">
     a.Gallery {
      background-color: #00b894;
      color: red;
     }
    </style>';
  } elseif ($_GET['p'] == 'chatclicked') {
    echo '<style type="text/css">
     a.Chat {
      background-color: #ffeaa7;
      color: red;
     }
    </style>';
  } elseif ($_GET['p'] == 'contactsclicked') {
    echo '<style type="text/css">
     a.Contacts {
      background-color: #fdcb6e;
      color: red;
     }
    </style>';
  }
}
?>
<hr>
<h2>Variant 9:</h2>
<p>Write a script that counts the sum of digits of the number entered by the user. Also make a check on the correctness of the data entered by the user. The number to receive through the web form.</p>

<form class="counter" action="SumOfNum.php" method="post">
  <p>Enter the number: <input type="text" name="number"></p>
  <p><input type="submit" value="Сount"></p>
</form>
<p>Sum of digits:
<?php
if (!empty($_POST['number'])){#Input Validation
  if(is_numeric($_POST['number'])){
    $num_array = str_split($_POST['number']);
    $sum = 0;
    for ($i = 0; $i<count($num_array); $i++) {
      if(($num_array[$i]=='-') or ($num_array[$i]=='.')){#Bypassing WARNING
        $i++;
      }
      $sum += $num_array[$i];
    }
    echo $sum;#Derive the sum of numbers
  }else{
      echo 'Not a number!';
  }
}else{
  echo 'Enter the number!';
}
?>
</p>
