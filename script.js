$(document).ready(function() {
    $("#signupForm").submit(function(event) {
      event.preventDefault(); // Prevent form submission
  
      var emailInput = $("#email");
      var emailError = $("#emailError");
  
      // Check if the email input is valid
      if (!validateEmail(emailInput.val())) {
        emailInput.addClass("is-invalid"); // Add 'is-invalid' class to input
        emailError.css("display", "block"); // Show the error message
      } else {
        emailInput.removeClass("is-invalid"); // Remove 'is-invalid' class from input
        emailError.css("display", "none"); // Hide the error message
  
        // Email is valid, you can proceed with form submission
        $(".mainContainer").css({"display": "none", "visibility": "hidden"});
        $(".successContainer").css({"display": "block", "visibility": "visible"});
      }

      $("#confirmedEmail").text($("#email").val());
      
      $.ajax({
        type: "POST",
        url: "forms/contact.php",
        data: {
          email: $("#email").val()
        },
        dataType: 'json',
        success: function (data) {
          console.log(data)
        },
        error: function (e) {
            console.log("ERROR : ", e);
        }
      }); // end of ajax
    }); // end of ready function
  
    // Function to validate email format
    function validateEmail(email) {
      var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return re.test(email);
    }
  });

$("#dismissBtn").on("click", function() {
    $(".successContainer").css({"display": "none", "visibility": "hidden"});
    $(".mainContainer").css({"display": "block", "visibility": "visible"});
});

