<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="icon" href="images/favicon.png" type="image/png">
<title>SignIn/Register | MY GOV Hospitals</title>
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/coda-slider.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="css/print.css" type="text/css" media="print">
<script src="js/jquery-1.2.6.js" type="text/javascript"></script>
<script src="js/coda-slider.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.easing.1.3.js" type="text/javascript" charset="utf-8"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="js/form-vadilation.js" type="text/javascript" charset="utf-8"></script>

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
			<a href="loginSignup.html">
			<img src="images/loginSignupBtn.png" alt="Login/SignUp" width="180" height="48" class="image"
			onmouseover="this.src='images/loginSignupBtn_hover.png'"
			onmouseout="this.src='images/loginSignupBtn.png'"></a>
		</div>
		<!--end of loginSignup-->
        <h1 id="printmedia">MY GOV Hospitals</h1>
		<div id="content">
			<div id="loginSignupBox">
					<div id="login">
                        <h1>Sign In</h1>
                        <div id="contact_form">
                            <form id="loginForm" action="addHospital.php" method="POST" >
                                
                                <label for="username">Username:</label> <input type="text" id="username" name="username" class="required input_field" required />
                                <div class="cleaner_h10"></div>
                                
                                <label for="password">Password:</label> <input type="password" id="password" name="password" class="required input_field" required />
                                <div class="cleaner_h10"></div>
                                
                                <input type="submit" class="submit_btn" name="submit" id="submit" value="Login" />
                                <input type="reset" class="submit_btn" name="reset" id="reset" value="Reset" />
                            
                            </form>
						</div>
					</div>
					<div id="register">
                        <h1>Register</h1>
                        <div id="contact_form">
                            <form id="registerForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
							
									<label for="userType">User Type:</label>
									<select name="userType" class="input_field" onchange="diffDisplay(this)">
									<option value="doctor" >Doctor</option>
									<option value="patient" selected="selected">Patient</option>
									</select>
									<div class="cleaner_h10"></div>
									
									<label for="checkingExistence" id="dIDPrompt" style="display:none;">DoctorID:</label>
									<label for="checkingExistence" id="NRICPrompt" style="display:default;">NRIC:</label>
									<input type="text" id="checkInput" name="checkInput" class="required input_field" required />
									<div class="cleaner_h10"></div>
									
									<input type="submit" class="submit_btn" name="submit" id="submit" value="Go" />
									<div class="cleaner_h10"></div>
								
									<script>
										function diffDisplay(that) {
											if (that.value == "doctor") {
												document.getElementById("dIDPrompt").style.display = "inline";
												document.getElementById("NRICPrompt").style.display = "none";
											} else {
												document.getElementById("dIDPrompt").style.display = "none";
												document.getElementById("NRICPrompt").style.display = "inline";
											}
										}
									</script>
							</form>
						</div>
					</div>
					<br>
			</div><!--end of login register-->
        </div> <!-- end of content -->
		<div id="templatemo_footer">
			Copyright © 2017 <a href="index.php">MYGovHospital</a> | <a href="#content" target="_parent">SignIn/Register | MY GOV Hospitals</a> by <a href="index.php" target="_parent">MY GOV Hospital</a>
        </div> <!-- end of footer -->
    </div> <!-- end of main -->
</div>
</body>
</html>
