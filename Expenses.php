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
    $Date = $_POST['Date'];
    $RS = $_POST['RS'];
    $Note = $_POST['Note'];

    $sql = "insert into expenses (Date, RS, Note) values ('$Date', '$RS', '$Note')";

    if(mysqli_query($link, $sql)){
        echo "<script>alert(\"Record Added Succesfully.\");</script>";
    }
    else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
      }
  }

  $sql2 = "SELECT concat('',format(SUM(RS),2)) AS Total FROM expenses";
$result = mysqli_query($link,$sql2);
while ($row = mysqli_fetch_assoc($result)){
    $Total = $row['Total'];
   
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Expenses</title>
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

.tab{
    max-height: 500px;
  overflow: auto;
}

        </style>
</head>

<body>
    <div class="container">
        <a href="Admin_Dashboard.php">
            < Back to Home</a> <p class="h3" style="color:blue;">Expenses</p>
                <br />
                <div class="row">
                <div class="col-6">
                    <form method="POST">
                        <div class="form-group">
                            <label for="Date">Date</label>
                            <input type="date" class="form-control" name="Date" id="Date" style="width:400px;"
                                aria-describedby="emailHelp" autocomplete="off" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Rupees</label>
                            <input type="float" class="form-control" name="RS" id="RS" style="width:400px;"
                                placeholder="Enter Rs." required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Note</label>
                            <input type="text" class="form-control" name="Note" id="Note" style="width:400px;"
                                placeholder="Enter Note" required>
                        </div>
                        <br />
                        <input type="submit" name="submit" class="btn btn-outline-primary" value="Save" />
                    </form>
                </div>
                <div class="col-6 tab">
                <p class="h4" style="color:RED;">Total Expenses : <?php echo "$Total" . " Rs."; ?></p>
                <?php
                   // $conn = mysqli_connect("localhost", "root", "", "hhh");
                    $sql1 = "SELECT Date, RS, Note FROM expenses ORDER BY Date DESC ";
                    if($result = mysqli_query($link, $sql1)){
                        if(mysqli_num_rows($result)>0){
                            
                            echo "<table class=\"table table-bordered\" id=\"myTable\">";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>Index</th>";
                            echo "<th>Date</th>";
                            echo "<th>RS.</th>";  
                            echo "<th>Note</th>";            
                            echo "</tr>";
                            echo "</thead>";
                            $counter = 1;
                            while($row = mysqli_fetch_array($result)){
                                
                            echo "<tbody>";
                            echo "<tr>";
                            echo "<td align=\"center\">". $counter . "</td>";
                            echo "<td>"  . $row['Date'] . "</td>";    
                            echo "<td>" . $row['RS'] . "</td>";
                            echo "<td>"  . $row['Note'] . "</td>";
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