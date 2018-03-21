<?php
require_once "header.phtml";
require_once "navAdmin.phtml";
require_once "adminSideNav.phtml";
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Stats</title>
  <link rel="stylesheet" href="./assets/css/adminStyle.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dc/2.1.9/dc.css">
  <script type="text/javascript" src="./assets/js/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crossfilter/1.3.11/crossfilter.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.17/d3.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dc/2.1.9/dc.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>




</head>
<body>





<div class="chart-container">
  <div class="pie">
    <canvas id="pie" width="100vw" height="50vh" class="scrollable"></canvas>
  </div>
</div>


</body>

<script>
$.getJSON("./stability.php", function(d){
  var pp = [];
  var qq = [];
  for (var i=1; i<20; i++) {
   pp.push( d[i].company_name);
  }
  for (var j=1; j<20; j++) {
   qq.push( d[j].date_added);
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
        text: 'The top 20 stable companies',
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

</script>


<style>

.county{
  background-color: blue;
}

</style>

</html>



<?php
require_once "footer.phtml";
?>
