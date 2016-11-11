<?php
include($_SERVER['DOCUMENT_ROOT'].'/include/init.inc.php');

if (!isset($_SESSION['online'])){
	header("Location:/home/");
}
else{}

$camp_qry = "SELECT camp_desc
				FROM camp
				WHERE camp_id = $pl_c_id";
$camp_result = $db->query($camp_qry);
$camp_row = $camp_result->fetch_assoc();

$camp_id = $pl_c_id;
$camp_name = $pl_c_name;
$camp_url = $pl_c_url;
$camp_desc = stripslashes_deep($camp_row['camp_desc']);

$surv_qry = "SELECT COUNT(ss.give_surv_id) AS 'count', sc.surv_id, s.surv_name, s.surv_url
				FROM survivor_camp sc
				JOIN survivor s
					ON s.surv_id = sc.surv_id
				LEFT JOIN supporters ss
					ON ss.rec_surv_id = s.surv_id
				WHERE sc.camp_id = $camp_id
				AND sc.surv_id != $player_id
				GROUP BY sc.surv_id, s.surv_name, s.surv_url
				ORDER BY COUNT( ss.give_surv_id ) ";

$surv_res = $db->query($surv_qry);

$ldr_qry = "SELECT s.surv_name, s.surv_url, sc.surv_id
			FROM survivor_camp sc
			JOIN survivor s
				ON s.surv_id = sc.surv_id
			WHERE sc.camp_id = $camp_id
			AND sc.camp_leader = $camp_id
			AND s.surv_id = $player_id";
$ldr_res = $db->query($ldr_qry);

if ($ldr_res->num_rows != 1){
	header("Location:/camp/".$camp_url."/");
}
else{}
  ?>
