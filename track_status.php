
<style>
*{
   
}
.status-container {
    margin-top: 15%;
    margin-left: 35%;
    padding: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: #f9f9f9;
    color: #333;
    height: 300px;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 300px;
    }
      
</style>


<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'carcass';


$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
  $token = $_POST['token'];
  $phoneNumber = $_POST['phoneNumber'];

  
  $stmt = $conn->prepare("SELECT complaintStatus FROM complaint WHERE token = ? AND informersPhoneNumber = ?");
  $stmt->bind_param("ss", $token, $phoneNumber);
  $stmt->execute();
  $stmt->bind_result($complaintStatus);
  $stmt->fetch();
  $stmt->close();


  if ($complaintStatus) {
  
    echo '<div class="status-container">Current Status: ' . $complaintStatus . '</div>';
    
    echo "work in progress...";
   
  } else {
   
    echo "Not Found";
   
  }
}


$conn->close();
?>
