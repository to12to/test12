<?php
error_reporting(0);
if(isset($_POST['submit']))
{
$fname=$_POST['fname'];
$fname=$_POST['lname'];
$mnumber=$_POST['mnumber'];
$email=$_POST['email'];
$PP=$_POST['profilepic'];
$password=$_POST['password'];
$pgender=$_POST['gender'];
$birth=$_POST['dob'];
$sql="INSERT INTO  usertbl(fname,lname,mnumber,email,profilepic,password,gender,dob) VALUES(:fname,:mnumber,:email,:profilepic, :password,:gender,:dob)";
$query = $dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':lname',$lname,PDO::PARAM_STR);
$query->bindParam(':mnumber',$mnumber,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':profilepic',$pp,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->bindParam(':gender',$pgender,PDO::PARAM_STR);
$query->bindParam(':dob',$birth,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$_SESSION['msg']="You are Scuccessfully registered. Now you can login ";
header('location:thankyou.php');
}
else 
{
$_SESSION['msg']="Something went wrong. Please try again.";
header('location:thankyou.php');
}
}
?>
<!--Javascript for check email availabilty-->

<script>

function checkAvailability() {

$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'emailid='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
<script src="js/jquery-1.12.0.min.js"></script>

<link rel="stylesheet" href="css/jquery-ui.css" />

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
						</div>
							<section>
								<div class="modal-body modal-spa">
									<div class="login-grids">
										<div class="login">
											<div class="login-left">
												<ul>
													<li><a class="fb" href="#"><i></i>Facebook</a></li>
													<li><a class="goog" href="#"><i></i>Google</a></li>

												</ul>
											</div>
											<div class="login-right">
												<form name="signup" method="post">
													<h3>Create your account </h3>
					

				<input type="text" value="" placeholder="First Name" name="fname" autocomplete="off" required="">
				<input type="text" value="" placeholder="Last Name" maxlength="10" name="lname" autocomplete="off" required="">
				<input type="text" value="" placeholder="mnumber Number" maxlength="10" name="mnumber" autocomplete="off" required="">
		<input type="text" value="" placeholder="Email id" name="email" id="email" onBlur="checkAvailability()" autocomplete="off"  required="">	
		<span id="user-availability-status" style="font-size:12px;"></span> 
		<input type="text" value="" placeholder="Profile Picture" maxlength="10" name="profilepic" autocomplete="off" required="">
	<input type="password" value="" placeholder="Password" name="password" required="">	
	<select>
  <option value="male">Male</option>
  <option value="female">Female</option>
</select>
<br>
<br>
	<input type="date" value="" id="datepicker" maxlength="10" name="dob" autocomplete="off" required="">

													<input type="submit" name="submit" id="submit" value="CREATE ACCOUNT">
												</form>
											</div>
												<div class="clearfix"></div>								
										</div>
											<p>By logging in you agree to our <a href="page.php?type=terms">Terms and Conditions</a> and <a href="page.php?type=privacy">Privacy Policy</a></p>
									</div>
								</div>
							</section>
					</div>
				</div>
			</div>