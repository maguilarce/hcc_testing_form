
 <!-- Faculty navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
              <a class="navbar-brand" rel="home" href="http://hccs.edu" title="Buy Sell Rent Everyting">
                <img style="max-width:200px; margin-top: -43px;"
                     src="img/logo_hcc_hover.png">
            </a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li ><a href="index.php">Home</a></li>

              <li><a href="contact.php">Contact Us</a></li>
            </ul>
              <ul class="nav navbar-nav pull-right">
                  <li  class="dropdown pull-right">
                      <a href="#" class="dropdown-toggle pull-right" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class='glyphicon glyphicon-user'></span><?php echo " ".$_SESSION['user_name']; ?> <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                          <li><a href="allrecords.php"><span class='glyphicon glyphicon-th-list'></span>  My Records</a></li>
                          <li><a href="signout.php"><span class='glyphicon glyphicon-log-out'></span>  Sign Out</a></li>

                      </ul>
                  </li>
              </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
