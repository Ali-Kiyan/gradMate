

$(document).ready(function(){
  var vs;
  var chartData;

  $.getJSON("./companiespercounty.php", function(data){
    var counties = data.map(function(element){
      return element.county
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
    cdata.county = $('#citySelect').val();
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
         pp.push( d[i].industry);
        }
        for (var j=0; j<d.length; j++) {
         qq.push( d[j].num);
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
                   aa.push( r[i].industry);
                  }
                  for (var j=0; j<r.length; j++) {
                   bb.push( r[j].num);
         chartData = {
          labels: largerCompany(aa,pp),
          backgroundColor: 'black',
          fontFamily: 'Dosis',
          datasets : [
            {
              label : 'Companies in ' + cdata.county,
              backgroundColor: 'rgba(255, 249, 99, 0.32)',
              borderWidth: 0.5,
              pointStyle: 'Doughnut',
              borderColor: 'rgba(255, 141, 99, 1)',


              data: qq,
            },
            {
              label : 'Companies in ' + cdata2.county,
              backgroundColor: [
               'rgba(87, 209, 37, 0.3)',
               'rgba(200, 206, 16, 0.7)',
               'rgba(130, 102, 255, 0.7)',
               'rgba(44, 162, 235, 0.7)',
               'rgba(220, 236, 64, 0.7)',
                'rgba(10, 92, 22, 0.7)',
                'rgba(30, 392, 192, 0.7)',
           ],
              borderWidth: 0.5,
              hoverBackgroundColor:  [
               'rgba(255, 255, 255, 1)',
               'rgba(0, 152, 255, 1)',
               'rgba(255, 206, 85, 1)',
               'rgba(75, 193, 193, 1)',
               'rgba(153, 102, 255, 1)',
               'rgba(255, 159, 64, 1)',
               'rgba(255, 236, 64, 1)',
           ],
              pointStyle: 'Doughnut',
              borderColor: [
               'rgba(44, 99, 132, 1)',
               'rgba(200, 206, 16, 1)',
               'rgba(130, 102, 255, 1)',
               'rgba(44, 162, 235, 1)',
               'rgba(220, 236, 64, 1)',
                'rgba(10, 92, 22, 1)',
                'rgba(30, 392, 192, 1)',
           ],


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
            position:'left',
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
        Chart.defaults.global.defaultFontSize = 13;
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
   $.getJSON("./companiespercounty.php", function(data){
     var counties = data.map(function(element){
       return element.county
     })
     counties.forEach(function(element){
      $('#citySelect').append('<option val="'+ element +'">'+ element +'</option>');
    });
    });
  }
});
