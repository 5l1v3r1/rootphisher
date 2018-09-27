<?php

session_start();

include('db.inc.php');

$sess = @($_SESSION['username']);

if(isset($sess)) {
    header("Location: index.php");
} else {

    echo '<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Add icon library -->
<link rel="stylesheet" type="text/css" href="mystyle.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
</head>
<body >
<form action="#" method="POST" style="max-width:500px;margin:auto">
  <h2>RootPhisher</h2>
  
  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Username" name="user">
  </div>

  <div class="input-container">
    <i class="fa fa-key icon"></i>
    <input class="input-field" type="password" placeholder="Password" name="pass">
  </div>

  <button type="submit" class="btn">Log In</button>
</form>

</body>
</html>';

    $login = @($_POST['login']);
    if(isset($login)) {

        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $q = "SELECT * FROM users WHERE username='$user'";
        $res = mysqli_query($link, $q);
        $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
      $count = mysqli_num_rows($res);
      if($count == 1 && $row['password'] == $pass) {
 
         $_SESSION['username'] = $row['username'];
         header("Location: index.php");
 
      } else {
 
         echo '<text style="color: white;">Incorrect Username or Password.</text>';
 
      }

 }

} 

?> 
