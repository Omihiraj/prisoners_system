<?php //session_start(); ?>
<?php require_once('connectDB.php');  ?>
<?php

if(isset($_POST['submit'])){
	$username = mysqli_real_escape_string($conn,$_POST['email']);
	$password = mysqli_real_escape_string($conn,$_POST['password']);



	$sql = "SELECT * FROM admin_data WHERE email = '$username' AND password = '$password' LIMIT 1";

	$result = mysqli_query($conn,$sql);
	if($result){
		if(mysqli_num_rows($result) == 1){
					$teacher = mysqli_num_rows($result);
					
					header("Location:view_data.php");
		}
		
	}
	else{
		
		
	} 
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Daily Attendance System</title>
	<link rel="stylesheet" type="text/css" href="css/home.css">
</head>
<body>
	
	<div class="login">
		
		<form action="index.php" method="POST">
			<fieldset>
				<legend><h1>Admin Log In</h1></legend>
				<!-- <p class="error">Invalid User Name or Password</p> -->
                <p>
					<label for="">Username:</label>
					<input type="email" name="email" id="" placeholder="Email Address">
					
				</p>
				<p>
					<label for="">Password</label>
					<input type="password" name="password" id="" placeholder="password">
				</p>
				<p>
					<button type="submit" name="submit">Log In</button>
				</p>
				
			</fieldset>
		</form>
	</div>

</body>
</html> 
<?php mysqli_close($conn);?>