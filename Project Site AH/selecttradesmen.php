
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
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li class="active">
                        <a href="property.html">Property</a>
                    </li>
                    <li>
                        <a href="#">Tenants</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav pull-right">
                    <li><a href="logout.php" class="btn btn-warning">Log Out</a></li>  
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

     <div class= "container">
        <div class= "jumbotron">

        <h2>Tenant Details</h2>

       <br>
     </br>
        

<?php
$con = mysql_connect("localhost","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("council_db", $con);

$ppsno = $_POST['pps_no']; 
$result = mysql_query("SELECT *   
  FROM tenants 
  WHERE pps_no = '$ppsno'");

echo "<table class='table' border='2' style='margin:0 auto;' 'width: 1000px;'
  margin-top: 20px;
  padding:300px;>
<tr>
<th><h4>PPS No.</h4></th>
<th><h4>Name</h4></th>
<th><h4>DOB </h4></th>
<th><h4>Contact</h4></th>
<th><h4>Property ID</h4></th>
<th><h4>Address Line 1</h4></th>
</tr>";

while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['pps_no'] . "</td>";
  echo "<td>" . $row['name'] . "</td>";
  echo "<td>" . $row['dob'] ."</td>";
  echo "<td>" . $row['contact_details'] ."</td>";
  echo "<td>" . $row['property_property_id'] ."</td>";
  echo "<td>" . $row['property_address_line_1'] ."</td>";
  echo "</tr>";
  }
echo "</table>";

mysql_close($con);
?>       


<br>
</br>

 

 </div>
      </div>

<div class= "container">
        <div class= "jumbotron">
            <h6><u>Delete Tenant Record</u><h6/>
              <div class="control-group">
                <form action="deletetenant.php" name="select" method="post"  class="form-horizontal">
                  PPS No. : <input type="text" name="pps_no" required /> 
                                <input type="submit" value="delete" class="btn btn-md btn-success"/>
                </form>
              </div>
        </div>
  </div>




        </div>
      </div>






    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
