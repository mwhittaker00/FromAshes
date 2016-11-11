<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/control/_settings.php');
?>
<!DOCTYPE html>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/head.inc.php'); ?>
	<title>From Ashes | Settings</title>
</head>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/top.inc.php'); ?>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/control.inc.php'); ?>

		<div id='page-content'>
			<h3>Settings</h3>


			<h4>Update your biography.</h4>
			<form id='update-bio' method='post' action='/action/survivor/bio/'>

			<?php
				if ($surv_desc){
			?>
				<textarea name='bio' maxlength=512 cols=70 rows=7 required><?= $surv_desc; ?></textarea>
			<?php
			}
				else{
			?>
				<textarea name='bio' maxlength=512 cols=70 rows=7 placeholder='Limit 512 characters...' required></textarea>
			<?php
			}
			?>
				<br />
				<input type='submit' value='Update Bio' name='update' />

			</form>

		<br />
		<hr />
		<br />

			<form id='update-password' method='post' action='/action/survivor/password/'>

			<label for='curr-pass' class='create-label'>
				Current Password:
			</label>
				<input type='password' id='curr-pass' name='curr' required />
				<br /><br />

			<label for='new-pass' class='create-label'>
				New Password:
			</label>
				<input type='password' id='new-pass' name='new' required />
				<br /><br />
			<label for='con-pass' class='create-label'>
				Confirm Password:
			</label>
				<input type='password' id='con-pass' name='con' required />
				<br />
				<input type='submit' value='Update Password' name='post' />
			</form>

		<br />
		<hr />
		<br />

			<form id='update-email' method='post' action='/action/survivor/email/'>

			<label for='email' class='create-label'>
				Verify email:
			</label>
				<input type='email' name='email' id='email' required />
				<input type='submit' value='Verify' disabled />
			</form>
		</div>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/footer.inc.php'); ?>

</body>
</html>
