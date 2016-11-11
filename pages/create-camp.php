<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/control/_create-camp.php');

?>
<!DOCTYPE html>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/head.inc.php'); ?>
	<title>From Ashes | Create a Camp</title>
</head>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/top.inc.php'); ?>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/control.inc.php'); ?>

		<div id='page-content'>
			<h2 id='surv_name'>Create a Camp</h2>


			<p>
				Have you had too much of the Wastelands? Are the other camps not the bastions of society you expected them to be? Or have they been a little <em>too</em> civil for your liking?
			</p>
			<p>
				Set your own path. Create your own camp, attract new survivors, and frame the society people will need to piece together this shattered world.
			</p>
		<hr />
		<form id='create-camp-form' method='post' action='/action/camp/create/'>
			<label for='camp-name'>
				Camp name:
			</label>
			<input type='text' size=35 maxlength=32 name='camp-name' id='camp-name' required autofocus/>
			<br /><br />

			<label for='camp-desc'>
				Camp Description
			</label>
			<br /><br ?>
				<textarea name='camp-desc' id='camp-desc' maxlength=700 cols=70 rows=7 placeholder='Limit 700 characters...' required></textarea>
			<br /><br />
			<input type='submit' value='Create camp' name='create' />

		</form>
<?php include($_SERVER['DOCUMENT_ROOT'].'/include/footer.inc.php'); ?>

</body>
</html>
