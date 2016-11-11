<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/control/_news.php');
?>
<!DOCTYPE html>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/head.inc.php'); ?>
	<title>From Ashes | News</title>
</head>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/top.inc.php'); ?>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/control.inc.php'); ?>

		<div id='page-content'>
			<h2 id='camp_name'>From Ashes News</h2>

		<?php
			while($row = $news_result->fetch_assoc()){
				echo "<div class='news-block'>
						<h3 class='news-title'>".$row['news_title']."</h3>
						<div class='news-info'>
							".$row['news_author']." - ".gmdate("F j, Y", $row['news_date'])."
						</div>
						<div class='news-content'>
							".nl2br(stripslashes($row['news_content']))."
						</div>
					</div>";
			}
		?>


<?php include($_SERVER['DOCUMENT_ROOT'].'/include/footer.inc.php'); ?>

</body>
</html>
