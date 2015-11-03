<?php 
		require_once("startup.php");
		$_SESSION['lastVisited'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>#45</title>
		<link rel="stylesheet" type="text/css" href="css/header.css">
		<link rel="stylesheet" type="text/css" href="css/index.css">
	    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
	    <link rel="stylesheet" type="text/css" href="css/mainContainer.css">
    	<link rel="stylesheet" type="text/css" href="css/style_homePage.css"/>
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
		<!-- SCRIPT FOR POP UP LOGIN AND REGISTER BOXES -->
    	<script type="text/javascript">
	    	function dlgLogin() {
	    		var whitebg = document.getElementById('white-background');
	    		var dlg = document.getElementById('dlgbox');
	    		whitebg.style.display = "none";
	    		dlg.style.display = "none";
	    	}
	    	function showDialog() {
	    		var whitebg = document.getElementById('white-background');
	    		var dlg = document.getElementById('dlgbox');
	    		whitebg.style.display = "block";
	    		dlg.style.display = "block";
	    		var winWidth = window.innerWidth;
	    		var winHeight = window.innerHeight;
	    		dlg.style.left = (winWidth/2) - 480/2 +"px";
	    		dlg.style.top = "150px";
	    	}
	    </script>

		<?php 
			if($_SESSION['confMess'] != "") {
		?>
				<script  type="text/javascript">
					var confMess = "<?php 
										echo $_SESSION['confMess']; 
										$_SESSION['confMess'] = "";
										?>";
					confirm("Message: " + confMess);
				</script>
		<?php
			}
		?>

	</head>
	<body>
		<!-- DIALOG BOX -->
		<?php if (!$_SESSION['loggedin']) { ?>
		 		<div id="white-background"> </div>
	            <div id="dlgbox"> 
	                <div id="dlg-header"> Login to edit locked Articles </div>
	                <div id="dlg-body">
	                    <div class="loginForm"> 
	                        <span style="font-size: 1.4em;"> Login </span> 
	                        <br />
	                        <br />
	                        <form action="login.php" method="post"> 
	                            Registered E-Mail:
	                            <br /> 
	                            <input type="text" name="logmail" value="" /> 
	                            <br />
	                            <br /> 
	                            Password:
	                            <br /> 
	                            <input type="password" name="logpassword" value="" /> 
	                            <br />
	                            <br /> 
	                            <input type="submit" class="submitBut" value="Login" /> 
	                        </form> 
	                    </div>
	                    <div class="loginForm"> 
	                        <span style="font-size: 1.4em;"> Register </span> 
	                        <br />
	                        <br />
	                        <form action="register.php" method="post"> 
	                            Full Name:
	                            <br /> 
	                            <input type="text" name="username" value="" /> 
	                            <br />
	                            <br />
	                            E-Mail:
	                            <br /> 
	                            <input type="text" name="email" value="" /> 
	                            <br />
	                            <br />
	                            Password:
	                            <br /> 
	                            <input type="password" name="password" value="" /> 
	                            <br />
	                            <br />
	                            <input type="submit" class="submitBut" value="Register" />
	                        </form>
	                    </div>
	                </div>
	                <div id="dlg-footer">
	                    <button onclick="dlgLogin()"> Cancel </button>
	                </div>
	            </div>
		<?php } ?>
		<!-- DIALOG BOX -->
		<!-- Implement flexible header -->
	 	<header id="nav"> <!-- SITE OF HORIZONTAL NAVIGATION BAR -->
	        <nav id="nav_wrapper">
	       		<?php include_once("horheader.php"); //Must Link Header.css ?>
	        </nav>
	    </header> <!-- SITE OF HORIZONTAL NAVIGATION BAR -->
		<!-- TITLE OF PAGE SHOWS UP -->
		<div id="mainBody">
			<div id="pageTitle">
			 	<p id="title_1">
			  		<span style="color:#bf7b2c;">#</span><span style="color:#64B4C8;">45</span>
			  	</p>
			  	<br />
	          	<p id="title_2">
	          		<strong>
	          			<span style="color:#2f2f2f;">Under Construction</span>
	          		<br /> 
	          			<span style="color:#bf7b2c;">#</span><span style="color:#64B4C8;">45</span> 
	          			- Work smart, play hard -
	          		</strong> 
	          		A (complete) guide to the IB exams
	          	</p>
		   </div>
		</div>
		<!-- Table for Subject Selection -->
		<div id="lowerPart">	
			<table id="fachTable">
		       	<tr>
			    	<td class="activeTd">
						<a href="view.php?cat=BIOLO0101">Biology</a>
				  	</td>
				  	<td>
						<a href="view.php?subject=PHYSI0101">Physics</a>
				  	</td>
				  	<!--
			      	
				  	<td>
						<a href="view.php?subject=Chemistry">Chemistry</a>
				  	</td>
			  	</tr>
			  	<tr>
				  	<td>
						<a href="view.php?subject=History">History</a>
				  	</td>
				  	<td>
	                	<a href="view.php?subject=Economics">Economics</a>
			      	</td>
				  	<td>
						<a href="view.php?subject=Business">Business</a>
				  	</td>
					-->
			  	</tr>
		   	</table>
		</div>
	</body>
</html>
