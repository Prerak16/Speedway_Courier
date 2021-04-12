<!doctype html>
<html lang="en">
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-109487614-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-109487614-1');
</script>


<LINK REL="SHORTCUT ICON"
       HREF="sclogo.png">

<title>
	Speedway 
</title>


<meta charset="utf-8" />

<link href="data.css" rel="stylesheet" type="text/css" />


</head>

<body>

<a href="UserReport_Export.php"> Export To Excel </a>
<br />
<br />
<div class="container">
 <input type="text" class="form-control" placeholder="Search Here" id="search_field"> 
 <br />
 <br />
 <?php
session_start();


	if (!isset($_SESSION['sid']))
{
	header("location: login.php");
}
?>
 
<?php
/*require_once dirname(__FILE__) . '.\Config\DBConnect.php';
        // opening db connection
        $db = new DBConnect();
        $link = $db->connect();*/
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "speedway1", "speedway1", "hhh");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

	$sql = "SELECT speedway_no,date,from_name,to_name,country,destination,service,counter_part,weight,customer_fee,service_fee,customer_fee-service_fee as pr,tracking_website,tracking_number,lnk,status,remark FROM speedway";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
		echo "<div class=\"row\">";
    echo "<div class=\"col-md-6\">";
        echo "<table id=\"myTable\" class=\"table table-inverse\" border=\"1\" cellpadding=\"20\" cellspacing=\"20\">";
            echo "<tr class=\"myHead\">";
                echo "<th bgcolor=\"#BFBFBF\">Speedway No</th>";
                echo "<th bgcolor=\"#BFBFBF\">Date</th>";
                echo "<th bgcolor=\"#BFBFBF\">From Name</th>";
                echo "<th bgcolor=\"#BFBFBF\">To Name</th>";
				echo "<th bgcolor=\"#BFBFBF\">Country</th>";
				echo "<th bgcolor=\"#BFBFBF\">Destination</th>";
				echo "<th bgcolor=\"#BFBFBF\">Service</th>";
				echo "<th bgcolor=\"#BFBFBF\">Counter Part</th>";
				echo "<th bgcolor=\"#BFBFBF\">Weight</th>";
				echo "<th bgcolor=\"#BFBFBF\">Customer Fee</th>";
				echo "<th bgcolor=\"#BFBFBF\">Service Fee</th>";
				echo "<th bgcolor=\"#BFBFBF\">PR</th>";
				echo "<th bgcolor=\"#BFBFBF\">Tracking Website</th>";
				echo "<th bgcolor=\"#BFBFBF\">Tracking Number</th>";
				echo "<th bgcolor=\"#BFBFBF\">Status</th>";
				echo "<th bgcolor=\"#BFBFBF\">Remark</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" ."<font color=\"#2A4D94\">" . $row['speedway_no'] ."</font>" . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['from_name'] . "</td>";
				echo "<td>" . $row['to_name'] . "</td>";
				echo "<td>" . $row['country'] . "</td>";
				echo "<td>" . $row['destination'] . "</td>";
				echo "<td>" . $row['service'] . "</td>";
				echo "<td>" . $row['counter_part'] . "</td>";
				echo "<td>" . $row['weight'] . "</td>";
				echo "<td>" . $row['customer_fee'] . "</td>";
				echo "<td>" . $row['service_fee'] . "</td>";
				echo "<td>" . $row['pr'] . "</td>";
				echo "<td>" . $row['tracking_website'] . "</td>";
				echo "<td>" . $row['tracking_number'] . "</td>";
				echo "<td>" . $row['status'] . "</td>";
                echo "<td>" ."<font color=\"red\">" . $row['remark'] . "</font>" . "</td>";
            echo "</tr>";
        }
        echo "</table>";
		 echo "</div>";
		 echo "</div>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records were found.";
    }
} 

// close connection
mysqli_close($link);
?>

<script src='https://code.jquery.com/jquery-1.12.4.min.js'></script>

        <script src="data.js"></script>
		

</div>
</body>
</html>