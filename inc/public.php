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

function getUserdata($username, $password){
  $data = array("apiKey" => "JlE5Jldo5Jibnk5O5hTx6XVqsJu4WJ26");
  return CallAPI($username, $password, "GET", "https://api.vrchat.cloud/api/1/auth/user", $data);
}

session_start();
$loggedin = false;

if (isset($_SESSION['username'])) {
  $jsondata = getUserdata($_SESSION['username'], $_SESSION['password']);
  $userdata = json_decode($jsondata);
  
  $username = $userdata->displayName;
  $picture = $userdata->currentAvatarImageUrl;
  
  $loggedin = true;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>VRChap</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/style.css" rel="stylesheet">
  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ" crossorigin="anonymous"></script>


  <!-- Custom styles for this template -->
  <link href="css/logo-nav.css" rel="stylesheet">
  <style>
    .image-header {
      width: 100%;
      max-height: 450px;
      overflow: hidden;
    }

    .image-header img {
      width: 100%;
    }

    .no-padding {
      padding 0 !important;
    }
  </style>
</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">
          <img src="/logos/vrchap.png" width="150" alt="">
        </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home
                <span class="sr-only">(current)</span>
              </a>
          </li>
          <?php
          if ($loggedin){
            ?>
          <li class="nav-item">
            <a class="nav-link" href="/profile/"><?php echo $username; ?> <i class="fas fa-user"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/logout/">Logout <i class="fas fa-sign-out-alt"></i></a>
          </li>
          <?php
          } else {
          ?>
          <li class="nav-item">
            <a class="nav-link" href="/register/">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/login/">Login <i class="fas fa-sign-in-alt"></i></a>
          </li>
          <?php
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>
  <div class="image-header">
    <img src="https://cdn.discordapp.com/attachments/401430576529408010/426126643950780417/20180321215326_1.jpg">
  </div>
  <!-- Page Content -->
  <div class="container">
    <h1 class="mt-5"><i class="fas fa-heart"></i> Welcome to <b>VRChap</b>!</h1>
    <hr>
    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">
        <p>
          VRChat is a community of people who enjoy playing and creating on the VRChat platform. We are dedicated to making VRChat a better place and a great one at that. Not that it currently isn't, Cause it most certainly is.<br><br>Even though we are
          a small community, We are surely a strong one at that.
        </p>
        <hr>
        <div class="world-showcase">
          <h1><i class="fas fa-globe"></i> <b>World</b> Showcase!</h1>
          <hr>
          <div class="showcase">
            <div class="card-deck">
              <div class="card">
                <img class="card-img-top" src="https://api.vrchat.cloud/api/1/file/file_fe04855f-99c9-4f71-a2a9-af5a2deaea8f/1/file">
                <div class="card-body">
                  <h5 class="card-title">SPACE RACE - HUB</h5>
                  <a href="vrchat://launch?id=wrld_8ef393c0-a985-4d7e-90f0-33ab10d41ee3" class="btn btn-dark">Launch World</a>
                  <p class="card-text">
                    <small class="text-muted"><i class="fas fa-clock"></i> Last updated: <b>3 days ago</b></small><br>
                    <small class="text-muted"><i class="fas fa-user"></i> Created by: <b><a href="/profile/VRChat">VRChat</a></b></small></p>
                </div>
              </div>
              <div class="card">
                <img class="card-img-top" src="https://api.vrchat.cloud/api/1/file/file_fe04855f-99c9-4f71-a2a9-af5a2deaea8f/1/file">
                <div class="card-body">
                  <h5 class="card-title">SPACE RACE - HUB</h5>
                  <a href="vrchat://launch?id=wrld_8ef393c0-a985-4d7e-90f0-33ab10d41ee3" class="btn btn-dark">Launch World</a>
                  <p class="card-text">
                    <small class="text-muted"><i class="fas fa-clock"></i> Last updated: <b>3 days ago</b></small><br>
                    <small class="text-muted"><i class="fas fa-user"></i> Created by: <b><a href="/profile/VRChat">VRChat</a></b></small></p>
                </div>
              </div>
              <div class="card">
                <img class="card-img-top" src="https://api.vrchat.cloud/api/1/file/file_fe04855f-99c9-4f71-a2a9-af5a2deaea8f/1/file">
                <div class="card-body">
                  <h5 class="card-title">SPACE RACE - HUB</h5>
                  <a href="vrchat://launch?id=wrld_8ef393c0-a985-4d7e-90f0-33ab10d41ee3" class="btn btn-dark">Launch World</a>
                  <p class="card-text">
                    <small class="text-muted"><i class="fas fa-clock"></i> Last updated: <b>3 days ago</b></small><br>
                    <small class="text-muted"><i class="fas fa-user"></i> Created by: <b><a href="/profile/VRChat">VRChat</a></b></small></p>
                </div>
              </div>


            </div>
            <hr>
          </div>
          <div class="avatar-showcase">
            <h1><i class="fas fa-user"></i> <b>Avatar</b> Showcase!</h1>

            <hr>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <iframe src="https://discordapp.com/widget?id=418093857394262020&theme=dark" width="100%" height="500" allowtransparency="true" frameborder="0"></iframe>
      </div>
    </div>
    <hr>
  </div>
  <!-- /.container -->

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>