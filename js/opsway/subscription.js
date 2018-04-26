jQuery(document).ready(function($) {
  console.log("Opsway JQuery is loaded!");
  var customForm = new VarienForm('subscription-form');
  $("#subscription-form").submit(function() {
    if(customForm.validator.validate()) {
      var form_data = $(this).serialize();
      $.ajax({
        type: "POST",
        url: "subscription/index/post",
        data: form_data,
        success: function(data) {
          $("#subscription-form").prepend("<h2>" + data + "</h2>");
        }
      });
      return false;
    }
  })
})