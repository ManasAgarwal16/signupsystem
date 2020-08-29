<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true)
{
  header("location:login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai+2&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Welcome</title>
</head>
<body>
<?php require 'partials/_nav.php' ?>
    Welcome --> <?php echo $_SESSION['username']?> 
    <header>
        <div class="container ">
            <nav id="main-nav" class="flex items-center justify-between">
                <div class="left flex items-center">
                    <div class="task">
                        <img src="./images/logo1.jpg" alt="">
                    </div>
                    <div>
                        <a href="#">Home</a>
                        <a href="#about">ABOUT</a>
                        <a href="#achievments">MY WORK</a>
                        <a href="#">BLOG</a>
                    </div>
                <div >
                <div class="right">
                    <button class="btn btn-primary">Contact Me</button>
                </div>

            </nav>
            <div class="hero flex items-center justify-between">
                <div class="left flex-1 flex justify-center" >
                    <img src="./images/manas2.jpeg" alt="">
                </div>
                <div class="right flex-1">
                    <h6>MANAS AGARWAL</h6>
                    <h1>
                        <span> Beginner! </h1></span>
                    <p>Manas Agarwal is a basic level programmer with a track record of 1501 rating on Codechef and he is a holder of 5 stars on Hackerrank. He has a knowledege of web designing, HTML and CSS.</p>
                </div>
            </div>
    </div>
    </header>
     
    <section id="about" class="about">
        <div class="container flex items-center about-inner-wrap">
            <div class="flex-1">
                <img class="about-img" src="./images/manas3.jpeg" alt="">
            </div>
            <div class="flex-1">
                <h1><span>About</span></h1>
                <h3>Hello! Meet Manas Agarwal</h3>
                <p>He has been born and brought up in BIJNOR which is situated on the bank of Ganges.The peaceful environment of the city helped him to devlop an innovative mind.Football has always been his go to go sport.</p>

            </div>
        </div>
    </section>
    <section id="achievments" class="services">
        <div class="container">
            <h1 class="section-heading"><span>My </span>work</h1>
            <p>"You have to learn the rules of the game. And then you have to play better than anyone else."</p>
            <div class="card-wrapper">
                <div class="card">
                    <h2>Web devlopment</h2>
                    <p>
                        Front-end (Home Page) Web design of a Gym website--In this project ,he has created a home web design with a text  area where people can fill up there details.
                    </p>
                    <p>
                        Animated moving car web Page--In this project ,he has created an animated moving car with the help of Css,Html and Java script.
                    </p>
                </div>
                <div class="card">
                    <h2>Competitive Programming</h2>
                    <p><a href="https://www.codechef.com/users/manas1602" target="_blank">Visit My Codechef Profile</a>
                    </p>
                    <p>
                        <a href="https://www.hackerrank.com/manasag1620?hr_r=1" target="_blank">Visit My Hackerrank Profile </a>
                    </p>
                    <p>
                        <a href="https://codeforces.com/profile/manasag1620" target="_blank">Visit My Codeforces Profile</a>
                    </p>
                    </p>
                </div>
                <div class="card">
                    <h2>Non-Technical</h2>
                    <p>Manas Agarwal is very active with his Photography skills.His passion for football is undying.Right from school to the college,he has always been up on every football team. </p>
                    
                </div>
            </div>
        </div>

    </section>
    
</body>
</html>