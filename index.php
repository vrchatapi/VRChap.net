<?php 
function isURL($text){
  if (substr($_SERVER['REQUEST_URI'], 0, strlen($text)) === $text){
    return true;
  } else {
    return false;
  }
}

  // PROFILE
if (isURL("/profile")){
  require 'inc/profile.php';
  die();
  
  // WORLD
} if (isURL("/world")) {
  require 'inc/world.php';
  die();
  
  // HOMEPAGE
} if (isURL("/")) {
  require 'inc/public.php';
  die();
  
  // 404 (NOT FOUND)
} else {
  require 'inc/404.php';
  die();
}
?>