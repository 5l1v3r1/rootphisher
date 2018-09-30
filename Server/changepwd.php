<?php

session_start();

include('db.inc.php'); # contains DB connection data

$sess = $_SESSION['username'];

if(isset($sess)) {

   echo '<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Add icon library -->
<link rel="stylesheet" type="text/css" href="mystyle.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
</head>
<body >
<form action="#" method="POST" style="max-width:500px;margin:auto">
  <h2>Change Password</h2>
  <div class="input-container">
    <i class="fa fa-key icon"></i>
    <input class="input-field" type="password" placeholder="Old Password" name="pass">
  </div>
  
  <div class="input-container">
    <i class="fa fa-key icon"></i>
    <input class="input-field" type="password" placeholder="New Password" name="passn">
  </div>
  
  <div class="input-container">
    <i class="fa fa-key icon"></i>
    <input class="input-field" type="password" placeholder="Repeat Password" name="pass2">
  </div>
  
<button name="change" Value="Change" type="submit" class="btn">Log In</button>
</form>
</body>
</html>';
   $change = @($_POST['change']);
   if(isset($change)) {

      $user = $_SESSION['username'];
      $pass = $_POST['pass'];
      $passn = $_POST['passn'];
      $pass2 = $_POST['pass2'];
      
      if($passn == $pass2) {

         $q = "SELECT * FROM users WHERE username='$user'";
         $res = mysqli_query($link, $q);
         $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
         $count = mysqli_num_rows($res);
         if($count == 1 && $row['password'] == $pass) {
 
            $q2 = "UPDATE users SET password='$passn' WHERE username = '$user'";
            $res2 = mysqli_query($link, $q2);
            header("Location: index.php");
 
         } else {
 
            echo '<text style="color: lime;">Incorrect Password.</text>';
 
        }

    } else {

       echo '<text style="color: lime;">Passwords do not match.</text>';  
  
    }

  } 

} else {

   header("Location: index.php");
  
}


?> 
