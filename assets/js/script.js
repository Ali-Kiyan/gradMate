$(document).ready(function(){

  TweenLite.fromTo($('#usersTable'),2,{y: 30}, {y:0, opacity: 1});





  $('#showhideACC').click(function(){
    $('#ACC').slideToggle(400);
  });

  $('#showhideACC2').click(function(){
    $('#ACC2').slideToggle(400);
  });
  
  $('#showhideACC3').click(function(){
    $('#ACC3').slideToggle(400);
  });

  $('#hamburger-6').click(function(){
    $('#sideNav').toggle("slide",600);
        $('.hamburger').toggleClass('hamMargin',1000);
        $('#tier2Table').toggleClass('col-xs-9 col-xs-offset-3 col-md-10 col-md-offset-2',200);
        $('.chart-container').toggleClass('col-xs-9 col-xs-offset-3 col-md-10 col-md-offset-2',600);
        $('.bluredSection').toggleClass('blur-all');
  });

    $(".hamburger").click(function() {
      $(this).toggleClass("is-active",300);
    });
      TweenLite.fromTo($('#large-header'),1.5,{y:10,ease: "easeOut.config(1.7)"}, {y:0,opacity:1,ease: "easeOut.config(1.7)"});
});
