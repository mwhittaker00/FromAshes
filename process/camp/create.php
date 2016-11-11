<?php
include($_SERVER['DOCUMENT_ROOT'].'/include/init.inc.php');

$camp = $db->escape_string(htmlentities($_POST['camp-name']));
$desc = $db->escape_string(htmlentities($_POST['camp-desc']));
$time = time();

if(!preg_match("/^[a-zA-Z0-9 ]+$/", $camp)) {
   header('Location:/page/create-camp/');
}
if (empty($camp) || empty($player_id)){
	header('Location:/page/create-camp/');
}

$camp_url = strtolower(str_replace(' ', '_', $camp));

//
// Check to see if a camp with this name already exists
$chk_qry = "SELECT camp_id FROM camp
				WHERE camp_url = '$camp_url'
				LIMIT 1";

$chk_res = $db->query($chk_qry);
$chk_count = $chk_res->num_rows;
if($chk_count >= 1){
	header('Location:/page/create-camp/');
}

$ins_qry = "INSERT INTO camp
				(camp_name, camp_url, camp_desc, camp_created)
			VALUES
				('$camp','$camp_url','$desc','$time')";

if(!$result = $db->query($ins_qry)){
    die('There was an error running the query [' . $db->error . ']');
}
$camp_id = $db->insert_id;

$upd_qry = "UPDATE survivor_camp
				SET camp_id = '$camp_id'
				WHERE surv_id = $player_id
				LIMIT 1";


if(!$result = $db->query($upd_qry)){
    die('There was an error running the query [' . $db->error . ']');
}
else{
	$del_qry = "DELETE FROM supporters
					WHERE give_surv_id = $player_id
					OR rec_surv_id = $player_id";
	if(!$result = $db->query($del_qry)){
		die('There was an error running the query [' . $db->error . ']');
	}


	$h_msg1 = "<a href='/survivor/$pl_s_url'>$pl_s_name</a> has arrived from <a href='/camp/$pl_c_url'>$pl_c_name</a>.";
	$h_msg2 = "<a href='/survivor/$pl_s_url'>$pl_s_name</a> has left for <a href='/camp/$camp_url'>$camp</a>.";
	$h_msg3 = "<a href='/survivor/$pl_s_url'>$pl_s_name</a> left <a href='/camp/$pl_c_url'>$pl_c_name</a> for <a href='/camp/$camp_url'>$camp</a>.";
	$h_msg1 = $db->escape_string($h_msg1);
	$h_msg2 = $db->escape_string($h_msg2);
	$h_msg3 = $db->escape_string($h_msg3);

	$ins_qry = "INSERT INTO happenings
					(surv_id, camp_id, h_message, h_timestamp, h_type)
					VALUES ($player_id, $camp_id, '$h_msg1', $time, 1)";
	if(!$result = $db->query($ins_qry)){
		die('There was an error running the query [' . $db->error . ']');
	}

	$ins_qry = "INSERT INTO happenings
					(surv_id, camp_id, h_message, h_timestamp, h_type)
					VALUES ($player_id, $pl_c_id, '$h_msg2', $time, 1)";
	if(!$result = $db->query($ins_qry)){
		die('There was an error running the query [' . $db->error . ']');
	}

	$ins_qry = "INSERT INTO happenings
					(surv_id, camp_id, h_message, h_timestamp, h_type)
					VALUES ($player_id, $pl_c_id, '$h_msg3', $time, 0)";
	if(!$result = $db->query($ins_qry)){
		die('There was an error running the query [' . $db->error . ']');
	}

	header('Location:/camp/'.$camp_url.'/');
}
?>
