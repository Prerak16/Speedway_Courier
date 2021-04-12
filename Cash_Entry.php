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

    $Counter_Part = $_POST['Counter_Part'];
    $Date = $_POST['Date'];
    $To_Name = strtoupper($_POST['To_Name']);
    $Speedway_Name = strtoupper($_POST['Speedway_Name']);
    $Payment = $_POST['Payment'];
    $Remark = $_POST['Remark'];

    $sql1 = "insert into account (Counter_Part,Date,To_Name,Speedway_Name,Payment,Remark) values ('$Counter_Part', '$Date', '$To_Name', '$Speedway_Name', '$Payment', '$Remark')";

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
    <title>Cash</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

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
        <a href="Account.php">
            < Back</a> <p class="h3" style="color:blue;">Cash Entry Form</p>
                <br />
                <form method="POST">
                    <div class="row">

                        <div class="form-group col-md-2">
                        <label for="Counter_Part">Counter Part</label>
                        <?php
                        //$link = mysqli_connect("localhost", "root", "", "hhh");
                        $sql="SELECT Counter_Part FROM counter_part"; 

                        echo "<select name=\"Counter_Part\" class=\"form-control\" id=\"Counter_Part\"></option>"; 
                        echo "<option value=\"Select Counter Part\">Select Counter Part</option>";
                        foreach ($link->query($sql) as $row){
                            echo "<option value= $row[Counter_Part]>$row[Counter_Part]</option>"; 
                         }

                         echo "</select>";
                        ?>

                        </div>

                        <div class="form-group col-md-2">
                            <label for="Date">Date</label>
                            <input type="date" class="form-control" name="Date" id="Date" required>
                        </div>


                        <div class="form-group col-md-2">
                            <label for="To_Name">To Name</label>
                            <input type="text" class="form-control" name="To_Name" id="To_Name" placeholder="Enter To Name" required>

                        </div>

                        <div class="form-group col-md-2">
                            <label for="Speedway_Name">Speedway Name</label>
                            <input type="text" class="form-control" name="Speedway_Name" id="Speedway_Name" placeholder="Enter Speedway Name"  required>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="Payment">Payment</label>
                            <input type="float" class="form-control" name="Payment" id="Payment" placeholder="Enter Payment" required>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="Remark">Remark</label>
                            <input type="text" class="form-control" name="Remark" id="Remark" placeholder="Enter Remark">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">

                            <input type="submit" name="submit" class="btn btn-outline-primary" value="Save" />
                        </div>
                    </form>
                    </div>

    <hr/>

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

    </div>
    <br/>
   
    <div class="row">
    <?php
     if(isset($_POST['Search'])){
        $Search_Counter_Part = $_POST['Search_Counter_Part'];
// $conn = mysqli_connect("localhost", "root", "", "hhh");
    $sql2 = "SELECT Counter_Part,date_format(Date,'%d-%m-%Y') AS Date, To_Name, Speedway_Name,Payment,Remark FROM account WHERE Counter_Part = '$Search_Counter_Part' ";
    if($result = mysqli_query($link, $sql2)){
        if(mysqli_num_rows($result)>0){
            
            echo "<table class=\"table table-bordered\" id=\"myTable\">";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Index</th>";
            echo "<th>Counter_Part</th>";
            echo "<th>Date</th>";
            echo "<th>To Name</th>";  
            echo "<th>Speedway Name</th>"; 
            echo "<th>Payment</th>";
            echo "<th>Remark</th>";           
            echo "</tr>";
            echo "</thead>";
            $counter = 1;
            while($row = mysqli_fetch_array($result)){
                
            echo "<tbody>";
            echo "<tr>";
            echo "<td align=\"center\">". $counter . "</td>";
            echo "<td>"  . $row['Counter_Part'] . "</td>";
            echo "<td>"  . $row['Date'] . "</td>";    
            echo "<td>"  . $row['To_Name'] . "</td>";
            echo "<td>"  . $row['Speedway_Name'] . "</td>";
            echo "<td>"  . $row['Payment'] . "</td>";
            echo "<td>"  . $row['Remark'] . "</td>";
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

<script>
document.querySelector("#Date").valueAsDate = new Date();

</script>