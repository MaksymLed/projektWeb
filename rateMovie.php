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
$forRate = $_POST['forRate'];
$rateNum =  (int)$_POST['rateNum'];

$query = "SELECT * FROM movies";

$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)){

        if($row['title']==$forRate) {
            echo $row['title'];
            $rateNum =  ($row['rating']+(int)$_POST['rateNum'])/2;
            $sql= "UPDATE movies SET rating='$rateNum'  WHERE title='$forRate'";


        }

    }
}


if (mysqli_query($conn,$sql)) {
    echo "<h1 style='color:green'>Successfully updated the database</h1>";
    echo "<script>window.location.href='indexAdmin.php';</script>";
}
else{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

echo "<script>window.location.href='indexAdmin.php';</script>";
?>