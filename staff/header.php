<?php 

    include("./session.php");

    $get_user_data_query = "SELECT * FROM users_data WHERE email = '{$_SESSION['email']}'";
    $get_user_data = mysqli_query($conn, $get_user_data_query) or die("User Not available");
    $user_data = mysqli_fetch_assoc($get_user_data);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- ============= jquery cdn =========== -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/<?= $css_page ?>.css">

</head>
<body>



    
    
    <main>
        <section class="sidebar">
            <div>
                <div class="logo">Mazano.</div>
                
                <div class="links">
                    <a href="./dashboard.php">Home</a>
                    <a href="./food_lists.php">Food Lists</a>
                    <a href="./add_table_reservation.php">Table Reservations</a>
                    <a href="./customers_orders.php">Customer Orders</a>
                </div>

            </div>

            <div class="actions">
                <a href="./staff_profile.php">Settings</a>
                <!-- <a href="../index.php">Logout</a> -->
                <form action = "<?= $_SERVER['PHP_SELF'] ?>" method = "POST">
                    <input type="submit" value="Logout" name = "logout">
                </form>
            </div>
        </section>  

        <section>

            <nav>
                <div>
                    <span class="title"></span>
                </div>

                <div class = "links-items">
                    <span><a href="./dashboard.php">Home</a></span>
                    <span><a href="#">Fresh Food</a></span>
                    <span><a href="#">Shop</a></span>
                    <span><a href="#">About</a></span>
                    <span><a href="#">Blog</a></span>
                </div>

                <div class = "links-icons">
                    <!-- <span><a href="./login.php">Log In</a></span>
                    <span><a href="./registration.php">Sign Up</a></span> -->
                    <span><i class="fa-solid fa-magnifying-glass"></i></span>
                    <!-- <span>
                        <a href="./profile.php">
                            <i class="fa-regular fa-user"></i>
                        </a>
                    </span>
                    <span>
                        <a href="./checkout.php">    
                            <i class="fa-solid fa-bag-shopping"></i>
                        </a>
                    </span> -->
                </div>
            </nav>
