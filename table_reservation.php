<?php 

    require("session.php");

    $get_user_data_query = "SELECT * FROM users_data WHERE email = '{$_SESSION['email']}'";
    $get_user_data = mysqli_query($conn, $get_user_data_query) or die("User Not available");
    $user_data = mysqli_fetch_assoc($get_user_data);
    // print_r($user_data['username']);


    $fetch_food_data_query = "SELECT * FROM foodItems";
    $fetch_food_data = mysqli_query($conn, $fetch_food_data_query);


    $category_query = "SELECT DISTINCT(food_category) FROM foodItems";
    $category_data = mysqli_query($conn, $category_query);

    $cssPage = 'table_reservation';
    include("header.php");
  

    if(isset($_GET['t_id'])) {
        $t_id = $_GET['t_id'];

        $sql = "SELECT * FROM `customer_guests_details` WHERE table_id = '{$t_id}'";
        $table_r_data = mysqli_query($conn, $sql);
        $table_r_data = mysqli_fetch_assoc($table_r_data);
    }



    // get tables info and compare with seats
    

    if(isset($_POST['book-table'])) {

        $res_guests = $_POST['select-guests'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $contact_no = $_POST['contact_no'];
        $request = $_POST['request'];

        $rt_query = "SELECT table_id FROM table_reserved WHERE status = 0";
        $rt_res = mysqli_query($conn, $rt_query) or die(mysqli_error($conn));
        $rt = [];
        while($d = mysqli_fetch_assoc($rt_res)){
            array_push($rt, $d['table_id']);
        }

        $str = implode(", ", $rt);

        $t_sql = "SELECT * FROM table_data WHERE seats >= {$res_guests} AND id NOT IN ({$str})";
        $t_res = mysqli_query($conn, $t_sql);
        $t_data = mysqli_fetch_assoc($t_res);


        if($_POST['book-table'] == "Book") {
            $res_date = $_POST['select-date'];
                        
            $sql2 = "INSERT INTO 
                        customer_guests_details
                        (user_id, table_id, guests_count, first_name, last_name, email, contact_no, request)
                    VALUES
                    ('{$user_data['id']}', '{$t_data['id']}', '{$res_guests}', '{$firstName}', '{$lastName}', '{$email}', '{$contact_no}', '{$request}')";

            $sql = "INSERT INTO 
                        table_reserved
                        (user_id, table_id, date)
                    VALUES
                        ({$user_data['id']}, {$t_data['id']}, '{$res_date}')";

            if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)) {
                header("Location: table_reserved.php");
                exit();
            }
        }

        if($_POST['book-table'] == "Update") {

            $table_id = $_POST['table_id'];

            $sql2 = "UPDATE 
                        customer_guests_details
                    SET
                        guests_count = '{$res_guests}', 
                        first_name = '{$firstName}', 
                        last_name = '{$lastName}', 
                        email = '{$email}', 
                        contact_no = '{$contact_no}', 
                        request = '{$request}'
                    WHERE
                        user_id = '{$user_data['id']}'
                    AND
                        table_id = '{$table_id}'
                    ";

            if(mysqli_query($conn, $sql2)) {
                header("Location: table_reserved.php");
                exit();
            }else {
                echo mysqli_error($conn);
            }

        }
        

    }

?>

    
    <main>

        <section class = "categories">
            <a href="./table_reservation.php">
                <div class = "active">
                    <span class = "icon">
                        <i class="fa-solid fa-utensils"></i>
                    </span>
                    <span>
                        Book Table
                    </span>
                </div>
            </a>

            <a href="./dashboard.php">
                <div>
                    <span class = "icon">
                        <i class="fa-solid fa-utensils"></i>
                    </span>
                    <span>
                        Delivery
                    </span>
                </div>
            </a>

            <a href="#">
                <div>
                    <span class = "icon">
                        <i class="fa-solid fa-utensils"></i>
                    </span>
                    <span>
                        Nightlife
                    </span>
                </div>
            </a>
            
        </section>
        <hr>


        <section class = "table-reservation-section">

            <div class = "table-reservation-info">
                <div class="title">Reserve Table</div>

                <div class="table-reservation-form">
                    <form action="<?= $_SERVER['PHP_SELF'] ?>" method = "POST">
                        <div class="booking-details">
                            <div>
                                <span>Please select your booking details</span>
                                <div>
                                    <select name="select-date" id="Date" placeholder="Select Date">
                                        <option value="one" disabled selected>Select Date</option>
                                        <option value="2024/01/06">01/06/2024</option>
                                        <option value="2024/02/06">02/06/2024</option>
                                        <option value="2024/03/06">03/06/2024</option>
                                    </select>

                                    <select name="select-guests" id="guests">
                                        <option value="one" disabled selected>Select Guests</option>
                                        <option value="1" <?= (isset($table_r_data['guests_count']) && $table_r_data['guests_count'] == '1') ? "selected" : "" ?>>1</option>
                                        <option value="2" <?= (isset($table_r_data['guests_count']) && $table_r_data['guests_count'] == '2') ? "selected" : "" ?>>2</option>
                                        <option value="3" <?= (isset($table_r_data['guests_count']) && $table_r_data['guests_count'] == '3') ? "selected" : "" ?>>3</option>
                                        <option value="4" <?= (isset($table_r_data['guests_count']) && $table_r_data['guests_count'] == '4') ? "selected" : "" ?>>4</option>
                                        <option value="5" <?= (isset($table_r_data['guests_count']) && $table_r_data['guests_count'] == '5') ? "selected" : "" ?>>5</option>
                                        <option value="6" <?= (isset($table_r_data['guests_count']) && $table_r_data['guests_count'] == '6') ? "selected" : "" ?>>6</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <span>Enter Guests Details</span>
                                <div>
                                    <input type="hidden" placeholder="First Name" name = "table_id" value = "<?= isset($t_id) ? $t_id : "" ?>">
                                    <input type="text" placeholder="First Name" name = "firstName" value = "<?= $table_r_data['first_name'] ?? "" ?>">
                                    <input type="text" placeholder="Last Name" name = "lastName" value = "<?= $table_r_data['last_name'] ?? "" ?>">
                                </div>
                                <div>
                                    <input type="text" placeholder="Email" name = "email" value = "<?= $table_r_data['email'] ?? "" ?>">
                                    <input type="text" placeholder="Phone" name = "contact_no" value = "<?= $table_r_data['contact_no'] ?? "" ?>">
                                </div>
                            </div>

                            <div>
                                <span>Additional Requests</span>
                                <textarea name="request" id="request" cols="30" rows="5"> <?= $table_r_data['request'] ?? "" ?></textarea>
                            </div>
                        
                            <div class="btns">
                                <input type="submit" name = "book-table" value = "<?= isset($table_r_data['first_name']) ? "Update" : "Book" ?>">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        
        </section>


    </main>


<?php include("footer.php") ?>