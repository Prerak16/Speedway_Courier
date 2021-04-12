<?php
include 'connection.php'; 
$id = $_POST['id']; 
$query = mysqli_query($link, "SELECT * FROM speedway WHERE Speedway_No= '$id'"); 
$row = mysqli_num_rows($query); 
if($row > 0){ 
  $data = mysqli_fetch_array($query); 
  
  // BUat sebuah array
  $callback = array(
    'status' => 'success', 
    'Date' => $data['Date'],
    'Country' => $data['Country'], 
    'Destination' => $data['Destination'], 
    'From_Name' => $data['From_Name'], 
    'From_Address' => $data['From_Address'], 
    'From_Number' => $data['From_Number'], 
    'To_Name' => $data['To_Name'], 
    'To_Address' => $data['To_Address'], 
    'To_Address2' => $data['To_Address2'], 
    'To_Address3' => $data['To_Address3'], 
    'To_Address4' => $data['To_Address4'], 
    'To_Number' => $data['To_Number'], 
    'To_Number2' => $data['To_Number2'], 
    'Service' => $data['Service'], 
    'Counter_Part' => $data['Counter_Part'], 
    'Weight' => $data['Weight'], 
    'CPK' => $data['CPK'], 
    'OC' => $data['OC'], 
    'Customer_Fee' => $data['Customer_Fee'], 
    'Tracking_Number' => $data['Tracking_Number'], 
    'Tracking_Website' => $data['Tracking_Website'], 
    'Link' => $data['Link'], 
    'Status' => $data['Status'], 
    'Payment' => $data['Payment'], 
    'Remarks' => $data['Remarks'], 
    
  );
}else{
  $callback = array('status' => 'failed'); 
}
echo json_encode($callback); 
?>