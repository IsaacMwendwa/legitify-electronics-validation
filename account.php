<?php
require_once "connect.php";
//require_once 'header.php';
if(isset($_POST['btn-signup']))
 {
 	session_start();
	$username = trim($_POST['username']);
	$email = trim($_POST['email']);
	$phone = trim($_POST['phone']);
	$pwd1 = trim($_POST['pwd1']);
	$pwd2 =trim($_POST['pwd2']);
	
   if(empty($username))
	{
		$error = "Enter your username(Company Name) !";
		$code = 1;
	}
	else if(!ctype_alpha($username))
	{
		$error = "Username should be letters only !";
		$code = 1;
	}
	else if(strlen($username)<=1)
	{
		$error = "Username should be atleast 2 characters!";
		$code = 1;
	}
	else if(empty($email))
	{
		$error = "Enter your email !";
		$code = 2;
	}
	else if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email))
	{
		$error = "Enter a valid email address !";
		$code = 2;
	}
	else if(empty($phone))
	{
		$error = "Enter Mobile Number!";
		$code = 3;
	}
	else if(!is_numeric($phone))
	{
		$error = "Mobile number should be numbers only !";
		$code = 3;
	}
	else if(strlen($phone)!=10)
	{
		$error = "10 characters only !";
		$code = 3;
	}
	else if(empty($pwd1))
	{
		$error = "Enter your password !";
		$code = 4;
	}
	else if(strlen($pwd1) < 6 )
	{
		$error = "Password should be a of Minimum 6 characters !";
		$code = 4;
	}
	else if(empty($pwd2))
	{
		$error = "Confirm your password !";
		$code = 5;
	}
	else if($pwd1 !=$pwd2) {
		$error= "Password & Confirm password must be the same! ";
		$code = 5;
	}
	else
	{  
		$EncryptPassword = md5($pwd1);
      $query = "insert into manufacturers (username,email,phone,password) values ('$username','$email','$phone','$EncryptPassword')";
	 }
}
?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Legitify Authentication</title>
	<script src="validation.js"></script>
	<script src="escape.js"></script>
	<link rel="stylesheet" type="text/css" href="main.css" />
	<style type="text/css">
     <?php
      if(isset($error))
      {
	  ?>
	     input:focus
	      {
		    border:solid red 2px;
	      }
	<?php
     }
   ?>
   </style>
</head>
<body>
	
	<div id="main_wrapper">
		<header id="top_header">
			<h1>Legitify Authentication</h1>
		</header>
		
		<nav id="top_menu">
			<ul>
			  <li><a href="home.php">Home</a></li>
			  <li><a href="#">Account Creation(Manufacturers)</a></li>
			  <li><a href="login.php">Login(Manufacturers)</a></li>
		   </ul>
		</nav>
		
		<div id="new_div">
		
		 <section id="main_section">
			  <article>
			   <form id="myForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			  
			   <table>
			   	<caption><h3>Enter your company's details below. </h3>
			   	</caption>
               <tbody>
                 <?php
                   if(isset($error))
                   {
	              ?>
               <tr>
                <td id="error"><?php echo $error; ?></td>
               </tr>
               <?php
                }
               ?>
				   <tr>
                <td>Username(Company Name)&nbsp</td>
                <td><input id="field_username" type="text" name="username" placeholder="User Name" title="Username must not be blank and contains at least 2 letters" required pattern="(?=.*[a-z]).{2,}" value="<?php if(isset($username)){echo $username;} ?>"  <?php if(isset($code) && $code == 1){ echo "autofocus"; }  ?> ></td>
               </tr>
               <tr>
                 <td>Email</td>
                 <td><input type="email" name="email" placeholder="Your Email" title="Enter a valid email address e.g name@domain.com"   value="<?php if(isset($email)){echo $email;} ?>" <?php if(isset($code) && $code == 2){ echo "autofocus"; }  ?> required/></td>
               </tr>
               <tr>
                 <td>Mobile Number</td>
                 <td><input type="text" name="phone" placeholder="Mobile No" title="Mobile Number should be 10 numerical digits" pattern="(?=.*\d).{10,}"value="<?php if(isset($phone)){echo $phone;} ?>" <?php if(isset($code) && $code == 3){ echo "autofocus"; }  ?> /></td>
               </tr>
               <tr>
                 <td>Password</td>
                 <td><input id="field_pwd1" type="password" name="pwd1" placeholder="Your Password" title="Password must contain at least 6 characters" required pattern="(?=.*[a-z]).{6,}"  <?php if(isset($code) && $code == 4){ echo "autofocus"; }  ?> ></td>
               </tr>
               <tr>
                  <td>Confirm password</td>
                  <td><input id="field_pwd2" type="password" name="pwd2" placeholder="Repeat Password" title="Please enter the same Password as above."  required pattern="(?=.*[a-z]).{6,}" <?php if(isset($code) && $code == 5){ echo "autofocus"; }  ?> ></td>
               </tr>
               <tr>
                   <td></td>
                   <td><button type="submit" name="btn-signup">Sign Me Up</button></td>
               </tr>
             </tbody>
			  </table>
			   	<?php 
			   	if(mysql_query($query)){ 
		           echo "<em>Account details saved successfully,"; 
		           echo " Please proceed to login</em>";
		         } 
		         else { 
		           echo "<em>Unable to Save, username already taken!</em>"; 
		         }
	           ?>  
			  </form>
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