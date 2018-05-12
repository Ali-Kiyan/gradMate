(function(){
var vs;
  TweenLite.fromTo($('#cityPicker'),1.5,{x:1000,opacity:0, rotationX: "+=140"}, {x:0,opacity:1, rotationX: "-=140"});
  TweenLite.fromTo($('#chartType'),1.5,{x:1000,opacity:0, rotationX: "-=210"}, {x:0,opacity:1, rotationX: "+=210"});
  $('#cityPicker').on('change', function(event){
    //prevent from submiting
    event.preventDefault();
    TweenLite.fromTo($('#chart'),4,{y:0,opacity:0,rotationY: "+=30"}, {y:0,opacity:1,rotationY: "-=30"});
    var that = $(this);
    var url = that.attr('action');
    var type = that.attr('method');
    var cdata = {};
    cdata.Industry = $('#citySelect').val();
    if($('#citySelect').val() != ''){
    $.ajax({
      url: url,
      type: type,
      data: cdata,
      success: function(response){
        var fetchedData = response;
        var yearsArray = [];
        var numOfComapnyArray = [];
        for (var i=0; i<fetchedData.length; i++) {
         yearsArray.push( fetchedData[i].Year);
        }
        for (var j=0; j<fetchedData.length; j++) {
         numOfComapnyArray.push( fetchedData[j].numOfCompany);
        }
        var chartData = {
          labels: yearsArray,
          backgroundColor: 'black',
          fontFamily: 'Dosis',
          datasets : [
            {
              label : cdata.Industry,
              backgroundColor:
               'rgba(54, 162, 235, 0.2)',
              borderWidth: 0.5,
              hoverBackgroundColor:

               'rgba(0, 152, 255, 1)'

           ,
              pointStyle: 'Doughnut',
              borderColor: 'rgba(54, 162, 235, 1)',
              data: numOfComapnyArray,
            },
          ],
        }
        $('#citySelect').on('change', function(){
          if(vs !== undefined)
          vs.update();
        });
        var chart = $('#chart');
        if (vs) {
            vs.destroy();
          }
         vs = new Chart(chart, {
          type: 'line',
          data: chartData,
          pointStyle: 'rect',
          options:{
            animation: {
              duration: 4000,
              easing: 'easeInQuad'
            },
            elements: {
              point: {
                pointStyle: 'rect',
                backgroundColor: 'white',
                hitRadius: 1,
                hoverRadius: 5
              },
              line: {
                tension: 0.5,
              }
            },
            title:{
              display: true,
              text: 'Industries Over Years',
                          fontFamily: 'Dosis',
              fontColor: '#000',
              defaultFontColor: 'black',
              fontWeight: 'normal'
            },
            legend:{
            display:true,
            position:'bottom',
            labels:{
              fontColor:'#000',

            }
          },
                tooltips: {
                  fontFamily: 'Dosis'
                },
                responsive: true,
                maintainAspectRation: true,
                fullwidth: true,
             },
        });
        Chart.defaults.global.defaultFontColor = 'rgb(46, 46, 46)';
                Chart.defaults.global.defaultFontFamily = 'Dosis';
        Chart.defaults.global.defaultFontSize = 9;
                vs.update();
      }
    });
    }
    else{
      alert("Please select an industry");
      return false;
    }
  });
})();
