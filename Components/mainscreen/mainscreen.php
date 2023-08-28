<?php

include '../../connection.php';
$database = new DatabaseConnection();
$database->connect();
$table = "category";
$data = $database->selectCategory($table);
$dish = "menu_items";
$userid=$_SESSION['user_id'];


if (isset($_POST['category']) && !empty($_POST['category'])) {
    $category = $_POST['category'];
    $alldish = $database->selectCategoryformenu($dish, $category);
} else {
    $alldish = $database->selectCategoryformenu($dish);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="mainscreen.css">



    <title>Document</title>
</head>

<body>


    <header>
        <div class="mainheader">
            <div class="twopart">
                <div class="part31">
                    <img class="img2" src="../../images/zomato.png" alt="" />
                </div>
                <div class="part32">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search..." class="search-input" />
                </div>
            </div>
            <i id="cartaddnewproduct" class="fa-solid fa-cart-shopping"><span id="showcount"></span></i>
            <div id="cartDataContainer">

            </div>
            <div class="part33">
                <img src="../../images/mick.png" alt="">
                <p class="userpofile"><?php if(isset($_SESSION['user_name'])){
                    echo $_SESSION['user_name'];
                }?></p>
                <i id="showdropdown" class="fa-solid fa-angle-down"></i>
                <div class="dropdown-content">
                    <ul id="profiledropdown">
                        <li>Profile</li>
                        <li><a href="../order/oldorder.php">ORDERS</a></li>
                        <li>Notification</li>
                        <li><a href="../../logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <div class="main_container">
        <div class="category">
            <div class="type_of_item">
                <div class="online  ">
                    <div class="circle ">
                        <img class="imgcolor" src="../../images/online_food.png" alt="">
                    </div>
                    <p class="pactive">Delivery</p>
                </div>

            </div>
        </div>
        <div class="allcontent">
            <div class="ceterall">
                <div class="sort">
                    <button id="filterButton" class="filter">Filter<i class="fa-solid fa-sliders"></i></button>
                    <div id="filterModal" class="modal">
                        <div class="modal-content">
                            <i id="xmark2" class="fa-solid fa-xmark"></i>
                            <form id="filterForm" method="post">
                                <div class="mainform">
                                    <div class="leftsidecate">
                                        <li id="cat">Sort By Category</li>
                                        <li id="price">Sort by Price</li>
                                    </div>
                                    <div class="rightsidecat">
                                        <div class="sidebar">
                                            <?php foreach ($data as $value) : ?>
                                                <?php
                                                $isChecked = isset($_POST['category']) && in_array($value['category_id'], $_POST['category']);
                                                ?>
                                                <label>
                                                    <input type="checkbox" name="category[]" id="categorys" value="<?php echo $value['category_id'] ?>" <?php if ($isChecked) echo 'checked'; ?>>
                                                    <?php echo $value['category_name'] ?>
                                                </label>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="buttoncenter">
                                    <button type="submit" id="applyFilter">Apply</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="fooditemsall">
                    <?php foreach ($alldish as $itemsall) : ?>
                        <div class="food-card" id="<?php echo $itemsall['menu_id'] ?>">
                            <img class="food-image" src="../reasturant/menuimages/<?php echo $itemsall['product_image'] ?>" alt="Pav Bhaji">
                            <h3 class="food-name"><?php echo $itemsall['item_name'] ?></h3>
                            <p class="food-description"><?php echo $itemsall['description'] ?></p>
                            <p class="food-price">Rs <?php echo $itemsall['price'] ?></p>
                            <div class="categoryfromat">
                                <div class="quantity-selector">
                                    <button class="minus-btn"><i class="fa-solid fa-minus"></i></button>
                                    <span class="quantity">1</span>
                                    <button class="plus-btn"><i class="fa-solid fa-plus"></i></button>
                                </div>
                                <div class="bttonaddcart">
                                    <button class="add-to-cart-btn" onclick="showSuccessModalofcart()"><i class="fa-solid fa-cart-shopping"></i></button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="hide90">
                    <div class="success-modal56">
                        <div class="container689">
                            <h1> <i class="fa-solid fa-cart-shopping"></i> Cart </h1>
                            <p>Item Add Succesfully </p>
                            <div class="animation-box">
                                <i id="iconsumbit" class="fas fa-check" style="font-size: 60px; color: #fff;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    </div>
    <script>
        
       // mainscreen.js

$(document).ready(function() {
    // Function to add item to the cart
    function addToCart(item_id) {
        $.ajax({
            type: "POST",
            url: "add_to_cart.php", // Replace this with the URL of the PHP file that handles adding items to the cart
            data: { add_to_cart: item_id },
            success: function(response) {
                // Handle the success response, if needed
                showSuccessModalofcart();
                // Disable the button after adding the item to the cart
                $("#"+item_id+" .add-to-cart-btn").attr("disabled", true);
            },
            error: function(error) {
                // Handle the error response, if needed
            }
        });
    }

    // Function to show the success modal for the cart
    function showSuccessModalofcart() {
        $(".hide90").fadeIn(500, function() {
            $(".success-modal56 .animation-box i").fadeIn(500);
        });
        setTimeout(function() {
            $(".hide90").fadeOut(500, function() {
                $(".success-modal56 .animation-box i").fadeOut(500);
            });
        }, 3000);
    }

    // Click event handler for the "Add to Cart" buttons
    $(".add-to-cart-btn").on("click", function() {
        var item_id = $(this).closest(".food-card").attr("id");
        addToCart(item_id);
    });
});

    </script>
    <script src="mainscreen.js"></script>

</body>

</html>