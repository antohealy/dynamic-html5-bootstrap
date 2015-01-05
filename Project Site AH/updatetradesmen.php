<?php


$con = mysql_connect("localhost","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("council_db", $con);


$tmid = $_POST['tradesmen_id']; 
$newskill = $_POST['skills']; 
$query = "UPDATE tradesmen SET skills = '$newskill' WHERE tradesmen_id = '$tmid'"; 


if (!mysql_query($query,$con))
  {
  die('Error: ' . mysql_error());
  }

 ?>
 
<script type="text/javascript">    <!--PopUp alert box, onclick returns to refreshed page-->

	alert("Tradesmen Skills Updated");
	window.location.href = "tradesmen.php";

</script>

<?php
 

mysql_close($con);
?> 
