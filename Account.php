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
  

  if(isset($_POST['submit'])){

    $Counter_Part = strtoupper( str_replace(' ','_', $_POST['Counter_Part']));

    $sql1 = "insert into counter_part values ('$Counter_Part')";

    if(mysqli_query($link, $sql1)){
        echo "<script>alert(\"Record Added Succesfully.\");</script>";
    }
    else{
        echo "ERROR: Could not able to execute $sql1. " . mysqli_error($link);
      }

  }

?>

<!doctype html>
<html lang="en">

<head>
    <title>Account Section</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <style>
    body {
        padding-top: 5px;
    }

    table.table-bordered>thead>tr>th {
        border: 1px solid black;
        background-color: rgb(172, 172, 172);

        font-family: 'arial', sans-serif;
    }

    table.table-bordered>tbody>tr>td {
        border: 1px solid black;
        font-family: 'arial', sans-serif;
    }
    </style>
</head>

<body>
    <div class="container-fluid">

        <div class="row">
            <div class="col">
                <a href="Admin_Dashboard.php">
                    < Back To Home</a> </div> <div class="col" align="center">
                        <p class="h3" style="color:blue;">Account Data</p>
            </div>
            <div class="col" align="right">
                <a href="Cash_Entry.php">
                    <button type="button" class="btn btn-outline-success" id="Cash">Cash Entry</button>
                </a>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-2">
                <form method="POST">
                    <?php
        
        //$link = mysqli_connect("localhost", "root", "", "hhh");
        $sql3="SELECT Counter_Part FROM counter_part"; 

        echo "<select name=\"Search_Counter_Part\" class=\"form-control\" id=\"Search_Counter_Part\" ></option>"; 
        echo "<option value=\"Select Counter Part\">Select Counter Part</option>";
        foreach ($link->query($sql3) as $row){
            echo "<option value= $row[Counter_Part]>$row[Counter_Part]</option>"; 
            }

            echo "</select>";
        ?>
            </div>

            <div class="col-2">
                <input type="submit" name="Search" class="btn btn-outline-primary" value="Search" />
            </div>
            </form>

            <div class="col-2">
                <a href="" data-toggle="modal" data-target="#exampleModalCenter">
                    <button type="button" class="btn btn-outline-success" id="Counter Part">Add Counter Part</button>
                </a>
            </div>

            <div class="col-2">
                <a href="" data-toggle="modal" data-target="#exampleModalCenter2">
                    <button type="button" class="btn btn-danger" id="generate">Create PDF</button>
                </a>
            </div>

        </div>
        <br />

        <?php
      if(isset($_POST['Search'])){

    
    $Search_Counter_Part = $_POST['Search_Counter_Part'];

    $sql4 = "SELECT SUM(Service_Fee) AS Service_Fee,Counter_Part FROM speedway WHERE Counter_Part = '$Search_Counter_Part'";
    $result = mysqli_query($link,$sql4);
    while ($row = mysqli_fetch_assoc($result)){
        $Service_Fee = $row['Service_Fee'];
        $Counter_Part = $row['Counter_Part'];
       
    }

    $sql5 = "SELECT SUM(Payment) AS Payment FROM account WHERE Counter_Part = '$Search_Counter_Part'";
    $result = mysqli_query($link,$sql5);
    while ($row = mysqli_fetch_assoc($result)){
        $Payment =  $row['Payment'];
    }

    $Delay = number_format( $Service_Fee - $Payment,2) ;

    echo "<div class=\"row\">";

    echo "<div class=\"col\">";
    echo "<p class=\"h4\" style=\" color:#407af7;\">Service Fee : ". $Service_Fee ." Rs. </p>";
    echo "</div>";

    echo "<div class=\"col\">";
    echo "<p class=\"h4\" style=\" color:#407af7;\">Total Payment : ". $Payment ." Rs. </p>";
    echo "</div>";

    echo "<div class=\"col\">";
    echo "<p class=\"h4\" style=\" color:#dd3030;\">Delay Payment : ". $Delay ." Rs. </p>";
    echo "</div>";

    echo "</div>";


    echo "<div class=\"row\">";
  
    $sql2 = "SELECT Speedway_No,date_format(Date,'%d-%m-%Y') AS Date, Country, Destination, To_Name, Service, Weight, Service_Fee, Tracking_Website FROM speedway WHERE Counter_Part = '$Search_Counter_Part' ";
    if($result = mysqli_query($link, $sql2)){
        if(mysqli_num_rows($result)>0){
            
            echo "<table class=\"table table-bordered\" id=\"myTable\">";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Index</th>";
            echo "<th>Speedway No</th>";
            echo "<th>Date</th>";
            echo "<th>Country</th>";  
            echo "<th>Destination</th>"; 
            echo "<th>To Name</th>";
            echo "<th>Service</th>";
            echo "<th>Weight</th>";
            echo "<th>Service Fee</th>";           
            echo "<th>Airway Bill No.</th>";
            echo "</tr>";
            echo "</thead>";
            $counter = 1;
             
            while($row = mysqli_fetch_array($result)){
                
            echo "<tbody>";
            echo "<tr>";
            echo "<td align=\"center\">". $counter . "</td>";
            echo "<td>"  . $row['Speedway_No'] . "</td>";
            echo "<td>"  . $row['Date'] . "</td>";    
            echo "<td>"  . $row['Country'] . "</td>";
            echo "<td>"  . $row['Destination'] . "</td>";
            echo "<td>"  . $row['To_Name'] . "</td>";
            echo "<td>"  . $row['Service'] . "</td>";
            echo "<td>"  . $row['Weight'] . "</td>";
            echo "<td>"  . $row['Service_Fee'] . "</td>";
            echo "<td>"  . $row['Tracking_Website'] . "</td>";
            $counter++;
            echo "</tr>";
            echo "</tbody>";
    
            }
    
        }
    
    }
    }

?>

    </div>


    </div>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Counter Part</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <label for="Counter_Part">Counter Part</label>
                        <input type="text" class="form-control" name="Counter_Part" id="Counter_Part"
                            placeholder="Enter Counter Part" required>

                        <br />
                        <input type="submit" name="submit" class="btn btn-outline-primary" value="Save" />
                    </form>


                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Create PDF</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" target="_blank" action="generate_pdf.php">
                        <?php
                            $sql6="SELECT Counter_Part FROM counter_part"; 

                            echo "<select name=\"Counter_Part_Pdf\" class=\"form-control\" id=\"Counter_Part_Pdf\" required ></option>"; 
                            echo "<option value=\"Select Counter Part\">Select Counter Part</option>";
                            foreach ($link->query($sql6) as $row){
                                echo "<option value= $row[Counter_Part]>$row[Counter_Part]</option>"; 
                                }

                                echo "</select>";
                         ?>
                       
                        <label for="From_Date">From Date</label>
                        <input type="date" class="form-control mb-2 mr-sm-2" id="From_Date" name="From_Date"
                            placeholder="Date" required>
            
                        <label for="To_Date">To Date</label>
                        <input type="date" class="form-control mb-2 mr-sm-2" id="To_Date" name="To_Date"
                            placeholder="Date" required>

                        <br />
                        <input type="submit" name="generate_pdf" class="btn btn-outline-primary" value="Create" />
                    </form>


                </div>

            </div>
        </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
</body>

</html>