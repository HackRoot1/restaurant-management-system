<?php 

include("session.php");

if(isset($_POST['id'])) {

    $id = $_POST['id'];

    $sql = "SELECT * FROM `customer_order` WHERE id = '{$id}'";
    $result = mysqli_query($conn, $sql);

    $data = mysqli_fetch_assoc($result);


    // c_sql = customer_sql
    $c_sql = "SELECT * FROM users_personal_info WHERE user_id = '{$data['user_id']}'";
    $c_result = mysqli_query($conn, $c_sql);
    $c_data = mysqli_fetch_assoc($c_result);
    
    // ca_sql = customer_order_sql
    $ca_sql = "SELECT * FROM users_address_info WHERE user_id = '{$data['user_id']}'";
    $ca_result = mysqli_query($conn, $ca_sql);
    $ca_data = mysqli_fetch_assoc($ca_result);
    
    // oi_sql = order_item_sql
    $oi_sql = "SELECT * FROM fooditems WHERE id = '{$data['food_id']}'";
    $oi_result = mysqli_query($conn, $oi_sql);
    $oi_data = mysqli_fetch_assoc($oi_result);
}

?>

    <div class="title">
        <span>
            Customer Order
        </span>
    </div>


    <div class="table-details-individual">

        <table>
            <thead>
                <tr>
                    <td>Customer Name</td>
                    <td><?= $c_data['fname'] . " " . $c_data['lname'] ?></td>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>Ordered Item</td>
                    <td><?= $oi_data['food_name'] ?></td>
                </tr>
                <tr>
                    <td>Quantity</td>
                    <td>
                        <?= $data['quantity'] ?>
                    </td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>
                        <?= $ca_data['address'] . " " . $ca_data['addr2'] . ", " . $ca_data['city'] . ", " . $ca_data['state'] . " " . $ca_data['zip_code'] ?>
                    </td>
                </tr>
                <tr>
                    <td>Customer Contact No.</td>
                    <td>
                        <?= $c_data['m_no'] ?>
                    </td>
                </tr>
                <tr>
                    <td>Total Price</td>
                    <td>
                        <?= $data['total_price'] * $data['quantity'] ?>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
