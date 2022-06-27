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

$movieTitle = $_POST['forReview'];
$postedReview = $_POST['newReview'];

$query = "SELECT review FROM movies WHERE title='$movieTitle'";

$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)){
        $newReview = $row['review'].",".$postedReview;
        $sql= "UPDATE movies SET review='$newReview' WHERE title='$movieTitle'";
    }
}

if (mysqli_query($conn,$sql)) {
    echo "<h1 style='color:green'>Successfully added new review</h1>";
    echo "<script>window.location.href='indexAdmin.php';</script>";
}
else{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

echo "<script>window.location.href='indexAdmin.php';</script>";
?>