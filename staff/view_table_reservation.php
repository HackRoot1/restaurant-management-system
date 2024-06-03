<?php 

include("session.php");

if(isset($_POST['bookid'])) {

    $id = $_POST['bookid'];

    $sql = "SELECT * FROM `table_reserved` WHERE id = '{$id}' ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);

    $c_sql = "SELECT * FROM users_personal_info WHERE user_id = '{$data['user_id']}'";
    $c_result = mysqli_query($conn, $c_sql);
    $c_data = mysqli_fetch_assoc($c_result);

    // t_sql = table_sql
    $t_sql = "SELECT * FROM table_data WHERE id = '{$data['table_id']}'";
    $t_result = mysqli_query($conn, $t_sql);
    $t_data = mysqli_fetch_assoc($t_result);
    
    // cg_sql = customer_guests_sql
    $cg_sql = "SELECT * FROM `customer_guests_details` WHERE user_id = '{$data['user_id']}' AND table_id = '{$data['table_id']}'";
    $cg_result = mysqli_query($conn, $cg_sql);
    $cg_data = mysqli_fetch_assoc($cg_result);
    
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
                    <td>Table No.</td>
                    <td><?= $t_data['table_no'] ?></td>
                </tr>
                <tr>
                    <td>Guests</td>
                    <td>
                        <?= $cg_data['guests_count'] ?>
                    </td>
                </tr>
                <tr>
                    <td>Date and Time</td>
                    <td>
                        <?= $data['date'] ?>
                    </td>
                </tr>
                <tr>
                    <td>Customer Contact No.</td>
                    <td>
                        <?= $c_data['m_no'] ?>
                    </td>
                </tr>
                <tr>
                    <td>Request</td>
                    <td>
                        <?= $cg_data['request'] ?>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
