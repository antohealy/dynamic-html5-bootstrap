<?php


$con = mysql_connect("localhost","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("council_db", $con);


$sql="INSERT INTO property (property_id, address_line_1, address_line_2, type, status)
VALUES ('$_POST[property_id]','$_POST[address_line_1]','$_POST[address_line_2]','$_POST[type]','$_POST[status]')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

?>

<script type="text/javascript">

	alert("Property Added to DB");
	window.location.href = "property.php";

</script>

<?php

mysql_close($con);

?> 