<?php
include($_SERVER['DOCUMENT_ROOT'].'/include/init.inc.php');

$get_url = $_GET['survivor'];
$surv_qry = "SELECT surv_id, surv_name, surv_url, verified, surv_desc
				FROM survivor
				WHERE surv_url = '$get_url'";
$surv_result = $db->query($surv_qry);
$surv_row = $surv_result->fetch_assoc();

$surv_id = $surv_row['surv_id'];
$surv_name = $surv_row['surv_name'];
$surv_url = $surv_row['surv_url'];
$verified = $surv_row['verified'];
$surv_desc = $surv_row['surv_desc'];
$surv_desc = stripslashes_deep(nl2br($surv_desc));

$camp_qry = "SELECT sc.camp_id, c.camp_name, c.camp_url
				FROM survivor_camp sc
				JOIN camp c
					ON c.camp_id = sc.camp_id
				WHERE sc.surv_id = $surv_id";
$camp_result = $db->query($camp_qry);
$camp_row = $camp_result->fetch_assoc();

$camp_id = $camp_row['camp_id'];
$camp_name = $camp_row['camp_name'];
$camp_url = $camp_row['camp_url'];

$home_camp = '';
$supported = '';
if (isset($_SESSION['online'])){
	$home_qry = "SELECT camp_id FROM survivor_camp
					WHERE surv_id = $player_id
					AND camp_id = $camp_id";

	$home_res = $db->query($home_qry);
	$home_camp = $home_res->num_rows;

	$supp_qry = "SELECT give_surv_id FROM supporters
				WHERE give_surv_id = $player_id
				AND rec_surv_id = $surv_id";

	$supp_res = $db->query($supp_qry);
	$supported = $supp_res->num_rows;
}

$supps_qry = "SELECT s.surv_name, s.surv_url
				FROM survivor s
				JOIN survivor_camp sc
					ON sc.surv_id = s.surv_id
				JOIN camp c
					ON c.camp_id = sc.camp_id
					AND sc.camp_id = $camp_id
				JOIN supporters ss
					ON ss.give_surv_id = s.surv_id
				WHERE rec_surv_id = $surv_id
				AND c.camp_id = $camp_id";

$supps_res = $db->query($supps_qry);
$supps_cnt = $supps_res->num_rows;

$hap_qry = "SELECT h_id, h_message, h_timestamp
		FROM happenings
		WHERE surv_id = $surv_id
		AND h_type = 0
		ORDER BY h_id DESC
		LIMIT 5";
$hap_res = $db->query($hap_qry);
$hap_count = $hap_res->num_rows;
 ?>
