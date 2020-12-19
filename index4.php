<?php 

//Front-End for book database

	include('config/db_connect.php');//My connection

	// write query for all pizzas
	$sql = 'SELECT Title, Author, genre, Bid FROM Book ORDER BY created_at';

	// get the resbault set (set of rows)
	$result = mysqli_query($conn, $sql);
	//echo print_r($result);
    $sqla='SELECT count(*) AS total FROM Book';
	$result2=mysqli_query($conn, $sqla);
	$data=mysqli_fetch_assoc($result2);
	
	

    //fetch the resulting rows as an array
	$books = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free the $result from memory (good practise)
	mysqli_free_result($result);

	//close connection
	mysqli_close($conn);
	
?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<h4 class="center grey-text">Books!</h4>

	<div class="container">
		<div class="row">

			<div class="card-action right-align">
				
				<a class="brand-text" ><p>Number of books in the database: <?php echo $data['total']; ?></p></a>
							
			</div>
			
				

			<?php foreach($books as $Book): ?>

				<div class="col s6 m4">
					<div class="card z-depth-0">
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($Book['Title']); ?></h6>
							<h6><?php echo htmlspecialchars($Book['Author']); ?></h6>
							<h6><?php echo htmlspecialchars($Book['genre']); ?></h6>
						</div>
						<div class="card-action right-align">
							<a class="brand-text" href="details.php?Bid=<?php echo $Book['Bid'] ?>">more info</a>
						</div>
						<div class="card-action right-align">
							<a class="brand-text" href="genre_count.php?Bid=<?php echo $Book['Bid'] ?>">Book Data</a>
						</div>

					</div>
				</div>

			<?php endforeach; ?>

		</div>
	</div>

	<?php include('templates/footer.php'); ?>

</html>
