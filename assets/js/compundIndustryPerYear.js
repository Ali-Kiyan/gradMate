
$(document).ready(function(){
  var vs;



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
               function largerCompany(first,second){
                return (first.length > second.length ? first : second);
               }
               console.log(largerCompany(aa,pp));
        var chartData = {
          labels: largerCompany(pp,aa),
          backgroundColor: 'black',
          fontFamily: 'Dosis',
          datasets : [
            {
              label : 'First',
              backgroundColor: [
               'rgba(255, 99, 132, 0.2)'
           ],
              borderWidth: 0.5,
              hoverBackgroundColor:  [
               'rgba(255, 255, 255, 1)'
           ],
              pointStyle: 'Doughnut',
              borderColor: [
               'rgba(255,99,132,1)'
              ],
              data: qq,
            },
            {
              label : 'Second',
              backgroundColor: [
               'rgba(157, 218, 255, 0.87)'
           ],
              borderWidth: 0.5,
              hoverBackgroundColor:
           'rgba(255, 236, 64, 1)',

              pointStyle: 'Point',
              borderColor: [
           'rgba(64, 146, 255, 1)'
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

});
