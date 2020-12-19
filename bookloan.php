<?php 

	include('config/db_connect.php');

	//This will issue a book

	$Bid = $Rid = $issue_date = $due_date='';
	$errors = array('Bid' => '', 'Rid' => '', 'issue_date' => '', 'due_date' => '');

	if(isset($_POST['submit'])){
		
		// check title
		if(empty($_POST['Bid'])){
			$errors['Bid'] = 'A Bid is required';
		} else{
			$Bid = $_POST['Bid'];
			if(!preg_match('/^[0-9]*$/', $Bid)){
				$errors['Bid'] = 'Bid must be numbers only';
			}
		}

		// check rid
		if(empty($_POST['Rid'])){
			$errors['Rid'] = 'A rid is required';
		} else{
			$Rid = $_POST['Rid'];
			if(!preg_match('/^[0-9]*$/', $Rid)){
				$errors['Rid'] = 'Rid must be numbers only';
			}
		}

		// check issuedate
		if(empty($_POST['issue_date'])){
			$test_date = 'issue_date';
			$test_arr  = explode('/', $test_date);
			if (count($test_arr) == 3) {
    			if (checkdate($test_arr[0], $test_arr[1], $test_arr[2])) {
        			
    			} else {
        			
    			}
			}
			
		} 


			
		

		// check duedate
		if(empty($_POST['due_date'])){
			$test_date2 = 'due_date';
			$test_arr  = explode('/', $test_date);
			if (count($test_arr) == 3) {
    			if (checkdate($test_arr[0], $test_arr[1], $test_arr[2])) {
        			// valid date ...
    			} else {
        			// problem with dates ...
    			}
			}
		}

		if(array_filter($errors)){
			//echo 'errors in form';
		} else {
			// escape sql chars
			$Bid = mysqli_real_escape_string($conn, $_POST['Bid']);
			$Rid = mysqli_real_escape_string($conn, $_POST['Rid']);
			$issue_date = mysqli_real_escape_string($conn, $_POST['issue_date']);
			$due_date = mysqli_real_escape_string($conn, $_POST['due_date']);

			// create sql
			$sql = "INSERT INTO book_loan(Bid,Rid,issue_date,due_date) VALUES('$Bid','$Rid','$issue_date','$due_date')";

			// save to db and check
			if(mysqli_query($conn, $sql)){
				// success
				header('Location: index2.php');
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
		<h4 class="center">Loan a Book</h4>
		<form class="white" action="bookloan.php" method="POST">
			<label>Book ID</label>
			<input type="text" name="Bid" value="<?php echo htmlspecialchars($Bid) ?>">
			<div class="red-text"><?php echo $errors['Bid']; ?></div>
			<label>Reader ID</label>
			<input type="text" name="Rid" value="<?php echo htmlspecialchars($Rid) ?>">
			<div class="red-text"><?php echo $errors['Rid']; ?></div>
			<label>Issue Date</label>
			<input type="text" name="issue_date" value="<?php echo htmlspecialchars($issue_date) ?>">
			<div class="red-text"><?php echo $errors['issue_date']; ?></div>
			<label>Due Date</label>
			<input type="text" name="due_date" value="<?php echo htmlspecialchars($due_date) ?>">
			<div class="red-text"><?php echo $errors['due_date']; ?></div>
			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

	<?php include('templates/footer.php'); ?>

</html>