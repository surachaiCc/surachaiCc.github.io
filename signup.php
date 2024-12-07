<?php



include_once "connect.php";

$username = $_POST['username'];
$password = $_POST['password'];
$firstname = $_POST['firstname'];
$age = $_POST['age'];

$sql = "INSERT INTO `user` 
        (`user_id`, `username`,  `password`,  `firstname`) 
        VALUES 
        (NULL     , '$username', '$password', '$firstname');";

$result = mysqli_query($conn, $sql);
if ($result)
{
    header("location:home.php");
}
?>