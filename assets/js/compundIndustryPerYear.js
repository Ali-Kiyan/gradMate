(function(){
  var vs;
  $('#cityPicker').on('change', function(event){
    //prevent from submiting
    event.preventDefault();
    var that = $(this);
    var url = that.attr('action');
    var type = that.attr('method');
    var cdata = {};
    var chartType = 'line';
    cdata.Industry = $('#citySelect').val();
    if($('#citySelect').val() != ''){
    $.ajax({
      url: url,
      type: type,
      data: cdata,
      success: function(response){
        var fetchedData1 = response;
        var yearsArray1 = [];
        var numOfCompanyArray1 = [];
        for (var i=0; i<fetchedData1.length; i++) {
         yearsArray1.push( fetchedData1[i].Year);
        }
        for (var j=0; j<fetchedData1.length; j++) {
         numOfCompanyArray1.push( fetchedData1[j].numOfCompany);
        }
        if(vs){
          vs.destroy();
        }
        $('#cityPicker2').on('change', function(event){
          event.preventDefault();
          var that = $(this);
          var url2 = that.attr('action');
          var type2 = that.attr('method');
          var cdata2 = {};
          cdata2.Industry = $('#citySelect2').val();
            if($('#citySelect2').val() != ''){
              $.ajax({
                url: url2,
                type: type2,
                data: cdata2,
                success: function(response){
                  var fetchedData2 = response;
                  var yearsArray2 = [];
                  var numOfCompanyArray2 = [];
                  for (var i=0; i<fetchedData2.length; i++) {
                   yearsArray2.push( fetchedData2[i].Year);
                  }
                  for (var j=0; j<fetchedData2.length; j++) {
                   numOfCompanyArray2.push( fetchedData2[j].numOfCompany);
               function largerCompany(first,second){
                return (first.length > second.length ? first : second);
               }
        var chartData = {
          labels: largerCompany(yearsArray1,yearsArray2),
          backgroundColor: 'black',
          fontFamily: 'Dosis',
          datasets : [
            {
              label : cdata.Industry,
              backgroundColor:
               'rgba(255, 99, 132, 0.2)',
              borderWidth: 0.5,
              hoverBackgroundColor:
               'rgba(209, 52, 52, 1)',
              pointStyle: 'Doughnut',
              borderColor:'rgba(255,99,132,1)',
              data: numOfCompanyArray1,
            },
            {
              label : cdata2.Industry,
              backgroundColor:
               'rgba(157, 218, 255, 0.87)',
              borderWidth: 0.5,
              hoverBackgroundColor:'rgba(64, 186, 255, 1)',

              pointStyle: 'Point',
              borderColor: 'rgba(64, 146, 255, 1)',
              data: numOfCompanyArray2,
            }
          ],
        }
        var chart = $('#chart');
        if(vs){
          vs.destroy();
        }
         vs = new Chart(chart, {
          type: chartType,
          data: chartData,
          pointStyle: 'rect',
          options:{
            animation: {
              duration: 8000,
              easing: 'easeOutSine'
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
            position:'right',
            labels:{
              fontColor:'#000',
            }
          },
                tooltips: {
                  fontFamily: 'Dosis'
                }
             },
        });
        Chart.defaults.global.defaultFontColor = 'rgb(46, 46, 46)';
                Chart.defaults.global.defaultFontFamily = 'Dosis';
        Chart.defaults.global.defaultFontSize = 8;
        vs.update();
      }
    }
   });
}
});


      }


    });

    }
    else{
      alert("Please select a city.");
      return false;
    }

  });

})();
