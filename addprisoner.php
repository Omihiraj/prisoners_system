<?php 
	session_start();
 ?>
<?php require_once('connectDB.php');  ?>
<?php 


	if(isset($_POST['user_add'])){
		
		if(isset($_SESSION['set-finger-id'])){
			
			$setup_finger_id = $_SESSION['set-finger-id'];
			$errors = array();
		$req_feilds = array('name','number','details');

		foreach ($req_feilds as $feild) {
			if(empty(trim($_POST[$feild]))){
				$errors[] = $feild." is required !"; 
			}	
		}
		
        if(empty($errors)){
			$name = mysqli_real_escape_string($conn,$_POST['name']);
			$number = mysqli_real_escape_string($conn,$_POST['number']);
			$details = mysqli_real_escape_string($conn,$_POST['details']);
			
			$query3 = "UPDATE switch SET finger_status ='0'";
			$result3 = mysqli_query($conn,$query3);
                    

			$query = "INSERT  INTO prisoners(name,gender,serial_no,finger_id,details)
                VALUES('$name','Male','$number','$setup_finger_id','$details')";
				
			$result = mysqli_query($conn, $query);
				
			if($result){
				echo"success";
			}
			else{
				echo"unsuccess";
			}
				
		}	
	}	
	}
    
 ?>
<?php
	

	if(isset($_POST['fingerid_btn'])){
		
        $_SESSION['set-finger-id'] = $_POST['finger_id'];
		
		$alert = array();
		if(empty($_POST['finger_id'])){
			$errors[] = 'Fingerprint Missing'; 

		}

		if(empty($errors)){

			$finger_Id = mysqli_real_escape_string($conn,$_POST['finger_id']);

            $query = "SELECT * FROM prisoners WHERE finger_id = '$finger_Id'";
            $result = mysqli_query($conn,$query);
            if($result){
				
				if(mysqli_num_rows($result) == 1){
					$errors[] = "Exist Value";
					show_alert(1);
					
				}else{
                    $query2 = "UPDATE switch SET finger_id = '$finger_Id',finger_status ='1'";
			        $result2 = mysqli_query($conn,$query2);
                    if($result2){
                        show_alert(2);
                    }
                }
			}
			
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Daily Attendance System</title>
    <link href="css/addstudent.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    
		<style>
			.butt {
  background-color: #00c6ff;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  margin-left:1100px;
}
		</style>
</head>
<a href="view_data.php" class='butt'>Go to View Page</a>
<body>
	<p id="test">
    <?php
					function show_alert($i){
						$val = $i;
						if($val==1){
							echo'<div class="errmsg">Already in the Database Please Select Another Value</div>';
						}
						elseif($val==2){
							echo'<div class="errmsg">Data Insert Succesfully</div>';
						}
						elseif ($val==3) {
							echo'<div class="errmsg">Error</div>';
							
						}
						elseif($val==4){
							echo'<div class="errmsg">Please Enter User Info For User Finger Id</div>';
						}
					}
					  ?>
					  <?php
					  	if(!empty($errors)){
					  		echo '<div class="errmsg">';
					  		echo '<b>There were errors on your form</b></br>';
					  		foreach ($errors as $error) {
					  			echo $error.'<br>';
					  		}
					  		echo '</div>';
					  	}
					   ?>

    </p>
	
	
			
	<div class="container">
        <div id="cover">
            <h1 class="sign-up">Welcome !..</h1>
            <p class="sign-up">First Insert Finger Id<br>Then Click Next Button</p>
            <a class="button sign-up" href="#cover">Next</a>
            <h1 class="sign-in">Welcome Back!</h1>
            <p class="sign-in">Now You Can Enter<br>Student's Personal Info</p>
                
            <br>

            <a class="button sub sign-in" href="#">previous</a>
        </div>

        <div class="login">

            <h1>Prisoner Registration</h1>
            
            <span class="social-login"><img src="fingerprints.png" height="100px" width="100px"></span>
            <p>Enter Fingerprint ID between 1 & 127</p>
            
                            

            <form action="addprisoner.php" method="POST">
                <input type="number" name="finger_id" id="finger_id" placeholder="Prisoner Finger Id..." class="input-field" min="1" max="127" required="Please add fingerprint" ><br>
                
                <input name="fingerid_btn" type="submit" value="Submit" class="submit-btn">
            </form>
        </div>

        <div class="register">
            <h1>Prisoner Information</h1>
            <span class="social-login"><img src="prisoner.png" height="100px" width="100px"></span>
            
                            
            <form action="addprisoner.php" method="POST">
                <input name="name" id="name" type="text" placeholder="Prisoner Name..." class="input-field" required="Please Enter User Name"><br>

                <input type="text" name="number" id="number" placeholder="Prisoner ID..." class="input-field" required="Please Enter Index No"><br>

                

                <textarea id="w3review" name="details" rows="4" cols="50" placeholder="Details..."></textarea><br>

                <input class="submit-btn" name="user_add" type="submit" value="Submit" >
            </form>
        </div>
		
    </div>				
					
				
			
			
		
	

</body>
</html>
 
<?php mysqli_close($conn);?>