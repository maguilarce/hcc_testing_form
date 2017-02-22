<?php
date_default_timezone_set('America/Chicago');
include('dconnection.php');
session_start();

if(isset($_SESSION['id_usuario']))
{
    header('location: index.php');
}

if(!empty($_POST))
{
    $user = mysqli_real_escape_string($mysqli,$_POST['email']);
    $password = mysqli_real_escape_string($mysqli,$_POST['password']);
    $error = '';
    
    //encrypt password
    $encrypted_password = sha1($password);
    
    //querying DB
    $sql = "SELECT * FROM user_testing_form WHERE user_name = '$user' AND password = '$encrypted_password'";
    $result = $mysqli->query($sql);
    $rows = $result->num_rows;
    
    if($rows>0)
    {
        $row = $result->fetch_assoc();
        $_SESSION['id_user'] = $row['id_user'];
        $_SESSION['id_type'] = $row['id_type'];
        $_SESSION['user_name'] = $row['user_name'];
        
        header("location: index.php");
    }
    else
    {
        $error = "User does not exist or email/password are incorrect";
    }
    
}   
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="apple-touch-icon" sizes="57x57" href="img/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="img/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="img/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="img/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="img/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="img/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="manifest" href="img/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="img/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <title>Signin Template for HCC Online Testing Form System</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
        <?php
        if(isset($error))
        {
            echo "<div class='alert alert-danger' role='alert'>";
                echo "<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>";
                echo "<span class='sr-only'>Error:</span>";
                echo utf8_decode($error);
            echo "</div>";
        }
        ?>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" class="form-signin" method="POST">
        <img class="img-responsive" src="img/HCC Houston Community College Logo.png"  />
        <h3 class="text-center">HCC Online Testing Information Form</h3>
        <h5 class="panel-title">Please sign in</h5><br/>
        
        <label>Email address</label><br />
        <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required autofocus autocomplete="off"><br />
        
        <label>Password</label><br />
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required autocomplete="off">

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <br /><p class="text-muted text-center"><a href="register_user.php">Not a registered user? Sign up!</a></p>
                
      </form>


    </div> <!-- /container -->
    
    <footer class="footer center-block">
      <div class="container center-block">
        <p class="text-muted text-center">© 2017 Houston Community College, 3100 Main St., Houston TX 77002, Ph. 713.718.2000</p>
        <p class="text-muted text-center"><a href="http://hccs.edu">HCC</a> | <a href="http://hccs.edu/online">HCC Online</a> | <a href="contact.php">Contact Us</a></p>
      </div>
    </footer>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>

  </body>
</html>
