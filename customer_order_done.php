<?php 

require("session.php");

// fetch users data first 
$get_user_data_query = "SELECT * FROM users_data WHERE email = '{$_SESSION['email']}'";
$get_user_data = mysqli_query($conn, $get_user_data_query) or die("User Not available");
$user_data = mysqli_fetch_assoc($get_user_data);


if(isset($_POST['c_order_data'])) {

    $data = $_POST['c_order_data'];
    $count = count($_POST['c_order_data']);


    for($i = 0; $i < $count; $i++) {
        // print_r($data[$i]);

        $sql = "INSERT INTO 
                    `customer_order`
                    (user_id, food_id, quantity, total_price, status) 
                VALUES 
                    ({$user_data['id']}, {$data[$i]['foodId']}, {$data[$i]['count']}, {$data[$i]['price']}, '1')";
        mysqli_query($conn, $sql);

        $sql2 = "DELETE FROM cart WHERE user_id = {$user_data['id']} AND food_id = {$data[$i]['foodId']}";
        mysqli_query($conn, $sql2);

    }

    echo "Success";

    mysqli_close($conn);

}