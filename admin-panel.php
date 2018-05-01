<?php
require_once "Header.phtml";
require_once "navAdmin.phtml";
$connect = mysqli_connect("localhost","root","root","jobWizard");
$query = "Select * FROM company ORDER BY Company_Id DESC LIMIT 12";
$result = mysqli_query($connect, $query);
?>


<body id="admin-page">
  <style>
  #tier2table{
    opacity: 0;
  }
  </style>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="./assets/css/adminStyle.css"/>
  <script type="text/javascript" src="./assets/js/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.4/TweenMax.min.js"></script>
  <script>
  $(document).ready(function(){
  TweenLite.fromTo($('#tier2Table'),2,{y:-100}, {y:0,opacity:1});
  });
  </script>


<div class="container-fluid">
  <?php
  require_once "adminSideNav.phtml";
  ?>

  <div class="col-xs-12 fade" id="tier2Table">
   <table id="companyData" class="table table-hover table-bordered">
   <thead>
     <tr>

       <td>Name</td>
       <td>Website</td>
       <td>County</td>
       <td>Subtier</td>
       <td>industry</td>
       <td>Date_added</td>
     </tr>

   </thead>
    <?php
    while($row = mysqli_fetch_array($result)){
      echo '<tr>

      <td>'.$row['Company_Name'].'</td>
      <td>'.$row['company_website'].'</td>
      <td>'.$row['county'].'</td>
      <td>'.$row['subtier'].'</td>
      <td>'.$row['industry'].'</td>
      <td>'.$row['date_added'].'</td>
      </tr>';
    }
    ?>
   </table>
  </div>
<!-- /#wrapper -->
</div>




</body>

<?php
require_once "footer.phtml";
?>
<link rel="stylesheet" href="z.css">
