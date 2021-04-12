<?php
include_once("connection.php");
$input = filter_input_array(INPUT_POST);
if ($input['action'] == 'edit') {
$update_field='';
if(isset($input['Speedway_No'])) {
$update_field.= "Speedway_No='".$input['Speedway_No']."'";
} else if(isset($input['Customer_Fee'])) {
$update_field.= "Customer_Fee='".$input['Customer_Fee']."'";
} else if(isset($input['Service_Fee'])) {
$update_field.= "Service_Fee='".$input['Service_Fee']."'";
} 

if($update_field && $input['id']) {
$sql_query = "UPDATE speedway SET $update_field WHERE id='" . $input['id'] . "'";
mysqli_query($link, $sql_query) or die("database error:". mysqli_error($link));
}

$sql_query = "update speedway set PR = Customer_Fee-Service_Fee";
mysqli_query($link, $sql_query) or die("database error:". mysqli_error($link));
}
?>