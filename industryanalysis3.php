<?php
require_once "header.phtml";
require_once "navAdmin.phtml";

?>
<link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">
<link rel="stylesheet" href="./assets/css/adminStyle.css"/>
<link rel="stylesheet" href="z.css">
<link rel="stylesheet" href="./assets/css/bootstrap-select.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
<script type="text/javascript" src="./assets/js/jquery-3.2.1.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<!-- <script src="./assets/js/bootstrap-select.min.js"></script> -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>

<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="
crossorigin="anonymous"></script>


</script>

<body>

  <div class="container-fluid">
    <?php
    require_once "adminSideNav.phtml";
    ?>


  <div class="container bluredSection">
    <form action="./industryPerCounty.php" class="col-xs-12" id="cityPicker" method="post">
          <select class="from-control input-sm" id="citySelect">
            <option value="">Select County</option>
          </select>
          <select class="from-control input-sm" id="chartType" hidden>
            <option value="">Select Chart Type</option>
            <option value="radar" selected="selected">Radar</option>
          </select>
          <br>
          <br>
          <input type="submit" name="submit" class="btn btn-sm btn-info" hidden>
    </form>
    <form action="./industryPerCounty.php" class="col-xs-12" id="cityPicker2" method="post">
          <select class="from-control input-sm" id="citySelect2">
            <option value="">Select County</option>
          </select>
          <br>
          <br>
          <input type="submit" name="submit" class="btn btn-sm btn-info" hidden>


    </form>


    <div class="chart-container col-xs-12" style="position:reletive;">

        <canvas id="pie" width="100vw" height="50vh"></canvas>

    </div>

    </div>




  </div>

</body>

<?php
require_once "footer.phtml";
?>
<script>


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
              label : 'First',
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
               'rgba(255,99,132,1)',
               'rgba(54, 162, 235, 1)',
               'rgba(255, 206, 86, 1)',
               'rgba(75, 192, 192, 1)',
               'rgba(153, 102, 255, 1)',
               'rgba(255, 159, 64, 1)',
               'rgba(255, 253, 64, 1)',
              ],


              data: qq,
            },
            {
              label : 'Second',
              backgroundColor: [
               'rgba(44, 99, 132, 0.7)',
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
        Chart.defaults.global.defaultFontSize = 18;
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

</script>
