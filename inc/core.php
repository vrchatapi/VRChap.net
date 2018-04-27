<?php

function CallAPI($username, $password, $method, $url, $data = false)
{
    $curl = curl_init();
    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }
  
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, $username . ":" . $password);

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}

function str_replace_first($from, $to, $content)
{
    $from = '/'.preg_quote($from, '/').'/';

    return preg_replace($from, $to, $content, 1);
}

function getUserdata($username, $password){
  $data = array("apiKey" => "JlE5Jldo5Jibnk5O5hTx6XVqsJu4WJ26");
  return CallAPI($username, $password, "GET", "https://api.vrchat.cloud/api/1/auth/user", $data);
}

session_start();
$session_username = $_SESSION['username'];
$session_crypt = $_SESSION['password'];

$mysqli = new mysqli("localhost", "root", "ChangeThisPassword", "vrchap");
if($mysqli === false){
    die("ERROR: The website is currently have problems. ");
}
        
$loggedin = false;

if (isset($session_username)) {
  $session_userdata = getUserdata($session_username, $session_crypt);
  $session_json = json_decode($session_userdata);
  
  $session_username = $session_json->displayName;
  $session_picture = $session_json->currentAvatarImageUrl;
  $session_userid = $session_json->id;
           
  $query = mysqli_query($mysqli, "SELECT * FROM `users` WHERE user_id='".$session_userid."'");
  if (!$query){
    die('Error: ' . mysqli_error($mysqli));
  }
  if(mysqli_num_rows($query) > 0){
    // ACCOUNT ALREADY ADDED.
  } else {
    // ADD TO DATABASE.
    $sql = "INSERT INTO users (user_id, profile_description, twitter, youtube, twitch) VALUES ('" . $session_userid . "', '{username} has logged in but did not update their profile.', 'None', 'None', 'None')";
    if ($mysqli->query($sql) === TRUE) {
      // SUCCESS
    } else {
      echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    
  }
  
  $loggedin = true;
}

?>