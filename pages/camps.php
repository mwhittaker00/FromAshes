<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/control/_camps.php');
 ?>
<!DOCTYPE html>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/head.inc.php'); ?>
	<title>From Ashes | Camps</title>
</head>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/top.inc.php'); ?>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/control.inc.php'); ?>

		<div id='page-content'>
			<h2 id='camp_name'>Survivor Camps</h2>

			<?php
				if ($pl_verified == 1){
					echo "<a href='/page/create-camp/'> Create a new camp</a>";
					echo "<br /><br /><br />";
				}
				else{}
			?>
			<div id='camp_members'>
	<?php
	//
	// Print names of camp members to screen
	//
	while ($row = $camp_result->fetch_assoc()){
	?>
	<a href="/camp/<?= $row['camp_url']; ?>/">
		<?= $row['camp_name'];?>
	</a>
	 - Survivors: <?= $row['s_count']; ?>

	<br /><br />
	<?php
	} //ENDS THE WHILE LOOP

	?>
			</div>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/footer.inc.php'); ?>

</body>
</html>
