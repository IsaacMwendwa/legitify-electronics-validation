<?php
	 session_start();
		if(isset($_SESSION['username']) && isset($_SESSION['password']))
			{
?>
<?php
$conn = mysqli_connect("localhost", "isaka", "tugoslav", "legitify");

if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    $modelName = trim($_POST['modelName']);
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        $message1 = "Importing Serial Numbers CSV file into the Database...";
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            $sqlInsert = "INSERT into serials (serial_no,modelName)
                   values ('" . $column[0] . "', '$modelName')";
            $result = mysqli_query($conn, $sqlInsert);
            
            
            if (! empty($result)) {
                $type = "success";
                $message = "CSV Data Imported into the Database";
            } else {
                $type = "error";
                $message = "Problem in Importing CSV Data";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8" />
	<title>Legitify Authentication</title>
	<link rel="stylesheet" href="main.css">
	<script src="jquery-3.2.1.min.js"></script>
	<script type="text/javascript">
    $(document).ready(function() {
    $("#frmCSVImport").on("submit", function () {

	    $("#response").attr("class", "");
        $("#response").html("");
        var fileType = ".csv";
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
        if (!regex.test($("#file").val().toLowerCase())) {
        	    $("#response").addClass("error");
        	    $("#response").addClass("display-block");
            $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
            return false;
        }
        return true;
    });
   });
  </script>
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
			  <li><a href="#">Manufacturers' Page</a></li>
			  <li><a href="logout.php">Log Out</a></li>
			  
		</ul>
			</ul>
		</nav>
		
		<div id="new_div">
		
		 <section id="main_section">
			   <article>
			   <header>
					<h5>Welcome to the Manufacturers' page</h5>
			   </header>
					<p>Here you can upload CSV files of serial numbers of your devices for customers to query against</p>
					
				</article>
				<article>
			   <header>
					<h5>Upload CSV files of Serial Numbers</h5>
			   </header>
					<p>
    
    <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) 
    { echo $message; } ?></div>
    <div class="outer-scontainer">
        <div class="row">

            <form class="form-horizontal" action="" method="post"
                name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
                <div class="input-row">
                	<table>
			   	<caption><h3>Enter Model name and upload Serial Numbers of that model. </h3>
			   	</caption>
               <tbody>
				   <tr>
                <td> <label class="col-md-4 control-label">Model Name</label> <input type="text" name="modelName" placeholder="Model Name"> </td>
               </tr>
               <tr>
                 <td> <label class="col-md-4 control-label">Choose CSV
                        File</label> <input type="file" name="file"
                        id="file" accept=".csv"> <button type="submit" id="submit" name="import"
                        class="btn-submit">Import</button>
                   </td> 
               </tr>
               </tbody>
               </table>    
                    </div>

            </form>

        </div>
    
					</p>
					
				</article>
		 </section>
		 
		 <aside id="side_news">
		 <h4>News</h4>
			<li><a href="https://www.sony.com/ke/electronics/home-cinema/t/all-in-one-home-cinema-systems">
			Have you seen the all new Sony Home Theatre Systems?</a></li>
	<p>		
	<?php	
	$conn = mysqli_connect("localhost", "isaka", "tugoslav", "legitify");	
  	$query = mysql_query("select distinct from serials" , $conn);
   while ($row = mysql_fetch_array($query)) {
   echo "{$row['modelName']}";
   echo "<br />";
    }
  ?>
  </p>
		</aside>
		
		</div>
		 
		<footer id="the_footer">
			<h3>&copy<strong>Legitify Authentication 2018</strong></h3>
		</footer>
	</div>
</body>
</html>
<?php
}
else
{
//Redirects the user to the login page if he is not logged in
header("Location: login.php");
}
?>