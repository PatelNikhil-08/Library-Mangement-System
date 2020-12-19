<?php 
    //this will give me the reader info
	include('config/db_connect.php');//My connection

	

	if(isset($_POST['delete'])){

		$id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

		$sql = "DELETE FROM reader WHERE Rid = $id_to_delete";

		if(mysqli_query($conn, $sql)){
			header('Location: index3.php');
		} else {
			echo 'query error: '. mysqli_error($conn);
		}

	}

	// check GET request id param
	if(isset($_GET['Rid'])){
		
		// escape sql chars
		$Rid = mysqli_real_escape_string($conn, $_GET['Rid']);

		// make sql
		$sql = "SELECT * FROM reader WHERE Rid = $Rid";

		// get the query result
		$result = mysqli_query($conn, $sql);

		// fetch result in array format
		$reader = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
		mysqli_close($conn);

	}

?>

<!DOCTYPE html>
<html>

	<?php include('templates/header.php'); ?>

	<div class="container center">
		<?php if($reader): ?>
			<h4><?php echo $reader['Rid']; ?></h4>
			<p>First Name <?php echo $reader['first_name']; ?></p>
			<p>Last Name <?php echo $reader['last_name']; ?></p>
			<!-- DELETE FORM -->
			<form action="readerinfo.php" method="POST">
				<input type="hidden" name="id_to_delete" value="<?php echo $reader['Rid']; ?>">
				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
			</form>

		<?php else: ?>
			<h5>No reader exists of that name.</h5>
		<?php endif ?>
	</div>

	<?php include('templates/footer.php'); ?>

</html>
