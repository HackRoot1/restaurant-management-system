<?php

require("../session.php");

// fetch users data first 
$get_user_data_query = "SELECT * FROM users_data WHERE email = '{$_SESSION['email']}'";
$get_user_data = mysqli_query($conn, $get_user_data_query) or die("User Not available");
$user_data = mysqli_fetch_assoc($get_user_data);

// fetch order data 
if (isset($_GET['order_id'])) {
    $fetch_food_data_query = "SELECT * FROM foodItems WHERE id = {$_GET['order_id']}";
    $fetch_food_data = mysqli_query($conn, $fetch_food_data_query);

    $foodData = mysqli_fetch_assoc($fetch_food_data);
}

// fetch order data 
if (isset($_GET['add_cart'])) {

    $fetch_food_add_data_query = "SELECT * FROM foodItems WHERE id = {$_GET['add_cart']}";
    $fetch_food_add_data = mysqli_query($conn, $fetch_food_add_data_query);

    $foodDataCart = mysqli_fetch_assoc($fetch_food_add_data);
}

// fetch cart data of user's 
$fetch_user_cart_data_query = "SELECT * FROM cart WHERE user_id = {$user_data['id']}";
$fetch_user_cart_data = mysqli_query($conn, $fetch_user_cart_data_query);
// $check_already_exists_item = mysqli_fetch_assoc($fetch_user_cart_data);

$cssPage = 'checkout';
include("header.php");


?>


<main>

    <section class="checkout-section">
        <div class="card">
            <div class="title">
                Your Cart
            </div>

            <table>
                <thead>
                    <tr class="theading">
                        <td>Image</td>
                        <td>Description</td>
                        <td>Quantity</td>
                        <td>Price</td>
                        <td>Action</td>
                    </tr>
                </thead>

                <tbody>

                    <?php if (isset($_GET['order_id'])) : ?>
                        <tr>
                            <td>
                                <div class="img">
                                    <img src="../assets/images/food.png" alt="Food Image">
                                </div>
                            </td>
                            <td>
                                <div class="info">
                                    <div class="title">
                                        <?= $foodData['food_name'] ?>
                                    </div>
                                    <div class="description">
                                        <?= $foodData['food_description'] ?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="quantity">
                                    <span style="display: hidden;" class="foodId" data-foodid="<?= $foodData['id'] ?>"></span>
                                    <button class="decrement">-</button>
                                    <span class="value">1</span>
                                    <button class="increment">+</button>
                                </div>
                            </td>
                            <td>
                                <div class="price">
                                    199
                                </div>
                            </td>
                            <td>
                                <div class="price">
                                    Remove
                                </div>
                            </td>
                        </tr>
                    <?php elseif (isset($_GET['add_cart'])) : ?>
                        <tr>
                            <td>
                                <div class="img">
                                    <img src="./images/food.png" alt="Food Image">
                                </div>
                            </td>
                            <td>
                                <div class="info">
                                    <div class="title">
                                        <?= $foodDataCart['food_name'] ?>
                                    </div>
                                    <div class="description">
                                        <?= $foodDataCart['food_description'] ?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="quantity">
                                    <span style="display: hidden;" class="foodId" data-foodid="<?= $foodDataCart['id'] ?>"></span>
                                    <button class="decrement">-</button>
                                    <span class="value">1</span>
                                    <button class="increment">+</button>
                                </div>
                            </td>
                            <td>
                                <div class="price">
                                    199
                                </div>
                            </td>
                            <td>
                                <div class="price">
                                    Remove
                                </div>
                            </td>
                        </tr>
                    <?php elseif (isset($fetch_user_cart_data) && mysqli_num_rows($fetch_user_cart_data) > 0) :
                            while ($data = mysqli_fetch_assoc($fetch_user_cart_data)) :
                                $food_query = "SELECT * FROM foodItems WHERE id = {$data['food_id']}";
                                $food_result = mysqli_query($conn, $food_query);

                                $item = mysqli_fetch_assoc($food_result);
                    ?>
                            <tr>
                                <td>
                                    <div class="img">
                                        <img src="./images/food.png" alt="Food Image">
                                    </div>
                                </td>
                                <td>
                                    <div class="info">
                                        <div class="title">
                                            <?= $item['food_name'] ?>
                                        </div>
                                        <div class="description">
                                            <?= $item['food_description'] ?>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="quantity">
                                        <span style="display: hidden;" class="foodId" data-foodid="<?= $item['id'] ?>"></span>
                                        <button class="decrement">-</button>
                                        <span class="value">1</span>
                                        <button class="increment">+</button>
                                    </div>
                                </td>
                                <td>
                                    <div class="price">
                                        199
                                    </div>
                                </td>
                                <td>
                                    <div class="price remove-item" data-id="<?= $item['id'] ?>">
                                        Remove
                                    </div>
                                </td>
                            </tr>
                    <?php   
                            endwhile;
                        else : 
                    ?>
                        <tr style="height: 200px">
                            <td colspan="5">
                                <div class="price">
                                    No Items in Your Cart
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>

                </tbody>


                <tfoot>
                    <tr>
                        <td colspan="2" rowspan="2"></td>
                        <td>Subtotal:</td>
                        <td class="subtotal-price">0</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Shipping:</td>
                        <td>Free</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <a href="./dashboard.php">
                                < Continue Shopping </a>
                        </td>
                        <td>Total:</td>
                        <td class="total-price">0</td>
                        <td></td>
                    </tr>
                </tfoot>

            </table>

        </div>

        <div class="checkout">
            <div class="title">
                Checkout
            </div>

            <div>
                <form action="./my_orders.php" class="payment-card">
                    <hr>

                    <div class="choose-card">
                        <div>Payment Method:</div>
                        <div>
                            <input type="radio" name="cred" id="cred">
                            <label for="cred">Credit Card</label>
                        </div>
                        <div>
                            <input type="radio" name="cred" id="paypal">
                            <label for="paypal">PayPal</label>
                        </div>
                    </div>

                    <hr>

                    <div>
                        <label for="card-name">
                            Name on card:
                        </label>
                        <input type="text" id="card-name">
                    </div>

                    <div>
                        <label for="card-number">Card Number:</label>
                        <input type="text" id="card-number">
                    </div>

                    <div>
                        <label for="expiry-date">Expiration Date:</label>
                        <input type="text" id="expiry-date">
                    </div>

                    <div>
                        <label for="cvv">CVV:</label>
                        <input type="text" id="cvv">
                    </div>

                    <div>
                        <button id="checkout">Check Out</button>
                    </div>
                </form>

            </div>
        </div>
    </section>

