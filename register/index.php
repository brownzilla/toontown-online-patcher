<?php include 'register.php'; ?>
<!DOCTYPE html>
<html>
<script src='https://www.google.com/recaptcha/api.js'></script>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, maximum-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="master.css" charset="utf-8">
    <title>Register » Toontown Online Patcher Demo</title>
  </head>
  <body>
    <div class="container">
      <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
          <h1><span class="fa fa-sign-in"></span> Login</h1>
          <form method="post">
            <div class="form-group">
              <label>Username</label>
              <input type="text" name="Usr" class="form-control"/>
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" name="Pwd" class="form-control"/>
            </div>
            <div class="form-group">
              <label>Password Confirm</label>
              <input type="password" name="pwdConf" class="form-control"/>
            </div>
            <div class="form-group">
              <div class="g-recaptcha" data-sitekey="SITE_KEY_HERE"></div>
            </div>
            <button type="submit" name="Submit" class="btn btn-primary btn-lg">Login</button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
