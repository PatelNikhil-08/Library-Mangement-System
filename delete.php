<?php 
//This is tab under books in index.php to get the details of the thing they click
	include('config/db_connect.php');//My connection

	if(isset($_POST['delete'])){

		$id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

		$sql = "DELETE FROM book WHERE Bid = $id_to_delete";

		if(mysqli_query($conn, $sql)){
			header('Location: index4.php');
		} else {
			echo 'query error: '. mysqli_error($conn);
		}

	}

	// check GET request id param
	if(isset($_GET['Bid'])){
		
		// escape sql chars
		$Bid = mysqli_real_escape_string($conn, $_GET['Bid']);

		// make sql
		$sql = "SELECT * FROM Book WHERE Bid = $Bid";

		// get the query result
		$result = mysqli_query($conn, $sql);

		// fetch result in array format
		$Book = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
		mysqli_close($conn);

	}

?>

<!DOCTYPE html>
<html>

	<?php include('templates/header.php'); ?>

	<div class="container center">
		<?php if($Book): ?>
			<h4><?php echo $Book['Title']; ?></h4>
			<p>Written by <?php echo $Book['Author']; ?></p>
			<p><?php echo date($Book['created_at']); ?></p>
			<h5>genre:</h5>
			<p><?php echo $Book['genre']; ?></p>

			<!-- DELETE FORM -->
			<form action="details.php" method="POST">
				<input type="hidden" name="id_to_delete" value="<?php echo $book['Bid']; ?>">
				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
			</form>

		<?php else: ?>
			<h5>No such book exists.</h5>
		<?php endif ?>
	</div>

	<?php include('templates/footer.php'); ?>

</html>
