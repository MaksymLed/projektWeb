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
$movie = $_POST['deleteMovieId'];

$sql= "DELETE FROM movies WHERE title='$movie'";


echo "<script>window.location.href='index.php';</script>";

if (mysqli_query($conn,$sql)) {
    echo "<h1 style='color:green'>Successfully added new movie</h1>";
    echo "<script>window.location.href='index.php';</script>";
}
else{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>