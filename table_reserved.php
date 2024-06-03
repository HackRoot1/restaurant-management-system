<?php 

    require("session.php");

    $get_user_data_query = "SELECT * FROM users_data WHERE email = '{$_SESSION['email']}'";
    $get_user_data = mysqli_query($conn, $get_user_data_query) or die("User Not available");
    $user_data = mysqli_fetch_assoc($get_user_data);
    // print_r($user_data['username']);

    $fetch_user_reservation_query = "SELECT * FROM table_reserved WHERE user_id = {$user_data['id']} AND reservation_cancelled = 0 ORDER BY date";
    $fetch_user_reservation = mysqli_query($conn, $fetch_user_reservation_query);

    $fetch_user_reservation_history_query = "SELECT * FROM table_reserved WHERE user_id = {$user_data['id']} AND reservation_cancelled = 1 ORDER BY date";
    $fetch_user_reservation_history = mysqli_query($conn, $fetch_user_reservation_history_query);

    $cssPage = 'table_reserved';
    include("header.php");
    
?>

    
    
    <main>

        <section class = "checkout-section">
            <div class="card">
                <div class="title">
                    Table Reservations
                </div>

                <table>
                    <thead>
                        <tr class = "theading">
                            <td>Table No</td>
                            <td>Customer Name</td>
                            <td>Seats</td>
                            <td>Date & Time</td>
                            <td>Status</td>
                            <td>Action</td>
                        </tr>
                    </thead>

                    
                    <tbody>
                        
                        <?php while($reservation = mysqli_fetch_assoc($fetch_user_reservation)): ?>
                            <?php 
                                $table_data_query = "SELECT * FROM table_data WHERE id = {$reservation['table_id']}";
                                $table_data = mysqli_query($conn, $table_data_query);
                                $table_data = mysqli_fetch_assoc($table_data);

                            ?>

                        <tr>
                            <td>
                                <div class = "info"><?= $table_data['table_no'] ?></div>
                            </td>
                            <td>
                                <div class="info">
                                    <div class="title"><?= $user_data['username'] ?></div>
                                </div>
                            </td>
                            <td>
                                <div class="quantity">
                                    <span><?= $table_data['seats'] ?></span>
                                </div>
                            </td>
                            <td>
                                <div class="price">
                                    <?= $reservation['date'] ?>
                                </div>
                            </td>

                            <td>
                                <div class="status">
                                    <?php if(!$reservation['reservation_cancelled']): ?>
                                        <div class = "<?= $reservation['status'] == 0 ? 'ordered' : 'cancelled' ?>">
                                            <?php echo $reservation['status'] == 0 ? "Table Booked" : "Pending" ?>
                                        </div>
                                    <?php else: ?>
                                        <div class = "cancelled">
                                            Reservation Cancelled
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </td>

                            <td>
                                <div class="buy">
                                    <?php if(!$reservation['reservation_cancelled']): ?>
                                        <div class="buy-edit">
                                            <span class = "cancel-item" data-tableno = <?= $reservation['id'] ?>>Cancel</span>
                                            <span>
                                                <a href="table_reservation.php?t_id=<?= $reservation['table_id'] ?>">
                                                    Edit
                                                </a>
                                            </span>
                                        </div>
                                    <?php else: ?>
                                        <div class="buy-return">
                                            <a href="table_reservation.php?t_id=<?= $reservation['table_id'] ?>">
                                                Book Again
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </td>
                                
                        </tr>
                        
                        <?php endwhile; ?>


                    </tbody>

                </table>

            </div>

        </section>


        
        <section class = "checkout-section">
            <div class="card">
                <div class="title">
                    Reservation History
                </div>

                <table>
                    <thead>
                        <tr class = "theading">
                            <td>Table No</td>
                            <td>Customer Name</td>
                            <td>Seats</td>
                            <td>Date & Time</td>
                            <td>Status</td>
                            <td>Action</td>
                        </tr>
                    </thead>

                    
                    <tbody>
                        
                        <?php while($reservation_history = mysqli_fetch_assoc($fetch_user_reservation_history)): ?>
                            <?php 
                                $table_data_history_query = "SELECT * FROM table_data WHERE id = {$reservation_history['table_id']}";
                                $table_data_history = mysqli_query($conn, $table_data_history_query);
                                $table_data_history = mysqli_fetch_assoc($table_data_history);

                            ?>

                        <tr>
                            <td>
                                <div class = "info"><?= $table_data_history['table_no'] ?></div>
                            </td>
                            <td>
                                <div class="info">
                                    <div class="title"><?= $user_data['username'] ?></div>
                                </div>
                            </td>
                            <td>
                                <div class="quantity">
                                    <span><?= $table_data_history['seats'] ?></span>
                                </div>
                            </td>
                            <td>
                                <div class="price">
                                    <?= $reservation_history['date'] ?>
                                </div>
                            </td>

                            <td>
                                <div class="status">
                                    <?php if(!$reservation_history['reservation_cancelled']): ?>
                                        <div class = "<?= $reservation_history['status'] == 0 ? 'ordered' : 'cancelled' ?>">
                                            <?php echo $reservation_history['status'] == 0 ? "Table Booked" : "Pending" ?>
                                        </div>
                                    <?php else: ?>
                                        <div class = "cancelled">
                                            Reservation Cancelled
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </td>

                            <td>
                                <div class="buy">
                                    <?php if(!$reservation_history['reservation_cancelled']): ?>
                                        <div class="buy-edit">
                                            <span class = "cancel-item" data-tableno = <?= $reservation_history['id'] ?>>Cancel</span>
                                            <span>
                                                <a href="table_reservation.php?t_id=<?= $reservation_history['table_id'] ?>">
                                                    Edit
                                                </a>
                                            </span>
                                        </div>
                                    <?php else: ?>
                                        <div class="buy-return">
                                            <a href="table_reservation.php?t_id=<?= $reservation_history['table_id'] ?>">
                                                Book Again
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </td>
                                
                        </tr>
                        
                        <?php endwhile; ?>


                    </tbody>

                </table>

            </div>

        </section>

    </main>

    
    <script>

        $(document).ready(function(){

            $(".cancel-item").on("click", function() {

                let tableno = $(this).data("tableno");
                // alert(foodId);

                if(confirm("Are you sure? want to cancel reservation")) {
                    $.ajax({
                        url : "cancel_order.php",
                        method : "POST",
                        data : { c_tableno : tableno },
                        success : function (data) {
                            alert("Your Reservation is cancelled.");
                            location.reload();
                        }
                    });
                }
            });

            
        });
    </script>


<?php include("footer.php") ?>