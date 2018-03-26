$( document ).ready(function() {

  $.getJSON("./industryPerCounty.php", function(d){

    var pp = [];
    var qq = [];
    for (var i=1; i<d.length; i++) {
     pp.push( d[i].industry);
    }
    for (var j=1; j<d.length; j++) {
     qq.push( d[j].num);
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
