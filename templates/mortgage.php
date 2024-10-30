<?php
if( !function_exists( 'wpho_registration_form_fields' ) ) {
    function wpho_registration_form_fields() { ?>
    <div class="formmortgage">
        <div class="formmortgage-heading"><?php _e('HasOffer Information'); ?></div>
        <?php if(isset($_GET['msg']) && $_GET['msg'] == 1) {
            echo '<div class="alert-box success">Record added successfully</div>';  } else if(isset($_GET['msg']) && $_GET['msg'] == 2) {
              echo '<div class="alert-box errormsg">Your HasOffer Credentails/ URL are invalid. Please check and try again.</div>';
            } ?>

        <form name="wpho_user_details" id="wpho_user_details" method="POST" action="<?php the_permalink(); ?>">
             <label for="wpho_property_type"><span><?php _e('Property Type'); ?><span class="required">*</span></span>    
                <input type="radio" id="sfh" name="wpho_property_type" value="Single family home" checked>
                   <label for="sfh"><?php _e('Single Family'); ?></label>
                <input type="radio" id="mf" name="wpho_property_type"value="Multi Family">
                   <label for="mf"><?php _e('Multi Family'); ?></label>
                <input type="radio" id="townhouse" name="wpho_property_type" value="Townhouse">
                   <label for="townhouse"><?php _e('Town House'); ?></label>
                <input type="radio" id="condominium" name="wpho_property_type" value="Condo">
                   <label for="condominium"><?php _e('Condo'); ?></label>
            </label>
            <label for="wpho_credit_rating"><span><?php _e('Rate Your Credit'); ?><span class="required">*</span></span>    
                <input type="radio" id="excellent" name="wpho_credit_rating" value="Excellent">
                   <label for="excellent"><?php _e('Excellent'); ?></label>
                <input type="radio" id="good" name="wpho_credit_rating"value="Good" checked>
                   <label for="good"><?php _e('Good'); ?></label>
                <input type="radio" id="fair" name="wpho_credit_rating" value="Some Problems">
                   <label for="fair"><?php _e('Some Problems'); ?></label>
                <input type="radio" id="poor" name="wpho_credit_rating" value="Major Problems">
                   <label for="poor"><?php _e('Major Problems'); ?></label>
            </label>
            <label for="wpho_home_value"><span><?php _e('Estimated Home Value'); ?></span>
                <select name="wpho_home_value" class="select-field">
                    <option value="$50,000 or less">$50,000 or less</option>
                    <option value="$50,001 - 75,000">$50,001 - 75,000</option>
                    <option value="$75,001 - 100,000">$75,001 - 100,000</option>
                    <option value="$100,001 - 125,000">$100,001 - 125,000</option>
                    <option value="$125,001 - 150,000">$125,001 - 150,000</option>
                    <option value="$150,001 - 175,000">$150,001 - 175,000</option>
                    <option value="$175,001 - 200,000">$175,001 - 200,000</option>
                    <option value="$200,001 - 250,000" selected="selected">$200,001 - 250,000</option>
                    <option value="$250,001 - 300,000">$250,001 - 300,000</option>
                    <option value="$300,001 - 350,000">$300,001 - 350,000</option>
                    <option value="$350,001 - 400,000">$350,001 - 400,000</option>
                    <option value="$400,001 - 450,000">$400,001 - 450,000</option>
                    <option value="$450,001 - 500,000">$450,001 - 500,000</option>
                    <option value="$500,001 - 750,000">$500,001 - 750,000</option>
                    <option value="$750,001 - 1,000,000">$750,001 - 1,000,000</option>
                    <option value="$1,000,001 - 1,500,000">$1,000,001 - 1,500,000</option>
                    <option value="$1,500,001 - 2,000,000">$1,500,001 - 2,000,000</option>
                    <option value="Over $2,000,000">Over $2,000,000</option>
                </select>
            </label>
            <label for="wpho_mortgage_balance"><span><?php _e('Current Loan Amount'); ?></span>
                <select name="wpho_mortgage_balance" class="select-field">
                    <option value="$50,000 or less">$50,000 or less</option>
                    <option value="$50,001 - 75,000">$50,001 - 75,000</option>
                    <option value="$75,001 - 100,000">$75,001 - 100,000</option>
                    <option value="$100,001 - 125,000">$100,001 - 125,000</option>
                    <option value="$125,001 - 150,000">$125,001 - 150,000</option>
                    <option value="$150,001 - 175,000">$150,001 - 175,000</option>
                    <option value="$175,001 - 200,000">$175,001 - 200,000</option>
                    <option value="$200,001 - 250,000" selected="selected">$200,001 - 250,000</option>
                    <option value="$250,001 - 300,000">$250,001 - 300,000</option>
                    <option value="$300,001 - 350,000">$300,001 - 350,000</option>
                    <option value="$350,001 - 400,000">$350,001 - 400,000</option>
                    <option value="$400,001 - 450,000">$400,001 - 450,000</option>
                    <option value="$450,001 - 500,000">$450,001 - 500,000</option>
                    <option value="$500,001 - 750,000">$500,001 - 750,000</option>
                    <option value="$750,001 - 1,000,000">$750,001 - 1,000,000</option>
                    <option value="$1,000,001 - 1,500,000">$1,000,001 - 1,500,000</option>
                    <option value="$1,500,001 - 2,000,000">$1,500,001 - 2,000,000</option>
                    <option value="Over $2,000,000">Over $2,000,000</option>
                </select>
            </label>
            <label for="wpho_rate"><span><?php _e('Current Interest Rate'); ?></span>
                <select name="wpho_rate" class="select-field">
                    <option value="2.00">2.00%</option>
                    <option value="2.50">2.50%</option>
                    <option value="3.00">3.00%</option>
                    <option value="3.50">3.50%</option>
                    <option value="4.00">4.00%</option>
                    <option value="4.50" selected="selected">4.50%</option>
                    <option value="5.00">5.00%</option>
                    <option value="5.50">5.50%</option>
                    <option value="6.00">6.00%</option>
                    <option value="6.50">6.50%</option>
                    <option value="7.00">7.00%</option>
                    <option value="7.50">7.50%</option>
                    <option value="8.00">8.00%</option>
                    <option value="8.50">8.50%</option>
                    <option value="9.00">9.00%</option>
                    <option value="9.50">9.50%</option>
                    <option value="10.00">10.00%</option>
                    <option value="10.00+">10.00+%</option>
                </select>
            </label>
            <label for="wpho_va"><span><?php _e('Are you a veteran?'); ?> <span class="required">*</span></span>    
                <input type="radio" id="va_yes" name="wpho_va" value="Yes">
                   <label for="va_yes"><?php _e('Yes'); ?></label>
                <input type="radio" id="va_no" name="wpho_va"value="No" checked>
                   <label for="va_no"><?php _e('No'); ?></label>
            </label>

            <label for="wpho_months_behind" id="wpho_months_behind"><span><?php _e('Are you current on your mortgage?'); ?></span>
                <select name="wpho_months_behind" class="select-field">
                    <option value="I'm not behind" selected="selected">I'm not behind </option>
                    <option value="1 Month Late">1 Month Late</option>
                    <option value="2 Months Late">2 Months Late</option>
                    <option value="3 Months Late">3 Months Late</option>
                    <option value="4 Months Late">4 Months Late</option>
                    <option value="4+ Months Late">4+ Months Late</option>
                </select>
            </label>

            <label for="wpho_lender" id="wpho_lender"><span><?php _e('Who is Your Current Lender?'); ?></span>
                <select name="wpho_lender" class="select-field">
                    <option value="">Select One</option>
                    <option value="American Home Mortgage">American Home Mortgage</option>
                    <option value="Bank of America">Bank of America</option>
                    <option value="BB&amp;T">BB&amp;T</option>
                    <option value="Beneficial">Beneficial</option>
                    <option value="Chase">Chase</option>
                    <option value="Citibank">Citibank</option>
                    <option value="Credit Union">Credit Union</option>
                    <option value="EMC">EMC</option>
                    <option value="Everhome">Everhome</option>
                    <option value="Fannie Mae">Fannie Mae</option>
                    <option value="Flagstar">Flagstar</option>
                    <option value="GMAC">GMAC</option>
                    <option value="Greentree">Greentree</option>
                    <option value="HFC">HFC</option>
                    <option value="HSBC">HSBC</option>
                    <option value="Nationstar">Nationstar</option>
                    <option value="Ocwen">Ocwen</option>
                    <option value="One West Bank">One West Bank</option>
                    <option value="PHH Mortgage">PHH Mortgage</option>
                    <option value="US Bank">US Bank</option>
                    <option value="USDA">USDA</option>
                    <option value="Wachovia">Wachovia</option>
                    <option value="Wells Fargo">Wells Fargo</option>
                    <option value="Other">Other</option>
                    </select>
                </select>
            </label>

            <label for="wpho_address"><span><?php _e('Street Address'); ?> <span class="required">*</span></span><input type="text" class="input-field" name="wpho_address" id="wpho_address" value="" /></label>
            <label for="wpho_zip"><span><?php _e('Zipcode'); ?> <span class="required">*</span></span><input type="text" class="input-field" name="wpho_zip" id="wpho_zip" value="" /></label>
            <div class="formmortgage-heading"><?php _e('Personal Information'); ?></div>
            <label for="wpho_firstname"><span><?php _e('First Name'); ?> <span class="required">*</span></span><input type="text" class="input-field" name="wpho_firstname" id="wpho_firstname" value="" /></label>
            <label for="wpho_lastname"><span><?php _e('Last Name'); ?> <span class="required">*</span></span><input type="text" class="input-field" name="wpho_lastname" id="wpho_lastname" value="" required="" /></label>
            <label for="wpho_email"><span><?php _e('Email'); ?> <span class="required">*</span></span><input type="text" class="input-field" name="wpho_email" id="wpho_email" value="" required="" /></label>
            <label for="wpho_phone"><span><?php _e('Phone Number'); ?> <span class="required">*</span></span><input type="text" class="input-field" name="wpho_phone" id="wpho_phone" value="" required="" /></label>
            <label><span>&nbsp;</span>
            <input type="hidden" name="wpho_register_nonce" value="<?php echo wp_create_nonce('wpho-register-nonce'); ?>"/>
            <input type="submit" id="btnhasofferform" value="<?php _e('Submit'); ?>"/>
            </label>
        </form>
    </div>
    <?php }
}