$('#showhideAnalysis').click(function(){
  $('#charts').slideToggle(400);
});
$('#showhideCV').click(function(){
  $('#cvs').slideToggle(400);
});
$('#hamburger-6').click(function(){
  $('#sideNav').toggle("slide",600);
      $('.hamburger').toggleClass('hamMargin',1000);
      $('#tier2table').removeClass('col-xs-12');
      $('#tier2Table').toggleClass('col-xs-9 col-xs-offset-3 col-md-10 col-md-offset-2',200);
      $('.container').toggleClass('blur-all');
});

  $(".hamburger").click(function() {
    $(this).toggleClass("is-active",300);
  });
    TweenLite.fromTo($('#large-header'),1.5,{y:10,opacity:0,ease: "easeOut.config(1.7)"}, {y:0,opacity:1,ease: "easeOut.config(1.7)"});
