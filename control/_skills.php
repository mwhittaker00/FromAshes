<?php
include($_SERVER['DOCUMENT_ROOT'].'/include/init.inc.php');

if (!isset($_SESSION['online'])){
	header("Location:/home/");
}
else{}

$sk_qry = "SELECT s.skill_id, s.skill_name, ss.skill_points
			FROM skill s
			JOIN surv_skill ss
				ON ss.skill_id = s.skill_id
			WHERE ss.surv_id = $player_id";
$sk_res = $db->query($sk_qry);
?>
