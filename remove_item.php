<?php 


include("./config.php");
include("./session.php");

// fetch users data first 
$get_user_data_query = "SELECT * FROM users_data WHERE email = '{$_SESSION['email']}'";
$get_user_data = mysqli_query($conn, $get_user_data_query) or die("User Not available");
$user_data = mysqli_fetch_assoc($get_user_data);


$id = $_POST['itemId'];

$sql = "DELETE FROM cart WHERE user_id = " . $user_data['id'] . " AND food_id = " . $id;

if(mysqli_query($conn, $sql)) {
    echo 1;
}else {
    echo 0;
}