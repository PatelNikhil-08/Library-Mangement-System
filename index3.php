<?php 

	include('config/db_connect.php');//My connection

	//This will register a reader

	//query
	$sql = 'SELECT Rid, first_name, last_name, email, age, phone_number FROM reader';

	// get the resbault set (set of rows)
	$result = mysqli_query($conn, $sql);
	
    //fetch the resulting rows as an array
	$readers = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free the $result from memory (good practise)
	mysqli_free_result($result);

	//close connection
	mysqli_close($conn);
	
?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<h4 class="center grey-text">Registered Readers! </h4>

	<div class="container">
		<div class="row">

			<?php foreach($readers as $reader): ?>

				<div class="col s6 m4">
					<div class="card z-depth-0">
						<div class="card-content center">
							<h6>Readers Firstname: <?php echo htmlspecialchars($reader['first_name']); ?></h6>
							<h6>Readers Lastname: <?php echo htmlspecialchars($reader['last_name']); ?></h6>
							<h6>Readers Email: <?php echo htmlspecialchars($reader['email']); ?></h6>
							<h6>Reader ID: <?php echo htmlspecialchars($reader['Rid']); ?></h6>
						</div>
						<div class="card-action right-align">
							<a class="brand-text" href="readerinfo.php?Rid=<?php echo $reader['Rid'] ?>">more info</a>
						</div>
					</div>
				</div>

			<?php endforeach; ?>

		</div>
	</div>

	<?php include('templates/footer.php'); ?>

</html>
