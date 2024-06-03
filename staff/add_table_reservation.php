<?php 

    $css_page = "staff_add_table_reservation";
    include("./header.php");

    if(isset($_POST['submitTableData']) && $_POST['submitTableData'] == "Submit") {
        $tableNo = $_POST['tableNo'];
        $seats = $_POST['seats'];

        $sql = "INSERT INTO
                    table_data
                    (table_no, seats)
                VALUES
                ($tableNo, $seats)
                ";
        mysqli_query($conn, $sql);
    }

    if(isset($_POST['submitTableData']) && $_POST['submitTableData'] == "Update") {

        $id = $_POST['id'];
        $tableNo = $_POST['tableNo'];
        $seats = $_POST['seats'];

        $sql = "UPDATE 
                    table_data
                SET
                    table_no = $tableNo, 
                    seats = $seats 
                WHERE
                    id = $id";
        mysqli_query($conn, $sql);

    }

    $table_lists_query = "SELECT * FROM table_data";
    $table_lists = mysqli_query($conn, $table_lists_query);

?>

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

                            <?php while($data = mysqli_fetch_assoc($table_lists)): ?>
                                <?php  
                                    $table_r_query = "SELECT * FROM table_reserved WHERE table_id = {$data['id']} ORDER BY id DESC";
                                    $table_r = mysqli_query($conn, $table_r_query);

                                    $table_r_data = mysqli_fetch_assoc($table_r);
                                ?>
                                <tr>
                                    <td><?= $data['table_no'] ?></td>
                                    <td><?= $data['seats'] ?></td>
                                    <td><?= isset($table_r_data['status']) && $table_r_data['status'] == 0 ? "Booked" : "Not Booked" ?></td>
                                    <td class = "actions">
                                        <div>
                                            <div class = "view-table-book-info" data-bookid = "<?= $table_r_data['id'] ?>">View</div>
                                            <div class = "removeTable" data-tableid="<?= $data['id'] ?>">Remove</div>
                                            <div class = "add-table" data-editid = "<?= $data['id'] ?>">Edit</div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                            

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

                    <form action="<?= $_SERVER['PHP_SELF'] ?>" method = "post">
                        
                        <div>
                            <label for="tableNo">Table No</label>
                            <input type="text" id = "tableNo" name = "tableNo">
                            <input type="hidden" id = "tableId" name = "id">
                        </div>
                        
                        <div>
                            <label for="seats">Seats</label>
                            <input type="text" id = "seats" name = "seats">
                        </div>
                    
                        <div class="btns">
                            <input type="reset" value="Reset">
                            <input type="submit" id = "submit-btn" name = "submitTableData" value="Submit">
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

            $(".add-modal").on("click", function() {
                $("#submit-btn").val("Submit");
                $("form").trigger("reset");
            });

            $(".removeTable").on("click", function() {

                let tableId = $(this).data("tableid");

                if(confirm("Are you sure? want to cancel reservation")) {
                    $.ajax({
                        url : "../cancel_order.php",
                        method : "POST",
                        data : { tableId : tableId },
                        success : function (data) {
                            alert("Your Reservation is cancelled.");
                            location.reload();
                        }
                    });
                }
            });


            $(".add-table").on("click", function() {
                $("#modal").show();

                let editid = $(this).data("editid");

                $.ajax({
                    url : "./edit_data.php",
                    method : "POST",
                    data : { editid : editid },
                    success : function (data) {
                        let info = JSON.parse(data);
                        $("#tableId").val(info.id);
                        $("#tableNo").val(info.table_no);
                        $("#seats").val(info.seats);
                        $("#submit-btn").val("Update");
                    }
                });
            });


            $(".view-table-book-info").on("click", function() {
                let bookid = $(this).data("bookid");

                $.ajax({
                    url : "./view_table_reservation.php",
                    method : "POST",
                    data : { bookid : bookid },
                    success : function (data) {
                        $(".main-section").html(data);
                    }
                });
            });

        });
    </script>

</body>
</html>