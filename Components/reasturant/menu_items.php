<?php
include '../../connection.php';
$database = new DatabaseConnection();
$connect =$database->connect();
if (!isset($_SESSION['user_id'])) {
    $database->redirect('mainpage.php');
};
$limit = 3;
$page = isset($_POST['page_no']) ? $_POST['page_no'] : 1;

$offset = ($page - 1) * $limit;
$userid = $_SESSION['user_id'];
$data = $database->MenuItem($limit, $offset, $userid);

$table = "menu_items";
$totalRecords = $database->getMenuItemsCountForOwner($userid);
$totalPages = ceil($totalRecords / $limit);

$table = "category";
$data2 = $database->selectCategorymenu($table);
$table2 = "resturant";

$reasturnat = $database->selectReasturantForMenu($table2, $userid);

?>
<!DOCTYPE html>
<html>

<head>
    <title>Menu Items</title>
    <link rel="stylesheet" href="menu_item.css">
</head>

<body>
    <style>
        .container4 {
            margin-top: -30px;
        }

        h3 {
            text-align: center;
            font-size: 24px;
            margin-bottom: -38px;
            color: #8c0b0b;
        }

        .buttonsumbmit {
            text-align: center;
            width: 98%;
            margin-top: 25px;
            margin-right: -4px;
            margin-left: 76px;
        }

        #availability {
            width: 30%;
            margin: 1% 14%;
        }

        .imagesset {
            height: 78px;
            width: 109px;
        }

        .pag4 a {
            display: inline-block;
            padding: 5px 10px;
            margin: 0 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            color: #333;
            text-decoration: none;
        }

        .pag4 {
            text-align: justify;
        }

        .pag4 a.active {
            background-color: #8c0b0b;
            color: #fff;
        }
    </style>
    <div class="container4">
        <h3>Menu Items</h3>
        <div class="addnew">
            <p id="result"></p>
            <button class="Addnewuser" onclick="openModal()">Add Item</button>
            <div class="pag4">
                <?php for ($i = 1; $i <= $totalPages; $i++) {
                    echo   "<a class='active' id='{$i}'>{$i}</a>";
                } ?>
            </div>
        </div>

        <div class="tablecontainer2">
            <table id="menuTable">
                <tr>
                    <th>Item Id</th>
                    <th>Item Name</th>
                    <th>restaurant_name</th>
                    <th>Price</th>
                    <th>Product Image</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Availability</th>
                    <th>Add Time</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($data as $value) : ?>

                    <tr id="tr-<?php echo $value['menu_id'] ?>">
                        <td><?php echo $value['menu_id'] ?></td>
                        <td><?php echo $value['item_name']; ?></td>
                        <td><?php echo $value['restaurant_name'] ?></td>
                        <td><?php echo $value['price']; ?></td>
                        <td><img class="imagesset" src="menuimages/<?php echo $value['product_image']; ?>" alt=""></td>
                        <td><?php echo $value['description']; ?></td>
                        <td><?php echo $value['category_name']; ?></td>
                        <td><?php echo $value['availability']; ?></td>
                        <td><?php echo $value['create_time']; ?></td>
                        <td class="widht">
                            <button id="<?php echo $value['menu_id']; ?>" class="delete-button">Delete</button>
                            <button id="up-<?php echo $value['menu_id']; ?>" class="update-button">Update</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

    <div id="modal" class="modal">
        <div class="modal-content">
            <p class="error-message"></p>
            <span class="close" onclick="closeModal()">&times;</span>
            <form id="menuForm" method="post">
                <input type="hidden" id="menu_upid" name="menu_upid">
                <label for="resturant">Select reasturant:</label>
                <select name="resturant" id="resturant">
                    <?php foreach ($reasturnat as $value3) : ?>
                        <option value="<?php echo $value3['resturant_id'] ?>"><?php echo $value3['restaurant_name'] ?></option>
                    <?php endforeach ?>
                </select>
                <label for="itemName">Item Name:</label>
                <input type="text" id="itemName">

                <label for="price">Price:</label>
                <input type="text" id="price">

                <label for="productImage">Product Image URL:</label>
                <input type="file" id="productImage" name="productImage" accept="image/*">



                <label for="description">Description:</label>
                <textarea id="description"></textarea>

                <label for="category">Category:</label>
                <select name="category" id="category">
                    <?php foreach ($data2 as $value2) : ?>
                        <option value="<?php echo $value2['category_id'] ?>"><?php echo $value2['category_name'] ?></option>
                    <?php endforeach ?>
                </select>
                <select name="availability" id="availability">
                    <option value="">Select Availability</option>
                    <option value="1">Available</option>
                    <option value="0">unavailable</option>
                </select>


                <div class="buttonsumbmit">
                    <button type="submit" name="submititem">Add Item</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function submitFormData(formData) {
            $.ajax({
                type: "POST",
                url: "menu_item_insert.php",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $("#result").html(response);
                    $(".modal").css("display", "none");
                    // setTimeout(function() {
                    //     $("#result").hide();
                    // }, 2000);
                },
                error: function(xhr, status, error) {
                    
                }
            });
        }

        $(document).ready(function() {
            $('#menuForm').submit(function(e) {
                e.preventDefault();
                $('.error-message').hide().empty();
                var valid = true;
                $('input[type="text"], input[type="file"],select', this).each(function() {
                    if ($(this).val() === '') {
                        valid = false;
                        return false;
                    }
                });

                if (!valid) {
                    $('.error-message').text('Please fill in all fields.').show();
                } else {
                    var menu_upid = $('#menu_upid').val();
                    var menuName = $('#itemName').val();
                    var resturant = $('#resturant').val();
                    var price = $('#price').val();
                    var description = $('#description').val();
                    var category = $('#category').val();
                    var availability = $('#availability').val();

                    var formData = new FormData();
                    formData.append('menu_upid', menu_upid);
                    formData.append('menuName', menuName);
                    formData.append('resturant', resturant);
                    formData.append('price', price);
                    formData.append('image', $('#productImage')[0].files[0]);
                    formData.append('description', description);
                    formData.append('category', category);
                    formData.append('availability', availability);

                    submitFormData(formData); // Pass formData here
                }
            });
            $(".update-button").click(function() {
                var menuid = $(this).attr("id").split("-")[1];
                console.log(menuid);
                $(".modal").css("display", "block");
                $.ajax({
                    url: "menu_item_show.php",
                    type: "POST",
                    data: {
                        menuid: menuid,
                    },
                    success: function(response) {

                        var data = JSON.parse(response);
                        $("#price").val(data.price);
                        $("#category").val(data.category_id);
                        $('#menu_upid').val(data.menu_id);
                        $("#description").val(data.description);
                        $("#itemName").val(data.item_name);
                        $("#availability").val(data.availability);
                        $("#resturant").val(data.resturant_id);
                        $("#productImage").val(data.product_image);

                    },
                    error: function(xhr, status, error) {
                        console.log("Error fetching menu item:", error);
                    },
                });
            });

            function loadTable2(pageno) {
                $.ajax({
                    url: 'menu_items.php',
                    type: 'POST',
                    data: {
                        page_no: pageno
                    },
                    success: function(response) {
                        $('#page-content').html(response);
                        $(".modal").hide();
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            }

            $(document).on('click', '.pag4 a', function(e) {
                e.preventDefault();
                var pageno = $(this).attr('id');
                console.log(pageno);
                loadTable2(pageno);
            });
        });
    </script>
    <script src="menu_item.js"></script>
</body>

</html>