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

    $cssPage = 'dashboard';
    include("header.php");
    
?>

    <main>


        <section class = "categories">
            <a href="./table_reservation.php">
                <div>
                    <span class = "icon">
                        <i class="fa-solid fa-utensils"></i>
                    </span>
                    <span>
                        Book Table
                    </span>
                </div>
            </a>

            <a href="#">
                <div class = "active">
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

        <section class = "filters">
            
            <!-- applied filter and their count -->
            <div>
                <span class = "count">1</span>
                <span>
                    Filters
                </span>
            </div>
            <div class = "applied-filter">
                <span>
                    Burger
                </span>
                <span>X</span>
            </div>
            <div>Rating: 4.0+</div>
            <div>Pure Veg</div>

            <!-- search box -->
            <div title = "search box here">Cuisines</div>

        </section>


        <section class="best-categories">
            <div class="title">Inspiration for your first order</div>
            <div class="boxes">

                <?php while($data = mysqli_fetch_assoc($category_data)): ?>
                    <div class="box">
                        <img src="./images/food2.png" alt="Food Category">
                        <div class="food-name"><?= $data['food_category']; ?></div>
                    </div>
                <?php endwhile; ?>
                
            </div>
        </section>


        <section class="menu-list">
            <div class = "title">
                Get Your Loved Food
            </div>
            <div class="boxes">

                <?php while($foodItem = mysqli_fetch_assoc($fetch_food_data)): ?>
                    <div class="box">
                        <a href="./us_food.php?s_item=<?= $foodItem['id'] ?>">
                            <div class="box-img">
                                <img src="./images/burger.png" alt="Food Image">
                                <?php if($foodItem['discount_percentage'] > 0): ?>
                                <div class="discount"> <?= $foodItem['discount_percentage'] . "% Off" ?> </div>
                                <?php endif; ?>
                            </div>
                            <div class = "box-title">
                                <span class="title"><?= $foodItem['food_name'] ?></span>
                                <span class="rating">4.3 <i class = "fa-solid fa-star"></i></span>
                            </div>
                            <div class="details">
                                <span>
                                    <?= $foodItem['food_description'] ?>
                                </span>
                                <span class="price">
                                    <i class="fa-solid fa-indian-rupee-sign"></i>
                                        <?= $foodItem['price'] ?> for one
                                </span>
                            </div>
                        </a>
                    </div>
                <?php endwhile; ?>
                
            </div>

            <div class="load-more">
                <button>
                    Load More...
                </button>
            </div>
        </section>




    </main>


<?php include("footer.php") ?>