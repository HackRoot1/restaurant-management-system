<?php 

    $css_page = "staff_profile";
    include("./header.php");

    $user_personal_info_query = "SELECT * FROM users_personal_info WHERE user_id = {$user_data['id']}";
    $user_personal_info = mysqli_query($conn, $user_personal_info_query);

    $user_personal_info = mysqli_fetch_assoc($user_personal_info);

    if(isset($_POST['submitPersonalInfo'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $m_no = $_POST['m_no'];

        $email = $_POST['email'];
        $username = $_POST['username'];

        $insert_query = "INSERT INTO 
                            `users_personal_info`
                            (user_id, fname, lname, m_no) 
                        VALUES 
                        ('{$user_data['id']}', '{$fname}', '{$lname}', '{$m_no}')";

        $update_query = "UPDATE 
                            users_data 
                        SET 
                            email = '{$email}',
                            username = '{$username}'
                        WHERE 
                            id = {$user_data['id']}";

        mysqli_query($conn, $insert_query) or die(mysqli_error($conn));
        mysqli_query($conn, $update_query) or die(mysqli_error($conn));
    }
?>

            <section class="main-section">

                <section class = "profile-section">

                    <div class = "tabs">
                        <div class = "active personal">Personal Information</div>
                        <div class = "change-password">Change Password</div>
                    </div>
        
                    <div class = "personal-info">
                        <div class="title">My Profile</div>
        
                        <div class="profile-form">
                            <form action="<?= $_SERVER['PHP_SELF'] ?>" method = "POST">
                                <div>
                                    <label for="fname">First name</label>
                                    <input type="text" id = "fname" name = "fname" value = "<?= $user_personal_info['fname'] ?? "" ?>">
                                </div>
                                
                                <div>
                                    <label for="lname">Last name</label>
                                    <input type="text" id = "lname" name = "lname" value = "<?= $user_personal_info['lname'] ?? "" ?>">
                                </div>
                                
                                <div>
                                    <label for="uname">Username</label>
                                    <input type="text" id = "uname" name = "username" value = "<?= $user_data['username'] ?>">
                                </div>
        
                                <div>
                                    <label for="m_no">Mobile No.</label>
                                    <input type="text" id = "m_no" name = "m_no" value = "<?= $user_personal_info['m_no'] ?? "" ?>">
                                </div>
                                
                                <div>
                                    <label for="email">Email</label>
                                    <input type="text" id = "email" name = "email" value = "<?= $user_data['email'] ?>">
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