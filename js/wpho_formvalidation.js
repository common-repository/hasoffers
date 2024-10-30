jQuery.validator.addMethod("phoneno", function(phone_number, element) {
    	    phone_number = phone_number.replace(/\s+/g, "");
    	    return this.optional(element) || phone_number.length > 9 && 
    	    phone_number.match(/^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/);
    	}, "<br />Please specify a valid phone number");

jQuery.validator.addMethod("email", function(value, element) {
  return this.optional( element ) || /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test( value );
}, 'Please enter a valid email address.');
        
jQuery(document).ready(function () {
    jQuery("#btnhasofferform").click(function (){
        jQuery("#wpho_user_details").validate({
            rules: {
                wpho_lender:'required',
                wpho_address:'required',
                wpho_zip: 'required',
                wpho_firstname:'required',
                wpho_lastname:'required',
                wpho_email: {
                                required: true,
                                email: true
                            },
                wpho_phone: {
                                    required: true,
                                    maxlength: 16,
                                    phoneno: true
				}
            },
            messages: {
                wpho_lender: 'Please select your Current Lender',
                wpho_address: 'Please select Street Address',
                wpho_zip: 'Please enter Zipcode',
                wpho_firstname:'Please enter First Name',
                wpho_lastname: 'Please enter Last Name',
                wpho_email: {
                                required: 'Please enter Email',
                                email: 'Please enter valid Email',
                            },
                wpho_phone:{
                                    required: 'Please enter Phone Number',
                                    phoneno: 'Please enter Valid Phone Number',
				}
            }
        });
        
        if ((!jQuery('#wpho_user_details').valid())) {
       		return false;
            }
    });        
});