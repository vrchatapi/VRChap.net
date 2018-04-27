<?php
require_once 'inc/core.php';

$user = str_replace_first("/profile", "", $_SERVER['REQUEST_URI']);
$user = str_replace_first("/", "", $user);
$user = str_replace_first("%20", " ", $user);

// SHOW LOGGED IN USER PROFILE.
if ($user === ""){
  if ($loggedin){
    $searchdata = array("apiKey" => "JlE5Jldo5Jibnk5O5hTx6XVqsJu4WJ26");
    $searchJsonData = CallAPI($session_username, $session_crypt, "GET", "https://api.vrchat.cloud/api/1/auth/user", $searchdata);
    $json = json_decode($searchJsonData);
    require 'inc/profile_user.php';
    die();
  } else {
    echo "You must be logged in to view or edit your own profile.";
  }
  die();
} else {
  $searchdata = array("apiKey" => "JlE5Jldo5Jibnk5O5hTx6XVqsJu4WJ26", "search" => $user);
  if ($loggedin){
    $searchJsonData = CallAPI($_SESSION['username'], $_SESSION['password'], "GET", "https://api.vrchat.cloud/api/1/users", $searchdata);
  } else {
    $searchJsonData = CallAPI("VRChap", "PleaseChangePassword", "GET", "https://api.vrchat.cloud/api/1/users", $searchdata);
  }
  $searchUser = json_decode($searchJsonData);
  $json = $searchUser[0];
        foreach ($searchUser as $value){
          if ($value->username == $user or $value->displayName == $user){
            $json = $value;
            }
        }
    // USER WAS NOT FOUND.
  if ($searchJsonData === "[]"){
    die("User not found.");
  }
  //echo $searchJsonData;
  require 'inc/profile_user.php';
}

?>