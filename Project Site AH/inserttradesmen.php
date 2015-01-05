<?php


$con = mysql_connect("localhost","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("council_db", $con);


$sql="INSERT INTO tradesmen (tradesmen_id, name, address, contact_details, skills)
VALUES ('$_POST[tradesmen_id]','$_POST[name]','$_POST[address]','$_POST[contact_details]','$_POST[skills]')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

?>

<script type="text/javascript">

	alert("Tradesmen Added Successfully");
	window.location.href = "tradesmen.php";

</script>

<?php

mysql_close($con);

?> 