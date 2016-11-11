<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/control/_survivor.php');
?>
<!DOCTYPE html>
<?php include($_SERVER['DOCUMENT_ROOT'].'/include/head.inc.php'); ?>
	<title>From Ashes | <?=$surv_name; ?></title>
</head>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/top.inc.php'); ?>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/control.inc.php'); ?>
		<div class='col-md-10'>
			<h2><?=$surv_name; ?></h2>
			<hr />
			<div class='row'>
			<div id='survivor-desc' class='col-md-9'>
			<h4>Camp: <a href="/camp/<?=$camp_url; ?>/">
					<?=$camp_name; ?>
				</a></h4>
			<?php
				if ($surv_desc){
					echo $surv_desc;
				}
				else{
					echo "$surv_name is a ragged, waste-torn survivor of <a href='/camp/".$camp_url."/'>".$camp_name."</a>. There is little else to say until $surv_name decides it needs to be said.";
				}
			?>

				<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>
			</div>

		<div id='supporter-list' class='col-md-3'>

			<div id='support-form'>

		<?php
		if ($pl_verified == 1){
			if ($home_camp == 1 && $supported != 1 && ($player_id != $surv_id)){
		?>
				<form method='post' action='/action/survivor/add-support/'>
					<input type='hidden' value='<?=$surv_id; ?>' name='rec_survivor' />
					<input type='submit' value='Support <?=$surv_name; ?>' />
					<br />
					<em>Supporting <?=$surv_name; ?> will remove your support from other survivors.</em>
				</form>
		<?php
		}
			elseif  ($home_camp == 1 && $supported == 1 && ($player_id != $surv_id)){
		?>
				<form method='post' action='/action/survivor/remove-support/'>
					<input type='hidden' value='<?= $surv_id; ?>' name='rec_survivor' />
					<input type='submit' value='Remove support from <?= $surv_name; ?>' />
				</form>
		<?php
			}
		} // ends verified check for player
			else{
				echo '';
			}
		?>

		</div> <!-- END #support-form DIV -->

		<?php
			// is the current user verified?
			if ($verified == 1){
		?>
			<h4>Supporters : <?=$supps_cnt; ?></h4>
		<?php
			while($row = $supps_res->fetch_assoc()){
				echo "<div class='supporter'>";
					echo "<a href='/survivor/".$row['surv_url']."/'>".
						$row['surv_name']
					."</a>";
				echo "</div>";
			}
		?>

		<?php
		} // end survivor page verified check
		?>

	</div> <!-- END #supporter-list DIV -->
</div>



		<!-- recent survivor events -->
		<div id='camp-updates'>
			<h4><?= $surv_name; ?> Events</h4>
		<?php
			if($hap_count == 0){
				echo "Nothing has happened yet...";
			}
			else{
				while($row = $hap_res->fetch_assoc()){
					echo "<div class='camp-upd'>
						<span class='hap-time'>".convertTime($row['h_timestamp'])."</span> - ".
							$row['h_message']."
						</div>";
				}
			}
		?>
			</div>
		<!-- END survivor events -->
		<hr />
		<?php

			if (isset($_SESSION['online']) && ($player_id != $surv_id)){
		?>
			<div id='pvt-msg'>
				Send a message to <?= $surv_name; ?>:<br /><br />
				<form method='post' action='/action/survivor/send-msg/'>
					<input type='hidden' value='<?= $surv_id; ?>' name='msg_get' />
					<input type='hidden' value='<?= $surv_url; ?>' name='surv_url' />
					<textarea name='msg' maxlength=1200 cols=70 rows=7 required></textarea>
					<br />
					<input type='submit' value='Message <?= $surv_name; ?>' />
				</form>
			</div>
		<?php
		} // end above IF
		else{}
		?>
	</div>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/footer.inc.php'); ?>

</body>
</html>
