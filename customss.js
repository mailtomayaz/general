/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/* Display Subcategories bar on home page */
jQuery('.level0 > .level-top').click(function(){
    jQuery(this).attr('href','#');
    jQuery('.level0 > .level-top').removeClass('active');
    jQuery('.level0.submenu').css('display','none');
    jQuery(this).addClass('active');
    jQuery(this).next().fadeToggle();
});

jQuery(document).ready(function(){
    /* Slide Up Section By clicking on Handle Bar */
    jQuery(".bottomclick").click(function(){
        jQuery(".slideb").find("div.snipit").slideDown("slow");
    });
    jQuery(".topclick").click(function(){
        jQuery(".slideb").find("div.snipit").slideUp("slow");
    });

    /* Change content of slider section box on hover */
    jQuery('.top-handle .col-sm-3').hover(function(){
        jQuery(this).children('.inner-content').addClass('active');
        jQuery(this).css('background-color','rgba(215, 107, 0, 0.8)');
        jQuery(this).children('.heading').animate({'marginTop':'60%'}, "fast");
        jQuery(this).children('.inner-content').show("fade", 500);
    },function(){
        jQuery(this).children('.inner-content').removeClass('active');
        jQuery(this).css('background-color','transparent');
        jQuery(this).children('.heading').animate({'marginTop':'0%'}, "fast");
        jQuery(this).children('.inner-content').hide("fade", 500);        
    }); 
    
       var widthScreen=jQuery(window ).width();
    if(widthScreen >= 767){
        disableAccordtion();
    }
    
});

 function disableAccordtion(){
       var active = true;
       if (active) {
            active = false;
           jQuery('.panel-collapse').collapse('show');
            jQuery('.panel-title').attr('data-toggle', '');
            jQuery(this).text('Enable accordion behavior');
        } else {
            active = true;
            jQuery('.panel-collapse').collapse('hide');
            jQuery('.panel-title').attr('data-toggle', 'collapse');
            jQuery(this).text('Disable accordion behavior');
        }
   
    
    jQuery('#accordion').on('show.bs.collapse', function () {
        if (active) jQuery('#accordion .in').collapse('hide');
    });
 }
 jQuery( window ).resize(function() {
    var widthScreen=jQuery( window ).width();
 if(widthScreen >= 767){
        disableAccordtion();
    }else{
        jQuery('#accordion').find('a').attr('aria-expanded','false');
    }
});

/********************************
 * RIGHT NAVIGATION IN MOB VIEW *
 ********************************/
jQuery('.navbar-toggle').click(function() {
    if(jQuery('.navbar-fixed-top').hasClass('moved')){
        jQuery('.page-wrapper').removeClass('moved');
        jQuery('.navbar-fixed-top').removeClass('moved');        
    }else{
        jQuery('.page-wrapper').addClass('moved');
        jQuery('.navbar-fixed-top').addClass('moved');
    }
});