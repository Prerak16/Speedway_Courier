<?php  
include 'connection.php';
// $connect = mysqli_connect("localhost", "root", "", "hhh");  
 $number = count($_POST["Tracking_Number"]);  
 $track_link = $_POST["link"];
 $Speedway_No = $_POST["Speedway_No"];

 if($number > 0)  
 {  
      for($i=0; $i<$number; $i++)  
      {  
           if(trim($_POST["Tracking_Number"][$i] != ''))  
           {  
                $sql = "INSERT INTO extra_box(Speedway_No,Tracking_Number,link) VALUES('$Speedway_No','".mysqli_real_escape_string($link, $_POST["Tracking_Number"][$i])."','".mysqli_real_escape_string($link, $_POST["link"][$i])."')";  
                mysqli_query($link, $sql);  
           }  
      }  
      echo "Data Inserted";  
 }  
 else  
 {  
      echo "Please Enter Name";  
 }  
 ?> 

