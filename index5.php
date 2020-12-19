<?php 

    //This will add a book to the system

	include('config/db_connect.php');//My connection

	//write query for all pizzas
	$sql = 'SELECT Bid, Rid, issue_date, due_date FROM book_loan';

	//get the resbault set (set of rows)
	$result = mysqli_query($conn, $sql);
	
    //fetch the resulting rows as an array
	$bookloans = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // free the $result from memory (good practise)
	mysqli_free_result($result);

	//close connection
	mysqli_close($conn);
	

?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<h4 class="center grey-text">Book Loans!</h4>

	<div class="container">
		<div class="row">

			<?php foreach($bookloans as $bookloan): ?>

				<div class="col s6 m4">
					<div class="card z-depth-0">
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($bookloan['Bid']); ?></h6>
							<h6><?php echo htmlspecialchars($bookloan['Rid']); ?></h6>
							<h6><?php echo htmlspecialchars($bookloan['issue_date']); ?></h6>
							<h6><?php echo htmlspecialchars($bookloan['due_date']); ?></h6>
						</div>
					</div>
				</div>

			<?php endforeach; ?>

		</div>
	</div>

	<?php include('templates/footer.php'); ?>

</html>
