$('#showhideAnalysis').click(function(){
  $('#charts').slideToggle(300);
});
$('#showhideCV').click(function(){
  $('#cvs').slideToggle(300);
});
$('#hamburger-6').click(function(){
  $('#sideNav').slideToggle(700);
  setTimeout(function () {
      $('#tier2Table').toggleClass('col-xs-9 col-xs-offset-3 col-md-10 col-md-offset-2 animated fadeIn');
      $('.hamburger').toggleClass('hamMargin');
  }, 400);

});

  $(".hamburger").click(function() {
    $(this).toggleClass("is-active");
  });
