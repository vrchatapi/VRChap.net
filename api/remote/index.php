<?php
include "/var/www/vrchap.net/public_html/api/vrchatapi.php";
echo CallAPI(GET, "https://api.vrchat.cloud/api/1/config");
?>