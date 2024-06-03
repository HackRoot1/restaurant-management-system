<?php 

    $css_page = "staff_customers_orders";
    include("./header.php");

    
    $c_orders_query = "SELECT * FROM `customer_order` ORDER BY id DESC";
    $c_orders = mysqli_query($conn, $c_orders_query);


?>


            <section class="main-section">
                <div class="title">
                    <span>
                        Customer Orders
                    </span>
                </div>


                <div class="table-details">

                    <table>
                        <thead>
                            <tr>
                                <td>Customer Name</td>
                                <td>Address</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                        </thead>

                        <tbody>

                            <?php 
                                if(mysqli_num_rows($c_orders) > 0): 
                                    while($data = mysqli_fetch_assoc($c_orders)): 
                                    
                                        $u_query = "SELECT * FROM users_personal_info WHERE user_id = {$data['user_id']}";
                                        $u = mysqli_query($conn, $u_query);
                                        $u_data = mysqli_fetch_assoc($u);
                            ?>
                                    <tr>
                                        <td><?= $u_data['fname'] . " " . $u_data['lname'] ?></td>
                                        <td>Shahapur</td>
                                        <td>
                                            <?php if(!$data['order_cancelled']): ?>
                                                <div class = "<?= $data['status'] ? 'ordered' : 'cancelled' ?>">
                                                    <?php echo $data['status'] == 1 ? "Order Placed" : "Pending" ?>
                                                </div>
                                            <?php else: ?>
                                                <div class = "cancelled">
                                                    Order Cancelled
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td class = "actions">
                                            <div>
                                                <div class = "view-order" data-orderid = "<?= $data['id'] ?>">View</div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                            
                                <tr>
                                    <td colspan = "4" style = "text-align: center">No Orders Yet.</td>
                                </tr>
                            <?php endif;?>
                            

                        </tbody>
                    </table>

                </div>
            </section>

            

            <script>
                $(document).ready(function() {
                    $(".view-order").on("click", function() {
                        let id = $(this).data("orderid");

                        $.ajax({
                            url : "view_customer_order.php",
                            method : "POST",
                            data : { id : id },
                            success : function (data) {
                                $(".main-section").html(data);
                            }
                        });
                    });
                });
            </script>
<?php 

    include("./footer.php");

?>