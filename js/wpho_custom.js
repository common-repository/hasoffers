jQuery(document).ready(function () { 
    jQuery("#wpho_months_behind").hide();
    jQuery("#wpho_lender").hide();
    jQuery("#townhouse,#condominium").click(function () {
    jQuery("#wpho_months_behind").show();
    jQuery("#wpho_lender").show();
    });
    jQuery("#sfh,#mf").click(function () {
    jQuery("#wpho_months_behind").hide();
    jQuery("#wpho_lender").hide();
    });
});