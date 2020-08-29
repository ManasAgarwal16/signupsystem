<?php
$showAlert=false;
$showError=false;
if($_SERVER["REQUEST_METHOD"]=="POST")
{
  include 'partials/_dbconnect.php';
  $username=$_POST["username"];
  $email=$_POST["email"];
  $password=$_POST["password"];
  $cpassword=$_POST["cpassword"];
 // $exists=false;
 $existSql="SELECT * FROM `users` WHERE username ='$username'";
 $result=mysqli_query($conn,$existSql);
 $numExistRows =mysqli_num_rows($result);
 if (!empty($_POST["username"])&&!empty($_POST["email"])) 
{
  if($numExistRows > 0)
  {
    $showError="Username Already Exists";
  }
  else
    {
      if(empty($_POST["password"]))
      {
        $showError="Password Field empty";
      }
      else if($password==$cpassword)
      {
        $hash=password_hash($password,PASSWORD_DEFAULT);
        $sql="INSERT INTO `users` ( `email`,`username`, `password`, `dt`) VALUES ( '$email','$username', '$hash', current_timestamp())";
        $result= mysqli_query($conn,$sql);

        if($result)
        {
          header("location: login.php");
          $showError=true;
        }
      }
      else
      {
        $showError="Passwords do not match or password is required";
      }
 
     }
  }
  else
  {
    $showError="Empty field found";
  }
  
  
  /*else 
  {
    $username = test_input($_POST["username"]);
    // check if e-mail address is well-formed
    /*if (!filter_var($username, FILTER_VALIDATE_USERNAME)) 
    {
      $showError = "Invalid username format";
    }
  }*/
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
    <title>Signup</title>
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
      margin-top: 42px;
      text-decoration:underline;
      color:ghostwhite;
    }
    .container form
    {
      display:flex;
      flex-direction:column;
      align-items:center;
      text-align:center;
      font-family:cursive;
      color:whitesmoke;
    }
    .container button
    {
      margin-top:20px;
    }
    
  </style>
  <body>
    <?php require 'partials/_nav.php'?>
    <?php
    if ($showAlert)
    {
    echo'
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong>Your account is now created and you can Login Now!
        <button type="button" class="close"          data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
    </div>
    ';
    }
    if ($showError)
    {
    echo'
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong>  '.$showError.'
        <button type="button" class="close"          data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
    </div>
    ';
    }
    ?>
    <div class="container">
      <h1 class="text-center">Signup to my portfolio</h1>
      <form action="/loginsystem/signup.php" method="post">
      <div class="form-group col-md-6">
          <label for="email">Email</label>
          <input type="email"  maxlength="50" class="form-control" id="email" name="email" placeholder="email" required>
        </div>
        <div class="form-group col-md-6">
          <label for="username">Username</label>
          <input type="text" maxlength="30" class="form-control" id="username" name ="username" aria-describedby="emailHelp" placeholder="Username" required>
        </div>
        <div class="form-group col-md-6">
          <label for="password">Password</label>
          <input type="password"  maxlength="255" class="form-control" id="password" name="password" placeholder="Password" required>
        </div>
        <div class="form-group col-md-6">
          <label for="cpassword">Confirm Password</label>
          <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" Required>
        <button type="submit" class="btn btn-primary">SignUp</button>
      </form>
    </div>
    
  </body>
</html>