<!-- us_food.php === user single food .php  -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Dashboard</title>

    <!-- ============= jquery cdn =========== -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../css/style.css">

    <style>
        
        main {
            display: flex;
        }

        nav {
            padding: 0 30px;
            width: calc(100vw - 250px);
            margin-left: 250px;
        }

        .sidebar {
            width: 250px;
            background-color: rgba(231, 31, 31, 0.822);
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 30px;

            position: fixed;
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
            overflow-y: scroll;
            margin-left: 250px;
        }

        .main-section .title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 30px;
            font-weight: 600;
        }

        .main-section .title .btns {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 20px;
            border-radius: 5px;
            background-color: antiquewhite;
            padding: 5px 15px;
            cursor: pointer;
        }
        .table-details {
            padding: 30px 0;
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
            width: 200px;
            font-size: 1.2rem;
        }

        table tbody :is(.img, img ){
            text-align: center;
            width: 150px;
            height: auto;
        }

        table tbody .actions > div {
            display: flex;
            justify-content: space-around;
            align-items: center;
        }
        
        table tbody .actions > div > div{
            background-color: rgb(105, 105, 105);
            padding: 5px 15px;
            border-radius: 5px;
            color: white;
            cursor: pointer;
        }


        
        #modal {
            position: fixed;
            height: 100vh;
            width: 100vw;
            background-color: rgba(0, 0, 0, 0.527);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 20;
        }

        #modal .modal-box {
            border-radius: 5px;
            min-height: 60%;
            width: 60%;
            background-color: #ba42ba;
            position: relative;
            color: white;
        }

        #modal .modal-box .close-btn {
            height: 40px;
            width: 40px;
            background-color: red;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 20px;

            border-radius: 50px;
            cursor: pointer;

            position: absolute;
            top: -20px;
            right: -20px;
        }

        .add-form .title {
            font-size: 25px;
            font-weight: 600;
            padding: 30px;
        }

        
        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
            padding: 20px 0px;
        }
        form > div {
            /* border: 1px solid blue; */
            padding: 5px 0px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 20px;
            gap: 20px
        }
        
        form label {
            width: 20%;
        }
        
        form input, form select {
            height: 40px;
            width: 30%;
            border: none;
            padding: 5px 10px;
            font-size: 16px;
            border-bottom: 1px solid black;
            background: transparent;
            /* color: white; */
        }
        
        form input[type='file'] {
            border: none;
        }

        form .btns input {
            height: 40px;
            width: 200px;
            border: none;
            outline: none;
            font-size: 16px;
            font-weight: 600;
            background: #f0f0f0;
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
                <a href="../index.php">Logout</a>
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


            <section class="main-section">
                <div class="title">
                    <span>
                        Table Reservations
                    </span>
                    <span class="btns">
                        <a href="#" class = "add-modal">
                            Add Tables
                        </a>
                    </span>
                </div>


                <div class="table-details">

                    <table>
                        <thead>
                            <tr>
                                <td>Table No</td>
                                <td>Seats</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>001</td>
                                <td>06</td>
                                <td>Booked</td>
                                <td class = "actions">
                                    <div>
                                        <div>View</div>
                                        <div>Remove</div>
                                        <div class = "add-modal" data-foodid = "1">Edit</div>
                                    </div>
                                </td>
                            </tr>
                            
                            
                            <tr>
                                <td>002</td>
                                <td>04</td>
                                <td>Empty</td>
                                <td class = "actions">
                                    <div>
                                        <div>View</div>
                                        <div>Remove</div>
                                        <div class = "add-modal" data-foodid = "2">Edit</div>
                                    </div>
                                </td>
                            </tr>


                        </tbody>
                    </table>

                </div>
            </section>

        </section>
        

        <section id="modal">
            <div class="modal-box">
                <div class="close-btn">
                    X
                </div>

                <div class="add-form">

                    <div class="title">
                        Add Table
                    </div>

                    <form action="">
                        
                        <div>
                            <label for="tableNo">Table No</label>
                            <input type="text" id = "tableNo">
                        </div>
                        
                        <div>
                            <label for="seats">Seats</label>
                            <input type="text" id = "seats">
                        </div>
                    
                        <div class="btns">
                            <input type="reset" value="Reset">
                            <input type="submit" name = "submitPersonalInfo" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </section>


    </main>

    

    <script>
        $(document).ready(function() {
            $("#modal").hide();

            $(".add-modal").on("click", function() {
                $("#modal").show();
            });

            $(".close-btn").on("click", function() {
                $("#modal").hide();
            });
        });
    </script>

</body>
</html>