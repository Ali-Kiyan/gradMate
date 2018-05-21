<?php
require_once "./Views/Template/header.phtml";
?>

<link href="https://fonts.googleapis.com/css?family=Raleway+Dots" rel="stylesheet">
<div id="large-header" class="large-header fade">
            <div id="showcase" class="fade">

                      <h1 style="font-family: 'Raleway Dots', cursive; font-size:4rem;">Job Wizard</h1>
                      <p class="">United Kingdom Job Market analyisis for student outside of EEA</p>

                <br>
                <div class="">
                <a href="login.php" class="button"><i class="fa fa-sign-in" aria-hidden="true"></i> Enter</a>
                </div>
            </div>
  <canvas id="demo-canvas"></canvas>
</div>

<script src="./assets/js/Tweenlite.min.js"></script>
<script src="./assets/js/Easepack.min.js"></script>
<script src="./assets/js/bgscript.js"></script>
<?php
require_once "./Views/Template/footer.phtml";
?>
<script>
$(document).ready(function(){
TweenLite.fromTo($('#showcase'),2.7,{y:-50,rotationX: "-=60",ease: "Power4.easeOut"}, {y:50,opacity:1,rotationX: "0",ease: "Power4.easeOut"});
});
</script>
