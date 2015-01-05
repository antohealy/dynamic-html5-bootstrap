<?php 
    require("config.php");
    if(!empty($_POST)) 
    { 
        // Ensure that the user fills out fields 
        if(empty($_POST['username'])) 
        { die("Please enter a username."); } 
        if(empty($_POST['password'])) 
        { die("Please enter a password."); } 
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
        { die("Invalid E-Mail Address"); } 
          
        // Check if the username is already taken
        $query = " 
            SELECT 
                1 
            FROM users 
            WHERE 
                username = :username 
        "; 
        $query_params = array( ':username' => $_POST['username'] ); 
        try { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); } 
        $row = $stmt->fetch(); 
        if($row){ die("This username is already in use"); } 
        $query = " 
            SELECT 
                1 
            FROM users 
            WHERE 
                email = :email 
        "; 
        $query_params = array( 
            ':email' => $_POST['email'] 
        ); 
        try { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage());} 
        $row = $stmt->fetch(); 
        if($row){ die("This email address is already registered"); } 
          
        // Add row to database 
        $query = " 
            INSERT INTO users ( 
                username, 
                password, 
                salt, 
                email 
            ) VALUES ( 
                :username, 
                :password, 
                :salt, 
                :email 
            ) 
        "; 
          
        // Security measures
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
        $password = hash('sha256', $_POST['password'] . $salt); 
        for($round = 0; $round < 65536; $round++){ $password = hash('sha256', $password . $salt); } 
        $query_params = array( 
            ':username' => $_POST['username'], 
            ':password' => $password, 
            ':salt' => $salt, 
            ':email' => $_POST['email'] 
        ); 
        try {  
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); } 
        header("Location: index.php"); 
        die("Redirecting to index.php"); 
    } 
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>South Dublin - Housing Council</title>

    <!-- Bootstrap css-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">


    
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>







      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Housing Council</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="index.html">Home</a>
                    </li>
                    <li>
                        <a href="#contact" data-toggle="modal">Contact</a>
                    </li>
                </ul>

                <ul class="nav navbar-nav pull-right">
                <li><a href="register.php" class="btn btn-warning">Register</a></li>
                <li class="divider-vertical"></li>
                <li class="dropdown">
                 <a class="dropdown-toggle" href="#" data-toggle="dropdown">Log In <strong class="caret"></strong></a>
                     <div class="dropdown-menu" style="padding: 25px; padding-bottom: 15px;">
                         <form action="property.php" method="post"> 
                         Username:<br /> 
                        <input type="text" name="username" value="username" /> 
                        <br /><br /> 
                         Password:<br /> 
                         <input type="password" name="password" value="" /> 
                        <br /><br /> 
                        <input type="submit" class="btn btn-info" value="Login" /> 
                         </form> 
                     </div>
                </li>
                </ul>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

     <div class= "container">
        <div class= "jumbotron">

    <h1>Register</h1> <br /><br />
    <form action="register.php" method="post"> 
        <label>Username:  <strong style="color:darkred;">*</strong></label> 
        <input type="text" name="username"  required/> 
        
        <label>Email: <strong style="color:darkred;">*</strong></label> 
        <input type="text" name="email" title="Valid email please" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="example@gmail.com"  /> 
        
        <label>Password:  <strong style="color:darkred;">*</strong></label> 
        <input type="password" name="password" value=""  required/> <br /><br />
        <br />
        <input type="submit" class="btn btn-info" value="Register" /> 

        </div>
      </div>
    </form>

<div class="modal fade" id="contact" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
      <form class="form-horizontal" role="form">    
        <div class="modal-header">
          <h4>Contact</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="contact-name" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="contact-name" placeholder="First & Last Name" required>
            </div>
          </div>
          <div class="form-group">
            <label for="contact-email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="contact-email" placeholder="example@domain.com" required> 
            </div>
          </div>
          <div class="form-group">
            <label for="contact-message" class="col-sm-2 control-label" required>Message</label>
            <div class="col-sm-10">
              <textarea class="form-control" rows="4"></textarea> 
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <a class="btn btn-default" data-dismiss="modal">Close</a>
          <button type="submit" class="btn btn-primary">Send</button>
        </div>
      </form>
    </div>
  </div>
</div>




    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>