<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login Form</title>
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="./assets/css/stylesheet.css">
</head>
<body>
    <div class="cover">
        <div class="bg">
        </div>
      </div>

    <div class="login">
      <div class="container-fluid">
          <div class="row">
              <div class="col-xs-12">
                  <div class="panel panel-default signUpForm fade">
                      <div class="panel-heading">Sign Up</div>
                      <div class="panel-body">
                        <br>
                          <form class="form-horizontal" role="form" method="POST" action="./admin-panel.php">




                            <div class="form-group">
                                <label for="firstName" class="col-xs-4 control-label">First Name</label>

                                <div class=" col-xs-7 col-md-5">
                                    <input id="firstName" class="form-control circle" name="firstName" value="">
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="LastName" class="col-xs-4 control-label">Last Name</label>

                                <div class=" col-xs-7 col-md-5">
                                    <input id="LastName" class="form-control circle" name="LastName" value="">
                                </div>
                            </div>

                              <div class="form-group">
                                  <label for="username" class="col-xs-4 control-label">Username</label>

                                  <div class=" col-xs-7 col-md-5">
                                      <input id="username" class="form-control circle" name="username" value="">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="email" class="col-xs-4 control-label">Email Address</label>

                                  <div class=" col-xs-7 col-md-5">
                                      <input id="email" class="form-control circle" name="email" value="">
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label for="password" class="col-xs-4 control-label">Password</label>

                                  <div class=" col-xs-7 col-md-5">
                                      <input id="password" type="password" class="form-control circle" name="password">
                                      <br>
                                      <button type="submit" name="Lsubmit" class="btn btn-md btn-success circle">sign up
                                      </button>
                                      <a href="./companyLogin.phtml" class="btn btn-md btn-info circle">Back to login</a>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
</body>

</html>
<!-- Latest compiled and minified JavaScript -->

<script
  src="http://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.4/TweenMax.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
<script>
$(document).ready(function(){
TweenLite.fromTo($('.signUpForm'),2,{z:+300,y:-900,rotation: "-=50"}, {z:0,y:150,rotation: "+=50",opacity: 1});

});
</script>
