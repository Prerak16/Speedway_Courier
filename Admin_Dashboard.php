<?php

session_start(); 
$role = $_SESSION['Role'];

if(isset($_SESSION['Role'])) {

if($role == "Admin"){
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

include 'connection.php';

$sql = "SELECT COUNT(Service_Fee) AS Total FROM speedway WHERE Service_Fee = 0";

$result = mysqli_query($link,$sql);
while ($row = mysqli_fetch_assoc($result)){
    $Service_Fee = $row['Total'];
   
}

$sql1 = "SELECT COUNT(Payment) AS Pay FROM speedway WHERE Payment = 'Not Done'";
$result = mysqli_query($link,$sql1);
while ($row = mysqli_fetch_assoc($result)){
    $Payment = $row['Pay'];
   
}


if(isset($_POST['submit'])){
      
    // $link = mysqli_connect("localhost", "root", "", "hhh");
    $Date1 = $_POST['From_Date'];
    $Date2 = $_POST['To_Date'];
    $sql2 = "SELECT COUNT(*) AS Courier FROM speedway WHERE Date BETWEEN '$Date1' AND '$Date2'";
    $result = mysqli_query($link,$sql2);
    while ($row = mysqli_fetch_assoc($result)){
    $Courier = $row['Courier'];
    }  
   
    $sql3 = "SELECT SUM(Customer_Fee) AS Turn_Over FROM speedway WHERE Date BETWEEN '$Date1' AND '$Date2'";
    $result = mysqli_query($link,$sql3);
    while ($row = mysqli_fetch_assoc($result)){
    $Turn_Over = number_format($row['Turn_Over'],2);
    } 
    
    $sql8 = "SELECT SUM(RS) AS RS FROM expenses WHERE Date BETWEEN '$Date1' AND '$Date2'";
    $result = mysqli_query($link,$sql8);
    while ($row = mysqli_fetch_assoc($result)){
        $RS = $row['RS'];
    }

    $sql4 = "SELECT SUM(PR) AS PR FROM speedway WHERE Date BETWEEN '$Date1' AND '$Date2'";
    $result = mysqli_query($link,$sql4);
    while ($row = mysqli_fetch_assoc($result)){
     $PR =$row['PR'] ;
    } 
    
    $PR_Total =  number_format( $PR - $RS,2);

    $sql5 = "SELECT COUNT(Payment) AS Payment FROM speedway WHERE Date BETWEEN '$Date1' AND '$Date2' AND Payment = 'Not Done'";
    $result = mysqli_query($link,$sql5);
    while ($row = mysqli_fetch_assoc($result)){
    $Payment2 = $row['Payment'];
    }
  }
   



$query = "SELECT * FROM graph";
$result = mysqli_query($link,$query);
$chart_data = '';
while ($row = mysqli_fetch_assoc($result)){
    $chart_data .= "{ month:'".$row["Month"]."', Profit:".$row["Profit"]."}, ";
}
$chart_data = substr($chart_data, 0, -2);


$sql9 = "SELECT * FROM graph";
$result = mysqli_query($link,$sql9);
$chart_data_2 = '';
while ($row = mysqli_fetch_assoc($result)){
    $chart_data_2 .= "{ month:'".$row["Month"]."', Courier:".$row["Courier"]."}, ";
}
$chart_data_2 = substr($chart_data_2, 0, -2);


if(isset($_POST['Lock'])){
    $sql10 = "update access set Permission='Lock' ";
            if(mysqli_query($link, $sql10)){
                echo "<script>alert(\"Employee Form Locked.\");</script>";
            }
            else{
                echo "ERROR: Could not able to execute $sql10. " . mysqli_error($link);
              }
}


if(isset($_POST['Unlock'])){
    $sql11 = "update access set Permission='Unlock' ";
            if(mysqli_query($link, $sql11)){
                echo "<script>alert(\"Employee Form Unlocked.\");</script>";
            }
            else{
                echo "ERROR: Could not able to execute $sql11. " . mysqli_error($link);
              }
}


?>

<!doctype html>
<html lang="en">

<head>
    <title>Dashboard</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <style>
    body {
        padding-top: 10px;
    }

    .log_out {
        
        margin-top: 10px;
    }
    .card{
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.1), 0 4px 7px 0 rgba(0, 0, 0, 0.19); 
    }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
                <img src="images/Copy of s2.jpg" name="Speedway" class="img-fluid" alt="Logo"
                    style="width:250px; height:70px;" />
            </div>
            <div class="col-4" align="center">
                <p class="display-4 headline " style="font-size: 40px; color:blue;">Admin Dashboard</p>
            </div>
            <div class="col-4" align="right">
            <a href="logout.php"><button class="btn btn-outline-danger log_out">Log Out</button></a>
            </div>
        </div>
        <hr />

        <div class="row">
            <div class="col-2">
                <div class="card border-danger mb-3" style="max-width: 15rem;">
                    <div class="card-body text-danger">
                    <a href="Service_Fee.php" style="color:red;">
                        <h5 class="card-title" style="font-size:30px;"><?php echo "$Service_Fee"; ?></h5>
                    </a>
                        <p class="card-text" style="color:black;">Update Service Fee</p>
                    </div>
                </div>
            </div>
            <div class="col-2">
                 <div class="card border-danger mb-3" style="max-width: 15rem;">
                    <div class="card-body text-danger">
                    <a href="" style="color:Red;" data-toggle="modal" data-target="#exampleModalCenter">
                        <h5 class="card-title" style="font-size:30px; "><?php echo "$Payment"; ?></h5>
                    </a>
                        <p class="card-text" style="color:black;">Pending Payments</p> 
                    </div>
                </div>
            </div>
            <div class=" col-2">
                <div class="card border-primary mb-3" style="max-width: 15rem;">
                    <div class="card-body text-primary">
                    <a href="Admin_Data.php">
                    
                    <img src="images/database.png" style="width:50px; height:50px;"/>
                    </a>
                        <p class="card-text" style="color:black;">All Records</p>
                    </div>
                </div>
            </div>
            <div class=" col-2">
                <div class="card border-primary mb-3" style="max-width: 15rem;">
                    <div class="card-body text-primary">
                    <a href="Account.php">
                    
                    <img src="images/account.png" style="width:50px; height:50px;"/>
                    </a>
                        <p class="card-text" style="color:black;">Account</p>
                    </div>
                </div>
            </div>
            <div class=" col-2">
                <div class="card border-primary mb-3" style="max-width: 15rem;">
                    <div class="card-body text-primary">
                    <a href="Expenses.php">
                    
                    <img src="images/expenses.png" style="width:50px; height:50px;"/>
                    </a>
                        <p class="card-text" style="color:black;">Expenses</p>
                    </div>
                </div>
            </div>
            <div class=" col-2">
                <div class="card border-primary mb-3" style="max-width: 15rem;">
                    <div class="card-body text-primary">
                    <a href="Add_Fuel.php">
                    
                    <img src="images/fuel.png" style="width:50px; height:50px;"/>
                    </a>
                        <p class="card-text" style="color:black;">Current Fuel</p>
                    </div>
                </div>
            </div>
        </div>
        <p class="h4">Date Wise Summury</p>
        <div class="row">
            <div class="col">
                <form class="form-inline" method="POST">
                <p class="h6">From : </p> 
                <label class="sr-only" for="From_Date">From Date</label>
                <input type="date" class="form-control mb-2 mr-sm-2" id="From_Date" name="From_Date" placeholder="Date" required>
                <p class="h6">To : </p>    
                <label class="sr-only" for="To_Date">To Date</label>
                <input type="date" class="form-control mb-2 mr-sm-2" id="To_Date" name="To_Date" placeholder="Date" required>

                <button type="submit" id="submit" name="submit" class="btn btn-outline-primary mb-2">Submit</button>
                </form>
            </div>
            <div class="col" align="right">
            
                <form method="POST">
                <button type="submit" class="btn btn-outline-success" name="Unlock" id="Unlock">Unlock</button>
                <button type="submit" class="btn btn-outline-danger " name="Lock" id="Lock"/>Lock</button>
                </form>
                <?php
                $sql12 = "SELECT Permission FROM access";
                $result = mysqli_query($link,$sql12);
                while ($row = mysqli_fetch_assoc($result)){
                $Permission =$row['Permission'] ;
                } 
                if ($Permission == "Unlock"){
                   echo "<script>document.getElementById(\"Unlock\").disabled = true;</script>";
                }
                else{
                    echo "<script>document.getElementById(\"Lock\").disabled = true;</script>";
                }
                ?>
            </div>
        
        </div>
        <br/>
        <div class="row">
            <div class="col-3">
                <div class="card border-info  mb-3" style="max-width: 15rem;">
                    <div class="card-body text-info ">                  
                        <h5 class="card-title" style="font-size:30px;">
                        <?php 
                        if(isset($_POST['submit'])){
                            echo "$Courier";
                        }
                        else{
                            echo "0";
                        }
                         ?>
                        </h5>
                        <p class="card-text" style="color:black;">Total Courier</p>
                    </div>
                </div>
            </div>
            <div class="col-3">
                 <div class="card border-success mb-3" style="max-width: 15rem;">
                    <div class="card-body text-success">
                        <h5 class="card-title" style="font-size:30px;">
                        <?php 
                        if(isset($_POST['submit'])){
                            echo "$Turn_Over "." Rs.";
                        }
                        else{
                            echo "0";
                        }
                        ?>
                         </h5>
                        <p class="card-text" style="color:black;">Monthly Turn Over</p>
                    </div>
                </div>
            </div>
            <div class=" col-3">
                <div class="card border-success mb-3" style="max-width: 15rem;">
                    <div class="card-body text-success">                
                    <h5 class="card-title" style="font-size:30px;">
                        <?php 
                        if(isset($_POST['submit'])){
                            echo "$PR_Total"." Rs.";
                        }
                        else{
                            echo "0";
                        }
                        ?>
                     </h5>
                     <p class="card-text" style="color:black;">Profit</p>
                    </div>
                </div>
            </div>
            <div class=" col-3">
                <div class="card border-danger mb-3" style="max-width: 15rem;">
                    <div class="card-body text-danger">
                    <h5 class="card-title" style="font-size:30px;">
                        <?php 
                        if(isset($_POST['submit'])){
                            echo "$Payment2";
                        }
                        else{
                            echo "0";
                        }
                        ?>
                     </h5>
                     <p class="card-text" style="color:black;">Remaing Payments</p>
                    </div>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
      <div class="col">
      <p class="h4">Profit</p>
        <div id="chart">
        </div>
      </div>
      <div class="col">
      <p class="h4">Courier</p>
        <div id="chart2">
        </div>
       </div> 
        </div>
    </div>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Pending Payment List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                   // $conn = mysqli_connect("localhost", "root", "", "hhh");
                    $sql6 = "SELECT Speedway_No,From_Name,Remarks FROM speedway WHERE Payment = 'Not Done' ";
                    if($result = mysqli_query($link, $sql6)){
                        if(mysqli_num_rows($result)>0){
                            
                            echo "<table class=\"table-sm table-bordered\" id=\"myTable\">";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>Index</th>";
                            echo "<th>Speedway No</th>";
                            echo "<th>From Name</th>";  
                            echo "<th>Remarks</th>";            
                            echo "</tr>";
                            echo "</thead>";
                            $counter = 1;
                            while($row = mysqli_fetch_array($result)){
                                
                            echo "<tbody>";
                            echo "<tr>";
                            echo "<td align=\"center\">". $counter . "</td>";
                            echo "<td align=\"center\">" ."<font color=\"#2A4D94\">" . $row['Speedway_No'] ."</font>" . "</td>";    
                            echo "<td align=\"center\">" . $row['From_Name'] . "</td>";
                            echo "<td align=\"center\">" ."<font color=\"Red\">" . $row['Remarks'] ."</font>" . "</td>";
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

Morris.Bar({
  
  element: 'chart',
  data: [<?php echo $chart_data; ?>],
  // The name of the data record attribute that contains x-values.
  xkey: 'month',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['Profit'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['Profit'],
  hideHover:'auto',
  barColors:['#407af7'],
  
});

Morris.Bar({
  
  element: 'chart2',
  data: [<?php echo $chart_data_2; ?>],
  // The name of the data record attribute that contains x-values.
  xkey: 'month',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['Courier'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['Courier'],
  hideHover:'auto',
  barColors:['#2ef44c'],
  
});

</script>