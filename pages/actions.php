<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/control/_actions.php');
?>
<!DOCTYPE html>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/head.inc.php'); ?>
	<title>From Ashes | Actions</title>
</head>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/top.inc.php'); ?>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/control.inc.php'); ?>

		<div id='page-content'>
			<h3>What would you like to do next?</h3>

		<?php
		if($act_id){
			echo "<em>You have selected to $act_name. The action will be completed after $act_time.</em>";
			echo "<hr />";
		}
		else{}
		?>
			<form id='action-form' method='post' action='/action/survivor/actions/'>

			<div class='action'>
				Search the wastes for supplies.
				<br />
				<input type='submit' value='Scavenge' name='action' />
			</div>

			<div class='action'>
				Hunt for food.
				<br />
				<input type='submit' value='Hunt' name='action' />
			</div>

			<div class='action'>
				Trade supplies with other survivors.
				<br />
				<input type='submit' value='Trade' name='action' disabled/>
			</form>
		</div>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/footer.inc.php'); ?>

</body>
</html>
