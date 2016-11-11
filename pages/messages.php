<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/control/_messages.php');
?>
<!DOCTYPE html>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/head.inc.php'); ?>
	<title>From Ashes | Messages</title>
</head>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/top.inc.php'); ?>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/control.inc.php'); ?>

		<div id='page-content'>
			<h3 id='camp_name'>Messages for <?= $pl_s_name; ?></h3>

			<div id='surv_messages'>

		<?php
			if ($pm_count == 0){
				echo "You doesn't have any messages yet.";
			}
			else{
				while($row = $pm_res->fetch_assoc()){
					echo "<div class='camp-msg'>
							<div class='msg-head'>
								<a href='/survivor/".$row['surv_url']."/'>
									".$row['surv_name']."
								</a>
								 <span class='msg-time'>".convertTime($row['pm_timestamp'])."</span>

						</div>
						<div class='cmp-msg-con'>
							".stripslashes($row['pm_content'])
					."	</div>
					</div>";
				}
			}


		?>
			</div>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/footer.inc.php'); ?>

</body>
</html>
