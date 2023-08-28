<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<title>Order Confirmation</title>
<link rel="stylesheet" href="styles.css">
</head>

<body>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .animation-box i {
      color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 100px;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    .container {
      text-align: center;
      background-color: #fff;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h1 {
      color: #333;
    }

    p {
      color: #666;
    }

    .animation-box {
      width: 100px;
      height: 100px;
      background-color: #3498db;
      margin: 20px auto;
      border-radius: 50%;
      position: relative;
    }
  </style>
  <div class="container">
    <h1>Order Confirmed!</h1>
    <p>Your order has been successfully placed.</p>
    <div class="animation-box"></div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      // Animation on page load
      animateOnLoad();

      // Function to handle animation on page load
      function animateOnLoad() {
        $(".animation-box").animate({
            width: "200px",
            height: "200px",
            opacity: 0.8,
          },
          1000,
          function() {
            // Animation complete
            animateHeart();
          }
        );
      }

      // Function to animate heart icon
      function animateHeart() {
        $(".animation-box").html('<i class="fas fa-heart"></i>');
        $(".animation-box i").animate({
            fontSize: "80px",
          },
          500,
          function() {
            // Animation complete
            $(".animation-box i").fadeOut(500, function() {
              // Animation complete
              showSuccessMessage();
            });
          }
        );
      }

      // Function to show success message
      function showSuccessMessage() {
        $(".animation-box").html('<i class="fas fa-check"></i>');
        $(".animation-box i").fadeIn(500);
        window.location.href ="./../mainscreen/mainscreen.php";
      }
    });
  </script>
</body>

</html>