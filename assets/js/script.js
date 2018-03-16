$('#showhideAnalysis').click(function(){
  $('#charts').slideToggle(300);
});
$('#showhideCV').click(function(){
  $('#cvs').slideToggle(300);
});
$('#hamburger-6').click(function(){
  $('#sideNav').toggle("slide");

      $('.hamburger').toggleClass('hamMargin',100);
      $('#tier2Table').toggleClass('col-xs-9 col-xs-offset-3 col-md-10 col-md-offset-2',200);

});

  $(".hamburger").click(function() {
    $(this).toggleClass("is-active",100);
  });
