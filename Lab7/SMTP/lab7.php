<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Send an EMAIL</title>
</head>

<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Load Composer's autoloader
require 'vendor/autoload.php';
//Check if there any variables in POST-array
if(!isset($_POST['mailsubject']) and !isset($_POST['mailtext'])){
?>
<body>
  <h2>Write Your Mail</h2>
  <form action="lab7.php" method="POST">
    <p>Mail Subject:</p>
    <input type="text" name="mailsubject" placeholder="Your Subject"><br>
    <p>Mail Text:</p>
    <textarea  name="mailtext" placeholder="Your Text" rows="10" cols="45"></textarea><br><br>
    <input type="submit" value="Send">
  </form>
<?php
  } else {
    $subject = $_POST['mailsubject'];
    $subject = '=?utf-8?B?' . base64_encode($subject) . '?=';
    $body = $_POST['mailtext'];

    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'PASSWORD');
    define('DB_NAME', 'lab7');

    $mysqli = @new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);#Establishes a new connection to the MySQL server
    if ($mysqli->connect_errno)#Check for successful connection
    {
      echo "<b>Failed to connect to MySQL: " , mysqli_connect_error() , "</b>";
      exit();
    }else{
      $order = 'SELECT * FROM `recipients`';#SQL-request for getting the table rows of `students`
      $result = $mysqli->query($order);#Sends MySQL-query
      $columnsAmount = $mysqli->field_count;#Returns the number of columns affected by the last query.

      while ($row = $result->fetch_array(1)) {#Retrieves the result series as an associative array and go on next
        $rows[] = $row;
      }
      $result->close();

      // Instantiation and passing `true` enables exceptions
      $mail = new PHPMailer(true);

      try {
          //Server settings
          $mail->SMTPDebug = 0;// Enable verbose debug output
          $mail->isSMTP();// Set mailer to use SMTP
          $mail->Host       = 'smtp.gmail.com';// Specify main and backup SMTP servers
          $mail->SMTPAuth   = true;// Enable SMTP authentication
          $mail->Username   = 'MYSMTPUSERNAME';// SMTP username
          $mail->Password   = 'MYPASSWORD';// SMTP password
          $mail->SMTPSecure = 'tls';// Enable TLS encryption, `ssl` also accepted
          $mail->Port       = 587;// TCP port to connect to

          //Recipients
          $mail->setFrom('MYSMTPUSERNAME', 'Constantin\'s ROBOT-Mailer');
          foreach ($rows as $users) {
            $mail->addAddress($users['UserMail']);
          }

          //Content
          $mail->isHTML(true);//Set email format to HTML
          $mail->CharSet = 'UTF-8';
          $mail->Encoding = 'base64';
          $mail->Subject = $subject;#'Here is the subject';
          $mail->Body    = $body;#'This is the HTML message body <b>in bold!</b>';
          $mail->AltBody = $body;#'This is the body in plain text for non-HTML mail clients';

          //Send mail to everyone from DB
          if($mail->send()){
            echo '<b>Message has been sent!</b>';
          }
          $mail->ClearAllRecipients();

      } catch (Exception $e) {
          echo "<b>Message could not be sent! Mailer Error: {$mail->ErrorInfo}</b>";
      }
    }
    $mysqli->close();
}
?>
</body>
</html>
