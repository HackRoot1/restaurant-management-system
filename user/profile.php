<?php 

    
    require("session.php");


    $get_user_data_query = "SELECT * FROM users_data WHERE email = '{$_SESSION['email']}'";
    $get_user_data = mysqli_query($conn, $get_user_data_query) or die("User Not available");
    $user_data = mysqli_fetch_assoc($get_user_data);
    // print_r($user_data['username']);

    $get_user_personal_data_query = "SELECT * FROM users_personal_info WHERE user_id = '{$user_data['id']}'";
    $get_user_personal_data = mysqli_query($conn, $get_user_personal_data_query) or die("Users personal data Not available");
    $user_personal_data = mysqli_fetch_assoc($get_user_personal_data);

    $get_user_address_data_query = "SELECT * FROM users_address_info WHERE user_id = '{$user_data['id']}'";
    $get_user_address_data = mysqli_query($conn, $get_user_address_data_query) or die("Users address data Not available");
    $user_address_data = mysqli_fetch_assoc($get_user_address_data);


    if(isset($_POST['submitPersonalInfo'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $m_no = $_POST['m_no'];
        $username = $_POST['username'];
        $email = $_POST['email'];

        $insert_query = "INSERT INTO users_personal_info(user_id, fname, lname, m_no) VALUES( '{$user_data['id']}', '{$fname}', '{$lname}', '{$m_no}' )";
        $insert_query_result = mysqli_query($conn, $insert_query) or die("Insert query failed");

        $update_query = "UPDATE users_data SET username = '{$username}', email = '{$email}' WHERE id = '{$user_data['id']}'";
        $update_query_result = mysqli_query($conn, $update_query) or die("Update query failed");

    }

    if(isset($_POST['submitAddress'])) {
        $address = $_POST['address'];
        $addr2 = $_POST['addr2'];
        $country = $_POST['country'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        $zip_code = $_POST['zip_code'];

        if($_POST['submitAddress'] == "Submit") {
            $insert_query = "INSERT INTO 
                                users_address_info
                                (user_id, address, addr2, country, state, city, zip_code) 
                            VALUES
                                (
                                    '{$user_data['id']}', 
                                    '{$address}', 
                                    '{$addr2}', 
                                    '{$country}', 
                                    '{$state}', 
                                    '{$city}', 
                                    '{$zip_code}' 
                                )";
            mysqli_query($conn, $insert_query) or die("Insert query failed");
        }elseif($_POST['submitAddress'] == "Update") {
            $update_query = "UPDATE 
                                users_address_info
                            SET
                                address = '{$address}', 
                                addr2 = '{$addr2}', 
                                country = '{$country}', 
                                state = '{$state}', 
                                city = '{$city}', 
                                zip_code ='{$zip_code}' 
                            WHERE 
                                user_id = '{$user_data['id']}'
                                ";
            mysqli_query($conn, $update_query) or die("update query failed" . mysqli_error($conn));
        }

    }
    
    mysqli_close($conn);


    $cssPage = 'profile';
    include("header.php");
    
?>
    
    <main>

        <section class = "profile-section">

            <div class = "tabs">
                <div class = "active personal">Personal Information</div>
                <div class = "add-address">Add Address</div>
                <div class = "change-password">Change Password</div>
            </div>

            <div class = "personal-info">
                <div class="title">My Profile</div>

                <div class="profile-form">
                    <form action="<?= $_SERVER['PHP_SELF'] ?>" method = "POST">
                        <div>
                            <label for="fname">First name</label>
                            <input type="text" id = "fname" name = "fname" value = "<?= $user_personal_data['fname'] ?? "" ?>">
                        </div>
                        
                        <div>
                            <label for="lname">Last name</label>
                            <input type="text" id = "lname" name = "lname" value = "<?= $user_personal_data['lname'] ?? "" ?>">
                        </div>
                        
                        <div>
                            <label for="uname">Username</label>
                            <input type="text" id = "uname" name = "username" value = "<?= $user_data['username'] ?? "" ?>">
                        </div>

                        <div>
                            <label for="m_no">Mobile No.</label>
                            <input type="text" id = "m_no" name = "m_no" value = "<?= $user_personal_data['m_no'] ?? "" ?>">
                        </div>
                        
                        <div>
                            <label for="email">Email</label>
                            <input type="text" id = "email" name = "email" value = "<?= $user_data['email'] ?? "" ?>">
                        </div>
                    
                        <div class="btns">
                            <input type="reset" value="Reset">
                            <input type="submit" name = "submitPersonalInfo" value="Submit">
                        </div>
                    </form>

                </div>
            </div>


            <div class = "address-info">
                <div class="title">Add Address</div>

                <div class="profile-form">
                    <form action="<?= $_SERVER['PHP_SELF'] ?>" method = "POST">
                        <div>
                            <label for="address">Address</label>
                            <input type="text" id = "address" name = "address" value = "<?= $user_address_data['address'] ?? "" ?>">
                        </div>
                        
                        <div>
                            <label for="addr2">Address Line 2</label>
                            <input type="text" id = "addr2" name = "addr2" value = "<?= $user_address_data['addr2'] ?? "" ?>">
                        </div>
                        
                        
                        <div>
                            <label for="Country">Country</label>
                            <select name="country" id="Country">
                                <option value="">-- Select --</option>
                                <option value="one" <?= $user_address_data['country'] == 'one' ? "selected" : "" ?> >one</option>
                                <option value="two" <?= $user_address_data['country'] == 'two' ? "selected" : "" ?> >one</option>
                                <option value="three" <?= $user_address_data['country'] == 'three' ? "selected" : "" ?> >one</option>
                                <option value="four" <?= $user_address_data['country'] == 'four' ? "selected" : "" ?> >one</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="state">State</label>
                            <select name="state" id="state">
                                <option value="">-- Select --</option>
                                <option value="one" <?= $user_address_data['state'] == 'one' ? "selected" : "" ?> >one</option>
                                <option value="two" <?= $user_address_data['state'] == 'two' ? "selected" : "" ?> >one</option>
                                <option value="three" <?= $user_address_data['state'] == 'three' ? "selected" : "" ?> >one</option>
                                <option value="four" <?= $user_address_data['state'] == 'four' ? "selected" : "" ?> >one</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="city">City</label>
                            <select name="city" id="city">
                                <option value="">-- Select --</option>
                                <option value="one" <?= $user_address_data['city'] == 'one' ? "selected" : "" ?> >one</option>
                                <option value="two" <?= $user_address_data['city'] == 'two' ? "selected" : "" ?> >one</option>
                                <option value="three" <?= $user_address_data['city'] == 'three' ? "selected" : "" ?> >one</option>
                                <option value="four" <?= $user_address_data['city'] == 'four' ? "selected" : "" ?> >one</option>
                            </select>
                        </div>

                        <div>
                            <label for="zip_code">Zip Code</label>
                            <input type="text" id = "zip_code" name = "zip_code" value = "<?= $user_address_data['zip_code'] ?? "" ?>">
                        </div>
                    
                        <div class="btns">
                            <input type="reset" value="Reset">
                            <input type="submit" name = "submitAddress" value="<?= $user_address_data['address'] ? "Update" : "Submit" ?>">
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

                
                $(".tabs .add-address").on("click", function(){
                    $(this).addClass("active");
                    $(".tabs .personal").removeClass("active");
                    $(".tabs .change-password").removeClass("active");
                    $(".address-info").show();
                    $(".personal-info").hide();
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
    </main>

<?php include("footer.php") ?>
    