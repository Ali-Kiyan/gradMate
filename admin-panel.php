<?php
require_once "Header.phtml";
require_once "navAdmin.phtml";
$connect = mysqli_connect("localhost","root","root","jobWizard");
$query = "Select * FROM company ORDER BY company_id DESC LIMIT 12";
$result = mysqli_query($connect, $query);
?>


<body id="admin-page">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="./assets/css/adminStyle.css"/>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
  <script type="text/javascript" src="./assets/js/jquery-3.2.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

<div class="container-fluid">
  <?php
  require_once "adminSideNav.phtml";
  ?>

  <div class="col-xs-12 animated fadeInUp scrollable" id="tier2Table">
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

      <td>'.$row['company_name'].'</td>
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

<style>




</style>
