<?php
$login=false;
$showError=false;
if($_SERVER["REQUEST_METHOD"]=="POST")
{
  include 'partials/_dbconnect.php';
  $username=$_POST["username"];
  $password=$_POST["password"];
  $exists=false;
  $sql="select * from users where username='$username'";
  $result= mysqli_query($conn,$sql);
  $num= mysqli_num_rows($result);
  if($num==1)
  {
    while($row=mysqli_fetch_assoc($result))
    {
      if(password_verify($password, $row['password']))
      {
        $login=true;
        session_start();
        $_SESSION['loggedin']=true;
        $_SESSION['username']=$username;
        header("location: welcome.php");
      }
      else
      {
        $showError="Invalid Credentials";
      }
      /*if (!empty($_POST["username"])) 
      {
        $showError = "Username is required";
      }*/
    } 
  }
  else
  {
    $showError="Invalid Credentials";
  }
  
}

?>
<!doctype html>
  <html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Login</title>
  </head>
  <style type="text/css">
    body
    {
      background-image: url('images/abs.jpg');
      background-repeat:no-repeat;
    }
    .container h1 
    {
      font-family: cursive;
      margin-bottom: 40px;
      margin-top: 60px;
      text-decoration: underline;
      color: ghostwhite;
    }

    .container form
    {
      display:flex;
      flex-direction:column;
      align-items:center;
      text-align:center;
      font-family:cursive;
      margin-top:56px;
      color:ghostwhite;
    }
    .container button
    {
      margin-top:20px;
    }
  </style>
  <body>
    <?php require 'partials/_nav.php'?>
    <?php
    if ($login)
    {
    echo'
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong>You are logged in!
        <button type="button" class="close"data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
    </div>
    ';
    }
    if ($showError)
    {
    echo'
        <div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong>  '.$showError.'
        <button type="button" collaps show class="close"data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
    </div>
    ';
    }
    ?>
    <div class="container">
      <h1 class="text-center">Login to my portfolio</h1>
      <form action="/loginsystem/login.php" method="post">
        <div class="form-group col-md-6">
          <label for="username">Username</label>
          <input type="username" class="form-control" id="username" name ="username" aria-describedby="emailHelp" placeholder="Username">
        </div>
        <div class="form-group col-md-6">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
          <button type="submit" class="btn btn-primary">Login</button>
      </form>
    </div>
  </body>
</html>