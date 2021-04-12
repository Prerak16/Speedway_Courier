<?php
  session_start();
  if(isset($_POST['submit'])){

    $usr = $_POST["Username"];
    $pass = $_POST["Password"];
    $role = $_POST["Role"];

    include 'connection.php';

  $sql = "select Username,Password,Role from users where Username='$usr' and Password='$pass' and Role='$role'";

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
      
      $_SESSION["Role"]=$role;
      $_SESSION['timestamp']=time();
      if($role == 'Employee'){

        $sql4 = "SELECT Permission FROM access";
        $result = mysqli_query($link,$sql4);
        while ($row = mysqli_fetch_assoc($result)){
        $Permission =$row['Permission'] ;
        } 

        if ($Permission == "Unlock"){
            header('Location:  form.php');
        }
        else{
            echo "<div class=\"alert alert-danger\" role=\"alert\">Access Denied Please Contact To Admin. </div>";
        }

    }
    else{
        header('Location:  Admin_Dashboard.php');
    }
      
    }
    else{
      $sql = "select Username from users where Username='$usr'";

      if($result = mysqli_query($link,$sql)){
        if(mysqli_num_rows($result) > 0){
          echo "<div class=\"alert alert-danger\" role=\"alert\">
    Password Is Incorrect OR Role Is Different.
  </div>";
        }
        else{
          echo "<div class=\"alert alert-danger\" role=\"alert\">
          User Does Not Exist.
  </div>";
        }
      }
    }
    
  }
  
  }
?>

<script>
function validateForm() {
    var x = document.forms["myForm"]["Username"].value;
    var y = document.forms["myForm"]["Password"].value;
    if (x == "") {
        alert("Username must be filled out");
        return false;
    }
    if (y == "") {
        alert("Password must be filled out");
        return false;
    }
}
</script>

<!doctype html>
<html lang="en">

<head>
    <title>Application</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
    body {
        padding-top: 50px;
    }
    
    </style>
</head>

<body>
    <div class="container">
        <h2 class="display-4" style="color:blue;">Log In</h2>
        <hr>
        <br/>

        <form name="myForm" action="login.php" onsubmit="return validateForm()" method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input type="text" class="form-control" name="Username" id="exampleInputEmail1" style="width:350px;"
                    aria-describedby="emailHelp" placeholder="Enter Username" autocomplete="off" autofocus>

            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="Password" id="exampleInputPassword1"
                    style="width:350px;" placeholder="Password">
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="Role" id="Employee" value="Employee" checked>
                <label class="form-check-label" for="exampleRadios1">
                    Employee
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="Role" id="Admin" value="Admin">
                <label class="form-check-label" for="exampleRadios2">
                    Admin
                </label>
            </div>
            <br />
            <input type="submit" name="submit" class="btn btn-outline-primary" value="Log In" />
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