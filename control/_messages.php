<?php 
include($_SERVER['DOCUMENT_ROOT'].'/include/init.inc.php');

if (!isset($_SESSION['online'])){
	header("Location:/home/");
}
else{}

$pm_qry = "SELECT pm_id, surv_from, pm_content, pm_viewed, pm_timestamp,
				  surv_name, surv_url
					FROM pvt_msg
					JOIN survivor s
						ON surv_id = surv_from
					WHERE surv_to = $player_id
					AND pm_active = 1
					ORDER BY pm_id DESC";

$pm_res = $db->query($pm_qry);
$pm_count = $pm_res->num_rows;

$update_qry = "UPDATE pvt_msg
				SET pm_viewed = 1
				WHERE surv_to = $player_id";
$db->query($update_qry);
?>
