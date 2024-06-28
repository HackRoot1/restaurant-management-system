<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- ============= jquery cdn =========== -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="../assets/js/jQuery.js"></script>

    <link rel="stylesheet" href="../assets/css/common.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/<?= $cssPage ?>.css">


    <style>
        .profile-links>li>form>input {
            width: 100%;
            background-color: transparent;
            outline: none;
            border: none;
            text-align: start;
            font-size: 20px;
            font-weight: 400;
            font-family: sans-serif;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <nav>
        <div>
            <span class="title">Mazano.</span>
        </div>

        <div class="links-items">
            <span><a href="./dashboard.php">Home</a></span>
            <span><a href="#">Fresh Food</a></span>
            <span><a href="#">Shop</a></span>
            <span><a href="#">About</a></span>
            <span><a href="#">Blog</a></span>
        </div>

        <div class="links-icons">
            <span><i class="fa-solid fa-magnifying-glass"></i></span>
            <span>
                <?= $user_data['username'] ?>
                <a>
                    <i class="fa-regular fa-user"></i>
                </a>
            </span>
            <span>
                <a href="./checkout.php">
                    <i class="fa-solid fa-bag-shopping"></i>
                </a>
            </span>
        </div>
    </nav>


    <section class="profile-links" id = "profile-links-tab">
        <li><a href="./checkout.php">Cart</a></li>
        <li><a href="./my_orders.php">Your Orders</a></li>
        <li><a href="./table_reserved.php">Reservations</a></li>
        <li><a href="./profile.php">Settings</a></li>
        <li>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                <input type="submit" value="Logout" name="logout">
            </form>
        </li>
    </section>


    <script>
        $(document).ready(function() {
            $(".profile-links").hide();

            $(".fa-user").on("click", function() {
                $(".profile-links").slideToggle();
            });

            $(document).on("click", (e) => {
                console.log(e.target === $(".profile-links"));
                (e.target === $(".profile-links")) ? $(".profile-links").hide() : false;
            });

        });
    </script>