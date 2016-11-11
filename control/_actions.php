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

$act_qry = "SELECT sa.act_id, sa.sa_time, a.act_name
				FROM surv_action sa
				JOIN action a
					ON a.act_id = sa.act_id
				WHERE surv_id = $player_id";
$act_res = $db->query($act_qry);
$act = $act_res->fetch_assoc();

$act_id = $act['act_id'];
$act_time = $act['sa_time'];
$act_name = $act['act_name'];

if($act_time == 1){
	$act_time = $act_time." update";
}
elseif($act_time > 1){
	$act_time = $act_time." updates";
}
?>
