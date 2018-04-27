<?php
$id = $json->id;
$username = $json->displayName;
$picture = $json->currentAvatarImageUrl;
$location = $json->location;


$getquery = mysqli_query($mysqli, "SELECT * FROM users WHERE user_id='" . $id . "' LIMIT 1");
$searchquery = mysqli_fetch_array($getquery);
$hasloggedin = false;

if ($getquery){
  $hasloggedin = true;
  $description = str_replace_first("{username}", $username, $searchquery['profile_description']);

}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $username; ?> | VRChap</title>

  <!-- Bootstrap core CSS -->
  <link href="/vendor/bootstrap/css/style.css" rel="stylesheet">
  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ" crossorigin="anonymous"></script>


  <!-- Custom styles for this template -->
  <link href="css/logo-nav.css" rel="stylesheet">
  <style>
    .image-header {
      width: 100%;
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
      <a class="navbar-brand" href="/">
          <img src="/logos/vrchap.png" width="150" alt="">
        </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/">Home
                <span class="sr-only">(current)</span>
              </a>
          </li>
          <?php
          if ($loggedin){
            ?>
          <li class="nav-item">
            <a class="nav-link" href="/profile/"><?php echo $session_username; ?> <i class="fas fa-user"></i></a>
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
    <img src="<?php echo $picture; ?>">
  </div>
  <!-- Page Content -->
  <div class="container">
    <h1 class="mt-5"><i class="fas fa-heart"></i> Profile of <b><?php echo $username; ?></b>!</h1>
    <hr>
    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">
        <p>
          <?php
          if (!$hasloggedin){
            echo $username . " has not logged in to update their profile page.";
          } else {
            echo $description;
          }
          ?>
        </p>
        
        <hr>
      </div>
      <div class="col-md-4">
        <?php if ($session_username === $username){?>
        <a href="" class="btn btn-dark">Edit Profile</a>
        <?php } ?>
        <hr>
        <img width="100%" src="<?php echo $picture; ?>">
        <hr>
        <iframe src="https://discordapp.com/widget?id=418093857394262020&theme=dark" width="100%" height="500" allowtransparency="true" frameborder="0"></iframe>
      </div>
    </div>
    <hr>
  </div>
  <!-- /.container -->

  <!-- Bootstrap core JavaScript -->
  <script src="/vendor/jquery/jquery.min.js"></script>
  <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>