<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/include/init.inc.php');
include($_SERVER['DOCUMENT_ROOT'].'/include/functions.php');

$get_url = $_GET['camp'];
$camp_qry = "SELECT camp_id, camp_name, camp_url, camp_desc
				FROM camp
				WHERE camp_url = '$get_url'";
$camp_result = $db->query($camp_qry);
$camp_row = $camp_result->fetch_assoc();

$camp_id = $camp_row['camp_id'];
$camp_name = $camp_row['camp_name'];
$camp_url = $camp_row['camp_url'];
$camp_desc = stripslashes(nl2br($camp_row['camp_desc']));

$surv_qry = "SELECT sc.surv_id, s.surv_name, s.surv_url
				FROM survivor_camp sc
				JOIN survivor s
					ON s.surv_id = sc.surv_id
				WHERE sc.camp_id = $camp_id";

$surv_result = $db->query($surv_qry);
$surv_cnt = $surv_result->num_rows;
$surv_s = '';
if ($surv_cnt > 1){
	$surv_s = 's';
}
else{}

if (isset($player_id)){
	$home_camp = '';
	$home_qry = "SELECT camp_id FROM survivor_camp
					WHERE surv_id = $player_id
					AND camp_id = $camp_id";

	$home_res = $db->query($home_qry);
	$home_camp = $home_res->num_rows;
}

$camp_msg_qry = "SELECT * FROM
	(SELECT cm.camp_msg_id, cm.msg_content, cm.msg_timestamp, cm.camp_id, cm.surv_id, s.surv_name, s.surv_url
					FROM camp_msg cm
					JOIN survivor s
						ON s.surv_id = cm.surv_id
					WHERE camp_id = $camp_id
					AND msg_active = 1
					ORDER BY camp_msg_id DESC
					LIMIT 10)
	AS T1 ORDER BY camp_msg_id ASC";

$camp_msg_res = $db->query($camp_msg_qry);
$camp_msg_cnt = $camp_msg_res->num_rows;

$ldr_qry = "SELECT s.surv_name, s.surv_url, sc.surv_id
			FROM survivor_camp sc
			JOIN survivor s
				ON s.surv_id = sc.surv_id
			WHERE sc.camp_id = $camp_id
			AND sc.camp_leader = $camp_id";
$ldr_res = $db->query($ldr_qry);
$ldr_row = $ldr_res->fetch_assoc();

$ldr_name = $ldr_row['surv_name'];
$ldr_url = $ldr_row['surv_url'];
$ldr_id = $ldr_row['surv_id'];

$hap_qry = "SELECT h_id, h_message, h_timestamp
		FROM happenings
		WHERE camp_id = $camp_id
		AND h_type = 1
		ORDER BY h_id DESC
		LIMIT 10";
$hap_res = $db->query($hap_qry);
$hap_count = $hap_res->num_rows;
?>
<!DOCTYPE html>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/head.inc.php'); ?>
	<title>From Ashes | <?=$camp_name; ?></title>
</head>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/top.inc.php'); ?>

	<hr />
	<div id='content'>
		<?php include($_SERVER['DOCUMENT_ROOT'].'/include/control.inc.php'); ?>

		<div id='page-content'>
			<h1 id='camp_name'><?=$camp_name; ?></h1>
			<h4 id='camp_leader'>Leader:
		<?php
			if (empty($ldr_name)){
				echo "None";
			}
			else{
		?>
				<a href='/survivor/<?=$ldr_url; ?>/'>
					<?=$ldr_name;; ?>
				</a>
		<?php
		}
		?>
			</h4>

		<?php
			if (isset($player_id) && $ldr_id == $player_id ){
				echo "<a href='/page/controls/'>Leader Controls</a>";
			}
		?>

			<div id='camp_desc'>
				<?=$camp_desc; ?>
			</div>

			<div id='camp-move'>
		<?php
			if (isset($player_id) && $home_camp != 1){
		?>
				<form id='move-form' method='post' action='/action/camp/move/'>
					<input type='hidden' name='camp' value='<?=$camp_id; ?>' />
					<input type='submit' value='Move to <?=$camp_name; ?>' />
				</form>
		<?php
		} //END IF
		elseif (isset($player_id)){
		?>
				<form id='move-form' method='post' action='/action/camp/move/'>
					<input type='hidden' name='camp' value='8' />
					<input type='submit' value='Leave <?=$camp_name;?>' />
				</form>
		<?php
		} // END ELSE
		?>
			</div>

			<div id='camp-updates'>
			<h4><?= $camp_name; ?> Updates</h4>
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

			<div id='camp-body'>
				<div class='row'>
					<div id='camp-messages' class='col-md-9'>
					<h4><?= $camp_name; ?> Community Board</h4>
				<?php
					if ($camp_msg_cnt == 0){
						echo "$camp_name doesn't have any messages yet.";
					}
					else{
						while($row = $camp_msg_res->fetch_assoc()){
							echo "<div class='camp-msg'>
									<div class='msg-head'>
										<a href='/survivor/".$row['surv_url']."/'>
											".$row['surv_name']."
										</a>
										 <span class='msg-time'>".convertTime($row['msg_timestamp'])."</span>

								</div>
								<div class='cmp-msg-con'>
									".stripslashes($row['msg_content'])
							."	</div>
							</div>";
						}
					}

					if (isset($player_id) && $home_camp == 1){
				?>
						<hr />
						<form id='camp_msg_form' method='post' action='/action/camp/post/'>
							<input type='hidden' name='camp' value='<?= $camp_id; ?>' />
							<textarea name='msg' maxlength=1200 cols=70 rows=7 required></textarea>
							<br /><br />
							<input type='submit' value='Post Message' name='post' />
						</form>
				<?php
				 } else{}
				?>

					</div> <!-- ENDS camp-messages -->

					<div id='camp-members' class='col-md-3'>
					<h4><?= $camp_name; ?> has <?= $surv_cnt; ?> member<?= $surv_s; ?></h4>

			<?php
			//
			// Print names of camp members to screen
			//
			while ($surv_row = $surv_result->fetch_assoc()){
			?>
			<div class='camp-mem'>
				<a href="/survivor/<?= $surv_row['surv_url']; ?>/">
					<?= $surv_row['surv_name']; ?>
				</a>
			</div>
			<?php
			} //ENDS THE WHILE LOOP

			?>
					</div> <!-- ENDS camp-members -->
			</div>
		</div><!-- ENDS camp-body -->

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/footer.inc.php'); ?>

</body>
</html>
