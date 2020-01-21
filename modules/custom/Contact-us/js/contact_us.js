jQuery.validator.addMethod("phoneno", function(phone_number, element) {
    phone_number = phone_number.replace(/\s+/g, "");
    return this.optional(element) || phone_number.length > 9 && 
    phone_number.match(/^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/);
}, "<br />Please specify a valid phone number");
(function($) {
  $("#contact-us, #contact-us--2").validate({
    rules: {
      name: "required",
      email: {
        required: true,
        email: true
      },
      phone: {
          required :  true,
           phoneno:true 
      },
      message: "required",
     
    },
    // Specify validation error messages
    messages: {
      name: "Please enter your name",
      email: "Please enter a valid email address",
      message : "Please enter your message."
    },
    submitHandler: function(form) {
    	 $(".waiting").css("display", "inline-block");
         $.ajax({
		        url: Drupal.url('contact_us/addQuery'),
		        type: 'POST',
		        data: {
		          'name': $("#contact_us_name").val(),
		          'phone': $("#contact_us_phone").val(),
		          'email': $("#contact_us_email").val(),
		          'message': $("#contact_us_query").val(),
		          'salesperson_contact': ($("#contact_us_salesperson_contact"). prop("checked") == true) ? 1 : 0,
		        },
		        success: function (results) {
		        	  $(".waiting").css("display", "none");
		        	var obj = JSON.parse(results);
		        	if(obj.result == 'done'){
		        		$("#contact-us, #contact-us--2").trigger("reset");                       
		        		$("#ajax-request-success").html(obj.message);
		        		 setTimeout('$("#ajax-request-success").hide()',4000);
		        		$("#ajax-request-success").focus();
		        		return false;
		        	}else{
		        		$("#ajax-request-error").html(obj.message);
                        return false;
		        	}
		        }
      }); 
      return false; 
    }
  });
})(jQuery);
