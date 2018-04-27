<?php
   ob_start();
   session_start();
?>

<?php

$apiKey = "JlE5Jldo5Jibnk5O5hTx6XVqsJu4WJ26";

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
?>
<title>Login using VRChat!</title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="../style.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


    <div class="login-area">
        <div class="bg-image">
            <div class="login-signup">
                <div class="container">
                    <div class="login-header">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="login-logo">
                                    <img src="../logos/vrchap.png" class="img-responsive">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="login-details">
                                    <ul class="nav nav-tabs navbar-right">
                                        <li><a href="/">Home</a></li>
																			<li><a target="_blank" href="/register/">Register</a></li>
                                        <li class="active"><a data-toggle="tab" href="#login">Login</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="tab-content">
                        <div id="login" class="tab-pane fade in active">
													<?php
            $msg = '';
            
            if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
              $username = $_POST['username'];
              $password = $_POST['password'];
							
							$jsondata = getUserdata($username, $password);
							$userdata = json_decode($jsondata);
							
							if ($userdata->error->status_code == 401){
								$msg = "The information you entered is invalid.";
							} else {
								$_SESSION['valid'] = true;
                $_SESSION['timeout'] = time();
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
							
							  echo 'You are now logged in, Redirecting...';
							  header('Refresh: 2; URL = /');
								}
            }
         ?>
                            <div class="login-inner">
                                <div class="title">
                                    <h1>Login using <span>VRChat!</span></h1>
                                </div>
                                <div class="login-form">
																	<h4>
																		<?php echo $msg; ?>
																	</h4>
                                    <form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
                                        <div class="form-details">
                                            <label class="user">
                                                <input type="text" name="username" placeholder="Username / Email" required autofocus>
                                            </label>
                                            <label class="pass">
                                                <input type="password" name="password" placeholder="Password" required>
                                            </label>
                                        </div>
                                        <button name="login" type="submit" class="form-btn">Login</button>
																			<h5>
																				We have no affiliations with VRChat Inc. We don't store any data regarding passwords.<br>
																				By logging in you agree to our <a href="/legal">Terms of Service</a> aswell as the VRChat <a target="_blank" href="https://vrchat.net/legal">Terms of Service</a>.
																				</h5>
																			<hr>
																				<h4>Frequently Asked Questions:</h4><br>
																				<h5><b>Why do you need my password for VRChat?</b>
																			<br>We use your information to access the VRChat API to pull your friends list and various other features. <br>We don't store any data related to logging in under your account.</h5>
																			
																			<h5><b>Why should I trust you with my information?</b>
																			<br>Honestly, There isn't a good reason why you should be willing to input your information and trust me. <br>I guess the only reason would be that I have no intent in causing anyone harm.</h5>
																	</form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>