<?php
require_once "Header.phtml";
require_once "navAdmin.phtml";
$connect = mysqli_connect("localhost","root","root","jobWizard");
$query = "select u.company_name from UpdatedCompanies as u left join company as c on u.company_name = c.company_name where c.company_name is NULL limit 20";
$result = mysqli_query($connect, $query);
?>


<body id="admin-page">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="./assets/css/adminStyle.css"/>
  <script type="text/javascript" src="./assets/js/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.4/TweenMax.min.js"></script>
  <script>
  $(document).ready(function(){
  TweenLite.fromTo($('#tier2Table'),2,{y:-100,opacity:0}, {y:0,opacity:1});
  });
  </script>


<div class="container-fluid">
  <?php
  require_once "adminSideNav.phtml";
  ?>

  <div class="col-xs-12 fade" id="tier2Table">
           <p>Newly added Tier 2 sponsoring companies</p>
   <table id="companyData" class="table table-hover table-bordered">
   <thead>

     <tr>
       <td>Company Name</td>
       <td>Add Company</td>
     </tr>

   </thead>
    <?php
    while($row = mysqli_fetch_array($result)){
      echo '<tr>
      <td>'.$row['company_name'].'</td>
      <td>
      <a href="./addingCompany.phtml" class="btn btn-md btn-info circle">Add to the Company list</a>
      </td>
      </tr>';
    }
    ?>
   </table>
  </div>
<!-- /#wrapper -->
</div>

<a href="./obsolete.php" class="btn btn-success">obsolete companies</a>


</body>

<?php
require_once "footer.phtml";
//select count(*) as num, date_added from company where industry = 'IT' group by YEAR(date_added)
?>
<link rel="stylesheet" href="z.css">

<style>


table{
  margin-top: 0;
}
#tier2Table{
  background-color: rgba(255,255,255,0.3);
}

</style>
