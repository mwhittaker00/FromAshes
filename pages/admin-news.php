<?php
include($_SERVER['DOCUMENT_ROOT'].'/include/init.inc.php');

if ($pl_s_url != 'mr_williams'){
	header("Location:/");
}

?>
<!DOCTYPE html>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/head.inc.php'); ?>
	<title>From Ashes | Add News</title>
</head>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/top.inc.php'); ?>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/control.inc.php'); ?>

		<div id='page-content'>

			<form id='news' method='post' action='/action/news/add/'>
			<label for='title'>
				Title:
			</label>
			<input type='text' name='title' id='title' />
			<br /><br />
			<label for='news-content'>
				Content
			</label>
			<br /><br ?>
				<textarea name='content' id='news-content' maxlength=2480 cols=70 rows=7 placeholder='Limit 2480 characters...' required></textarea>
			<br /><br />
			<input type='submit' value='Post news' name='submit' />

		</div>
	</div>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/footer.inc.php'); ?>

</body>
</html>
