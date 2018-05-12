(function(){
var vs;

  TweenLite.fromTo($('#cityPicker'),1.5,{x:1000,opacity:0, rotationX: "+=140"}, {x:0,opacity:1, rotationX: "-=140"});
  TweenLite.fromTo($('#chartType'),1.5,{x:1000,opacity:0, rotationX: "-=210"}, {x:0,opacity:1, rotationX: "+=210"});
  $.getJSON("./Web_Service/companyPerCountyAPI.php", function(data){
    var counties = data.map(function(element){
      return element.County
    })
    counties.forEach(function(element){
      $('#citySelect').append('<option val="'+ element +'">'+ element +'</option>');
    });
   });
  $('#cityPicker').on('change', function(event){
    //prevent from submiting
    event.preventDefault();
    TweenLite.fromTo($('#chart'),3,{y:0,opacity:0,rotationY: "+=30"}, {y:0,opacity:1,rotationY: "-=30"});
    var that = $(this);
    var url = that.attr('action');
    var type = that.attr('method');
    var cdata = {};
    var chartType = $('#chartType').val();
    cdata.county = $('#citySelect').val();
    if($('#citySelect').val() != ''){
    $.ajax({
      url: url,
      type: type,
      data: cdata,
      success: function(response){
        var fetchedData = response;
        var industryArray = [];
        var numOfComapnyArray = [];
        for (var i=0; i<fetchedData.length; i++) {
         industryArray.push( fetchedData[i].Industry);
        }
        for (var j=0; j<fetchedData.length; j++) {
         numOfComapnyArray.push( fetchedData[j].numOfCompany);
        }
        var chartData = {
          labels: industryArray,
          backgroundColor: 'black',
          fontFamily: 'Dosis',
          datasets : [
            {
              label : cdata.county,
              backgroundColor: [
               'rgba(255, 99, 132, 0.2)',
               'rgba(54, 162, 235, 0.2)',
               'rgba(255, 206, 86, 0.2)',
               'rgba(75, 192, 192, 0.2)',
               'rgba(153, 102, 255, 0.2)',
               'rgba(255, 159, 64, 0.2)',
               'rgba(255, 236, 64, 0.2)',
           ],
              borderWidth: 0.5,
              hoverBackgroundColor:  [
               'rgba(245, 7, 45, 0.9)',
               'rgba(0, 152, 255, 1)',
               'rgba(255, 206, 85, 1)',
               'rgba(75, 193, 193, 1)',
               'rgba(153, 102, 255, 1)',
               'rgba(255, 159, 64, 1)',
               'rgba(255, 236, 64, 1)',
           ],
              pointStyle: 'Doughnut',
              borderColor: [
               'rgba(224, 27, 58, 1)',
               'rgba(54, 162, 235, 1)',
               'rgba(255, 206, 86, 1)',
               'rgba(75, 192, 192, 1)',
               'rgba(153, 102, 255, 1)',
               'rgba(255, 159, 64, 1)',
               'rgba(255, 253, 64, 1)',
              ],


              data: numOfComapnyArray,
            },
          ],


        }
        $('#chartType').on('change', function(){
          if(vs !== undefined)
          vs.update();
        });

        var chart = $('#chart');
        if (vs) {
            vs.destroy();
          }
         vs = new Chart(chart, {
          type: chartType,
          data: chartData,
          pointStyle: 'rect',
          options:{
            animation: {
              duration: 3000,
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
              text: 'Industires in region',
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
        Chart.defaults.global.defaultFontSize = 7;
                vs.update();
      }
    });
    }
    else{
      alert("Please select a city.");
      return false;
    }

  });

  $('#cityPicker').keyup(function(elemet){
    var input = element.target.value;
    if(input.length > 1){
      getListOfCompaniesByCounty(input)
    }
  })


  function getListOfCompaniesByCounty(input){
   $.getJSON("./Web_Service/companyPerCounty.php", function(data){
     var counties = data.map(function(element){
       return element.county
     });
     counties.forEach(function(element){
      $('#citySelect').append('<option val="'+ element +'">'+ element +'</option>');
    });
    });
  }
})();
