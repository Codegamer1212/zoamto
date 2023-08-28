$(document).ready(function () {
  $(".delete-button").click(function () {
    var restaurantId = $(this).attr("id");
    $.ajax({
      url: "reasturant_Table_data_delete.php",
      type: "POST",
      data: {
        restaurantId: restaurantId,
      },
      success: function (response) {
        $("#tr-" + restaurantId).remove();
      },
    });
  });

  function showModal() {
    $("#modal").show();
  }

  // Function to hide the modal
  function hideModal() {
    $("#modal").hide();
  }

  // Event handler for the close button (cross)
  $(".close").on("click", function () {
    hideModal();
  });

  // Event handler for the "Add New User" button
  $("#open-modal-btn").on("click", function () {
     $("#restaurant_id").val("");
    $("#restaurant-name").val("");
    $("#location").val("");
    $("#ownername").val("");
    $("#contact-number").val("");
    $("#availability").val("");
    showModal();
  });

  // ... Your existing JavaScript code ...

  // Event handler for form submission (field validation and AJAX submission)
  $("#restaurant-form").on("submit", function (e) {
    e.preventDefault(); // Prevent form submission

    // Add your field validation logic here
    var restaurantId = $("#restaurant_id").val(); // Corrected to retrieve restaurant_id
    var restaurantName = $("#restaurant-name").val();
    var location = $("#location").val();
    var contactNumber = $("#contact-number").val();
    var availability = $("#availability").val();

    if (restaurantName.trim() === "") {
      $("#error").text("Restaurant Name is required.");
      return;
    }

    if (contactNumber.trim() === "") {
      $("#error").text("phone number is required.");
      return;
    } else if (!isValidPhoneNumber(contactNumber)) {
      $("#error").text("phone number length is 10");
      return;
    }

    if (location.trim() === "") {
      $("#error").text("Location is required.");
      return;
    }

    function isValidPhoneNumber(contactNumber) {
      var phonePattern = /^\d{10}$/;
      return phonePattern.test(contactNumber);
    }

    // Data to be sent via AJAX
    var formData = {
      restaurant_id: restaurantId, // Corrected the variable name
      restaurant_name: restaurantName,
      location: location,
      contact_number: contactNumber,
      availability: availability,
    };

    // AJAX submission to "reasturant_insert.php"
    $.ajax({
      url: "reasturant_insert.php",
      type: "POST",
      data: formData,
      success: function (response) {
        $("#result").html(response);
        setTimeout(() => {
          $("#result").hide();
          
        }, 2000);
        console.log(response);

        hideModal();
      },
      error: function (xhr, status, error) {
        console.log(error);
      },
    });
  });
  $(".update-button").click(function () {
    var restaurantId = $(this).attr("id").split("-")[1];
    $("#modal").addClass("active");
    $.ajax({
      url: "reasturnat_Data_select.php",
      type: "POST",
      data: {
        restaurantId: restaurantId,
      },
      success: function (response) {
        showModal();
        var data = JSON.parse(response);
        console.log(data.owner_id);
        $("#restaurant_id").val(data.resturant_id);
        $("#restaurant-name").val(data.restaurant_name);
        $("#location").val(data.location);
        $("#ownername").val(data.owner_id);
        $("#contact-number").val(data.contact_number);
        $("#availability").val(data.availabilty);
      },
    });
  });
});
