(function($){
  $(function(){

    $('.sidenav').sidenav();
    $('.dropdown-trigger').dropdown();
    $('.dropdown-nav').dropdown({ constrainWidth: false });
    $('select').formSelect();
    $('.tabs').tabs();
    $('.fixed-action-btn').floatingActionButton();
    $('.collapsible').collapsible();
    $('.scrollspy').scrollSpy();
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd'
    });
    $('.tooltipped').tooltip();
    $('.carousel').carousel({
      // fullWidth: true,
      indicators: true
    });


    // $(".tabs>li>a").css("color", '#37474f ');
    // $(".tabs>.indicator").css("background-color", '#37474f ');


  }); // end of document ready
})(jQuery); // end of jQuery name space
