<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/control/_controls.php');
?>
<!DOCTYPE html>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/head.inc.php'); ?>
	<title>From Ashes | <?= $camp_name; ?></title>
</head>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/top.inc.php'); ?>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/control.inc.php'); ?>

		<div id='page-content'>
			<h2 id='camp_name'><?= $camp_name; ?></h2>


			<div id='control-desc'>
			<h4>Update camp description.</h4>
				<form id='update-desc' method='post' action='/action/camp/desc/'>

				<?php
					if ($camp_desc){
				?>
					<textarea name='desc' maxlength=512 cols=70 rows=7 required><?= br2nl($camp_desc); ?></textarea>
				<?php
				}
					else{
				?>
					<textarea name='desc' maxlength=700 cols=70 rows=7 placeholder='Limit 700 characters...' required></textarea>
				<?php
				}
				?>
					<br />
					<input type='submit' value='Update Description' name='update' />

				</form>
			</div>
			<hr />

			<div id='control-members'>
			<h4>Exile members to The Wastelands.</h4>
			<p>
				You can only exile members who do not have any supporters.
			</p>
		<?php
			$disabled = '';
			while ($row = $surv_res->fetch_assoc()){

			// If the player has supporters, disabled to exile button.

			if ($row['count'] > 0){
				$disabled = "disabled";
			}
			else{
				$disabled = '';
			}
		?>
			<div class='camp-mem'>
				<a href="/survivor/<?= $row['surv_url']; ?>/">
					<?= $row['surv_name']; ?>
				</a>

				<form class='control-exile' action='/action/camp/exile/' method='post'>
					<input type='hidden' name='survivor' value='<?= $row['surv_id']; ?>' />
					<input type='submit' name='exile' value='Exile' <?= $disabled; ?> />
				</form>
			</div>
		<?php
			} // END WHILE LOOP
		?>
			</div>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/footer.inc.php'); ?>

</body>
</html>
