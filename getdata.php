<?php 
//******************************** SESSION START *****************************************************************
  session_start();  
?>
<?php
//******************************** CONNECT WITH DATA BASE **********************************************************
 require_once('connectDB.php');
 

 ?>
<?php
    date_default_timezone_set("Asia/Colombo");


    
    if(!empty($_POST['confirm_id'])){
        $query = "SELECT * FROM switch LIMIT 1";
        $result =  mysqli_query($conn, $query);
        if($result){
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result) ;
                if($row["finger_status"]==1){
                    echo "set_id".$row["finger_id"];
                }elseif($row["finger_status"] == 0){
                    echo "log_in";
                    
                }    
            } 
            
           
        }
    }
    if(isset($_POST['FingerID'])){
        $_SESSION['check_id'] = $_POST['FingerID'];
        if(!empty($_SESSION['check_id'])){
            echo"login";
            $check_tmp_id = $_SESSION['check_id'];
            $query = "UPDATE switch SET finger_status ='2',check_id='$check_tmp_id'";
			$result = mysqli_query($conn,$query);
        }
        
    }

    $conn->close();
?>