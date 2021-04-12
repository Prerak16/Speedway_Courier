<?php 

$connection  = mysqli_connect('localhost','speedway1','speedway1' , 'hhh'); 
	
$userObj  = mysqli_query($connection , 'SELECT * FROM `speedway`');

if(isset($_POST['data'])){
	$dataArr = $_POST['data'] ; 

	foreach($dataArr as $id){
		mysqli_query($connection , "DELETE FROM speedway where id='$id'");
	}
	echo 'Record deleted successfully';
	
}

?>