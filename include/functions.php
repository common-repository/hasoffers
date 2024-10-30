<?php
add_action( "admin_init", "wpho_setting" );
if( !function_exists( 'wpho_setting' ) ) {
    function wpho_setting() {
           register_setting( 'wpho-plugin-setting', 'wpho_username' );
           register_setting( 'wpho-plugin-setting', 'wpho_password' );
           register_setting( 'wpho-plugin-setting', 'wpho_hasoffer_url' );
           register_setting( 'wpho-plugin-setting', 'wpho_off_id' );
           register_setting( 'wpho-plugin-setting', 'wpho_aff_id' );
           register_setting( 'wpho-plugin-setting', 'wpho_sub_id' );
           register_setting( 'wpho-plugin-setting', 'wpho_source' );
    }  
}

if( !function_exists( 'wpho_setting_page_callback' ) ) {
    function wpho_setting_page_callback() { ?>
        <div class="wrap">
            <h2><?php _e('HasOffer Settings'); ?></h2>
            <form method="post" action="options.php">
               <?php
                settings_fields( 'wpho-plugin-setting' );
                do_settings_sections( 'wpho-plugin-setting' );
               ?>
                <table class="form-table">
                    <tr valign="top">
                    <th><h2><?php _e('HasOffers Credentials'); ?></h2></th>
                    </tr>
                    <tr valign="top">
                    <th scope="row"><?php _e('Username'); ?></th>
                    <td><input type="text" name="wpho_username" value="<?php echo esc_attr(get_option('wpho_username') ); ?>" size="40"/></td>
                    </tr>
                    <tr valign="top">
                    <th scope="row"><?php _e('Password'); ?></th>
                    <td><input type="password" name="wpho_password" value="<?php echo esc_attr( get_option('wpho_password') ); ?>" size="40" /></td>
                    </tr>
                    <tr valign="top">
                    <th><h2><?php _e('HasOffers Details'); ?></h2></th>
                    </tr>
                    <tr valign="top">
                    <th scope="row"><?php _e('PX API URL'); ?></th>
                    <td><input type="text" name="wpho_hasoffer_url" value="<?php echo esc_attr( get_option( 'wpho_hasoffer_url' ) ); ?>" size="40"/> EX: http://api.*****.px.com</td>
                    </tr>
                    <tr valign="top">
                    <th scope="row"><?php _e('Affiliate ID'); ?></th>
                    <td><input type="text" name="wpho_aff_id" value="<?php echo esc_attr( get_option( 'wpho_aff_id' ) ); ?>" size="40"/></td>
                    </tr>
                    <tr valign="top">
                    <th scope="row"><?php _e('Offer ID'); ?></th>
                    <td><input type="text" name="wpho_off_id" value="<?php echo esc_attr( get_option( 'wpho_off_id' ) ); ?>" size="40" /></td>
                    </tr>
                    <tr valign="top">
                    <th scope="row"><?php _e('Sub ID'); ?></th>
                    <td><input type="text" name="wpho_sub_id" value="<?php echo esc_attr( get_option( 'wpho_sub_id' ) ); ?>" size="40" /></td>
                    </tr>
                    <tr valign="top">
                    <th scope="row"><?php _e('Source'); ?></th>
                    <td><input type="text" name="wpho_source" value="<?php echo esc_attr( get_option( 'wpho_source' ) ); ?>" size="40" /></td>
                    </tr>
                </table>
               <?php submit_button(); ?>
            </form>
        </div>
    <?php } 
}

