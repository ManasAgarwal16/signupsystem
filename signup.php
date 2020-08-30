<?php
$showAlert=false;
$showError=false;
 // $secreKkey="6LdA48QZAAAAAC0CZsNsSFhCft764KzXYZo-AJp6"
  // $responseKey=$_POST['g-recaptcha-response'];
  // $userIp=$_SERVER['REMOTE_ADDR'];
  // $url=" https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$responsekey&remoteip=$userIp";
  // $response =file_get_contents($url);
  // echo $response;
 // $exists=false;
if($_SERVER["REQUEST_METHOD"]=="POST")// method post used because request para will pass through body.
{
  include 'partials/_dbconnect.php';// include shows warning and script continues , whereas require shows fatal error and stops script.
  $username=$_POST["username"];
  $email=$_POST["email"];
  $password=$_POST["password"];         // req para
  $cpassword=$_POST["cpassword"];
  $fname=$_POST["fname"];
 
 $existSql="SELECT * FROM `users` WHERE username ='$username'";
 $result=mysqli_query($conn,$existSql); //user exist or not 
 $numExistRows =mysqli_num_rows($result);//uniqueness
 if (!empty($_POST["username"])&&!empty($_POST["email"])) //Ui username
{
  if($numExistRows > 0) //condition checking
  {
    $showError="Username Already Exists";
  }
  else
    {
      if(empty($_POST["password"]))  // empty condition checking!
      {
        $showError="Password Field empty";
      }
      else if (strlen($_POST["password"]) <= '8') //password length checking (validation)
      {
        $showError = "Your Password Must Contain At Least 8 Characters!";
      }
      elseif(!preg_match("#[0-9]+#",$password)) 
      {
        $showError = "Your Password Must Contain At Least 1 Number!";
      }
      elseif(!preg_match("#[A-Z]+#",$password)) 
      {
      $showError = "Your Password Must Contain At Least 1 Capital Letter!";
      }
      elseif(!preg_match("#[a-z]+#",$password)) 
      {
      $showError = "Your Password Must Contain At Least 1 Lowercase Letter!";
      }
      else if($password==$cpassword)
      {
        $hash=password_hash($password,PASSWORD_DEFAULT); //Password hashing converted to string ! For secureness.
        $sql="INSERT INTO `users` (`fname`, `email`,`username`, `password`, `dt`) VALUES ( '$fname','$email','$username', '$hash', current_timestamp())"; //Inserting into DB!
        $result= mysqli_query($conn,$sql);//query passed
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
}

?>
<!doctype html>
  <html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">  
    <!-- visible area of the web page.Varies with devices! (responsive) -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Signup</title>
  </head>
  <style>
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
      font-size:51px;
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
    <!-- require includes a key file to the flow of execution -->
    <?php
    if ($showAlert)
    {
    echo'
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong>Your account is now created and you can Login Now!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
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
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
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
          <div>
            <label for="fname">Full Name</label>
            <input type="text" maxlength="30" class="form-control" id="fname" name ="fname" aria-describedby="emailHelp" placeholder="Enter Your Full Name" required>
          </div>
            <label for="email">Email</label>
            <input type="email"  maxlength="50" class="form-control" id="email" name="email" placeholder="Enter Your Email" required>
          </div>
          <div class="form-group col-md-6">
            <label for="username">Username</label>
            <input type="text" maxlength="30" class="form-control" id="username" name ="username" aria-describedby="emailHelp" placeholder="Enter Your Username" required>
          </div>
          <div class="form-group col-md-6">
            <label for="password">Password</label>
            <input type="password"  maxlength="255" class="form-control" id="password" name="password" placeholder="Enter Your Password" required>
          </div>
          <div class="form-group col-md-6">
            <label for="cpassword">Confirm Password</label>
            <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="RE-Enter to Confirm Password" Required>
            <!-- <div class="g-recaptcha" data-sitekey="6LdA48QZAAAAAFihcOL6mKQRM3l6BGkFtfJnXA4D"></div> -->
            <button type="submit" class="btn btn-primary">SignUp</button>
        </form>
      </div>
    <!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->
    
  </body>
</html>