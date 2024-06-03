<?php 

    $css_page = "staff_dashboard";
    include("./header.php");

?>

            <section class="main-section">
                <div class="title">
                    Welcome <?= $user_data['username'] ?> to Staff Dashboard
                </div>

            </section>


<?php 
    include("./footer.php");
?>