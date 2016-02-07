<?php
  /*
    This is where the magic happens. Schweet!
    Author: brownzilla
    Author URL: https://brownzilla.me
    Version: 0.1
  */

  include 'default.php';
  $db = doDB();
  $response = "Toontown Online Launcher API. https://github.com/brownzilla/toontown-online-patcher/"; // I would greatly appreciate it if you didn't change this. :^)
  $salt = grabSalt(); // This is used to add extra protection to your logins.

  // Server Accessibility.
  $isTest   = 0;
  $isClosed = 0;

  // Where the server gets the data. e.g https://example.com/api/login/?u=demo&p=demo
  $usr  = $_GET['u']; // Unfortunately, I'm unable to change these. They're in the latest build of the launcher.
  $pwd  = $_GET['p'];
  $spwd = $salt . $pwd; // Combinding the salt and pwd together.
  $ip   = $_SERVER['REMOTE_ADDR'];

  // This is where the DB is queried.
  $sql  = "SELECT * FROM Users WHERE Username='$usr'";
  $stmt = $db->query($sql);

  // Finally, the IF statement. Only edit if you know what's happening.
  if ($stmt->num_rows < 1) {
    $response = "LOGIN_ACTION=LOGIN\nLOGIN_ERROR=LOGIN_FAILED\nGLOBAL_DISPLAYTEXT=Unable to retrieve account ".$usr.".\n"; // Checking to see if the account exists.
  } else {
    while ($arr = $stmt->fetch_assoc()) {
      $ID = $arr['ID'];
      $hpwd = $arr['Password']; // Grabbing the User's password.
      $gmTok = hash('sha256', $hpwd); // Encrypting the salt encrypted password. Wow, I love security. :^)
      if (!password_verify($spwd, $hpwd)) {
        $response = "LOGIN_ACTION=LOGIN\nLOGIN_ERROR=LOGIN_FAILED\nGLOBAL_DISPLAYTEXT=Password was incorrect. Please try again.\n"; // Checking to see if the password is incorrect.
        $db->query("INSERT INTO LoginAttempts (`IP`, `Username`, `Reason`) VALUES('$ip', '$usr', 'Password was incorrect.')"); // Inserting Login Attempt in the DB
      } elseif ($isTest == 1) {
        if ($arr['TestAccess'] == 1) {
          $response = "LOGIN_ACTION=PLAY\nLOGIN_TOKEN=$gmTok\nGAME_USERNAME=".$usr."\nGAME_DISL_ID=$ID\nUSER_TOONTOWN_ACCESS=FULL\nGAME_CHAT_ELIGIBLE=1"; // Distributing Game Token
          $db->query("INSERT INTO LoginAttempts (`IP`, `Username`, `Reason`) VALUES('$ip', '$usr', 'Tester accessed Test Town.')");
        } else {
          $response = "LOGIN_ACTION=LOGIN\nLOGIN_ERROR=LOGIN_FAILED\nGLOBAL_DISPLAYTEXT=You're unable to participate in Test Town.\n";
          $db->query("INSERT INTO LoginAttempts (`IP`, `Username`, `Reason`) VALUES('$ip', '$usr', 'Trying to access Test server.')");
        }
      } elseif ($isClosed == 1) {
        if ($arr['Ranking'] == 'Administrator' || $arr['Ranking'] == 'Developer' || $arr['Ranking'] == 'Moderator') {
          $response = "LOGIN_ACTION=PLAY\nLOGIN_TOKEN=$gmTok\nGAME_USERNAME=$usr\nGAME_DISL_ID=$ID\nUSER_TOONTOWN_ACCESS=FULL\nGAME_CHAT_ELIGIBLE=1";
          $db->query("INSERT INTO LoginAttempts (`IP`, `Username`, `Reason`) VALUES('$ip', '$usr', 'Staff Member accessed Closed Server')");
        } else {
          $response = "LOGIN_ACTION=LOGIN\nLOGIN_ERROR=LOGIN_FAILED\nGLOBAL_DISPLAYTEXT=Server is closed for maintenance\n";
          $db->query("INSERT INTO LoginAttempts (`IP`, `Username`, `Reason`) VALUES('$ip', '$usr', 'Trying to access closed server.')");
        }
      } elseif ($arr['Verified'] == 0) {
        $response = "LOGIN_ACTION=LOGIN\nLOGIN_ERROR=LOGIN_FAILED\nGLOBAL_DISPLAYTEXT=Account isn't verified.\n";
        $db->query("INSERT INTO LoginAttempts (`IP`, `Username`, `Reason`) VALUES('$ip', '$usr', 'Unverified account.')");
      } else {
        $response = "LOGIN_ACTION=PLAY\nLOGIN_TOKEN=".$gmTok."\nGAME_USERNAME=".$usr."\nGAME_DISL_ID=$ID\nUSER_TOONTOWN_ACCESS=FULL\nGAME_CHAT_ELIGIBLE=1";
      }
    }
  }

  echo $response;
