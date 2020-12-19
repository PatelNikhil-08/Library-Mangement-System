<?php
	include 'header.php';
?>

<form action = "search2.php" method = "POST">
	<input type="text" name="search" placeholder="Search">
	<button type="submit" name="submit-search">Search</button>
</form>
<h2>Search for Books with Title or Author </h2>
<div class="books-container">
	<?php
		$sql = "SELECT * FROM Book";
		$result = mysqli_query($conn, $sql);
		$queryResults = mysqli_num_rows($result);


		if($queryResults > 0){
			while($row = mysqli_fetch_assoc($result)){
				echo "<div class= 'book-box'>
				</div>";
			}
		}


	?>
</div>
</body>
</html>