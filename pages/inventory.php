<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/control/_inventory.php');
?>
<!DOCTYPE html>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/head.inc.php'); ?>
	<title>From Ashes | Inventory</title>
</head>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/top.inc.php'); ?>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/control.inc.php'); ?>

		<div id='page-content'>
			<h3>Your Inventory</h3>

		<?php
		if($item_res->num_rows == 0){
			echo "You don't have any items yet.";
		}
		else{
			echo "Item  -  Count  -  Weight <br /><br />";
			while ($row = $item_res->fetch_assoc()){
				echo $row['item_name']." - ".$row['count']." - ".(($row['count']*$row['item_weight'])/10)."<br />";
			}

		}
		?>
		</div>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/footer.inc.php'); ?>

</body>
</html>
