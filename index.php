<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="icon" href="images/favicon.png" type="image/png">
<title>HOME | MY GOV Hospitals</title>
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/coda-slider.css" type="text/css" media="screen"/>
<script src="js/jquery-1.2.6.js" type="text/javascript"></script>
<script src="js/coda-slider.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.easing.1.3.js" type="text/javascript" charset="utf-8"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="http://maps.googleapis.com/maps/api/js"></script>

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
			<h1>Malaysia Government Hospital</h1>
			<?php include "googlemap.php" ?>
			<div id="googleMap" style="width:820px;height:380px;margin-left:0px;"></div><br><br>
			<?php
				session_start();
				$_SESSION['isLogin']=false;
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "mygovhospital";
				$con = new mysqli($servername, $username, $password, $dbname);
				$sql1 = "SELECT hospitalID, name, address, phoneNum FROM hospital WHERE hshow='Y'";
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
				$hospitals = array();
				$counter =0;
				$length = count($value);
				for($i=0;$i<$length;$i++)
				{
					$hospital[] = $value[$i];
					$counter++;
					if($counter==4)
					{
						$hospitals[] = $hospital;
						$hospital = array();
						$counter = 0;
					}
				}
				$hospitalNum = count($hospitals);
				for($i=0;$i<$hospitalNum;$i++)
				{
					$hospital = $hospitals[$i];
					$hospitalID = $hospital[0];
					$hospitalName = $hospital[1];
					$hospitalAddress = $hospital[2];
					$hospitalPhoneNum = $hospital[3];
					
					echo '<table border="1" id="'.$hospitalID.'">';
					echo '<tr>
							<td rowspan="4" width="150"><img src="images/hospital/'.$hospitalID.'.jpg" width="150" height="200" alt="'.$hospitalName.'"></td>
							<td width="75">Name:</td>
							<td><h4>'.$hospitalName.'</h4></td>
						</tr>';
					echo  '	<tr>
							<td>Address:</td>
							<td>'.$hospitalAddress.'<br>
							</td>
							</tr>';
					echo  '	<tr>
							<td>Tel:</td>
							<td>'.$hospitalPhoneNum.'</td>
						</tr>';
					echo  '	<tr>
							<td>More: </td>
							<td><a href=doctors.php?hID='.$hospitalID.'&hName='.encodeURIComponent($hospitalName).'>View Doctors</td>
						</tr>
					</table>';
					echo '<br>';
				}
			function encodeURIComponent($str) {
				$revert = array('%21'=>'!', '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')');
				return strtr(rawurlencode($str), $revert);
				}
			?>
		<a href="#content">Back to Top</a>
        </div> <!-- end of content -->
		<div id="templatemo_footer">
			Copyright © 2017 <a href="index.php">MYGovHospital</a> | <a href="#content" target="_parent">Home | MY Gov Hospital</a> by <a href="index.php" target="_parent">MY GOV Hospital</a>
        </div> <!-- end of footer -->
    </div> <!-- end of main -->
</div>
</body>
</html>