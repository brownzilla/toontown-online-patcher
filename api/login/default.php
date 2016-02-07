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
      $fo = fopen($pwdLoc, 'r');
      $json = fgets($fo);
      $str = json_decode($json, true);
      $dbPass = $str['default-password'];
      fclose($fo);
    } else {
      die('Unable to find password.json');
    }

    $db = new mysqli($dbHost, $dbUser, $dbPass, $db);
    return $db;
  }
