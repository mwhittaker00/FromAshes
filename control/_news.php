<?php
include($_SERVER['DOCUMENT_ROOT'].'/include/init.inc.php');


$news_qry = "SELECT news_title, news_author, news_content, news_date
				FROM news
				ORDER BY news_id DESC
				LIMIT 10 ";
$news_result = $db->query($news_qry);

//
// Mark all updates as "seen" for this user
$upd_qry = "UPDATE survivor_news
				SET seen = 1
				WHERE surv_id = $player_id";
$db->query($upd_qry);
 ?>
