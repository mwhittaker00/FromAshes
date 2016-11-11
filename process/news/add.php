<?php
include($_SERVER['DOCUMENT_ROOT'].'/include/init.inc.php');


$author = $pl_s_name;
$title = $db->escape_string(htmlentities($_POST['title']));
$content = $db->escape_string(htmlentities($_POST['content']));
$time = time();

if (empty($title) || empty($content)){
	header('Location:/page/admin-news/');
}

if ($pl_s_url != 'mr_williams'){
	header('Location:/page/admin-news/');
}

$ins_qry = "INSERT INTO news
				(news_title,news_content,news_author,news_date)
			VALUES
				('$title','$content','$author','$time')";

if(!$result = $db->query($ins_qry)){
    die('There was an error running the query [' . $db->error . ']');
}
$news_id = $db->insert_id;

$usr_qry = "SELECT surv_id FROM survivor";
$usr_res = $db->query($usr_qry);

//
// Add a news entry for every user
$multi = array();
while ($row = $usr_res->fetch_assoc()){
	array_push($multi, "'".$row['surv_id']."','".$news_id."',0");
}

$query = "(".implode("),(",$multi).")";
$qry = "INSERT INTO survivor_news VALUES ".$query.";";
$db->query($qry);


header('Location:/page/news/');


?>
