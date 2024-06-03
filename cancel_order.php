<?php 


include("./config.php");
include("./session.php");

// fetch users data first 
$get_user_data_query = "SELECT * FROM users_data WHERE email = '{$_SESSION['email']}'";
$get_user_data = mysqli_query($conn, $get_user_data_query) or die("User Not available");
$user_data = mysqli_fetch_assoc($get_user_data);


if(isset($_POST['c_itemId'])){

    $id = $_POST['c_itemId'];
    $sql = "UPDATE 
                customer_order
            SET
                order_cancelled = '1'
            WHERE 
                user_id = {$user_data['id']} 
            AND 
                id = {$id}";

    if(mysqli_query($conn, $sql)) {
        echo 1;
    }else {
        echo 0;
    }
}

if(isset($_POST['c_tableno'])){

    $id = $_POST['c_tableno'];
    $sql = "UPDATE 
                `table_reserved`
            SET
                status = '1',
                reservation_cancelled = '1'
            WHERE 
                id = {$id}";

    if(mysqli_query($conn, $sql)) {
        echo 1;
    }else {
        echo 0;
    }
}


if(isset($_POST['tableId'])){

    $id = $_POST['tableId'];
    $sql = "DELETE FROM 
                `table_data`
            WHERE 
                id = {$id}";

    if(mysqli_query($conn, $sql)) {
        echo 1;
    }else {
        echo 0;
    }
}


if(isset($_POST['foodid'])){

    $id = $_POST['foodid'];
    $sql = "DELETE FROM 
                `fooditems`
            WHERE 
                id = {$id}";

    if(mysqli_query($conn, $sql)) {
        echo 1;
    }else {
        echo 0;
    }
}
