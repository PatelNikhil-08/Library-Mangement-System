
<?php
	include 'header.php';
?>



<h1><center>BOOKS</center></h1>
<div class="books-container">

<?php
	if(isset($_POST['submit-search'])){
		$search = mysqli_real_escape_string($conn, $_POST['search']);
		$sql = "SELECT * FROM Book WHERE genre LIKE '%$search%'";
		$result = mysqli_query($conn, $sql);
		$queryResult = mysqli_num_rows($result);

		if($queryResult > 0){
			while($row = mysqli_fetch_assoc($result)){
				echo "<div class= 'book-box'>
				<table border = 1 >
						
						<th>BID</th>
						<th>TITLE</th>
						<th>AUTHOR</th>
						<th>GENRE</th>

					<tr>
					<td>".$row['Bid']."</td>
				    <td>".$row['Title']."</td>
				    <td>".$row['Author']."</td>
					<td>".$row['genre']."</td>


				    </tr>
				</table>

				</div>";
			

			}

		}else{
			echo " There are no results matching your results";
					}


	}
 



?>

<br>
<br>
<br>
<li><a href="Home.html">HOME</a><p>Click on home link below to go back to main page</p></li>

</div>

</body>

</html>