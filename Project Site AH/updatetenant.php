<?php


$con = mysql_connect("localhost","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("council_db", $con);


$tenantid = $_POST['pps_no']; 
$newnum = $_POST['contact_details']; 
$query = "UPDATE tenants SET contact_details = '$newnum' WHERE pps_no = '$tenantid'"; 


if (!mysql_query($query,$con))
  {
  die('Error: ' . mysql_error());
  }

 ?>
 
<script type="text/javascript">    <!--PopUp alert box, onclick returns to refreshed page-->

	alert("New Number Updated");
	window.location.href = "tenant.php";

</script>

<?php
 

mysql_close($con);
?> 
