<?php require_once('connectDB.php');  ?>

<html>
    <head>
    <style>
#prisoners {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 75%;
}

#prisoners td, #prisoners th {
  border: 1px solid #ddd;
  padding: 8px;
}

#prisoners tr:nth-child(even){background-color: #f2f2f2;}

#prisoners tr:hover {background-color: #ddd;}

#prisoners th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #00c6ff;
  color: white;
}
.button {
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
}



</style>
    </head>
    <body>
  <div>  
  
  <a href="addprisoner.php" class="button" align='right'>Add Prisoner</a>
  

        <h1 align = 'center'>Prisoner Data</h1>
        <p style='color:#FFBF00' align = 'center'>Enter Prisoner Finger to Show Data!</p>
        <?php
        
    
    $query8 = "SELECT check_id FROM switch";
    $result8 = mysqli_query($conn,$query8);
    $id = 0; 
    if($result8){
      $row8 = mysqli_fetch_assoc($result8);
      $id = $row8['check_id'];
    } 
      
    $query = "SELECT * FROM prisoners WHERE finger_id = '$id'";
    $result = mysqli_query($conn,$query);

    if($result){
        echo"<table id='prisoners' align = 'center'>";
        echo"<tr>
            <th>Prisoner Field</th>
            <th>Prisoner Data</th>
        </tr>";
        
          while($row = mysqli_fetch_assoc($result)){

            echo"<tr>";
                echo"<td>Name</td>";
                echo"<td>${row['name']}</td>";
            echo"</tr>";
            echo"<tr>";
                echo"<td>Prisoner Id</td>";
                echo"<td>${row['serial_no']}</td>";
            echo"</tr>";
            echo"<tr>";
                echo"<td>Details</td>";
                echo"<td>${row['details']}</td>";
            echo"</tr>";
          }
        
        
        echo"</table>";
    }

  
?>
  </div>  
  </body>
</html>