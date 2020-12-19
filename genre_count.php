<?php 

	//With this you will get the count for a specific genre

	include('config/db_connect.php');//My connection


    $output = 0;

	// Check Connection
	if (!$conn)
	{
		echo 'Connection error: ' . mysqli_connect_error();
	}

	if (isset ($_POST['search']))
    {
        $searchq = $_POST['search'];
        $sql = "SELECT COUNT(Bid) FROM Book WHERE genre LIKE '%".$searchq."%'";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($query);
        $num = $row[0];
        $count = mysqli_num_rows($query);
        if ($count == 0)
        {
            $output = 'There was no search results';
        }
        else
        {
            $output = $num;
        }
    }

?>






<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	

				<form action="genre_count.php" method="post">
    			<input type="text" name="search" placeholder="Search for genre..."/>
    			<input type="submit" value=">>" />
				</form>
    
<p>Book count for that genre is <?php echo $output; ?></p>

				<h4 class="center grey-text">Data Book Count for Genre!</h4>

					<div class="container">
						<div class="row">

				
							

						</div>
					</div>

			

				

	
	<?php include('templates/footer.php'); ?>

</html>
