<?php
session_start(); 
$role = $_SESSION['Role'];

  if(isset($_SESSION['Role'])) {

    if($role == "Employee"){
        if (time() - $_SESSION['timestamp'] > 600){
            header('Location: logout.php');
            }
          else{
            $_SESSION['timestamp'] = time();
          }      
    }
    else{
        header('Location: logout.php');
    }
  }
  else{
    header('Location: logout.php');
  }

  if(isset($_POST['submit'])){

    include 'connection.php';
    
    
        $Speedway_No = $_POST["id"];
        $Date = $_POST["Date"];
        $Origin = $_POST["Origin"];
        $Country = strtoupper($_POST["Country"]);
        $Destination = strtoupper($_POST["Destination"]);
        $From_Name = strtoupper($_POST["From_Name"]);
        $From_Address = strtoupper($_POST["From_Address"]);
        $From_Address2 = strtoupper($_POST["From_Address2"]);
        $From_Number = $_POST["From_Number"];
        $To_Name = strtoupper($_POST["To_Name"]);
        $To_Address = strtoupper($_POST["To_Address"]);
        $To_Address2 = strtoupper($_POST["To_Address2"]);
        $To_Address3 = strtoupper($_POST["To_Address3"]);
        $To_Address4 = strtoupper($_POST["To_Address4"]);
        $To_Number = $_POST["To_Number"];
        $To_Number2 = $_POST["To_Number2"];
        $Service = strtoupper($_POST["Service"]);
        $Counter_Part = $_POST["Counter_Part"];
        $Weight = $_POST["Weight"];
        $CPK = $_POST["CPK"];
        $OC = $_POST["OC"];
        $Customer_Fee = $_POST["Customer_Fee"];
        $Service_Fee = 0;
        //$PR = $Customer_Fee - $Service_Fee;
        $Tracking_Number = $_POST["Tracking_Number"];
        $Tracking_Website = $_POST["Tracking_Website"];
        $Link = $_POST["Link"];
        $Status = strtoupper($_POST["Status"]);
        $Payment = $_POST["Payment"];
        $Remarks = $_POST["Remarks"];

        $sql3 = "SELECT * FROM speedway WHERE Speedway_No = '$Speedway_No' ";
        $res=mysqli_query($link,$sql3);
        if (mysqli_num_rows($res) > 0){
            $sql4 = "update speedway set Speedway_No='$Speedway_No', Date='$Date', Origin='$Origin', Country='$Country', Destination='$Destination', From_Name='$From_Name', From_Address='$From_Address', From_Address2='$From_Address2', From_Number='$From_Number', To_Name='$To_Name', To_Address='$To_Address', To_Address2='$To_Address2', To_Address3='$To_Address3', To_Address4='$To_Address4', To_Number='$To_Number', To_Number2='$To_Number2', Service='$Service', Counter_Part='$Counter_Part', Weight='$Weight', CPK='$CPK', OC='$OC', Customer_Fee='$Customer_Fee', Tracking_Number='$Tracking_Number', Tracking_Website='$Tracking_Website', Link='$Link', Status='$Status', Payment='$Payment', Remarks='$Remarks' where Speedway_No = '$Speedway_No'";
            if(mysqli_query($link, $sql4)){
                echo "<script>alert(\"Record Update Succesfully.\");</script>";
            }
            else{
                echo "ERROR: Could not able to execute $sql4. " . mysqli_error($link);
              }

        }
        else{
            $sql = "insert into speedway ( Speedway_No, Date, Origin, Country, Destination, From_Name, From_Address, From_Address2, From_Number, To_Name, To_Address, To_Address2, To_Address3, To_Address4, To_Number, To_Number2, Service, Counter_Part, Weight, CPK, OC, Customer_Fee, Service_Fee, Tracking_Number, Tracking_Website, Link, Status, Payment, Remarks) values('$Speedway_No','$Date','$Origin','$Country','$Destination','$From_Name', '$From_Address', '$From_Address2', '$From_Number', '$To_Name', '$To_Address', '$To_Address2', '$To_Address3', '$To_Address4', '$To_Number', '$To_Number2', '$Service', '$Counter_Part', '$Weight', '$CPK', '$OC', '$Customer_Fee', '$Service_Fee', '$Tracking_Number', '$Tracking_Website', '$Link', '$Status', '$Payment', '$Remarks')";

            if(mysqli_query($link, $sql)){
                echo "<script>alert(\"Record Added Succesfully.\");</script>";
            }
            else{
              echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
            }
        }
        
    
       
    }

?>

<!doctype html>
<html lang="en">

<head>
    <title>Data Form</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="process.js"></script>
    
    <style>
    .log_out {
        float: right;
        margin-top: 5px;
    }

    .reset {
        margin-top: 5px;
    }
    </style>
</head>

