
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
                <a class="navbar-brand" href="index.php">Housing Council</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li class="active">
                        <a href="property.php">Property</a>
                    </li>
                    <li>
                        <a href="tenant.php">Tenants</a>
                    </li>
                    <li>
                        <a href="tradesmen.php">Tradesmen</a>
                    </li>
                    <li>
                        <a href="#contact" data-toggle="modal">Contact</a>
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

        <h2 style="text-align: center;">Property Regsiter</h2>

       <br>
     </br>
        

          <div  style="text-align: center;">
            <img src="images/property.jpg" width="450" height="270"/><br><br>
             </div>


<?php
$con = mysql_connect("localhost","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("council_db", $con);

$result = mysql_query("SELECT * FROM property");

echo "<table class='table' border='2' style='margin: auto;' 'width: 1000px;'
  margin-top: 20px;
  padding:300px;>
<tr>
<th><h4>Property ID</h4></th>
<th><h4>Address Line 1</h4></th>
<th><h4>Address Line 2</h4></th>
<th><h4>Type</h4></th>
<th><h4>Status</h4></th>
</tr>";

while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['property_id'] . "</td>";
  echo "<td>" . $row['address_line_1'] . "</td>";
  echo "<td>" . $row['address_line_2'] ."</td>";
  echo "<td>" . $row['type'] ."</td>";
  echo "<td>" . $row['status'] ."</td>";
  echo "</tr>";
  }
echo "</table>";

mysql_close($con);
?>       


<br>
</br>




 <div class= "container">
        <div class= "jumbotron">




            <h6>
              <form action="insertproperty.php" method="post" class="form-horizontal" style="text-align: left;">

              <!-- Form Name -->
              <legend>Add Property</legend>

              <!-- Property Id  input-->
              <div class="control-group">
                <label class="control-label" for="property_id">Property ID:  </label>
                <div class="controls">
                  <input id="property_id" name="property_id" type="number" placeholder="ID" class="input-mini" required autofocus>
                  
                </div>
              </div>

              <!-- Address Line 1 input-->
              <div class="control-group">
                <label class="control-label" for="address_line_1">Address Line 1:</label>
                <div class="controls">
                  <input id="address_line_1" name="address_line_1" type="text"  placeholder="Addr L 1" class="input-medium" required autofocus>
                  
                </div>
              </div>

              <!-- Address Line 2 input-->
              <div class="control-group">
                <label class="control-label" for="address_line_2">Address Line 2:  </label>
                <div class="controls">
                  <input id="address_line_2" name="address_line_2" type="text" pattern=[A-Za-z]+ title="Only Letters" placeholder="Addr L 2" class="input-medium">
                  
                </div>
              </div>

              <!-- Property type input-->
              <div class="control-group">
                <label class="control-label" for="type">Property Type:  </label>
                <div class="controls">
                  <input id="type" name="type" type="text" pattern=[A-Za-z]+ title="Only Letters" placeholder="Type" class="input-small">
                  
                </div>
              </div>

              <!-- Select property status, dropdown -->
              <div class="control-group">
                <label class="control-label" for="status">Current Status:  </label>
                <div class="controls">
                  <select id="status" name="status" class="input-small" required>
                    <option>VACANT</option>
                    <option>FULL</option>
                  </select> <br></br>
                  <input type="submit" value="Add Property" class="btn btn-sm btn-success"/>
                </h6>
              </form>

             
        <br>
      </br>

       

            <h6><u>Update Property</u></h6>
              <div class="control-group">
                <form action="updateproperty.php" name="update" method="post"  class="form-horizontal">
                  Property ID: <br> <input id="property_id" name="property_id" type="number" placeholder="ID" class="input-mini" title="Select One" required autofocus /> <br> </br>
                  Status: <br> <select id="status" name="status" class="input-small" required> <br> </br>
                            <option>VACANT</option>
                            <option>FULL</option>
                        </select> <br> </br>

                  <input type="submit" value="Update Property" class="btn btn-sm btn-success"/>
                </form>
              </div>

        <br>
      </br>
            <h6><u>Delete Property</u><h6/>
              <div class="control-group">
                <form action="deleteproperty.php" name="delete" method="post"  class="form-horizontal">
                  Property ID: <br><input type="text" name="property_id" required /> <br><br>
                                <input type="submit" value="delete" class="btn btn-md btn-success"/>
                </form>
              </div>
        
  

 </div>
      </div>



        </div>
      </div>
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


