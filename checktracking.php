<?php
include 'connection.php';

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$serch = $_POST["cus_no1"];

$sql = "SELECT * FROM speedway WHERE Speedway_No='$serch'";

if($result = mysqli_query($link,$sql)){
    if(mysqli_num_rows($result)>0){
        echo "<div class=\"table-responsive\">";
            echo "<table class=\"table table-bordered\" style=\"width:60%; margin:0 auto;\">";
            

            while($row = mysqli_fetch_array($result)){
                echo "<caption>" . "Result of $serch" . "</caption>";
            echo "<tbody>";
            echo"<tr>";
            echo "<td style=\"background-color:rgb(172, 172, 172);\">Speedway No.</td>";
            echo "<td>" . $row['Speedway_No'] . "</td>";
            echo"</tr>";
            echo"<tr>";
            echo "<td style=\"background-color:rgb(172, 172, 172);\">Name</td>";
            echo "<td>" . $row['To_Name'] .  "</td>";
            echo"</tr>";
            echo"<tr>";
            echo "<td style=\"background-color:rgb(172, 172, 172);\">Country</td>";
            echo "<td>" . $row['Country'] . "</td>";
            echo"</tr>";
              echo "<tr>";
              echo "<td style=\"background-color:rgb(172, 172, 172);\">Status</td>";
              echo "<td>" . $row['Status'] . "</td>";
              echo "</tr>";
              echo "<tr>";
              echo "<td style=\"background-color:rgb(172, 172, 172);\">Tracking Number</td>";
              if($row['Tracking_Number']== "0"){
                echo "<td>" . "Not Available" . "</td>";
              }
              else{
                echo "<td>" . "<a href='".$row['Link']."'>".$row['Tracking_Number']."</a>" . "</td>"; 
              }
              echo "</tr>";
              echo "</tbody>";
              echo "</table>";
              

              
             
            }

           


            mysqli_free_result($result);
    }
    else{
        echo "<p> No records found. </p>";
    }
   
}
else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}


$sql1 = "SELECT * FROM extra_box WHERE Speedway_No='$serch'";

if($result = mysqli_query($link, $sql1)){
  if(mysqli_num_rows($result)>0){
    echo "<p class=\"display-4 headline\" style=\"font-size: 30px;\">Other Box Tracking Number</p>";
     echo "<hr style=\"height:4px;border:none;color:#333;background-color:#E4322B;margin-bottom:0px;width:80px;\" />";
     echo "<br/>"; 
      echo "<table class=\"table table-bordered\" style=\"width:20%; margin:0 auto;\">";
      echo "<thead>";
      echo "<tr>";
      echo "<th>Box</th>"; 
      echo "<th>Tracking Number</th>";            
      echo "</tr>";
      echo "</thead>";
      $counter = 2;
      while($row = mysqli_fetch_array($result)){
          
      echo "<tbody>";
      echo "<tr>";
      echo "<td>". $counter . "</td>";   
      echo "<td>" ."<font color=\"Red\">". "<a href='".$row['link']."'>" . $row['Tracking_Number']."</a>" ."</font>" . "</td>";
      $counter++;
      echo "</tr>";
      echo "</tbody>";

      }
  }
}


mysqli_close($link);
?>