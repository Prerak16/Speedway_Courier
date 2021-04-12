<?php
session_start();
if(isset($_SESSION['Role'])) {
    if (time() - $_SESSION['timestamp'] > 600){
    header('Location: logout.php');
    }
  else{
    $_SESSION['timestamp'] = time();
  }
  }
  else{
    header('Location: login.php');
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Full Data</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        table.table-bordered > thead > tr > th{
  border:1px solid black;
  background-color: rgb(172, 172, 172);
  
  font-family:'arial',sans-serif;
}

table.table-bordered > tbody > tr > td{
  border:1px solid black;
  font-family:'arial',sans-serif;
}

        </style>
  </head>
  <body>
  <div class="container-fluid">
  <p class="h3" style="color:blue;">All Records</p>
  <a href="form.php"> < Back to Home</a>
  <br/>
  <input type="text" class="form-control" style="width:400px;" placeholder="Search Here" id="search_field" autofocus> 
  <br/>
  <?php
  include 'connection.php';

  $sql = "SELECT Speedway_No, Date, Origin,Country,Destination,From_Name,From_Address,From_Address2,From_Number,To_Name,To_Address,To_Address2,To_Address3,To_Address4,To_Number,To_Number2, Service,Counter_Part, Weight, CPK, OC,Customer_Fee,Tracking_Number,Tracking_Website,Link,Status,Payment,Remarks FROM speedway ORDER BY Date DESC";
  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result)>0){
      
        echo "<table class=\"table table-bordered\" id=\"myTable\">";
        echo "<thead>";
        echo "<tr class=\"myHead\">";
        echo "<th>Speedway No</th>";              
        echo "<th>Date</th>";
        echo "<th>Origin</th>";
        echo "<th>Country</th>";
        echo "<th>Destination</th>";
        echo "<th>From Name</th>";
        echo "<th>From Address</th>";
        echo "<th>From Address</th>";
        echo "<th>From Number</th>";
        echo "<th>To Name</th>";
        echo "<th>To Address</th>";
        echo "<th>To Address</th>";
        echo "<th>To Address</th>";
        echo "<th>To Address</th>";
        echo "<th>To Number</th>";
        echo "<th>To Number</th>";
        echo "<th>Service</th>";
        echo "<th>Counter Part</th>";
        echo "<th>Weight</th>";
        echo "<th>Charge Per Kg</th>";
        echo "<th>Other Charge</th>";
        echo "<th>Customer Fee</th>";
        echo "<th>Tracking Number</th>";
        echo "<th>Airway Bill No</th>";
        echo "<th>Link</th>";
        echo "<th>Status</th>";
        echo "<th>Payment</th>";
        echo "<th>Remarks</th>";
        echo "</tr>";
        echo "</thead>";
        
        while($row = mysqli_fetch_array($result)){
         
          echo "<tbody>";
          echo "<tr>";
          echo "<td align=\"center\">" ."<font color=\"#2A4D94\">" . $row['Speedway_No'] ."</font>" . "</td>";    
          echo "<td>" . $row['Date'] . "</td>";
          echo "<td>" . $row['Origin'] . "</td>";
          echo "<td>" . $row['Country'] .  "</td>";
          echo "<td>" . $row['Destination'] . "</td>";
          echo "<td>" . $row['From_Name'] . "</td>";
          echo "<td>" . $row['From_Address'] . "</td>";
          echo "<td>" . $row['From_Address2'] . "</td>";
          echo "<td>" . $row['From_Number'] . "</td>";
          echo "<td>" . $row['To_Name'] . "</td>";
          echo "<td>" . $row['To_Address'] . "</td>";
          echo "<td>" . $row['To_Address2'] . "</td>";
          echo "<td>" . $row['To_Address3'] . "</td>";
          echo "<td>" . $row['To_Address4'] . "</td>";
          echo "<td>" . $row['To_Number'] . "</td>";
          echo "<td>" . $row['To_Number2'] . "</td>";
          echo "<td>" . $row['Service'] . "</td>";
          echo "<td>" . $row['Counter_Part'] . "</td>";
          echo "<td>" . $row['Weight'] . "</td>";
          echo "<td>" . $row['CPK'] . "</td>";
          echo "<td>" . $row['OC'] . "</td>";
          echo "<td>" . $row['Customer_Fee'] . "</td>";
          echo "<td>" . $row['Tracking_Number'] . "</td>";
          echo "<td>" . $row['Tracking_Website'] . "</td>";
          echo "<td>" . $row['Link'] . "</td>";
          echo "<td>" . $row['Status'] . "</td>";
          echo "<td>" . $row['Payment'] . "</td>";
          echo "<td>" . $row['Remarks'] . "</td>";
          echo "</tr>";
          echo "</tbody>";
     
      }
      
    }
    
  }
  ?>
  </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="data.js"></script>
  </body>
</html>