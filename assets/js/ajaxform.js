$(document).ready(function () {
    $('#ajax-form').on('submit', function (e) {
      e.preventDefault(); // Prevent default form submission

      // Collect form data
      var formData = $(this).serialize();

      $.ajax({
        type: 'POST',
        url: $(this).attr('action'), // Uses the form's action attribute
        data: formData,
        success: function (response) {
          // Display the server's response in the result <p> element
          $('#result').html(response);
        },
        error: function () {
          $('#result').html('<div class="alert alert-error">There was an error with the submission. Please try again later.</div>');
        }
      });
    });
  });