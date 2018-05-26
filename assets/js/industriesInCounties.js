$(document).ready(function(){
  var vs;
  var chartData;

  $.getJSON("./Web_Service/companyPerCountyAPI.php", function(data){
    var counties = [];
    for (var i=0; i<data.length; i++) {
     counties.push(data[i].County);
    }
    counties.forEach(function(element){
      $('#citySelect').append('<option val="'+ element +'">'+ element +'</option>');
      $('#citySelect2').append('<option val="'+ element +'">'+ element +'</option>');
    });
   });


  $('#cityPicker').on('change', function(event){
    //prevent from submiting
    event.preventDefault();
    var that = $(this);
    var url = that.attr('action');
    var type = that.attr('method');
    var cdata = {};
    var chartType = 'radar';
    cdata.county = $('#citySelect').val();
    if($('#citySelect').val() != ''){
    $.ajax({
      url: url,
      type: type,
      data: cdata,
      success: function(response){
        var fetchedData1 = response;
        var industryArray1 = [];
        var numOfCompanyArray1 = [];
        for (var i=0; i<fetchedData1.length; i++) {
         industryArray1.push( fetchedData1[i].Industry);
        }
        for (var j=0; j<fetchedData1.length; j++) {
         numOfCompanyArray1.push( fetchedData1[j].numOfCompany);
        }
        if(vs){
          vs.destroy();
        }
        function largerCompany(first, second){
          return (first.length > second.length ? first : second);
        }
        $('#cityPicker2').on('change', function(event){
          event.preventDefault();
          var that = $(this);
          var url2 = that.attr('action');
          var type2 = that.attr('method');
          var cdata2 = {};
          cdata2.county = $('#citySelect2').val();
            if($('#citySelect2').val() != ''){
              $.ajax({
                url: url2,
                type: type2,
                data: cdata2,
                success: function(response){
                  var fetchedData2 = response;
                  var industryArray2 = [];
                  var numOfCompanyArray2 = [];
                  for (var i=0; i<fetchedData2.length; i++) {
                   industryArray2.push( fetchedData2[i].Industry);
                  }
                  for (var j=0; j<fetchedData2.length; j++) {
                   numOfCompanyArray2.push( fetchedData2[j].numOfCompany);
         chartData = {
          labels: largerCompany(industryArray2,industryArray1),
          backgroundColor: 'black',
          fontFamily: 'Dosis',
          datasets : [
            {
              label : 'Companies in ' + cdata.county,
              backgroundColor: 'rgba(255, 249, 99, 0.32)',
              borderWidth: 0.5,
              pointStyle: 'rect',
              borderColor: 'rgba(255, 141, 99, 1)',


              data: numOfCompanyArray1,
            },
            {
              label : 'Companies in ' + cdata2.county,
              backgroundColor: 'rgba(87, 209, 37, 0.3)',
              borderWidth: 0.5,
              pointStyle: 'rect',
              borderColor:
               'rgba(44, 99, 132, 1)',
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
              duration: 2000,
              easing: 'linear'
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
            legend:{
            display:true,
            position:'bottom',
            labels:{
              fontColor:'#000',
              fontSize: 10,

            }
          },
                tooltips: {
                  fontFamily: 'Dosis'
                }
             },
        });
        Chart.defaults.global.defaultFontColor = 'rgb(46, 46, 46)';
                Chart.defaults.global.defaultFontFamily = 'Dosis';
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

  $('#cityPicker').keyup(function(e){
    var input = e.target.value;
    if(input.length > 1){
      getListOfCompaniesByCounty(input)
    }
  })


  function getListOfCompaniesByCounty(input){
   $.getJSON("./Web_Service/companyPerCountyAPI.php", function(data){
     var counties = data.map(function(element){
       return element.County
     })
     counties.forEach(function(element){
      $('#citySelect').append('<option val="'+ element +'">'+ element +'</option>');
    });
    });
  }
});
