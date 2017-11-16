/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    $('.accordion').on('click', function () {
       // $('.a').slideToggle( "fast");
        $(this).children('.a').slideToggle("fast");
    });
    
    //accordion
    var widthScreen=$(window ).width();
    console.log(widthScreen);
    if(widthScreen >= 767){
        disableAccordtion();
    }
    
    
});
 function disableAccordtion(){
       var active = true;
       if (active) {
            active = false;
            $('.panel-collapse').collapse('show');
            $('.panel-title').attr('data-toggle', '');
            $(this).text('Enable accordion behavior');
        } else {
            active = true;
            $('.panel-collapse').collapse('hide');
            $('.panel-title').attr('data-toggle', 'collapse');
            $(this).text('Disable accordion behavior');
        }
   
    
    $('#accordion').on('show.bs.collapse', function () {
        if (active) $('#accordion .in').collapse('hide');
    });
 }
 $( window ).resize(function() {
    var widthScreen=$( window ).width();
 if(widthScreen >= 767){
        disableAccordtion();
    }
});