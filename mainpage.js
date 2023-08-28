$(document).ready(function () {
  $("#openlogin").click(function () {
    $("#Login").show();
  });
  $("#closeLogin").click(function () {
    $("#Login").hide();
  });
  $("#opensignin").click(function () {
    $("#signup").show();
  });
  $("#closeModalSignin").click(function () {
    $("#signup").hide();
  });
  $("#signupform").submit(function (event) {
    event.preventDefault();
    var isValid = validateForm();

   
  });

  function validateForm() {
    var isValid = true;

    $(".error").remove();
    var username = $("#username").val();
    var name = $("#name").val();
    var email = $("#email").val();
    var password = $("#password").val();
    var phone = $("#phone").val();
    var address = $("#address").val();
    var city = $("#city").val();
    var state = $("#state").val();
    var country = $("#country").val();
    var pincode = $("#pincode").val();
    var role = $("#role").val();

    if (username === "") {
      $("#username").after('<span class="error">Username is required</span>');
      isValid = false;
    }

    // Validate Full Name
    if (name === "") {
      $("#name").after('<span class="error">Full Name is required</span>');
      isValid = false;
    }

    // Validate Email
    if (email === "") {
      $("#email").after('<span class="error">Email is required</span>');
      isValid = false;
    } else if (!isValidEmail(email)) {
      $("#email").after('<span class="error">Invalid Email format</span>');
      isValid = false;
    }

    // Validate Password
    if (password === "") {
      $("#password").after('<span class="error">Password is required</span>');
      isValid = false;
    } else if (password.length < 6) {
      $("#password").after(
        '<span class="error">Password must be at least 6 characters long</span>'
      );
      isValid = false;
    }

    // Validate Phone Number
    if (phone === "") {
      $("#phone").after('<span class="error">Phone number is required</span>');
      isValid = false;
    } else if (!isValidPhoneNumber(phone)) {
      $("#phone").after(
        '<span class="error">Invalid Phone number format</span>'
      );
      isValid = false;
    }

    // Validate Address
    if (address === "") {
      $("#address").after('<span class="error">Address is required</span>');
      isValid = false;
    }

    // Validate City
    if (city === "") {
      $("#city").after('<span class="error">City is required</span>');
      isValid = false;
    }

    // Validate State
    if (state === "") {
      $("#state").after('<span class="error">State is required</span>');
      isValid = false;
    }

    // Validate Country
    if (country === "") {
      $("#country").after('<span class="error">Country is required</span>');
      isValid = false;
    }

    // Validate Pincode
    if (pincode === "") {
      $("#pincode").after('<span class="error">Pincode is required</span>');
      isValid = false;
    } else if (!isValidPincode(pincode)) {
      $("#pincode").after('<span class="error">Invalid Pincode format</span>');
      isValid = false;
    }

    // Validate Role
    if (role === "") {
      $("#role").after('<span class="error">Role is required</span>');
      isValid = false;
    }

    if (isValid) {
      var formData = {
        username: username,
        name: name,
        email: email,
        password: password,
        phone: phone,
        address: address,
        city: city,
        state: state,
        country: country,
        pincode: pincode,
        role: role,
      };

    
      $.ajax({
        type: "POST",
        url: "insert_user.php",
        data: formData,
        success: function (response) {
          if(response == "yes"){
            $("#sucessfullregister").html("Registration Sucessfully");
             $("#username").val('');
           $("#name").val('');
            $("#email").val('');
            $("#password").val('');
            $("#phone").val('');
            $("#address").val('');
             $("#city").val('');
             $("#state").val('');
            $("#country").val('');
             $("#pincode").val('');
            $("#role").val('');
            $("#signup").hide('');

          }
          else{
            $("#ckeckeror").html("Username, email, or phone number already exists. Please choose a different one.");
          }
          
          console.log("Form data submitted successfully!");
          

        },
        error: function (xhr, status, error) {

          console.error("Error submitting form data: " + error);
        },
      });
    }

    return isValid;
  }

  function isValidEmail(email) {
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
  }

  function isValidPhoneNumber(phone) {
    var phonePattern = /^\d{10}$/;
    return phonePattern.test(phone);
  }

  function isValidPincode(pincode) {
    var pincodePattern = /^\d{6}$/;
    return pincodePattern.test(pincode);
  }

  $("#loginForm").submit(function (e) {
    e.preventDefault();

    var email2 = $("#email2").val();
    var password2 = $("#pasword2").val();
    console.log(password2);
    $.ajax({
      url: "login.php",
      type: "POST",
      data: {
        email: email2,
        password: password2,
      },
      success: function (response) {
        $("#error_login").html(response);
        console.log(response);
        if (response === "customer") {
          window.location.href = "Components/mainscreen/mainscreen.php";
        } else if (response === "reasturnat") {
          window.location.href = "Components/reasturant/reasturant_page.php";
        }
      },
      error: function (xhr, status, error) {
        console.log(error);
      },
    });
  });
});