<body>
    <div class="container-fluid">

        <div class="container">
            <div class="row">
                <div class="col-4">
                    <p class="h3" style="color:blue;">Data Entry Form</p>
                </div>
                <div class="col-4">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="Full_Data.php">All Records</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="" data-toggle="modal" data-target="#exampleModalCenter">Pending
                                Tracking No</a>
                        </li>
                    </ul>
                </div>
                <div class="col-4">
                    <button class="btn btn-outline-info reset" onclick="Reset()">Reset</button>
                    <a href="logout.php"><button class="btn btn-outline-danger log_out">Log Out</button></a>

                </div>
            </div>
        </div>

        <form method="POST">
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="Speedway_No">Speedway No.</label>
                    <input type="number" class="form-control" style="color:blue;" id="id" name="id"
                        placeholder="Enter Speedway No." autocomplete="nofill">
                </div>
                <div class="form-group col-md-2">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label for="">For Data Retrive</label>
                    <br />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <!--<input type="submit" class="btn btn-outline-success" name="btn-search" id="btn-search" value="Show Data" />-->
                    <button type="button" class="btn btn-outline-primary" id="btn_search">Search</button>
                </div>
                <div class="form-group col-md-2">
                    <label for="Date">Date</label>
                    <input type="date" class="form-control" style="color: black;" id="Date" name="Date"
                        placeholder="Date">
                </div>
                <div class="form-group col-md-2">
                    <label for="Origin">Origin</label>
                    <input type="text" class="form-control" style="color: black;" id="Origin" name="Origin"
                        value="INDIA" placeholder="Enter Origin" readonly>
                </div>
                <div class="form-group col-md-2">
                    <label for="Country">Country</label>
                    <input type="text" class="form-control" style="color: black;" id="Country" name="Country"
                        placeholder="Enter Country" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="Destination">Destination</label>
                    <input type="text" class="form-control" style="color: black;" id="Destination" name="Destination"
                        placeholder="Enter Destination" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="From_Name">From Name</label>
                    <input type="text" class="form-control" style="color: black;" id="From_Name" name="From_Name"
                        placeholder="Enter Name" autocomplete="nofill" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="From_Address">From Address</label>
                    <input type="text" class="form-control" style="color: black;" id="From_Address" name="From_Address"
                        placeholder="Enter Street Name" autocomplete="nofill">
                    <input type="text" class="form-control" style="color: black;" id="From_Address2"
                        name="From_Address2" placeholder="Enter Area" autocomplete="nofill">
                </div>
                <div class="form-group col-md-4">
                    <label for="From_Number">From Number</label>
                    <input type="text" class="form-control" style="color: black;" id="From_Number" name="From_Number"
                        placeholder="Enter Mobile Number" autocomplete="nofill">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="To_Name">To Name</label>
                    <input type="text" class="form-control" style="color: black;" id="To_Name" name="To_Name"
                        placeholder="Enter Name" autocomplete="nofill" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="To_Address">To Address</label>
                    <input type="text" class="form-control" style="color: black;" id="To_Address" name="To_Address"
                        placeholder="Enter Street Name" autocomplete="nofill">
                    <input type="text" class="form-control" style="color: black;" id="To_Address2" name="To_Address2"
                        placeholder="Enter House No." autocomplete="nofill">
                    <input type="text" class="form-control" style="color: black;" id="To_Address3" name="To_Address3"
                        placeholder="Enter City" autocomplete="nofill">
                    <input type="text" class="form-control" style="color: black;" id="To_Address4" name="To_Address4"
                        placeholder="Enter Pincode" autocomplete="nofill">
                </div>
                <div class="form-group col-md-4">
                    <label for="To_Number">To Number</label>
                    <input type="text" class="form-control" style="color: black;" id="To_Number" name="To_Number"
                        placeholder="Enter Mobile Number" autocomplete="nofill">
                    <input type="text" class="form-control" style="color: black;" id="To_Number2" name="To_Number2"
                        placeholder="Enter Mobile Number" autocomplete="nofill">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="Service">Service</label>
                    <input type="text" class="form-control" style="color: black;" id="Service" name="Service"
                        placeholder="Enter Service Name">
                </div>
                <div class="form-group col-md-2">
                    <label for="Counter_Part">Counter Part</label>
                    <?php
                        $link = mysqli_connect("localhost", "root", "Abp@216", "ppa488");
                        $sql1="SELECT Counter_Part FROM counter_part"; 

                        echo "<select name=\"Counter_Part\" class=\"form-control\" id=\"Counter_Part\" required></option>"; 
                        echo "<option value=\"Select Counter Part\">Select Counter Part</option>";
                        foreach ($link->query($sql1) as $row){
                            echo "<option value= $row[Counter_Part]>$row[Counter_Part]</option>"; 
                         }

                         echo "</select>";
                    ?>

                </div>
                <div class="form-group col-md-2">
                    <label for="Weight">Weight</label>
                    <div class="input-group">
                        <input type="float" class="form-control" style="color: black;" id="Weight" name="Weight"
                            placeholder="Enter Weight" autocomplete="nofill">
                        <div class="input-group-append">
                            <span class="input-group-text" id="inputGroupPrepend">Kg.</span>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <label for="CPK">Charge Per Kg</label>
                    <input type="number" class="form-control" style="color: black;" id="CPK" name="CPK"
                        placeholder="Enter Charge" autocomplete="nofill">

                </div>
                <div class="form-group col-md-2">
                    <label for="OC">Other Charges</label>
                    <input type="float" class="form-control" style="color: black;" id="OC" name="OC"
                        onblur="calculate()" placeholder="Enter Other Charges" autocomplete="nofill">

                </div>
                <div class="form-group col-md-2">

                    <label for="Customer_Fee">Customer Fee</label>
                    <div class="input-group">
                        <input type="float" class="form-control" style="color: black;" id="Customer_Fee"
                            name="Customer_Fee" placeholder="Enter Customer Fee" autocomplete="nofill">
                        <div class="input-group-append">
                            <span class="input-group-text" id="inputGroupPrepend">Rs.</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="Tracking_Number">Tracking Number</label>

                    <div class="input-group">

                        <input type="text" class="form-control" style="color: black;" id="Tracking_Number"
                            name="Tracking_Number" placeholder="Enter Tracking Number" autocomplete="nofill" />
                        <div class="input-group-append">
                            <a href="Add_Box.php" target="_blank"><button type="button"
                                    class="btn btn-secondary">+</button></a>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <label for="Tracking_Website">Airway Bill No.</label>
                    <input type="text" class="form-control" style="color: black;" id="Tracking_Website"
                        name="Tracking_Website" placeholder="Enter Airway Bill No." autocomplete="nofill">
                </div>
                <div class="form-group col-md-2">
                    <label for="Link">Link</label>
                    <input type="text" class="form-control" style="color: black;" id="Link" name="Link"
                        placeholder="Enter Tracking Link" autocomplete="nofill">
                </div>
                <div class="form-group col-md-2">
                    <label for="Status">Status</label>
                    <input type="text" class="form-control" style="color: black;" id="Status" name="Status"
                        placeholder="Enter Status">
                </div>
                <div class="form-group col-md-2">
                    <label for="Payment">Payment</label>
                    <select class="form-control" id="Payment" name="Payment">
                        <option value="Done">Payment Done</option>
                        <option value="Not Done">Not Done</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="Remarks">Remarks</label>
                    <input type="text" class="form-control" style="color: red;" id="Remarks" name="Remarks"
                        placeholder="Enter Remarks" autocomplete="nofill">
                </div>
            </div>

            <input type="submit" name="submit" class="btn btn-outline-primary" value="Save" />
        </form>
    </div>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Pending Tracking No List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    
                    //$conn = mysqli_connect("localhost", "root", "", "hhh");
                    $sql2 = "SELECT Speedway_No FROM speedway WHERE Tracking_Number = '' ORDER BY Date ASC ";
                    if($result = mysqli_query($link, $sql2)){
                        if(mysqli_num_rows($result)>0){
                            
                            echo "<table class=\"table-sm table-bordered\" id=\"myTable\">";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>Index</th>";
                            echo "<th>Speedway No</th>";              
                            echo "</tr>";
                            echo "</thead>";
                            $counter = 1;
                            while($row = mysqli_fetch_array($result)){
                                
                            echo "<tbody>";
                            echo "<tr>";
                            echo "<td align=\"center\">". $counter . "</td>";
                            echo "<td align=\"center\">" ."<font color=\"#2A4D94\">" . $row['Speedway_No'] ."</font>" . "</td>";    
                            
                            $counter++;
                            echo "</tr>";
                            echo "</tbody>";

                            }

                        }

                    }
                    ?>

                </div>

            </div>
        </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>

</body>

</html>

<script>
$(document).ready(function() {
    $(window).keydown(function(event) {
        if ((event.keyCode == 13) && ($(event.target)[0] != $("textarea")[0])) {
            event.preventDefault();
            return false;
        }
    });
});

document.querySelector("#Date").valueAsDate = new Date();

document.getElementById("OC").defaultValue = 0;

calculate = function() {
    var Weight = document.getElementById('Weight').value;
    var CPK = document.getElementById('CPK').value;
    var Cal = Weight * CPK;
    var OC = document.getElementById('OC').value;
    var plus = +Cal + +OC;
    var final = plus.toFixed(2);
    document.getElementById('Customer_Fee').value = final;

}

function Reset() {
    location.reload();
}
</script>