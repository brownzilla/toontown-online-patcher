<?php
  /*
    This is where I keep all my functions.
    Author: Brownzilla
    Author URL: https://brownzilla.me
    Version: 0.1
  */

  function doDB() {
    $dbHost   = '';
    $dbUser   = '';
    $db       = '';

    # Grabbing the password.This is to insure DB security.
    $pwdLoc = $_SERVER['DOCUMENT_ROOT'] . '/password.json';
    if (file_exists($pwdLoc)) {
      $json = file_get_contents($pwdLoc);
      $arr = json_decode($json, TRUE);
      $dbPass = $arr['default-password'];
    } else {
      die('Unable to find password.json');
    }

    $db = new mysqli($dbHost, $dbUser, $dbPass, $db);
    return $db;
  }
