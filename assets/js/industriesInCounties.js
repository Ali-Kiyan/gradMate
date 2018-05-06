

$(document).ready(function(){
  var vs;
  var chartData;

  $.getJSON("./Web_Service/companyPerCountyAPI.php", function(data){
    var counties = data.map(function(element){
      return element.County
    })
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
    var chartType = $('#chartType').val();
    cdata.County = $('#citySelect').val();
    if($('#citySelect').val() != ''){
    $.ajax({
      url: url,
      type: type,
      data: cdata,
      success: function(response){
        var d = response;
        var pp = [];
        var qq = [];
        for (var i=0; i<d.length; i++) {
         pp.push( d[i].Industry);
        }
        for (var j=0; j<d.length; j++) {
         qq.push( d[j].numOfCompany);
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
                  var r = response;
                  var aa = [];
                  var bb = [];
                  for (var i=0; i<r.length; i++) {
                   aa.push( r[i].Industry);
                  }
                  for (var j=0; j<r.length; j++) {
                   bb.push( r[j].numOfCompany);
         chartData = {
          labels: largerCompany(aa,pp),
          backgroundColor: 'black',
          fontFamily: 'Dosis',
          datasets : [
            {
              label : 'Companies in ' + cdata.County,
              backgroundColor: 'rgba(255, 249, 99, 0.32)',
              borderWidth: 0.5,
              pointStyle: 'Doughnut',
              borderColor: 'rgba(255, 141, 99, 1)',


              data: qq,
            },
            {
              label : 'Companies in ' + cdata2.County,
              backgroundColor: [
               'rgba(87, 209, 37, 0.3)',

           ],
              borderWidth: 0.5,
              pointStyle: 'Doughnut',
              borderColor:
               'rgba(44, 99, 132, 1)',
              data: bb,
            }
          ],


        }

        var pie = $('#pie');
        if(vs){
          vs.destroy();
        }
         vs = new Chart(pie, {
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
