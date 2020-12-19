<?php

//This file ADDs a book

	include('config/db_connect.php');//My connection
	
	$Title = $Author = $genre = '';
	$errors = array('Title' => '', 'Author' => '', 'genre' => '');

	//When clicking on submit
	if(isset($_POST['submit'])){
		
		// check title
		if(empty($_POST['Title'])){
			$errors['Title'] = 'A Title is required';
		} else{
			$Title = $_POST['Title'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $Title)){
				$errors['Title'] = 'Title must be letters and spaces only';
			}
		}

		// check author
		if(empty($_POST['Author'])){
			$errors['Author'] = 'A author is required';
		} else{
			$Author = $_POST['Author'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $Author)){
				$errors['Author'] = 'Author must be letters and spaces only';
			}
		}

		// check genre
		if(empty($_POST['genre'])){
			$errors['genre'] = 'A genre is required';
		} else{
			$genre = $_POST['genre'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $genre)){
				$errors['genre'] = 'Genre must be letters and spaces only';
			}
		}

		if(array_filter($errors)){
			//echo 'errors in form';
		} else {
			// escape sql chars
			$Title = mysqli_real_escape_string($conn, $_POST['Title']);
			$Author = mysqli_real_escape_string($conn, $_POST['Author']);
			$genre = mysqli_real_escape_string($conn, $_POST['genre']);

			// create sql query
			$sql = "INSERT INTO Book(Title,Author,genre) VALUES('$Title','$Author','$genre')";

			// save to db and check
			if(mysqli_query($conn, $sql)){
				// success
				header('Location: index4.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}
			
		}

	} // end POST check

?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<section class="container grey-text">
		<h4 class="center">Add a Book</h4>
		<form class="white" action="add.php" method="POST">
			<label>Book Title</label>
			<input type="text" name="Title" value="<?php echo htmlspecialchars($Title) ?>">
			<div class="red-text"><?php echo $errors['Title']; ?></div>
			<label>Book Author</label>
			<input type="text" name="Author" value="<?php echo htmlspecialchars($Author) ?>">
			<div class="red-text"><?php echo $errors['Author']; ?></div>
			<label>Book Genre</label>
			<input type="text" name="genre" value="<?php echo htmlspecialchars($genre) ?>">
			<div class="red-text"><?php echo $errors['genre']; ?></div>
			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

	<?php include('templates/footer.php'); ?>

</html>
