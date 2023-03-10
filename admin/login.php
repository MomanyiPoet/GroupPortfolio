<?php
    session_start();

    include '../connection.php';
    include 'functions.php';


    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //something was posted
		$username = $_POST['username'];
		$password = $_POST['password'];

        if(!empty($username) && !empty($password) && !is_numeric($username)){
            //read from database
			
			$query = "select * from adminusers where username = '$username' limit 1";

			$result = mysqli_query($conn, $query);

			$user = $result->fetch_assoc();

            if ($user){
                if (password_verify($_POST["password"], $user["password_hash"])){
                    session_regenerate_id();
            
                    $_SESSION["username"] = $user["username"];
            
                    header("Location: dashboard.php");
                    exit;
                }
            }
            echo ("<script> alert('Incorrect Username or Password'); </script>");
            
        } else {
            echo ("<script> alert('Please Fill out all required fields'); </script>");
        }
    }

?>

<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Group Portfolio</title>

  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-kit.css?v=3.0.4" rel="stylesheet" />
</head>

<body class="sign-in-basic">

  <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');" loading="lazy">
    <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <form method="post" autocomplete="off">
          <div class="row">
            <div class="col-lg-4 col-md-8 col-12 mx-auto">
              <div class="card z-index-0 fadeIn3 fadeInBottom">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                  <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Login</h4>
                  </div>
                </div>
                <div class="card-body">
                  <form role="form" class="text-start">
                    <div class="input-group input-group-outline my-3">
                      <label class="form-label">Username</label>
                      <input type="text" required name="username" class="form-control" value="<?= htmlspecialchars($_POST["username"] ?? "") ?>"/>
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Password</label>
                      <input type="password" class="form-control" required name="password">
                    </div>
                    <div class="text-center">
                      <button type="submit" name="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Sign in</button>
                    </div>

                    <p class="mt-4 text-sm text-center">
                      Don't have an account? <a href="#" target="_blank">Sign-Up</a>.<br>
                      <a href="index.php" target="_blank">Back to Homepage</a>
                    </p>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
  </div>

  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="../assets/js/core/bootstrap.min.js" type="text/javascript"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <!--  Plugin for Parallax, full documentation here: https://github.com/wagerfield/parallax  -->
  <script src="../assets/js/plugins/parallax.min.js"></script>
  <!-- Control Center for Material UI Kit: parallax effects, scripts for the example pages etc -->
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script>
  <script src="../assets/js/material-kit.min.js?v=3.0.4" type="text/javascript"></script>
</body>

</html>