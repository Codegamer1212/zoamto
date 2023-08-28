<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Resturant</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="shortcut icon" href="images/zomato.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Signika+Negative:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="reasturant.css">
</head>


<body>
    <style>
        a {
            cursor: pointer;
        }
    </style>

    <div class="container">
        <div class="sidebar">
            <ul class="menu">
               
                <li><a href="#" data-page="reasturant_Table"><i class="fas fa-utensils"></i> Restaurants</a></li>
                <li><a href="#" data-page="menu_items"><i class="fas fa-clipboard-list"></i> Menu Items</a></li>
                <!-- <li><a href="#" data-page="coupon"><i class="fa fa-gift" aria-hidden="true"></i> coupons </a></li> -->

            </ul>
        </div>
       
        <div class="contenta">
        <div class="logout"><button><a href="../../logout.php">Logout</a></button></div>

            <div id="page-content">


            </div>


        </div>
    </div>
    </div>
    <!-- <footer>
    <div class="footer-content">
      <p>&copy; 2023 RedFood. All rights reserved.</p>
    </div>
  </footer> -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#navbar-toggle').on('click', function() {
                $('.sidebar2').slideToggle();
            });
            $('#imglogout').on('click', function() {
                $('#alogout').html('<i class="fa-solid fa-right-from-bracket"></i>');
                $('#alogout').slideToggle();
            });

        });
    </script>
    <script src="reasturant.js"></script>
</body>

</html>