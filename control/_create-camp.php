<?php
include($_SERVER['DOCUMENT_ROOT'].'/include/init.inc.php');

if (!isset($_SESSION['online'])){
	header("Location:/home/");
}
else{}
?>
