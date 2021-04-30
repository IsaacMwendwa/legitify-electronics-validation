<?php
  require_once "connect.php";
  session_start();
  if(isset($_SESSION['username']) && isset($_SESSION['password']))
     {
       header("Location: manufacturers.php");
     }
  ?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Legitify Authentication</title>
	<link rel="stylesheet" type="text/css" href="main.css">
	<script src="validation.js"></script>
	<script src="escape.js"></script>
</head>
<body>
	
	<div id="main_wrapper">
		<header id="top_header">
			<h1>Legitify Authentication</h1>
		</header>
		
		<nav id="top_menu">
			<ul>
			  <li><a href="home.php">Home</a></li>
			  <li><a href="account.php">Account Creation</a></li>
			  <li><a href="#">Login</a></li>
		   </ul>
		</nav>
		
		<div id="new_div">
		
		 <section id="main_section">
			  <article> 
			   <?php
              if (isset($_POST['uname']) && isset($_POST['pass']))
                 {
                 if (!empty($_POST['uname']) && !empty($_POST['pass']))
                 {
                   $uname=stripslashes(trim($_POST['uname']));
                   $pass=stripslashes(trim($_POST['pass']));
                   $EncryptPassword = md5($pass);
                   $check=mysql_query("SELECT * FROM manufacturers WHERE username='$uname' AND password='$EncryptPassword'");
                  if(mysql_num_rows($check)!=0)
                    {
                      $details=mysql_fetch_array($check);
                      $_SESSION['display_name']=$details[0];
                      $_SESSION['username']=$details[1];
                      $_SESSION['password']=$details[2];
                      header("Location: manufacturers.php");
                    }
                 else
                    {
                      print "Invalid Username/Password";
                    }
                 }      
                 else
                    {
                      print "All fields must be filled";
                    }
                 }
                 else
                    {
                      ?>
                         <form action="login.php" method="post">
                         Username: &nbsp<input type="text" name="uname" /><br />
                         Password: &nbsp<input type="password" name="pass" /><br />
                         <input type="submit" value="Login" />
                         </form>
                       <?php
                         }
                       ?>
			   </article>
		  </section>
		<aside id="side_news">
			<h4>News</h4>
			<li><a href="https://www.sony.com/ke/electronics/home-cinema/t/all-in-one-home-cinema-systems">
			Have you seen the all new Sony Home Theatre Systems?</a></li>
				</aside>
		
		</div>
		 
		<footer id="the_footer">
			<h3>&copy<strong>Legitify Authentication 2018</strong></h3>
		</footer>
	</div>
</body>
</html>