$(document).ready(function () {

  $(".plus-btn").click(function () {
    var inputField = $(this).prev();
    var currentQuantity = parseInt(inputField.text());
    inputField.text(currentQuantity + 1);
  });
  var cartDataContainer = $("#cartDataContainer");
  $(document).on("click", function () {
    cartDataContainer.hide();
    
  
  });
  $(".minus-btn").click(function () {
    var inputField = $(this).next();
    var currentQuantity = parseInt(inputField.text());
    if (currentQuantity > 0) {
      inputField.text(currentQuantity - 1);
    }
  });

  $("#closeSuccessModal").on("click", function () {
    $("#successModal").css("display", "none");
  });
  $(".add-to-cart-btn").on("click", function () {
    var foodId = $(this).closest(".food-card").attr("id");
    var foodCard = $(this).closest(".food-card");
    var foodName = foodCard.find(".food-name").text();
    var foodPrice = parseFloat(
      foodCard.find(".food-price").text().replace("Rs ", "")
    );
    var quantity = parseInt(foodCard.find(".quantity").text());
    if (quantity > 0) {
      var cartItem = {
        id: foodId,
        name: foodName,
        price: parseFloat(foodPrice),
        quantity: parseInt(quantity),
      };
      $.ajax({
        type: "POST",
        url: "add_to_cart.php",
        data: cartItem,
        success: function (response) {
          $("#successModal").css("display", "block");
        },
        error: function () {
          console.log("Error adding item to cart!");
        },
      });
    } else {
      $(".modal-content2 p").html(
        "Quantity should be greater than 0 to add to cart"
      );
      $("#successModal").css("display", "block");
    }
  });

  $("#showdropdown").click(function () {
    $(".dropdown-content").toggle();
  });

  $(".type_of_item .online").addClass("active");

  $(".type_of_item div").click(function () {
    $(".type_of_item div").removeClass("active");
    $(this).addClass("active");
  });
  $("#filterButton").on("click", function () {
    $("#filterModal").css("display", "block");
  });

  $(".close").on("click", function () {
    $("#filterModal").css("display", "none");
  });
  $("#xmark2").on("click", function () {
    $("#filterModal").css("display", "none");
  });

  $(".leftsidecate #cat").on("click", function () {
    $(".sidebar").show();
    $(".leftsidecate #cat").addClass("sideactive");
    $(".sidebar2").hide();
  });
  $(".leftsidecate #price").on("click", function () {
    $(".sidebar2").css("display", "flex");
    $(".sidebar").hide();
  });


  function updateCartItems(response) {
    var cartDataContainer = $("#cartDataContainer");
    cartDataContainer.empty();

    if (response && response.cartItems.length > 0) {
      var totalAmount = 0;

      $.each(response.cartItems, function (index, item) {
        var cartItem = '<div class="cart-item" id="' + item.cart_id + '">';
        cartItem +=
          '<img src="../reasturant//menuimages/' +
          item.product_image +
          '" alt="' +
          item.item_name +
          '">';
        cartItem += '<div class="item-details">';
        cartItem += '<div class="cartprices">';
        cartItem += "<h2>" + item.item_name + "</h2>";
        cartItem += "<h2>Quantity: " + item.quantity + "</h2>";
        cartItem += "<p>Price: " + item.price + "</p>";
        cartItem += "</div>";
        cartItem +=
          '<button class="remove-btn" id="' +
          item.cart_id +
          '"><i class="fa-solid fa-trash"></i></button>';
        cartItem += "</div>";
        cartItem += "</div>";

        cartDataContainer.append(cartItem);

        // Calculate total amount
        totalAmount += item.price * item.quantity;
       
      });
      shpping = response.cartSummary.shipping ;
      var cartSummary = '<div class="cart-summary">';
      cartSummary +=
        '<p id="shippingcharge"><span>Shipping:</span> Rs ' + shpping +  "</p>";
      cartSummary +=
        '<p id="totalpay"><span>Total:</span> Rs ' +
        (totalAmount + shpping ) +
        "</p>";
      cartSummary += '<a href="../cart/cart.php" id="ctratag"><button class="cart-show-btn">View Cart</button></a>';
      cartSummary +=
        '<button class="checkout-btn">Proceed to Checkout</button>';
      cartSummary += "</div>";

      cartDataContainer.append(cartSummary);
      cartDataContainer.show();
    } else {
      cartDataContainer.text("Your cart is empty.");
      cartDataContainer.hide(); 
    }
  }

  $(document).on("click", ".remove-btn", function () {
    var cartItemId = $(this).attr("id");

    $.ajax({
      type: "POST",
      url: "./../cart/cart_delete.php",
      data: { cartItemId: cartItemId },
      success: function (response) {
        $("#" + cartItemId).remove();
        console.log("Item removed successfully:", response);
        $.ajax({
          url: "show_cart_item.php",
          method: "post",
          dataType: "json", 
          success: function (response) {
            updateCartItems(response);
          },
          error: function (xhr, status, error) {
            console.error("AJAX Error:", status, error);
          },
        });
      },
      error: function () {
        console.log("Error removing item from cart!");
      },
    });
  });

  
  $("#cartaddnewproduct").click(function () {
    var cartDataContainer = $("#cartDataContainer");
    if (cartDataContainer.is(":visible")) {
      cartDataContainer.hide();
    } else {
      $.ajax({
        url: "show_cart_item.php",
        method: "post",
        dataType: "json",
        success: function (response) {
          updateCartItems(response);
        },
        error: function (xhr, status, error) {
          console.error("AJAX Error:", status, error);
          cartDataContainer.text("Your cart is empty.");
        },
      });
    }
  });


});
