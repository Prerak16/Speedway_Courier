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
  include 'connection.php';
$sql2 = "SELECT COUNT(*) AS Total FROM speedway";
$result = mysqli_query($link,$sql2);
while ($row = mysqli_fetch_assoc($result)){
    $Total = $row['Total'];
   
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
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
  <a href="Admin_Dashboard.php"> < Back to Home</a>
  <div class="row">
  <div class="col">
  <p class="h3" style="color:blue;">All Records &nbsp; &nbsp; &nbsp; Total : <?php echo "$Total"; ?> </p>
  </div>
  <div class="col">
  <input type="text" class="form-control" style="width:400px;" placeholder="Search Here" id="search_field" autofocus> 
  </div>
  <div class="col">
  <button type="button" class="btn btn-outline-danger" id="delete">Delete Selected </button>
  </div>
  <div class="col">
  <a href="UserReport_Export.php">
  <button type="button" class="btn btn-outline-success" id="Excel">Export To Excel</button>
  </a>
  </div>
  <div class="col">
  <a href="UserReport_Export_Email.php">
  <button type="button" class="btn btn-danger" id="delete">Delete Data & Send</button>
  </a>
  </div>
  </div>
  <br/>
  <?php
  
  include 'function.php'; 

  $sql = "SELECT id,Speedway_No, Date, Origin,Country,Destination,From_Name,From_Address,From_Address2,From_Number,To_Name,To_Address,To_Address2,To_Address3,To_Address4,To_Number,To_Number2, Service,Counter_Part, Weight, CPK, OC,Customer_Fee,Service_Fee,PR,Tracking_Number,Tracking_Website,Link,Status,Payment,Remarks FROM speedway ORDER BY Date DESC";
  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result)>0){
      
        echo "<table class=\"table table-bordered\" id=\"myTable\">";
        echo "<thead>";
        echo "<tr class=\"myHead\">";
        echo "<th><input type=\"checkbox\" id=\"checkAll\"></th>";
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
        echo "<th>Service Fee</th>";
        echo "<th>PR</th>";
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
          echo "<td><input class=\"checkbox\" type=\"checkbox\" id=\" ".$row['id'] ."\" name=\"id[]\"></td>";
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
          echo "<td>" . $row['Service_Fee'] . "</td>";
          echo "<td>" . $row['PR'] . "</td>";
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
    
    <script src="data.js"></script>
  </body>
</html>

<script>
$(document).ready(function(){
      $('#checkAll').click(function(){
         if(this.checked){
             $('.checkbox').each(function(){
                this.checked = true;
             });   
         }else{
            $('.checkbox').each(function(){
                this.checked = false;
             });
         } 
      });


    $('#delete').click(function(){
       var dataArr  = new Array();
       if($('input:checkbox:checked').length > 0){
          $('input:checkbox:checked').each(function(){
              dataArr.push($(this).attr('id'));
              $(this).closest('tr').remove();
          });
          sendResponse(dataArr)
       }else{
         alert('No record selected ');
       }

    });  


    function sendResponse(dataArr){
        $.ajax({
            type    : 'post',
            url     : 'function.php',
            data    : {'data' : dataArr},
            success : function(response){
                        alert(response);
                      },
            error   : function(errResponse){
                      alert(errResponse);
                      }                     
        });
    }

  });
</script>