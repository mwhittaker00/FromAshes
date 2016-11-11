<?php
include($_SERVER['DOCUMENT_ROOT'].'/include/init.inc.php');


$camp_qry = "SELECT COUNT(sc.surv_id) AS s_count, sc.camp_id, c.camp_name, c.camp_url
				FROM camp c
				LEFT JOIN survivor_camp sc
					ON sc.camp_id = c.camp_id
				GROUP BY sc.camp_id, c.camp_name, c.camp_url
				ORDER BY COUNT(sc.surv_id) DESC";
$camp_result = $db->query($camp_qry);

?>
