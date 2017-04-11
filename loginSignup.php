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
			<a href="loginSignup.php">
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
                            <form id="loginForm" action="loginValidation.php" method="POST" >
                                
                                <label for="username">Username:</label> <input type="text" id="loginUsername" name="loginUsername" class="required input_field" required />
                                <div class="cleaner_h10"></div>
                                
                                <label for="password">Password:</label> <input type="password" id="loginPassword" name="loginPassword" class="required input_field" required />
                                <div class="cleaner_h10"></div>
                                
                                <input type="submit" class="submit_btn" name="login" id="submit" value="Login" />
                                <input type="reset" class="submit_btn" name="reset" id="reset" value="Reset" />
                            
                            </form>
						</div>
					</div>
					<div id="register">
                        <h1>Register</h1>
                        <div id="contact_form">
                            <form id="registerForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
							
							
									<?php
									session_start();
									$userType="";
									$checkInput="";
									$_SESSION['isLogin']=false;
									$_SESSION['username']="";
										if(isset($_POST['go']))//check if user pressed 'Go'
											{
												$userType=$_POST['userType'];
												$checkInput=$_POST['checkInput'];
												$_SESSION['userType'] = $userType;
											}
									
									echo '<label for="userType">User Type:</label>';
									echo '<select name="userType" class="input_field" onchange="diffDisplay(this)">';
									if($userType=='doctor')
									{
										echo '<option value="doctor" selected="selected">Doctor</option>';
										echo '<option value="patient">Patient</option>';
									}
									else
									{
										echo '<option value="doctor" >Doctor</option>';
										echo '<option value="patient" selected="selected">Patient</option>';
									}
									echo '</select>';
									echo '<div class="cleaner_h10"></div>';
									if($userType=='doctor')
									{
										echo '<label for="checkingExistence" id="dIDPrompt" style="display:inline;">DoctorID:</label>';
										echo '<label for="checkingExistence" id="NRICPrompt" style="display:none;">NRIC:</label>';
									}
									else
									{
										echo '<label for="checkingExistence" id="dIDPrompt" style="display:none;">DoctorID:</label>';
										echo '<label for="checkingExistence" id="NRICPrompt" style="display:default;">NRIC:</label>';
									}
									echo '<input type="text" id="checkInput" name="checkInput" class="required input_field" required value="'.$checkInput.'"/>';
									echo '<div class="cleaner_h10"></div>';
									?>
									
									<input type="submit" class="submit_btn" name="go" id="submit" value="Go" />
									<div class="cleaner_h10"></div>
								
									<script type="text/javascript">
									</script>
							</form>
							<?php
									$servername = "localhost";
									$username = "root";
									$password = "";
									$dbname = "mygovhospital";
									$con = new mysqli($servername, $username, $password, $dbname);
									$existDoctor=false;
									$newPatient=false;
									$unregisteredPatient=false;
										if(isset($_POST['go']))//check if user pressed 'Go'
										{
											$userType=$_POST['userType'];
											$checkInput=$_POST['checkInput'];
											if($userType=='doctor')//if doctor is selected
											{
												$doctorID=$checkInput; //the input will be doctor ID
												$_SESSION['doctorID'] = $doctorID;
												$sql1 = "SELECT doctorID,userID FROM doctor WHERE doctorID = '".$doctorID."'";
												$result = mysqli_query($con, $sql1);
												$row = mysqli_fetch_assoc($result);
												$userID=$row['userID'];				
												if (mysqli_num_rows($result) > 0)//if the doctor exist
													{
														if($userID==null)
															$existDoctor=true;
														else
														{
															echo '<font color=red>You already have an account.</font>';
														}
													}
												else
													echo '<font color=red>Doctor ID not found. Please check with admin.</font>';
											}
											else // if patient is selected
											{
												$NRIC =$checkInput; //the input will be NRIC
												$_SESSION['NRIC'] = $NRIC;
												$sql1 = "SELECT patientID, userID FROM patient WHERE NRIC = '".$NRIC."'";
												$result = mysqli_query($con, $sql1);
																	
												if (mysqli_num_rows($result) == 0)//new Patient-not patient, not user of our system
													{
														$newPatient=true;
													}
												else //patient
												{
														$row = mysqli_fetch_assoc($result);
														if($row['userID']==null)//unregistered patient-is patient, but not user of our system
														{
															$unregisteredPatient=true;
														}
														else//registered patient, patient and user of our system
															echo '<font color=\'red\'>You already have an account. Please log in.</font>';
												}
																				
											}
										}
										if(isset($_POST['submit']))
										{
											$userType=$_SESSION['userType'];
											$successful = true;
											$username = $_POST['username'];
											$email=$_POST['email'];
											$password = $_POST['password'];
											$phoneNum = $_POST['phoneNum'];
											$sql1 = "SELECT * FROM user WHERE username ='".$username."'";
											$result = mysqli_query($con, $sql1);
											if (mysqli_num_rows($result) > 0)
											{
												echo "This Username has already been used by another account. Your account is not created.</br>";
												$successful = false;
											}
											else
											{
												if($userType=='doctor')
												{
													$doctorID=$_SESSION['doctorID'];
													//add user
													$sql2 = "INSERT INTO user (username, password, email, phoneNum, userType) 
															VALUES ('".$username."','".$password."','".$email."','".$phoneNum."','dr')";
													if(mysqli_query($con, $sql2))
													{
														echo "New account is signed up successfully.";				
													}
													else
													{
														echo "Error occurs: " . mysqli_error($con) . "</br>";
													}
													//get userID of that doctor
													$sql3 = "SELECT userID FROM user WHERE username='".$username."'";
													$result = mysqli_query($con, $sql3);
													$row = mysqli_fetch_assoc($result);
													$userID=$row['userID'];
													//update userID of that doctor
													$sql4 = "UPDATE doctor SET userID=".$userID." WHERE doctorID=".$doctorID."";
													mysqli_query($con, $sql4);
												}
												else if($userType=='patient')
												{
													$NRIC=$_SESSION['NRIC'];
													if($newPatient==true)
													{
														$name=$_POST["name"];
														$address=$_POST["addr"];
																
														if($name=="" || $address=="")
														{
															echo "Name and address cannot be empty. Please fill in the form.</br>";
															$successful = false;
														}
														else
														{
															//add user
															$sql5 = "INSERT INTO user (username, password, email, phoneNum, userType) 
																		VALUES ('".$username."','".$password."','".$email."','".$phoneNum."','pt')";
															if(mysqli_query($con, $sql5))
															{
																echo "New account is signed up successfully.";				
															}
															else
															{
																echo "Error occurs: " . mysqli_error($con) . "</br>";
															}
															//get userID of that patient
															$sql6 = "SELECT userID FROM user WHERE username='".$username."'";
															$result = mysqli_query($con, $sql6);
															$row = mysqli_fetch_assoc($result);
															$userID=$row['userID'];
															//add Patient
															$sql7 = "INSERT INTO patient (name, NRIC, address, userID) 
																	VALUES ('".$name."','".$NRIC."','".$address."','".$userID."')";
															$result = mysqli_query($con, $sql7);
														}
													}
													else
													{
														//add user
														$sql5 = "INSERT INTO user (username, password, email, phoneNum, userType) 
																		VALUES ('".$username."','".$password."','".$email."','".$phoneNum."','pt')";
														if(mysqli_query($con, $sql5))
														{
															echo "New account is signed up successfully.";				
														}
														else
														{
															echo "Error occurs: " . mysqli_error($con) . "</br>";
														}
														//get userID of that patient
														$sql6 = "SELECT userID FROM user WHERE username='".$username."'";
														$result = mysqli_query($con, $sql6);
														$row = mysqli_fetch_assoc($result);
														$userID=$row['userID'];
														//update userID of that patient
														$sql8 = "UPDATE patient SET userID=".$userID." WHERE NRIC='".$NRIC."'";
														mysqli_query($con, $sql8);
													}	
												}
											}
										}
									echo '<form id="registerForm2" method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" onsubmit="return checking(this)">';
									if($existDoctor==true || $newPatient==true || $unregisteredPatient==true)
									{
									echo '
									<div class="cleaner_h10"></div>
									<label for="username">Username:</label> <input type="text" id="username" name="username" class="required input_field" style="display:inline;" required autofocus placeholder="Try a username" />
									<div class="cleaner_h10"></div>
															
									<label for="password">Password:</label> <input type="password" id="password" name="password" class="required input_field" style="display:inline;" required autofocus placeholder="Enter Your Password Here" />
									<div class="cleaner_h10"></div>
											
									<label for="confirmpassword">Confirm Password:</label> <input type="password" id="confirmpassword" name="confirmpassword" class="required input_field" style="display:inline;" required autofocus placeholder="Repeat your password here."/>
									<div class="cleaner_h10"></div>
									
									<label for="email">Email Address:</label> <input type="email" id="email" name="email" class="validate-email required input_field" style="display:inline;" required placeholder="MYGovHospital@example.com"/>
									<div class="cleaner_h10"></div>
									<label for="phone">Phone Number:</label> <input type="text" id="phoneNum" name="phoneNum" class="required input_field" style="display:inline;" required placeholder="012-3456789"/>
									<div class="cleaner_h10"></div>';
									}
									if($newPatient==true){
										echo '<label for="name">Name:</label> <input type="text" id="name" name="name" class="required input_field" style="display:inline;"/>
										<div class="cleaner_h10"></div>
									
										<label for="address">Address:</label> <input type="text" id="addr" name="addr" class="required input_field" style="display:inline;"/>
										<div class="cleaner_h10"></div>';	
									}
									mysqli_close($con);
									if($existDoctor==true || $newPatient==true || $unregisteredPatient==true || $newPatient==true)
									{
									echo'
									<input type="submit" class="submit_btn" name="submit" id="submit" value="Send" />
									<input type="reset" class="submit_btn" name="reset" id="reset" value="Reset" />';
									}
									echo '</form>';
								?>
                            
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
<script type="text/javascript">
/**
$(document).ready(function(){
  $('#student_id').change(function() {
    $('#student_id2').val($('#student_id).val());
  });
});**/
function diffDisplay(that) 
{
	if (that.value == "doctor") {
		document.getElementById("dIDPrompt").style.display = "inline";
		document.getElementById("NRICPrompt").style.display = "none";
	} else {
		document.getElementById("dIDPrompt").style.display = "none";
		document.getElementById("NRICPrompt").style.display = "inline";
	}
	document.getElementById("checkInput").value="";
}

function checking(x)
{
	if (x.password.value.length<6){
		alert("Password must contain at least 6 characters.Please try again.");
		return false;
	}
	if (x.password.value != x.confirmpassword.value){
		alert("Unmatched Password. Please try again.");
		return false;
	}
	
}
</script>
</html>
