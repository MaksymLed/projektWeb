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


$sql= "INSERT INTO `movies`( `title`, `description`, `image`, `category`, `review`, `release_date`, `director`, `major_actors`, `link`) VALUES ('".$_POST['title']."','".$_POST['description']."','".$_POST['image']."','".$_POST['category']."','".$_POST['review']."','".$_POST['release_date']."','".$_POST['director']."','".$_POST['major actors']."','".$_POST['link']."')";




if (mysqli_query($conn,$sql)) {
    echo "<h1 style='color:green'>Successfully added new movie</h1>";
    echo "<script>window.location.href='indexAdmin.php';</script>";
}
else{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

echo "<script>window.location.href='indexAdmin.php';</script>";
?>