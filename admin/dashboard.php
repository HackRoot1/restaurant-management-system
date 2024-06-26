<!-- us_food.php === user single food .php  -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../css/style.css">

    <style>
        
        main {
            display: flex;
        }

        nav {
            padding: 0 30px;
            width: calc(100vw - 250px);
        }

        .sidebar {
            width: 250px;
            background-color: rgba(231, 31, 31, 0.822);
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 30px;
        }

        .sidebar .logo {
            text-align: center;
            font-size: 35px;
            font-weight: 600;
        }
        .sidebar :is(.actions, .links, .logo) {
            display: flex;
            flex-direction: column;
            padding: 10px 20px;
            gap: 20px;
        }

        .sidebar a {
            background-color: aliceblue;
            padding: 5px 15px;
            text-align: center;
            font-size: 20px;
        }


        .main-section {
            padding: 30px 50px;
        }

        .main-section .title {
            font-size: 30px;
            font-weight: 600;
        }

        .table-details {
            padding: 50px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        table thead tr{
            background-color: antiquewhite;
        }
        
        table thead td{
            font-size: 20px;
            font-weight: 600;
        }

        table tr td{
            border: 1px solid black;
            padding: 10px;
        }



    </style>

</head>
<body>



    
    
    <main>
        <section class="sidebar">
            <div>
                <div class="logo">Mazano.</div>
                
                <div class="links">
                    <a href="./dashboard.php">Home</a>
                    <a href="./food_lists.php">Food Lists</a>
                    <a href="./staff_lists.php">Staff Lists</a>
                    <a href="./add_table_reservation.php">Table Reservations</a>
                    <a href="./customers_orders.php">Customer Orders</a>
                </div>

            </div>

            <div class="actions">
                <a href="./admin_profile.php">Settings</a>
                <a href="#">Logout</a>
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
                    <span>
                        <a href="./profile.php">
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


            <section class="main-section">
                <div class="title">
                    Welcome to Admin Dashboard
                </div>

            </section>

        </section>
        

    </main>

    

</body>
</html>