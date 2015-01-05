<?php
$con = mysql_connect("localhost","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("council_db", $con);

$tmid=  $_POST['tradesmen_id'];
$sql= "DELETE FROM tradesmen WHERE tradesmen_id = '$tmid'";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

?>

<script type="text/javascript">

	alert("Tradesmen Deleted");
	window.location.href = "tradesmen.php";
	
</script>

<?php



mysql_close($con);
?> 
