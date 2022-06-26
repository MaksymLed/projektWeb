<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projektdb";


$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

$usr = $_POST['usrname'];
$passw = $_POST['passw'];

if($usr=='' || $passw=='')
{
    echo "<script>alert('Please fill in all the fields.');
    window.location.href='login.php';</script>";
}


$sql= "SELECT * FROM users WHERE username = '$usr' AND passw = '$passw'";
$result = mysqli_query($conn,$sql);
$check = mysqli_fetch_array($result);
if(!isset($check)){
    echo "<script>window.location.href='login.php';
    alert('Some of your credentials are wrong.');</script>";
}

if(isset($check) and $usr=="admin" and $passw=="admin"){
    echo "<script>window.location.href='indexAdmin.php';</script>";
}else{
    echo "<script>window.location.href='indexUser.php';</script>";
}



$sql1= "SELECT username FROM users WHERE username = '$usr' AND passw = '$passw'";
$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) {
    while($row1 = $result1->fetch_assoc()) {
        $_SESSION['username'] = $row1["username"];
    }
} else {
    echo "0 results";
}

?>