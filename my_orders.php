<?php 

    require("session.php");

    $get_user_data_query = "SELECT * FROM users_data WHERE email = '{$_SESSION['email']}'";
    $get_user_data = mysqli_query($conn, $get_user_data_query) or die("User Not available");
    $user_data = mysqli_fetch_assoc($get_user_data);
    // print_r($user_data['username']);


    $fetch_user_orders_query = "SELECT * FROM customer_order WHERE user_id = {$user_data['id']} AND order_cancelled = 0";
    $fetch_user_orders = mysqli_query($conn, $fetch_user_orders_query);


    $fetch_user_orders_history_query = "SELECT * FROM customer_order WHERE user_id = {$user_data['id']} AND order_cancelled = 1";
    $fetch_user_orders_history = mysqli_query($conn, $fetch_user_orders_history_query);


    $cssPage = 'my_orders';
    include("header.php");
    
?>

    
    <main>

        <section class = "checkout-section">
            <div class="card">
                <div class="title">
                    Your Orders
                </div>

                <table>
                    <thead>
                        <tr class = "theading">
                            <td>Image</td>
                            <td>Description</td>
                            <td>Quantity</td>
                            <td>Price</td>
                            <td>Total Price</td>
                            <td>Status</td>
                            <td>Action</td>
                        </tr>
                    </thead>

                    <tbody>

                        <?php while($food_order = mysqli_fetch_assoc($fetch_user_orders)): ?>
                            <?php 
                                $ordered_food_query = "SELECT * FROM fooditems WHERE id = {$food_order['food_id']}";
                                $ordered_food = mysqli_query($conn, $ordered_food_query);
                                $ordered_food = mysqli_fetch_assoc($ordered_food);

                            ?>

                            <tr>
                                <td>
                                    <div class="img">
                                        <img src="./images/food.png" alt="Food Image">
                                    </div>
                                </td>
                                <td>
                                    <div class="info">
                                        <div class="title"><?= $ordered_food['food_name'] ?></div>
                                        <div class="description"><?= $ordered_food['food_description'] ?></div>
                                    </div>
                                </td>
                                <td>
                                    <div class="quantity">
                                        <span><?= $food_order['quantity'] ?></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="price">
                                        <?= $food_order['total_price'] ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="price">
                                        <?= ($food_order['quantity'] * $food_order['total_price']) ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="status">
                                        <?php if(!$food_order['order_cancelled']): ?>
                                            <div class = "<?= $food_order['status'] ? 'ordered' : 'cancelled' ?>">
                                                <?php echo $food_order['status'] == 1 ? "Order Placed" : "Pending" ?>
                                            </div>
                                        <?php else: ?>
                                            <div class = "cancelled">
                                                Order Cancelled
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="buy">
                                        <?php if(!$food_order['order_cancelled']): ?>
                                            <div class="buy-edit">
                                                <span class = "cancel-item" data-foodid = <?= $food_order['id'] ?>>Cancel</span>
                                                <span>
                                                    <a href="./checkout.php?order_id=<?= $food_order['food_id'] ?>">
                                                        Edit
                                                    </a>
                                                </span>
                                            </div>
                                        <?php else: ?>
                                            <div class="buy-return">
                                                <a href="./checkout.php?order_id=<?= $food_order['food_id'] ?>">
                                                    Buy Return
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
                    Order History
                </div>

                <table>
                    <thead>
                        <tr class = "theading">
                            <td>Image</td>
                            <td>Description</td>
                            <td>Quantity</td>
                            <td>Price</td>
                            <td>Total Price</td>
                            <td>Status</td>
                            <td>Action</td>
                        </tr>
                    </thead>

                    <tbody>

                        <?php while($food_order_history = mysqli_fetch_assoc($fetch_user_orders_history)): ?>
                            <?php 
                                $ordered_food_history_query = "SELECT * FROM fooditems WHERE id = {$food_order_history['food_id']}";
                                $ordered_food_history = mysqli_query($conn, $ordered_food_history_query);
                                $ordered_food_history = mysqli_fetch_assoc($ordered_food_history);

                            ?>

                            <tr>
                                <td>
                                    <div class="img">
                                        <img src="./images/food.png" alt="Food Image">
                                    </div>
                                </td>
                                <td>
                                    <div class="info">
                                        <div class="title"><?= $ordered_food_history['food_name'] ?></div>
                                        <div class="description"><?= $ordered_food_history['food_description'] ?></div>
                                    </div>
                                </td>
                                <td>
                                    <div class="quantity">
                                        <span><?= $food_order_history['quantity'] ?></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="price">
                                        <?= $food_order_history['total_price'] ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="price">
                                        <?= ($food_order_history['quantity'] * $food_order_history['total_price']) ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="status">
                                        <?php if(!$food_order_history['order_cancelled']): ?>
                                            <div class = "<?= $food_order_history['status'] ? 'ordered' : 'cancelled' ?>">
                                                <?php echo $food_order_history['status'] == 1 ? "Order Placed" : "Pending" ?>
                                            </div>
                                        <?php else: ?>
                                            <div class = "cancelled">
                                                Order Cancelled
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="buy">
                                        <?php if(!$food_order_history['order_cancelled']): ?>
                                            <div class="buy-edit">
                                                <span class = "cancel-item" data-foodid = <?= $food_order_history['id'] ?>>Cancel</span>
                                                <span>
                                                    <a href="./checkout.php?order_id=<?= $food_order_history['food_id'] ?>">
                                                        Edit
                                                    </a>
                                                </span>
                                            </div>
                                        <?php else: ?>
                                            <div class="buy-return">
                                                <a href="./checkout.php?order_id=<?= $food_order_history['food_id'] ?>">
                                                    Buy Return
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

                let foodId = $(this).data("foodid");
                // alert(foodId);

                if(confirm("Are you sure want to cancel order")) {
                    $.ajax({
                        url : "cancel_order.php",
                        method : "POST",
                        data : { c_itemId : foodId },
                        success : function (data) {
                            alert("Your Item is removed from cart.");
                            location.reload();
                        }
                    });
                }
            });

            
        });
    </script>


<?php include("footer.php") ?>