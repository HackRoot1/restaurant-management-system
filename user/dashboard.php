<?php

require("../session.php");

$get_user_data_query = "SELECT * FROM users_data WHERE email = '{$_SESSION['email']}'";
$get_user_data = mysqli_query($conn, $get_user_data_query) or die("User Not available");
$user_data = mysqli_fetch_assoc($get_user_data);
// print_r($user_data['username']);


// $fetch_food_data_query = "SELECT * FROM foodItems";
// $fetch_food_data = mysqli_query($conn, $fetch_food_data_query);


$category_query = "SELECT DISTINCT(food_category) FROM foodItems";
$category_data = mysqli_query($conn, $category_query);

$cssPage = 'dashboard';
include("./header.php");

?>

<main>


    <section class="categories">
        <a href="./table_reservation.php">
            <div>
                <span class="icon">
                    <i class="fa-solid fa-utensils"></i>
                </span>
                <span>
                    Book Table
                </span>
            </div>
        </a>

        <a href="#">
            <div class="active">
                <span class="icon">
                    <i class="fa-solid fa-utensils"></i>
                </span>
                <span>
                    Delivery
                </span>
            </div>
        </a>

        <a href="#">
            <div>
                <span class="icon">
                    <i class="fa-solid fa-utensils"></i>
                </span>
                <span>
                    Nightlife
                </span>
            </div>
        </a>

    </section>
    
    <hr>

    <section class="filters">

        <!-- applied filter and their count -->
        <div>
            <span class="count">1</span>
            <span>
                Filters
            </span>
        </div>
        <div class="applied-filter">
            <span>
                Burger
            </span>
            <span>X</span>
        </div>
        <div>Rating: 4.0+</div>
        <div>Pure Veg</div>

        <!-- search box -->
        <div title="search box here">Cuisines</div>

    </section>


    <section class="best-categories">
        <div class="title">Inspiration for your first order</div>
        <div class="boxes">

            <?php while ($data = mysqli_fetch_assoc($category_data)) : ?>
                <div class="box">
                    <img src="../assets/images/food2.png" alt="Food Category">
                    <div class="food-name"><?= $data['food_category']; ?></div>
                </div>
            <?php endwhile; ?>

        </div>
    </section>


    <section class="menu-list">
        <div class="title">
            Get Your Loved Food
        </div>

        <div class="result-ajax-data">

        </div>

    </section>

</main>


<script>
    $(document).ready(function() {
        function loadData(page) {
            $.ajax({
                url: "load_dynamic_data.php",
                type: "POST",
                data: {
                    page_no: page
                },
                success: function(data) {
                    if (data) {
                        $(".load-more").remove();
                        $(".result-ajax-data").append(data);
                    } else {
                        $("#load-more").html("Finished");
                        $("#load-more").prop("disabled", true);
                    }
                },
            });
        }

        loadData();

        $(document).on("click", "#load-more", function() {
            $("#load-more").html("Loading...");
            var page_id = $(this).data("id");
            loadData(page_id);
        });

    });
</script>

<?php include("footer.php") ?>