<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="icon" href="images/favicon.png" type="image/png">
<title>Doctors | MY GOV Hospitals</title>
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/coda-slider.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="css/print.css" type="text/css" media="print">
<script src="js/jquery-1.2.6.js" type="text/javascript"></script>
<script src="js/coda-slider.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.easing.1.3.js" type="text/javascript" charset="utf-8"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div id="slider">
	
    <div id="templatemo_sidebar">
    	<div id="templatemo_header">
        	<img src="images/logo.png" alt="MYGovHospital" width="230" height="80" style="position:absolute;top:80px;left:80px;"/>

        </div> <!-- end of header -->
        
        <ul class="navigation">
            <li><a href="index.php">Home<span class="ui_icon home"></span></a></li>
			<li><a href="aboutus.html">About Us<span class="ui_icon aboutus"></span></a></li>
               
        </ul>
    </div> <!-- end of sidebar -->
	<div id="templatemo_main">
    	<ul id="social_box">
            <li><a href="https://www.facebook.com/" target="_blank"><img src="images/facebook.png" alt="facebook" /></a></li>
            <li><a href="https://twitter.com/" target="_blank"><img src="images/twitter.png" alt="twitter" /></a></li>
            <li><a href="https://www.linkedin.com/" target="_blank"><img src="images/linkedin.png" alt="linkin" /></a></li>
            <li><a href="https://portal.technoratimedia.com/" target="_blank"><img src="images/technorati.png" alt="technorati" /></a></li>
            <li><a href="https://myspace.com/" target="_blank"><img src="images/myspace.png" alt="myspace" /></a></li>                
        </ul>
		<div id="loginSignup">
			<a href="loginSignup.php">
			<img src="images/loginSignupBtn.png" alt="Login/SignUp" width="180" height="48" class="image"
			onmouseover="this.src='images/loginSignupBtn_hover.png'"
			onmouseout="this.src='images/loginSignupBtn.png'"></a>
		</div>
		<!--end of loginSignup-->
		<div id="content">
		<div id="aboutUs">
		<?php
			$hospitalID=trim($_GET["hID"]);
			$hName=$_GET['hName'];
			echo '<h1>'.$hName.'-Doctor List</h1>';
			session_start();
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "mygovhospital";
			$con = new mysqli($servername, $username, $password, $dbname);
			$sql1 = "SELECT doctorID, name, specialization FROM doctor WHERE hospitalID='".$hospitalID."'";
			$result = mysqli_query($con, $sql1);
			$list = array();
			while($row = $result->fetch_assoc())
			{
					$list[] = $row;
			}
			mysqli_close($con);
			$value = array();
			foreach($list as $key=>$val)
			{
				foreach($val as $k=>$v)
				{ 
					// $v is string.
					// And $k is $val array index (0, 1, ....)
					$value[] = $v;		
				}
			}
			$doctors = array();
			$counter =0;
			$length = count($value);
			for($i=0;$i<$length;$i++)
			{
				$doctor[] = $value[$i];
				$counter++;
				if($counter==3)
				{
					$doctors[] = $doctor;
					$doctor = array();
					$counter = 0;
				}
			}
			$doctorNum = count($doctors);
			if($doctorNum==0)
				 echo "<p><i>No doctors to show.</i><p>";
			else
			{
				echo '<table border="1">';
				echo '<tr>
						<td align=center>No</td>
						<td align=center>DoctorName</td>
						<td align=center>Specialization</td>
						<td align=center>Achievements</td>
					  </tr>';
				$sno=1;
				for($i=0;$i<$doctorNum;$i++)
				{
					$doctor = $doctors[$i];
					$doctorID = $doctor[0];
					$doctorName = $doctor[1];
					$doctorSpec = $doctor[2];
						
					echo "<tr><td>".$sno."</td><td>".$doctorName."</td><td>".$doctorSpec."</td><td>
					<a href=achievement.php?dID=".$doctorID."&dName=".encodeURIComponent($doctorName).">Display</a></td>";
					$sno++;
				}
				echo '</table>';				
			}
				echo '<br><br>';
				echo '<img src="images/backBtn.png" alt="Back" width="71" height="30" class="image"
			onmouseover="this.src=\'images/backBtn_hover.png\'"
			onmouseout="this.src=\'images/backBtn.png\'" onclick="goPreviousPage()"></a>';
			function encodeURIComponent($str) {
				$revert = array('%21'=>'!', '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')');
				return strtr(rawurlencode($str), $revert);
				}
			?>
		</div>
        </div> <!-- end of content -->
		<div id="templatemo_footer">
			Copyright © 2017 <a href="index.php">MYGovHospital</a> | <a href="#content" target="_parent">Doctors | MY Gov Hospital</a> by <a href="index.php" target="_parent">MY GOV Hospital</a>
        </div> <!-- end of footer -->
    </div> <!-- end of main -->
</div>
</body>
<script type="text/javascript">
		
		function goPreviousPage() 
		{
			window.history.back();
		}
</script>
</html>