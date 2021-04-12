<html>
<html lang="en">
<head>
<LINK REL="SHORTCUT ICON"
       HREF="sclogo.png">

<style>
input[type=text],input[type=number], select {
    width: 50%;
    padding: 12px 20px;
    margin: 5px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
body {
padding-left:80px;
background-color:#f2f2f2;
font-family:'arial',sans-serif;}
</style>
<img src="s2.jpg" height=100px; width=500px;>
</head>
<br />
<br />
<h2> Add Counter Part Form</h2>
<br />
<?php
session_start();


	if (!isset($_SESSION['sid']))
{
	header("location: login.php");
}
?>

<form action="newcounter.php" method="post">
<label>Counter Part:</label>
<br />
<input type="text" name="addcounter" placeholder="Enter Counter Part">
<br />
<br />
<label>Address:</label>
<br />

<input type="text" name="address" placeholder="Enter Address">
<br />
<br />
<input type="submit" name="Submit" value="Submit">
</form>
</html>