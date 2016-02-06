<?php
  /*
    This is where the magic happens. Schweet!
    Author: brownzilla
    Author URL: https://brownzilla.me
    Version: 0.1
  */

  include 'default.php';
  $db = doDB();
  $response = "";

  // Where the server gets the data. e.g https://example.com/api/login/?u=demo&p=demo
  $usr  = $_GET['u']; // Unfortunately, I'm unable to change these. They're in the latest build of the launcher.
  $pwd  = hash('base64', $_GET['p']); // Encrypting the password for security.
  $ip   = $_SERVER['REMOTE_ADDR'];

  // This is where the DB is queried.
  $sql  = "SELECT * FROM Users WHERE Username='$usr'";
  $stmt = $db->query($sql);

  // Finally, the IF statement. Only edit if you know what's happening.
  if ($stmt->num_rows < 1) {
    $response = "LOGIN_ACTION=LOGIN\nLOGIN_ERROR=LOGIN_FAILED\nGLOBAL_DISPLAYTEXT=Unable to retrieve account "$usr".\n"; // Checking to see if the account exists.
  } else {
    while ($arr = $stmt->fetch_assoc()) {
      if ($row['Password'] != $pwd) {
        $response = "LOGIN_ACTION=LOGIN\nLOGIN_ERROR=LOGIN_FAILED\nGLOBAL_DISPLAYTEXT=Unable to retrieve account "$usr".\n"; // Checking to see if the password is incorrect.
      }
    }
  }

  echo $response;
  exit();
