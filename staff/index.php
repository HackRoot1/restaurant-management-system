<?php 

    require("../config.php");

    if(isset($_POST['login-form'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $login_query = "SELECT * FROM users_data WHERE email = '{$email}' AND password = '{$password}'";
        $login_result = mysqli_query($conn, $login_query) or die("Login Query Failed");

        if($login_result->num_rows === 1) {
            session_start();
            $_SESSION['email'] = $email;
            header("Location: ./dashboard.php");
            exit();
        }
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../css/style.css">

    <style>
        main {
            width: 100vw;
            height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;

            background: url(../images/image2.jpg);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        #login-section {
            width: 70vw;
            height: 80vh;
            /* background-color: rgb(255, 255, 255); */

            border-radius: 10px;
            border: 5px solid rgb(0, 0, 0);

            display: flex;

            backdrop-filter: blur(10px);
        }
        
        #login-section > div {
            width: 50%;
        }
        
        #login-section > .login-illustration {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #login-section img {
            width: 80%;
        }

        .login-form {
            padding: 5%;

            display: flex;
            flex-direction: column;
            justify-content: center;

            gap: 30px;
        }

        .title {
            font-size: 50px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        form > div {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        label {
            font-weight: 600;
        }

        input {
            height: 40px;
            padding: 5px 0px;
            border: none;
            outline: none;
            border-bottom: 1px solid blue;
            background-color: transparent;
        }

        input[type='submit'] {
            background-color: blue;
            color: white;
            font-size: 25px;
            font-weight: 600;
            cursor: pointer;

            box-shadow: 0 0.3rem 1rem #535252;
        }
        .return-page {
            position: absolute;
            top: 50px;
            left: 50px;

            background-color: #f0f0f0;
            padding: 10px 20px;
            border-radius: 50px;
            cursor: pointer;
        }

    </style>

</head>
<body>
    
    <main>
        <section id = "login-section">

            <div class = "login-form">
                <div class="return-page"><a href="../index.html">Back</a></div>
                <div>
                    <div class="title">Login</div>
                    <div class="data">Welcome to log in to your restaurant management system.</div>
                </div>

                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "post">

                    <div>
                        <label for="email">Email</label>
                        <input type="email" name = "email" id = "email" placeholder="Please enter your email" autocomplete="off">
                    </div>

                    <div>
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Please enter your password"  autocomplete="off">
                    </div>

                    <div>
                        <input type="submit" value="LOGIN" name = "login-form">
                    </div>
                </form>
            </div>

            <div class = "login-illustration">
                <img src="../images/illustration2.png" alt="">
            </div>
        </section>
    </main>

</body>
</html>