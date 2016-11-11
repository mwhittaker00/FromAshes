<?php
include($_SERVER['DOCUMENT_ROOT'].'/include/init.inc.php');

if (!isset($_SESSION['online'])){
	header("Location:/home/");
}
else{}

$item_qry = "SELECT COUNT(si.item_id) AS 'count', i.item_name, i.item_weight
				FROM surv_item si
				JOIN item i
					ON si.item_id = i.item_id
				WHERE si.surv_id = $player_id
				GROUP BY i.item_name";

$item_res = $db->query($item_qry);
?>
