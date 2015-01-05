<?php


$con = mysql_connect("localhost","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("council_db", $con);


$propid = $_POST['property_id']; 
$newstatus = $_POST['status']; 
$query = "UPDATE property SET status = '$newstatus' WHERE property_id = '$propid'"; 


if (!mysql_query($query,$con))
  {
  die('Error: ' . mysql_error());
  }

 ?>
 
<script type="text/javascript">    <!--PopUp alert box, onclick returns to refreshed page-->

	alert("Property status updated");
	window.location.href = "property.php";

</script>

<?php
 

mysql_close($con);
?> 



