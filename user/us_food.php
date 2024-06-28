<?php 

    require("../session.php");

    $get_user_data_query = "SELECT * FROM users_data WHERE email = '{$_SESSION['email']}'";
    $get_user_data = mysqli_query($conn, $get_user_data_query) or die("User Not available");
    $user_data = mysqli_fetch_assoc($get_user_data);


    $fetch_food_data_query = "SELECT * FROM foodItems WHERE id = {$_GET['s_item']}";
    $fetch_food_data = mysqli_query($conn, $fetch_food_data_query);

    $foodData = mysqli_fetch_assoc($fetch_food_data);
    
    $cssPage = 'us_food';
    include("header.php");
    
?>

    
    <main>

        <section class="food">
            <div class="food-container">
                <div class="food-items food-1">
                    <img src="../assets/images/desi-meals.png" alt="" id="food-1">
                </div>
                <div class="food-items food-2">
                    <img src="../assets/images/desi-meals2.png" alt="" id="food-2">
                </div>
                
                <div class="food-items food-3">
                    <div class="btn">
                        More..
                    </div>
                    <img src="../assets/images/desi-meals3.png" alt="" id="food-3">
                </div>
                <div class="food-items food-4">
                    <img src="../assets/images/desi-meals4.png" alt="" id="food-4">
                </div>
            </div>



            <div class="food-content">
                <div class="food-title"><?= $foodData['food_name'] ?></div>
                <div class="food-text">
                    <?= $foodData['food_description'] ?>
                </div>
                <div class="btns">
                    <a href="./checkout.php?order_id=<?= $foodData['id'] ?>">
                        Order
                    </a>

                    <a href="./add_to_cart.php?add_cart=<?= $foodData['id'] ?>">
                        Add to Cart
                    </a>
                </div>
            </div>
        </section>

    </main>

<?php include("footer.php") ?>