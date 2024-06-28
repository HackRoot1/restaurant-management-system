<?php 

require($_SERVER['DOCUMENT_ROOT'] . "/restaurant-template-php/session.php");

$get_user_data_query = "SELECT * FROM users_data WHERE email = '{$_SESSION['email']}'";
$get_user_data = mysqli_query($conn, $get_user_data_query) or die("User Not available");
$user_data = mysqli_fetch_assoc($get_user_data);


$insert_query = "INSERT INTO cart(user_id, food_id) VALUES({$user_data['id']}, {$_GET['add_cart']})";

if(mysqli_query($conn, $insert_query)){
    header("Location: ../checkout.php");
    exit();
}


