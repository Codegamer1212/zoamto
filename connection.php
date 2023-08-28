<?php
session_start();
class DatabaseConnection
{
    private $hostname;
    private $username;
    private $password;
    private $database;
    private $connection;

    public function __construct()
    {
        $this->hostname = 'localhost';
        $this->username = 'root';
        $this->password = '';
        $this->database = 'zomato';
    }

    public function connect()
    {
        $this->connection = mysqli_connect($this->hostname, $this->username, $this->password, $this->database);
        if (!$this->connection) {
            die("Database connection failed: " . mysqli_connect_error());
        }
    }

    public function getConnection()
    {
        
        return $this->connection;
    
    }

    public function login($email, $password)
    {
        $msg = "";
        if (!empty($email) && !empty($password)) {
            $sql = "SELECT * FROM users WHERE email ='$email' AND password = '$password'";
            $result = mysqli_query($this->connection, $sql);

            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    $rows = mysqli_fetch_assoc($result);
                    $_SESSION['user_id'] = $rows['user_id'];
                    $_SESSION['user_name'] = $rows['username'];
                    $role = $rows['role'];

                    if ($role == 1) {
                        // User's role is 1, redirect to other page for role 1
                        $msg = "reasturnat";
                    } else {
                        // User's role is not 1, redirect to other page for other roles
                        $msg = "customer";
                    }
                } else {
                    $msg = "Incorrect email or password";
                }
            } else {
                $msg = "Database query failed: " . mysqli_error($this->connection);
            }
        } else {
            $msg = "please fill all fields";
        }
        return $msg;
    }

    public function insertData($table, $data)
    {
        $columns = implode(', ', array_keys($data));
        $values = implode("', '", array_values($data));
        $query = "INSERT INTO $table ($columns) VALUES ('$values')";

        $result = mysqli_query($this->connection, $query);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function selectCategory($table)
    {
        $sql = "SELECT * FROM $table ";
        $result = mysqli_query($this->connection, $sql);
        if ($result) {
            return $result;
        } else {
            echo "Database query failed: " . mysqli_error($this->connection);
            return false;
        }
    }
    public function selectCategoryformenu($table, $categoryIds = null)
    {
        $sql = "SELECT * FROM $table  WHERE availability='1' ";

        if (!empty($categoryIds) && is_array($categoryIds)) {
            $categoryIds = implode(',', $categoryIds);
            $sql .= " AND category_id IN ($categoryIds)";
        }
        $result = mysqli_query($this->connection, $sql);

        if ($result) {
            return $result;
        } else {
            echo "Database query failed: " . mysqli_error($this->connection);
            return false;
        }
    }


    public function selectDataForResturant($limit, $offset, $userid)
    {
        $sql = "SELECT r.resturant_id, r.restaurant_name, r.location, r.contact_number, u.name, r.availabilty, r.create_time
        FROM resturant AS r
        JOIN users AS u ON r.owner_id = u.user_id
        WHERE u.role = 1 AND r.owner_id = '$userid'
        LIMIT $limit OFFSET $offset";
        $result = mysqli_query($this->connection, $sql);
        if ($result) {
            return $result;
        } else {
            echo "Database query failed: " . mysqli_error($this->connection);
            return false;
        }
    }
    public function getResturantCount($userid)
    {
        $this->connect();

        $sql = "SELECT COUNT(*) AS total
            FROM resturant AS r
            INNER JOIN users AS u ON r.owner_id = u.user_id
            WHERE u.role = 1 AND r.owner_id = '$userid'";

        $result = mysqli_query($this->connection, $sql);

        if ($result) {
            $rowCount = mysqli_fetch_assoc($result)['total'];
            return $rowCount;
        } else {
            echo "Database query failed: " . mysqli_error($this->connection);
            return false;
        }
    }

    public function getMenuItemsCountForOwner($userid)
    {
        $this->connect();
        $sql = "SELECT COUNT(*) AS total FROM menu_items AS m
         JOIN resturant AS r ON r.resturant_id = m.restaurant_id
         JOIN category AS c ON c.category_id = m.category_id
        WHERE r.owner_id = '$userid'
        ORDER BY m.menu_id ASC";

        $result = mysqli_query($this->connection, $sql);

        if ($result) {
            $rowCount = mysqli_fetch_assoc($result)['total'];
            return $rowCount;
        } else {
            echo "Database query failed: " . mysqli_error($this->connection);
            return false;
        }
    }

    public function MenuItemShowById($id)
    {

        $sql = "SELECT m.menu_id, m.item_name, r.resturant_id, m.price, m.product_image, m.description, c.category_id , c.category_name, m.availability, m.create_time
        FROM menu_items AS m
       JOIN resturant AS r ON r.resturant_id = m.restaurant_id
       JOIN category AS c ON c.category_id = m.category_id WHERE m.menu_id = $id";

        $result = mysqli_query($this->connection, $sql);

        if ($result) {
            return $result;
        } else {
            echo "Database query failed: " . mysqli_error($this->connection);
            return false;
        }
    }
    public function DeleteRowById($table, $field, $id)
    {
        $sql = "DELETE FROM $table WHERE $field = $id";

        $result = mysqli_query($this->connection, $sql);

        if ($result) {
            return true;
        } else {
            echo "Database query failed: " . mysqli_error($this->connection);
            return false;
        }
    }
    public function updateMenuData($table, $data, $id, $field)
    {
        $updateFields = [];
        foreach ($data as $key => $value) {
            $updateFields[] = "$key = '$value'";
        }
        $updateFieldsStr = implode(", ", $updateFields);
        $sql = "UPDATE $table SET $updateFieldsStr WHERE $field = '$id'";
        $result = mysqli_query($this->connection, $sql);

        if ($result) {
            return true;
        } else {
            echo "Database query failed: " . mysqli_error($this->connection);
            return false;
        }
    }
    public function DeleteRowByIdiamge($table, $field, $id)
    {
        $sql = "SELECT product_image FROM $table WHERE $field = $id";
        $result = mysqli_query($this->connection, $sql);
        if ($result && $row = mysqli_fetch_assoc($result)) {
            $product_image = $row['product_image'];

            echo "Product Image: " . $product_image . "<br>";
            $imagePath = __DIR__ . '\Components\reasturant\menuimages\\' . $product_image;
            echo "Image Path: " . $imagePath . "<br>";

            // Check if the image file exists in the folder
            if (file_exists($imagePath)) {
                // Attempt to delete the image file
                if (unlink($imagePath)) {
                    echo "Image deleted successfully.<br>";
                } else {
                    echo "Failed to delete image.<br>";
                }
            } else {
                echo "Image not found in the folder.<br>";
            }
        } else {
            echo "Failed to fetch product_image from the database.<br>";
        }

        // Proceed with deleting the row from the database
        $sql = "DELETE FROM $table WHERE $field = $id";
        $result = mysqli_query($this->connection, $sql);
        if ($result) {
            return true;
        } else {
            echo "Database query failed: " . mysqli_error($this->connection);
            return false;
        }
    }

    public function selectDatareatunrant($table, $field, $id)
    {
        $sql = "SELECT * FROM $table where $field = $id";
        $result = mysqli_query($this->connection, $sql);
        if ($result) {
            return $result;
        } else {
            echo "Database query failed: " . mysqli_error($this->connection);
            return false;
        }
    }
    public function MenuItem($limit, $offset, $userid)
    {
        $sql = "SELECT m.menu_id, m.item_name, r.restaurant_name, m.price, m.product_image, m.description, c.category_name, m.availability, m.create_time
        FROM menu_items AS m
         JOIN resturant AS r ON r.resturant_id = m.restaurant_id
         JOIN category AS c ON c.category_id = m.category_id
        WHERE r.owner_id = '$userid'
        ORDER BY m.menu_id ASC
        LIMIT $limit OFFSET $offset";
        $result = mysqli_query($this->connection, $sql);
        if ($result) {
            return $result;
        } else {
            echo "Database query failed: " . mysqli_error($this->connection);
            return false;
        }
    }
    public function selectCategorymenu($table)
    {
        $this->connect();

        $sql = "SELECT * FROM $table ";

        $result = mysqli_query($this->connection, $sql);

        if ($result) {
            return $result;
        } else {
            echo "Database query failed: " . mysqli_error($this->connection);
            return false;
        }
    }
    public function updateCartItemsQuantities($cartIds, $quantities)
    {
        if (count($cartIds) !== count($quantities)) {
            echo "Invalid input data.";
            return false;
        }

        $updateSuccess = true;

        for ($i = 0; $i < count($cartIds); $i++) {
            $cartId =  $cartIds[$i];
            $quantity = (int)$quantities[$i];

            $sql = "UPDATE cart SET quantity = $quantity WHERE cart_id = $cartId";
            $result = mysqli_query($this->connection, $sql);

            if (!$result) {
                echo "Database query failed: " . mysqli_error($this->connection);
                $updateSuccess = false;
                break;
            }
        }

        return $updateSuccess;
    }

    public function selectReasturantForMenu($table, $ownerid)
    {
        $this->connect();

        $sql = "SELECT * FROM $table WHERE owner_id  = $ownerid";

        $result = mysqli_query($this->connection, $sql);

        if ($result) {
            return $result;
        } else {
            echo "Database query failed: " . mysqli_error($this->connection);
            return false;
        }
    }
    public function Selectcart($userid)
    {
        $sql = "SELECT *
        FROM cart
        JOIN menu_items ON cart.menu_id = menu_items.menu_id where cart.user_id ='$userid'";
        $result = mysqli_query($this->connection, $sql);
        if ($result) {
            return $result;
        } else {
            echo "Database query failed: " . mysqli_error($this->connection);
            return false;
        }
    }
    public function Selectcartcount($userid)
    {
        $sql = "SELECT count(*) as totalcount
        FROM cart
        JOIN menu_items ON cart.menu_id = menu_items.menu_id where cart.user_id ='$userid'";
        $result = mysqli_query($this->connection, $sql);
        foreach ($result as $counts) {
            $row = $counts['totalcount'];
        }

        return $row;
    }
    public function selectuserfororder($table, $id)
    {
        $this->connect();

        $sql = "SELECT * FROM $table WHERE user_id ='$id'";

        $result = mysqli_query($this->connection, $sql);

        if ($result) {
            return $result;
        } else {
            echo "Database query failed: " . mysqli_error($this->connection);
            return false;
        }
    }
    public function payment($table)
    {
        $this->connect();

        $sql = "SELECT * FROM $table WHERE availability = 1";

        $result = mysqli_query($this->connection, $sql);

        if ($result) {
            return $result;
        } else {
            echo "Database query failed: " . mysqli_error($this->connection);
            return false;
        }
    }
    public function redirect($location)
    {
        header("Location: $location");
        exit();
    }
    public function selectAllUsers($table, $id)
    {
        $sql = "SELECT * FROM $table WHERE user_id='$id'";
        $result = mysqli_query($this->connection, $sql);

        if ($result) {
            $users = array();

            while ($row = mysqli_fetch_assoc($result)) {
                $users[] = $row;
            }
            return $users;
        } else {
            echo "Database query failed: " . mysqli_error($this->connection);
            return false;
        }
    }
    public function checkUserExists($username, $email, $phonenumber)
    {
        $sql = "SELECT COUNT(*) as count FROM users WHERE username = '$username' OR email = '$email' OR phonenumber = '$phonenumber'";
        $result = mysqli_query($this->connection, $sql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $count = $row['count'];
            if ($count > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            echo "Database query failed: " . mysqli_error($this->connection);
            return false;
        }
    }
    public function insertOrderItemsBatch($cartItems, $order_id)
    {
        $values = [];
        foreach ($cartItems as $item) {
            $menu_id =  $item['menu_id'];
            $quantity =  $item['quantity'];
            $price = $item['price'];

            $values[] = "('$order_id', '$menu_id', '$quantity', '$price')";
        }

        $valuesStr = implode(', ', $values);

        $query = "INSERT INTO order_items (order_id, menu_id, quantity, price) VALUES $valuesStr";

        $result = mysqli_query($this->connection, $query);

        if ($result) {
            return true;
        } else {
            echo "Database query failed: " . mysqli_error($this->connection);
            return false;
        }
    }

    public function selectoldorder($table, $id)
    {
        $sql = "SELECT *
        FROM $table
        JOIN payment ON orders.payment_id = payment.payment_id where user_id ='$id'";
        $result = mysqli_query($this->connection, $sql);
        if ($result) {
            return $result;
        } else {
            echo "Database query failed: " . mysqli_error($this->connection);
            return false;
        }
    }
    public function selectolditem($id)
    {
        $sql = "SELECT *
        FROM order_items
        JOIN orders ON order_items.order_id= orders.order_id 
        JOIN menu_items ON menu_items.menu_id = order_items.menu_id
        WHERE orders.order_id ='$id'";
        $result = mysqli_query($this->connection, $sql);
        if ($result) {
            return $result;
        } else {
            echo "Database query failed: " . mysqli_error($this->connection);
            return false;
        }
    }
    public function selectdataforinvoic($orderid)
    {
        $sql = "SELECT *
        FROM orders 
        JOIN order_items ON order_items.order_id=orders.order_id
        JOIN menu_items ON order_items.menu_id=menu_items.menu_id
        JOIN resturant ON resturant.resturant_id=menu_items.restaurant_id
        JOIN payment ON payment.payment_id=orders.payment_id
        JOIN users ON users.user_id=orders.user_id
        WHERE orders.order_id ='$orderid'";
        $result = mysqli_query($this->connection, $sql);
        if ($result) {
            return $result;
        } else {
            echo "Database query failed: " . mysqli_error($this->connection);
            return false;
        }
    }
    public function matchcart($userid,$menu_id)
    {
        $sql = "SELECT *
        FROM cart
        JOIN menu_items ON cart.menu_id = menu_items.menu_id where cart.user_id ='$userid'and cart.menu_id = $menu_id";
        $result = mysqli_query($this->connection, $sql);
        if ($result) {
            return $result;
        } else {
            echo "Database query failed: " . mysqli_error($this->connection);
            return false;
        }
    }
    
    public function __destruct()
    {
        if ($this->connection) {
            mysqli_close($this->connection);
        }
    }
}
