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
$toEdit = $_POST['toEdit'];
$title = $_POST['newTitle'];
$desc = $_POST['newDesc'];
$rd = $_POST['newRD'];
$director = $_POST['newDirector'];
$ma = $_POST['newMA'];
$link = $_POST['newLink'];


$sql= "UPDATE movies SET title='$title', description = '$desc', release_date = '$rd', director = '$director', major_actors = '$ma', link = '$link' WHERE title='$toEdit'";


if (mysqli_query($conn,$sql)) {
    echo "<h1 style='color:green'>Successfully updated the database</h1>";
    echo "<script>window.location.href='index.php';</script>";
}
else{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

echo "<script>window.location.href='index.php';</script>";
?>