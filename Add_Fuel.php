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

    $sql3 = "DELETE FROM fuel";
    if(mysqli_query($link, $sql3)){

    $Month = $_POST['Month'];
    $Fedex = $_POST['Fedex'];
    $Ups = $_POST['Ups'];
    $Dhl = $_POST['Dhl'];
    $Tnt = $_POST['Tnt'];
    $Sky = $_POST['Sky'];
    $Airwings = $_POST['Airwings'];
    $Aramex = $_POST['Aramex'];

    $sql = "insert into fuel values ('$Month', '$Fedex', '$Ups', '$Dhl', '$Tnt', '$Sky', '$Airwings', '$Aramex')";

    if(mysqli_query($link, $sql)){
        echo "<script>alert(\"Record Added Succesfully.\");</script>";
    }
    else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
      }
    }
    else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    } 
  }


  if(isset($_POST['Graph'])){

    $Month = $_POST['Month'];
    $Profit = $_POST['Profit'];
    $Courier = $_POST['Courier'];
    

    $sql = "insert into graph values ('$Month', '$Profit', '$Courier')";

    if(mysqli_query($link, $sql)){
        echo "<script>alert(\"Record Added Succesfully.\");</script>";
    }
    else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
      }
  }

  if(isset($_POST['Delete'])){
    $sql2 = "DELETE FROM graph";
    if(mysqli_query($link, $sql2)){
        echo "<script>alert(\"Record Delete Succesfully.\");</script>";
    }
    else{
        echo "ERROR: Could not able to execute $sql2. " . mysqli_error($link);
      }

  }
?>

<!doctype html>
<html lang="en">

<head>
    <title>Add Currunt Fuel</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>

<div class="container-fluid">
<a href="Admin_Dashboard.php">
< Back to Home</a> <p class="h3" style="color:blue;">Update Fuel</p>
<br />
<form method="POST">
<div class="row">

    <div class="form-group col-md-2">
       
        <label for="Month">Month</label>
            <select class="form-control" id="Month" name="Month">
                <option value="JANUARY">JANUARY</option>
                <option value="FEBRUARY">FEBRUARY</option>
                <option value="MARCH">MARCH</option>
                <option value="APRIL">APRIL</option>
                <option value="MAY">MAY</option>
                <option value="JUNE">JUNE</option>
                <option value="JULY">JULY</option>
                <option value="AUGUST">AUGUST</option>
                <option value="SEPTEMBER">SEPTEMBER</option>
                <option value="OCTOBER">OCTOBER</option>
                <option value="NOVEMBER">NOVEMBER</option>
                <option value="DECEMBER">DECEMBER</option>
            </select>
    </div>
    
    <div class="form-group col-md-2">
        <label for="Fedex">Fedex</label>
        <input type="float" class="form-control" name="Fedex" id="Fedex" required>
    </div>
   
   
    <div class="form-group col-md-2">
        <label for="Ups">Ups</label>
        <input type="float" class="form-control" name="Ups" id="Ups" required>
    
    </div>
    
    <div class="form-group col-md-2">
        <label for="Dhl">Dhl</label>
        <input type="float" class="form-control" name="Dhl" id="Dhl" required>
    </div>
    
    <div class="form-group col-md-2">
        <label for="Tnt">Tnt</label>
        <input type="float" class="form-control" name="Tnt" id="Tnt" required>
    </div>
 
    <div class="form-group col-md-2">
        <label for="Sky">Sky</label>
        <input type="float" class="form-control" name="Sky" id="Sky" required>
    </div>
</div>  

<div class="row">
    <div class="form-group col-md-2">
        <label for="Airwings">Airwings</label>
        <input type="float" class="form-control" name="Airwings" id="Airwings" required>
    </div>
    <div class="form-group col-md-2">
        <label for="Aramex">Aramex</label>
        <input type="float" class="form-control" name="Aramex" id="Aramex" required>
    </div>

    <br />
    <div class="form-group col-md-2">
  
    <input type="submit" name="submit" class="btn btn-outline-primary" value="Save" />
    </div>
    </form>
</div>

<hr/>

<p class="h3" style="color:blue;">Insert Data For Graph</p>

<form method="POST">
<div class="row">
<div class="form-group col-md-2">
    <label for="Month">Month</label>
    <select class="form-control" id="Month" name="Month">
        <option value="JANUARY">JANUARY</option>
        <option value="FEBRUARY">FEBRUARY</option>
        <option value="MARCH">MARCH</option>
        <option value="APRIL">APRIL</option>
        <option value="MAY">MAY</option>
        <option value="JUNE">JUNE</option>
        <option value="JULY">JULY</option>
        <option value="AUGUST">AUGUST</option>
        <option value="SEPTEMBER">SEPTEMBER</option>
        <option value="OCTOBER">OCTOBER</option>
        <option value="NOVEMBER">NOVEMBER</option>
        <option value="DECEMBER">DECEMBER</option>
    </select>
</div>

<div class="form-group col-md-2">
    <label for="Profit">Profit</label>
    <input type="float" class="form-control" name="Profit" id="Profit" required>
</div>

<div class="form-group col-md-2">
    <label for="Courier">Courier</label>
    <input type="number" class="form-control" name="Courier" id="Courier" required>
</div>

<div class="form-group col-md-2">
    <input type="submit" name="Graph" class="btn btn-outline-primary" value="Save" />
</div>
</form>


</div>

<form method="POST">
<div class="form-group col-md-6">
    <label for="Delete">Delete Record When Year Change</label>
    &nbsp;
    &nbsp;
    <input type="submit" name="Delete" class="btn btn-outline-danger" value="Delete" />
</div>
</form>

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