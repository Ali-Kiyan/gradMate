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
   <table id="companyData" class="table table-hover table-bordered table-responsive ">
   <thead>
     <tr>
       <td>Id</td>
       <td>Name</td>
       <td>Website</td>
       <td>Town</td>
       <td>County</td>
       <td>Main Tier</td>
       <td>Subtier</td>
       <td>industry</td>
       <td>Date_added</td>
     </tr>

   </thead>
    <?php
    while($row = mysqli_fetch_array($result)){
      echo '<tr>
      <td>'.$row['company_id'].'</td>
      <td>'.$row['company_name'].'</td>
      <td>'.$row['company_website'].'</td>
      <td>'.$row['town'].'</td>
      <td>'.$row['county'].'</td>
      <td>'.$row['main_tier'].'</td>
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


<style>


table{
  margin-top: 10%;
  background-color: #ebebeb;
}
.table-hover > tbody > tr:hover {
  background-color: #f6f7db;
}

.hamburger{
  display: inline-block;

}
.hamMargin{
float: right;
}

.hamburger .line{
 width: 50px;
 height: 3px;
 background-color: #8c97c3;
 display: block;
 margin: 8px auto;
 -webkit-transition: all 0.3s ease-in-out;
 -o-transition: all 0.3s ease-in-out;
 transition: all 0.3s ease-in-out;

}


#hamburger-6.is-active{
 -webkit-transition: all 0.3s ease-in-out;
 -o-transition: all 0.3s ease-in-out;
 transition: all 0.3s ease-in-out;
 -webkit-transition-delay: 0.6s;
 -o-transition-delay: 0.6s;
 transition-delay: 0.6s;
 -webkit-transform: rotate(45deg);
 -ms-transform: rotate(45deg);
 -o-transform: rotate(45deg);
 transform: rotate(45deg);
}

#hamburger-6.is-active .line:nth-child(2){
 width: 0px;
}

#hamburger-6.is-active .line:nth-child(1),
#hamburger-6.is-active .line:nth-child(3){
 -webkit-transition-delay: 0.3s;
 -o-transition-delay: 0.3s;
 transition-delay: 0.3s;
}

#hamburger-6.is-active .line:nth-child(1){
 -webkit-transform: translateY(13px);
 -ms-transform: translateY(13px);
 -o-transform: translateY(13px);
 transform: translateY(13px);
}

#hamburger-6.is-active .line:nth-child(3){
 -webkit-transform: translateY(-10px) rotate(90deg);
 -ms-transform: translateY(-10px) rotate(90deg);
 -o-transform: translateY(-10px) rotate(90deg);
 transform: translateY(-10px) rotate(90deg);
}

</style>