</main>


<script>
    $(document).ready(function() {

        // total value displaying
        function updateValue() {
            let total = 0;
            $(".quantity").each(function() {
                let count = parseInt($(this).find(".value").text());
                let price = parseFloat($(this).closest("tr").find(".price").text());
                total += count * price;
            });
            $(".subtotal-price").text(total.toFixed(2));
            $(".total-price").text(total.toFixed(2));
            // $("tfoot td:last-child").text(total.toFixed(2)); // Update total in footer
        }


        updateValue();

        // increment button
        $(".increment").on("click", function() {
            var count = $(this).siblings(".value").text();
            // alert(count);
            count = +count + 1;
            $(this).siblings(".value").text(count);
            updateValue();
        });

        // decrement button
        $(".decrement").on("click", function() {
            var count = $(this).siblings(".value").text();
            // alert(count);
            if (count > 1) {
                count = +count - 1;
                $(this).siblings(".value").text(count);
            }
            updateValue();
        });



        // Remove item from cart
        $(document).on("click", ".remove-item", function() {

            let item = $(this).data("id");
            // alert(item);

            if (confirm("Are you sure want to remove item")) {
                $.ajax({
                    url: "./models/remove_item.php",
                    method: "POST",
                    data: {
                        itemId: item
                    },
                    success: function(data) {
                        alert("Your Item is removed from cart.");
                        location.reload();
                    }
                });
            }
            updateValue();

        });


        $(document).on("click", "#checkout", function() {
            $("form").on("submit", function(e) {
                e.preventDefault();
            });

            let data = [];
            // let foodId = 0;
            $(".quantity").each(function() {
                let count = parseInt($(this).find(".value").text());
                let foodId = $(this).find(".foodId").data("foodid");
                let price = parseFloat($(this).closest("tr").find(".price").text());
                let obj = {
                    "count": count,
                    "foodId": foodId,
                    "price": price
                }
                data.push(obj);
            });
            console.log(data);

            $.ajax({
                url: "./models/customer_order_done.php",
                method: "POST",
                data: {
                    c_order_data: data
                },
                success: function(data) {
                    if(data){
                        alert("Your order is placed" + data);
                        location.pathname = "restaurant-template-php/user/my_orders.php";
                    }else {
                        alert("Error");
                    }
                }
            });
        });
    });
</script>


<?php include("footer.php") ?>