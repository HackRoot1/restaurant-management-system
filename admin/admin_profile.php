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


        .profile-section {
            max-height: 100vh;
            min-height: 500px;
            padding: 20px 0px;
        }
        
        .profile-section .tabs {
            display: flex;
            gap: 20px;
            font-size: 20px;
            background-color: #f0f0f0;
        }
        
        .profile-section .tabs div {
            padding: 10px 20px;
            height: 100%;
            cursor: pointer;
        }
        
        .profile-section .tabs .active {
            background-color: #ba42ba;
            color: white;
        }
        
        .profile-section .title {
            padding: 20px 0;
            font-size: 25px;
            font-weight: 600;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
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
        }

        form .btns input {
            height: 40px;
            width: 200px;
            border: none;
            outline: none;
            font-size: 16px;
            font-weight: 600;
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

                <section class = "profile-section">

                    <div class = "tabs">
                        <div class = "active personal">Personal Information</div>
                        <div class = "change-password">Change Password</div>
                    </div>
        
                    <div class = "personal-info">
                        <div class="title">My Profile</div>
        
                        <div class="profile-form">
                            <form action="">
                                <div>
                                    <label for="fname">First name</label>
                                    <input type="text" id = "fname">
                                </div>
                                
                                <div>
                                    <label for="lname">Last name</label>
                                    <input type="text" id = "lname">
                                </div>
                                
                                <div>
                                    <label for="uname">Username</label>
                                    <input type="text" id = "uname">
                                </div>
        
                                <div>
                                    <label for="m_no">Mobile No.</label>
                                    <input type="text" id = "m_no">
                                </div>
                                
                                <div>
                                    <label for="email">Email</label>
                                    <input type="text" id = "email">
                                </div>
                            
                                <div class="btns">
                                    <input type="reset" value="Reset">
                                    <input type="submit" name = "submitPersonalInfo" value="Submit">
                                </div>
                            </form>
        
                        </div>
                    </div>
        
                    
                    
                    <div class = "password-info">
                        <div class="title">Change Password</div>
        
                        <div class="profile-form">
                            <form action="">
                                <div>
                                    <label for="c_pass">Current Password</label>
                                    <input type="text" id = "c_pass">
                                </div>
                                
                                <div>
                                    <label for="new_pass">New Password</label>
                                    <input type="text" id = "new_pass">
                                </div>
                                
                                <div>
                                    <label for="confirm_pass">Confirm New Password</label>
                                    <input type="text" id = "confirm_pass">
                                </div>
                            
                                <div class="btns">
                                    <input type="reset" value="Reset">
                                    <input type="submit" name = "submitPersonalInfo" value="Submit">
                                </div>
                            </form>
        
                        </div>
                    </div>
        
                </section>
            </section>

        </section>
        

    </main>


    <script>
        // jquery code for form changing

        $(document).ready(function(){
            $(".address-info").hide();
            $(".password-info").hide();

            $(".tabs .personal").on("click", function(){
                $(this).addClass("active");
                $(".tabs .add-address").removeClass("active");
                $(".tabs .change-password").removeClass("active");
                $(".address-info").hide();
                $(".personal-info").show();
                $(".password-info").hide();
            });


            $(".tabs .change-password").on("click", function(){
                $(this).addClass("active");
                $(".tabs .personal").removeClass("active");
                $(".tabs .add-address").removeClass("active");
                $(".address-info").hide();
                $(".personal-info").hide();
                $(".password-info").show();
            });

        });
    </script>    

</body>
</html>