<?php 

//This file adds a reader to the system

	include('config/db_connect.php');//My connection

	$Rid = $first_name = $last_name = $email = $age = $phone_number = '';
	$errors = array('Rid ' => '', 'first_name' => '','last_name' => '', 'email' => '', 'age' => '','phone_number' => '');

	if(isset($_POST['submit'])){
		
		// check rid
		if(empty($_POST['Rid'])){
			$errors['Rid'] = 'A rid is required';
		} else{
			$rid = $_POST['Rid'];
			if(!preg_match('/^[0-9]*$/', $Rid)){
				$errors['Rid'] = 'rid must be numbers and spaces only';
			}
		}

		
		if(empty($_POST['first_name'])){
			$errors['first_name'] = 'A firstname is required';
		} else{
			$first_name = $_POST['first_name'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $first_name)){
				$errors['first_name'] = 'Firstname must be letters and spaces only';
			}
		}


		if(empty($_POST['last_name'])){
			$errors['last_name'] = 'A lastname is required';
		} else{
			$last_name = $_POST['last_name'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $last_name)){
				$errors['last_name'] = 'Lastname must be letters and spaces only';
			}
		}


		if(empty($_POST['email'])){
			$errors['email'] = 'An email is required';
		} else{
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errors['email'] = 'Email must be a valid email address';
			}
		}

	
		if(empty($_POST['age'])){
			$errors['age'] = 'A age is required';
		} else{
			$age = $_POST['age'];
			if(!preg_match('/^[0-9]*$/', $age)){
				$errors['age'] = 'Age must be numbers and spaces only';
			}
		}


		if(empty($_POST['phone_number'])){
			$errors['phone_number'] = 'A phonenumber is required';
		} else{
			$phone_number = $_POST['phone_number'];
			if(!preg_match('/^[0-9]*$/', $phone_number)){
				$errors['phone_number'] = 'Phone number must be numbers  and spaces only';
			}
		}

		if(array_filter($errors)){
		
		} else {
			
			$Rid = mysqli_real_escape_string($conn, $_POST['Rid']);
			$first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
			$last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$age = mysqli_real_escape_string($conn, $_POST['age']);
			$phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
			
			// create sql
			$sql = "INSERT INTO reader(Rid, first_name, last_name, email, age, phone_number) VALUES('$Rid','$first_name','$last_name','$email','$age','$phone_number')";

			// save to db and check
			if(mysqli_query($conn, $sql)){
				// success
				header('Location: index3.php');
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
		<h4 class="center">Register a Reaader</h4>
		<form class="white" action="addreader.php" method="POST">
			<label>Reader ID</label>
			<input type="text" name="Rid" value="<?php echo htmlspecialchars($Rid) ?>">
			<div class="red-text"><?php echo $errors['Rid']; ?></div>
			<label>Reader Firstname</label>
			<input type="text" name="first_name" value="<?php echo htmlspecialchars($first_name) ?>">
			<div class="red-text"><?php echo $errors['first_name']; ?></div>
			<label>Reader Lastname</label>
			<input type="text" name="last_name" value="<?php echo htmlspecialchars($last_name) ?>">
			<div class="red-text"><?php echo $errors['last_name']; ?></div>
			<label>Reader Email</label>
			<input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
			<div class="red-text"><?php echo $errors['email']; ?></div>
			<label>Reader Age</label>
			<input type="text" name="age" value="<?php echo htmlspecialchars($age) ?>">
			<div class="red-text"><?php echo $errors['age']; ?></div>
			<label>Reader Phone Number</label>
			<input type="text" name="phone_number" value="<?php echo htmlspecialchars($phone_number) ?>">
			<div class="red-text"><?php echo $errors['phone_number']; ?></div>
			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

	<?php include('templates/footer.php'); ?>

</html>