// Register a New User
if( !function_exists( 'wpho_add_new_member' ) ) {
function wpho_add_new_member() { 
        
  	if ( !empty( $_POST ) && wp_verify_nonce( $_POST['wpho_register_nonce'], 'wpho-register-nonce' ) ) {
            global $wpdb;
                        
            $username           = esc_attr( get_option( 'wpho_username' ) );
            $password           = esc_attr( get_option( 'wpho_password' ) );
            $pxurl              = esc_attr( get_option( 'wpho_hasoffer_url' ) );
            $offid              = esc_attr( get_option( 'wpho_off_id' ) );
            $affid              = esc_attr( get_option( 'wpho_aff_id' ) );
            $subid              = esc_attr( get_option( 'wpho_sub_id' ) );
            $source             = esc_attr( get_option( 'wpho_source' ) );
            $Date               = date( 'Y-m-d H:i:s' );
            $IP                 = $_SERVER['REMOTE_ADDR'];
            $PhoneNumber        = sanitize_text_field($_POST['wpho_phone']);
            $NewPhoneNumber     = preg_replace('/[^a-zA-Z0-9\']/', '', $PhoneNumber);
            $PXPhoneNumber      = str_replace("( )", '', $NewPhoneNumber);
                        
            $url = 'http://go.protrckr.com/aff_c?offer_id='.$offid.'&aff_id='.$affid;
            $ch = curl_init($url);
            curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, false );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch, CURLOPT_HEADER, true );
            curl_setopt( $ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Linux x86_64; rv:21.0) Gecko/20100101 Firefox/21.0" ); // Necessary. The server checks for a valid User-Agent.
            curl_exec( $ch );
            $response           = curl_exec( $ch );
            preg_match_all( '/^Location:(.*)$/mi', $response, $matches );
            curl_close( $ch );
            $PageURL            = $matches[1][0];
            $TrackTransactionID = trim( $Archive[1] );
            
            $str = '{
                    "type":"jsonwsp/request",
                    "version":"1.0",
                    "methodname":"Lead.Insert",

                    "LeadData" : {
                            "Target": "Lead.Insert",
                            "Partner": "'.$username.'",
                            "Password": "'.$password.'",
                            "RequestTime": "'.$Date.'",
                            "UserAgent": "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36",
                            "SessionLength": "7",
                            "TCPAText": "By clicking Get My Quotes, I authorize security companies, their dealers and partner companies to contact me about security offers by phone calls and text messages to the number I provided. I authorize that these marketing communications may be delivered to me using an automatic telephone dialing system or by prerecorded message. I understand that my consent is not a condition of purchase",

                            "AffiliateData": {
                                    "Id": "'.$affid.'",
                                    "TransactionId": "'.$TrackTransactionID.'",
                                    "OfferId": "'.$affid.'",
                                    "SubId": "'.$subid.'",
                                    "Source": "'.$source.'",
                                    "SellResponseURL": "",
                                    "VerifyAddress": "false",
                                    "LeadId": "",
                                    "TrustedForm": "",
                                    "ClickConsentID": ""
                            },

                            "ContactData": {
                                    "FirstName": "'.sanitize_text_field($_POST['wpho_firstname']).'",
                                    "LastName": "'.sanitize_text_field($_POST['wpho_lastname']).'",
                                    "Address": "'.str_replace(',',' ',(sanitize_text_field($_POST['wpho_address']))).'",
                                    "City": "New York",
                                    "State": "AL",
                                    "ZIPCode": "'.sanitize_text_field($_POST['wpho_zip']).'",
                                    "EmailAddress": "'.sanitize_email($_POST['wpho_email']).'",
                                    "PhoneNumber": "'.$PXPhoneNumber.'",
                                    "DayPhoneNumber": "'.$PXPhoneNumber.'",
                                    "IPAddress": "'.$IP.'"
                            },

                            "QuoteRequest": {
                                    "QuoteType": "Mortgage",
                                    "Persons": {
                                            "Person": {
                                                    "BirthDate": "",
                                                    "Gender": "",
                                                    "SocialSecurityNumber": "",
                                                    "CreditRating": "'.sanitize_text_field($_POST['wpho_credit_rating']).'",
                                                    "MilitaryOrVeteran": "'.sanitize_text_field($_POST['wpho_va']).'"
                                            }
                                    },

                                    "Mortgages": {
                                            "Mortgage": {
                                                    "LoanType": "Refinance",
                                                    "PropertyType": "'.sanitize_text_field($_POST['wpho_property_type']).'",
                                                    "PropertyUse": "Primary home",
                                                    "PropertyValue": "'.sanitize_text_field($_POST['wpho_home_value']).'",
                                                    "FirstMortgageBalance": "'.sanitize_text_field($_POST['wpho_mortgage_balance']).'",
                                                    "SecondMortgage": "No",
                                                    "SecondMortgageBalance": "$50,000 or less",
                                                    "CashOutAmount": "0 (No cash)",
                                                    "AnyBankruptcy": "No",
                                                    "BankruptcyTime": "Less than 1 year",
                                                    "AnyForeclosure": "No",
                                                    "ForeclosureTime": "Less than 1 year",
                                                    "FirstTimeBuyer": "No",
                                                    "PurchaseTimeFrame": "0-3 months",
                                                    "DownPayment": "5%",
                                                    "LoanAmount": "1",
                                                    "LoanToValue": "1"
                                            }
                                    }
                            }
                    }
            }';     
            $ch = curl_init( $pxurl.'?' );                                                                      
            curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, "POST" ); 
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $str );   
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );                                                                      
            $results = curl_exec( $ch );
            curl_close( $ch );
            $arr = json_decode( $results );
            $LeadResult     = $arr->Result;
            if( $LeadResult == "BaeOK" ) {
                $TransactionId  = $arr->Transactionid;
                $LeadExtraInfo  = $results; 
            } else {
                $TransactionId  = '';
                $LeadExtraInfo  = $results;
            }
            $myArr["type"] = "jsonwsp/request";
            $myArr["version"] = "1.0";
            $myArr["methodname"] = "Lead.Insert";
            $myArr["LeadData"]["Target"] = "Lead.Insert";
            $myArr["LeadData"]["Partner"] = "'.$username.'";
            $myArr["LeadData"]["Password"] = "'.$password.'";
        
            $table = PREFIX."mortgage";
            $data = array( 
                'property_type'     => sanitize_text_field($_POST['wpho_property_type']),
                'rate'              => sanitize_text_field($_POST['wpho_credit_rating']),
                'homevalue'         => sanitize_text_field($_POST['wpho_home_value']),
                'loanamt'           => sanitize_text_field($_POST['wpho_mortgage_balance']),
                'loaninterest'      => sanitize_text_field($_POST['wpho_rate']),
                'veteran'           => sanitize_text_field($_POST['wpho_va']),
                'your_mortgage'     => sanitize_text_field($_POST['wpho_months_behind']),
                'lender'            => sanitize_text_field($_POST['wpho_lender']),
                'streetaddress'     => str_replace(',',' ',(sanitize_text_field($_POST['wpho_address']))),
                'zipcode'           => intval($_POST['wpho_zip']),
                'firstname'         => sanitize_text_field($_POST['wpho_firstname']),
                'lastname'          => sanitize_text_field($_POST['wpho_lastname']),
                'email'             => sanitize_text_field($_POST['wpho_email']),
                'primaryphone'      => sanitize_text_field($_POST['wpho_phone']),
                'createddate'       => $Date,
                'result'            => $LeadResult,
                'transactionid'     => $TransactionId,
                'extrainfo'         => $LeadExtraInfo
                              
            );
            $format = array(
                '%s',
                '%s'
            );
                       
            $success = $wpdb->insert( $table, $data, $format );
            $Path = $_SERVER['REQUEST_URI'];
            $SiteURL = get_permalink().$Path;
           if( $success ){ 
                    wp_redirect( $SiteURL.'/?msg=1' );
                    exit;
             } else {
                    wp_redirect( $SiteURL.'/?msg=2' );
                    exit;
             }
        } 
    }
}
add_action( 'init', 'wpho_add_new_member' );