<?php
$con = mysql_connect("localhost","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("council_db", $con);

$propertyid=  $_POST['property_id'];
$sql= "DELETE FROM property WHERE property_id = '$propertyid'";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

?>

<script type="text/javascript">

	alert("Property Deleted");
	window.location.href = "property.php";
	
</script>

<?php



mysql_close($con);
?> 
