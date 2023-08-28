<?php

include '../../connection.php';
$database = new DatabaseConnection();
$database->connect();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $menu_id = isset($_POST['menu_upid']) ? $_POST['menu_upid'] : null;

    $menuName = $_POST['menuName'];
    $resturant = $_POST['resturant'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $availability = $_POST['availability'];

    $image = $_FILES['image']['name'];
    if (!empty($image)) {
        $imageTemp = $_FILES['image']['tmp_name'];
        $uploadDir = __DIR__ . '/menuimages/';
        $targetPath = $uploadDir . basename($image);

        if (!move_uploaded_file($imageTemp, $targetPath)) {
            echo "Failed to upload image.";
            exit();
        }
    } else {
        // No new image provided, use the existing image if updating
        if ($menu_id) {
            $existingData = $database->selectDatareatunrant($table, 'menu_id', $menu_id);
            if ($existingData && $row = mysqli_fetch_assoc($existingData)) {
                $image = $row['product_image'];
            }
        }
    }

    // Prepare data for insertion or update
    $data = array(
        'item_name' => $menuName,
        'restaurant_id' => $resturant,
        'price' => $price,
        'product_image' => $image,
        'description' => $description,
        'category_id' => $category,
        'availability' => $availability
    );

    // Insert data into the database using prepared statements
    $table = "menu_items";

    if ($menu_id) {
        // Update existing record
        $result = $database->updateMenuData($table, $data, $menu_id, 'menu_id');
        if ($result) {
            echo "Item updated successfully.";
        } else {
            echo "Failed to update item.";
        }
    } else {
        // Insert new record
        $result = $database->insertData($table, $data);
        if ($result) {
            echo "Item added successfully.";
        } else {
            echo "Failed to add item.";
        }
    }
}
?>
