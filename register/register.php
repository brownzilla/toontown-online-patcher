<?php
  include '../api/login/default.php';
  $db = doDB();
  $salt = "SPAM-YOUR-KEYBOARD-HERE";
  $output = "";

  if (isset($_POST['Submit'])) {
    $usr     = $_POST['Usr'];
    $pwd     = $_POST['Pwd'];
    $spwd    = $salt . $pwd;
    $hpwd    = password_hash($spwd, PASSWORD_DEFAULT);
    $pwdConf = $_POST['pwdConf'];
    $re      = $_POST['g-recaptcha-response'];
    $sql     = "INSERT INTO `Users` (Username, Password) VALUES ('$usr', '$hpwd')";
    if (!$re) {
      $output = "<div class='alert alert-danger'><strong>Uh oh!</strong> Please do the captcha!</div>";
    } else {
      $resp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=SECERT_KEY_HERE&response=".$re."&remoteip=".$_SERVER['REMOTE_ADDR']"");
      if ($resp.success == false) {
        $output = '<div class="alert alert-danger"><strong>Uh oh!</strong> Are you a bot? Try again.</div>';
      } else {
        if($pwd != $pwdConf) {
          $output = "<div class='alert alert-danger'><strong>Uh oh!</strong> Passwords did not match.</div>";
        } else {
          if ($db->query($sql) > 0) {
            $output = "<div class='alert alert-success'><strong>Awesome!</strong> You're now signed up for demo!</div>";
          } else {
            $output = "<div class='alert alert-danger'><strong>Uh oh!</strong> Something went wrong creating account.</div>";
          }
        }
      }
    }
  } else {
    $output = "Please use the <a href='https://demo.plaim.ml/tto-patcher/register>register</a> to add an account.'";
  }
