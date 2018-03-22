$( document ).ready(function() {


  $.getJSON("./companiesPerCounty.php", function(d){

    var pp = [];
    var qq = [];
    for (var i=1; i<20; i++) {
     pp.push( d[i].county);
    }
    for (var j=1; j<20; j++) {
     qq.push( d[j].companies);
    }
    var chartData = {
      labels: pp,
      datasets : [
        {
          label : 'Companies',
          backgroundColor: 'rgba(185, 179, 193, 1)',
          borderWidth: 0.5,
          hoverBackgroundColor: 'rgba(156, 93, 93, 0.75)',
          data: qq,
        }

      ]

    }
    var pie = $('#pie');
    var pie = new Chart(pie, {
      type: "radar",
      data: chartData
      ,
      options:{
        title:{
          display: true,
          text: 'The top 20 hiring cities',
          fontFamily: 'Dosis',
          fontColor: '#000',
          fontWeight: 'normal'
        },
            legend:{
              display: false
            },
            tooltips: {
              fontFamily: 'Dosis'
            }
          }
    });
  });






});
