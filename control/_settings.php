<?php
include($_SERVER['DOCUMENT_ROOT'].'/include/init.inc.php');

if (!isset($_SESSION['online'])){
	header("Location:/home/");
}
else{}

$surv_qry = "SELECT surv_desc
				FROM survivor
				WHERE surv_id = '$player_id'";
$surv_result = $db->query($surv_qry);
$surv_row = $surv_result->fetch_assoc();

$surv_desc = trim(br2nl($surv_row['surv_desc']),'\t');
$surv_desc = stripslashes_deep($surv_desc);

 ?>
