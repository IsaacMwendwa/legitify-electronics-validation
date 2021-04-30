<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="keywords" content="online, serial numbers, electronics, authentication, free, Legitify">
   <meta name="description" content="This website gives a free electronics authentication platform using serial umbers. 
   Here manufacturers can create accounts and upload their products' serial numbers; to assist buyers in getting genuine products">
	<title>Legitify Authentication</title>
	<link rel="stylesheet" href="main.css">
</head>
<body>
	<div id="main_wrapper">
		<header id="top_header">
			<h1>Legitify Authentication</h1>
		</header>
		
		<nav id="top_menu">
			<ul>
			  <li><a href="#">Home</a></li>
			  <li><a href="account.php">Account Creation(Manufacturers)</a></li>
			  <li><a href="login.php">Login(Manufacturers)</a></li>
		   </ul>
		</nav>
		
		<div id="new_div">
		
		 <section id="main_section">
			   <article>
			   <header>
					<h5>Validating Electronics before Purchase</h5>
			   </header>
					<p>Welcome to Legitify Authentication, an electronics authentication site that provides great functionalities for validating products before purchase
			    . Just proceed to punch in the serial number of the device and search it in our database. After successfully validating the serial number, you get the device's
			    model name and a valid product message; otherwise you get an invalid product message. This pre-purchase authentication process gives you the luxury of validating
			     the authenticity of electronics before purchase; ensuring you get value for your money.
				 Voila!
					</p>
				</article>
				
				<article>
			   <header>
					<h5>Are You a Manufacturer?</h5>
			   </header>
					<p>Please<a href="account.php">create an account</a> to upload your products' serial numbers; ensuring customers get genuine products; hence protecting your good brand-name</p>
				</article>
				
		 </section>
		 
		 <aside id="side_news">
		  <form method="POST" action="home.php" >
		     <p><label>Search Serial Number:
		  	  <input type="search" name= "serial_no" placeholder="Search here" />
		  </label></p>
		  <p><input type="submit" name="search"/></p>
		  </form>
		  <p>
		  <?php
        require_once "connect.php";
 
        if (isset($_POST['search']))
        {
         if (!empty($_POST['serial_no']))
             {
              $serial_no=stripslashes(trim($_POST['serial_no']));
              $check=mysql_query("SELECT * FROM serials WHERE serial_no='$serial_no'");
              if(mysql_num_rows($check)!=0)
                 {
                   $connect = mysqli_connect("localhost","isaka","tugoslav","legitify");
                   if(! $connect ) {
                      die('Could not connect: ' . mysqli_error());
                   }
   					$sql = "SELECT modelName FROM serials where serial_no='$serial_no'";
                  $retval = mysqli_query( $connect, $sql );
                  if(! $retval ) {
   	              echo $retval;
                    die('Could not get data: ' . mysqli_error());
                  }
                  while($row = mysqli_fetch_array($retval, MYSQL_ASSOC)){
                       echo "Model Name: {$row['modelName']}  <br> ";
                  }
                  mysqli_close($conn);
                  print "Device's Serial Number Successfully Authenticated...This is a genuine product";
                }
              else
                 {
                    print "Invalid Serial Number...Product not authenticated";
                 }
             }      
          else
             {
               print "Please key in the serial number";
             }
         }
        ?>
		  </p>
		  <p>&nbsp</p>
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
