<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/control/_skills.php');
?>
<!DOCTYPE html>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/head.inc.php'); ?>
	<title>From Ashes | Skills</title>
</head>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/top.inc.php'); ?>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/control.inc.php'); ?>

		<div id='page-content'>
			<h3>Your current skill set.</h3>

		<?php
			while ($row = $sk_res->fetch_assoc()){
				echo "<div class='skill-row'>
					<span class='skill-name'>".$row['skill_name']."</span>
					<span class='skill-points'>".floor($row['skill_points']/10)."</span>
				</div>";
			}
		?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/include/footer.inc.php'); ?>

</body>
</html>
