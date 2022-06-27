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
$revDel = $_POST['deleteReviewId'];

echo str_replace("nigga", "", "old,nigga,xd");

$query = "SELECT review FROM movies";

$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)){
        if(str_contains($row['review'],$revDel)) {
            $colDel = $row['review'];
            $newReview = str_replace($revDel, "", $row['review']);
            $sql= "UPDATE movies SET review='$newReview' WHERE review='$colDel'";

        }
    }
}

if (mysqli_query($conn,$sql)) {
    echo "<h1 style='color:green'>Successfully deleted</h1>";
    echo "<script>window.location.href='indexAdmin.php';</script>";
}
else{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

echo "<script>window.location.href='indexAdmin.php';</script>";




?>