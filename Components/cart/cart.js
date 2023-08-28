$(document).ready(function() {
    $(".plus-btn").on("click", function(e) {
      e.preventDefault();
      const quantityEl = $(this).siblings(".quantity").find("input");
      let quantity = parseInt(quantityEl.val());
      quantity++;
      quantityEl.val(quantity);
      
      
      
      (quantityEl);
    });

    $(".minus-btn").on("click", function(e) {
      e.preventDefault();
      const quantityEl = $(this).siblings(".quantity").find("input");
      let quantity = parseInt(quantityEl.val());
      if (quantity > 1) {
        quantity--;
        quantityEl.val(quantity);
        updateCartItemQuantity(quantityEl);
      }
    });
    $(document).on("click", ".delete-btn", function(e) {
      e.preventDefault();
      var cartItemId = $(this).attr("id");

      $.ajax({
        type: "POST",
        url: "cart_delete.php",
        data: {
          cartItemId: cartItemId
        },
        success: function(response) {
          $("#" + cartItemId).remove();
          console.log("Item removed successfully:", response);
          if ($("#cart-table tbody tr").length === 0) {
            window.location.href = "../mainscreen/mainscreen.php";
          }

        },
        error: function() {
          console.log("Error removing item from cart!");
        },
      });
    });


  });