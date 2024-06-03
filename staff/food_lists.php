<?php 

    $css_page = "staff_food_lists";
    include("./header.php");
    
    if(isset($_POST['submitFoodInfo']) && $_POST['submitFoodInfo'] == "Submit") {
        $food_name = $_POST['food_name'];
        $food_quantity = $_POST['food_quantity'];
        $food_price = $_POST['food_price'];
        $food_description = $_POST['food_description'];
        $food_discount = $_POST['food_discount'];
        $food_category = $_POST['food_category'];

        $sql = "INSERT INTO
                    fooditems
                    (food_name, food_category, food_description, price, quantity, discount_percentage)
                VALUES
                ('{$food_name}', '{$food_category}', '{$food_description}', '{$food_price}', '{$food_quantity}', '{$food_discount}')
                ";
        mysqli_query($conn, $sql) or die("Quary Failed" . mysqli_error($conn));
    }


    if(isset($_POST['submitFoodInfo']) && $_POST['submitFoodInfo'] == "Update") {

        $id = $_POST['food_id'];
        $food_name = $_POST['food_name'];
        $food_quantity = $_POST['food_quantity'];
        $food_price = $_POST['food_price'];
        $food_description = $_POST['food_description'];
        $food_discount = $_POST['food_discount'];
        $food_category = $_POST['food_category'];

        $sql = "UPDATE 
                    fooditems
                SET
                    food_name = '{$food_name}', 
                    food_category = '{$food_category}', 
                    food_description = '{$food_description}', 
                    price = '{$food_price}', 
                    quantity = '{$food_quantity}', 
                    discount_percentage = '{$food_discount}'
                WHERE
                    id = $id";
        mysqli_query($conn, $sql);

    }

    $food_lists_query = "SELECT * FROM fooditems";
    $food_lists = mysqli_query($conn, $food_lists_query);

?>


            <section class="main-section">
                <div class="title">
                    <span>
                        Food Lists
                    </span>
                    <span class="btns">
                        <a href="#" class = "add-modal">
                            Add
                        </a>
                    </span>
                </div>


                <div class="table-details">

                    <table>
                        <thead>
                            <tr>
                                <td>Image</td>
                                <td>Title</td>
                                <td>Max Quantity</td>
                                <td>Price</td>
                                <td>Discount</td>
                                <td>Action</td>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if(mysqli_num_rows($food_lists) > 0):  ?>
                            <?php while($data = mysqli_fetch_assoc($food_lists)): ?>
                                <tr>
                                    <td class = "img">
                                        <img src="../images/pizza.png" alt="">
                                    </td>
                                    <td><?= $data['food_name'] ?></td>
                                    <td><?= $data['quantity'] ?></td>
                                    <td><?= $data['price'] ?> Rs</td>
                                    <td><?= $data['discount_percentage'] ?>%</td>
                                    <td class = "actions">
                                        <div>
                                            <div class = "remove-food-item" data-foodid="<?= $data['id'] ?>" >Remove</div>
                                            <div class = "add-food" data-editid = "<?= $data['id'] ?>">Edit</div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" style = "text-align: center;">
                                        No Data Found
                                    </td>
                                </tr>
                            <?php endif; ?>

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
                        Add Food Item
                    </div>

                    <form action="<?= $_SERVER['PHP_SELF'] ?>" method = "POST">

                        <div>
                            <label for="item-img">Image</label>
                            <input type="file" id = "item-img">
                        </div>
                        
                        <div>
                            <label for="title">Title</label>
                            <input type="hidden" id = "food-id" name = "food_id" value="">
                            <input type="text" id = "title" name = "food_name" value="">
                        </div>
                        
                        <div>
                            <label for="quantity">Quantity</label>
                            <input type="text" id = "quantity" name = "food_quantity" value="">
                        </div>

                        <div>
                            <label for="price">Price</label>
                            <input type="text" id = "price" name = "food_price" value="">
                        </div>
                        
                        <div>
                            <label for="description">Description</label>
                            <input type="text" id = "description" name = "food_description" value="">
                        </div>
                    
                        <div>
                            <label for="discount">Discount</label>
                            <input type="text" id = "discount" name = "food_discount" value="">
                        </div>
                    
                        <div>
                            <label for="category">Category</label>
                            <select name="food_category" id="category">
                                <option value="one">one</option>
                                <option value="one">one</option>
                                <option value="one">one</option>
                                <option value="one">one</option>
                            </select>
                        </div>
                    
                        <div class="btns">
                            <input type="reset" value="Reset">
                            <input type="submit" id = "submit-btn" name = "submitFoodInfo" value="Submit">
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

            

            $(".remove-food-item").on("click", function() {

                let foodid = $(this).data("foodid");

                if(confirm("Are you sure? want to cancel reservation")) {
                    $.ajax({
                        url : "../cancel_order.php",
                        method : "POST",
                        data : { foodid : foodid },
                        success : function (data) {
                            alert("Your Reservation is cancelled.");
                            location.reload();
                        }
                    });
                }
            });

            $(".add-modal").on("click", function() {
                $("#submit-btn").val("Submit");
                $("form").trigger("reset");
            });


            $(".add-food").on("click", function() {
                $("#modal").show();

                let foodid = $(this).data("editid");

                $.ajax({
                    url : "./edit_data.php",
                    method : "POST",
                    data : { foodid : foodid },
                    success : function (data) {
                        let info = JSON.parse(data);
                        $("#food-id").val(info.id);
                        $("#title").val(info.food_name);
                        $("#quantity").val(info.quantity);
                        $("#price").val(info.price);
                        $("#description").val(info.food_description);
                        $("#submit-btn").val("Update");
                    }
                });
            });
        });
    </script>
    

</body>
</html>