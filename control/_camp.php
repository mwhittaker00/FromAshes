<?
include($_SERVER['DOCUMENT_ROOT'].'/include/init.inc.php');

$get_url = $_GET['camp'];
$camp_qry = "SELECT camp_id, camp_name, camp_url, camp_desc
				FROM camp
				WHERE camp_url = '$get_url'";
$camp_result = $db->query($camp_qry);
$camp_row = $camp_result->fetch_assoc();

$camp_id = $camp_row['camp_id'];
$camp_name = $camp_row['camp_name'];
$camp_url = $camp_row['camp_url'];
$camp_desc = stripslashes(nl2br($camp_row['camp_desc']));

$surv_qry = "SELECT sc.surv_id, s.surv_name, s.surv_url
				FROM survivor_camp sc
				JOIN survivor s
					ON s.surv_id = sc.surv_id
				WHERE sc.camp_id = $camp_id";

$surv_result = $db->query($surv_qry);
$surv_cnt = $surv_result->num_rows;
$surv_s = '';
if ($surv_cnt > 1){
	$surv_s = 's';
}
else{}

if (isset($player_id)){
	$home_camp = '';
	$home_qry = "SELECT camp_id FROM survivor_camp
					WHERE surv_id = $player_id
					AND camp_id = $camp_id";

	$home_res = $db->query($home_qry);
	$home_camp = $home_res->num_rows;
}

$camp_msg_qry = "SELECT * FROM
	(SELECT cm.camp_msg_id, cm.msg_content, cm.msg_timestamp, cm.camp_id, cm.surv_id, s.surv_name, s.surv_url
					FROM camp_msg cm
					JOIN survivor s
						ON s.surv_id = cm.surv_id
					WHERE camp_id = $camp_id
					AND msg_active = 1
					ORDER BY camp_msg_id DESC
					LIMIT 10)
	AS T1 ORDER BY camp_msg_id ASC";

$camp_msg_res = $db->query($camp_msg_qry);
$camp_msg_cnt = $camp_msg_res->num_rows;

$ldr_qry = "SELECT s.surv_name, s.surv_url, sc.surv_id
			FROM survivor_camp sc
			JOIN survivor s
				ON s.surv_id = sc.surv_id
			WHERE sc.camp_id = $camp_id
			AND sc.camp_leader = $camp_id";
$ldr_res = $db->query($ldr_qry);
$ldr_row = $ldr_res->fetch_assoc();

$ldr_name = $ldr_row['surv_name'];
$ldr_url = $ldr_row['surv_url'];
$ldr_id = $ldr_row['surv_id'];

$hap_qry = "SELECT h_id, h_message, h_timestamp
		FROM happenings
		WHERE camp_id = $camp_id
		AND h_type = 1
		ORDER BY h_id DESC
		LIMIT 10";
$hap_res = $db->query($hap_qry);
$hap_count = $hap_res->num_rows;
?>
