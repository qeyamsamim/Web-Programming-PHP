
<?php
	include("../include/dbconnection.php");

	if(isset($_POST['search'])){
                $input = mysqli_real_escape_string($db_connect, $_POST['input']);

		$fields = mysqli_query($db_connect, "select * from football_fields where name Like '%$input%'");
		$fieldsn = mysqli_num_rows($fields);
	}
?>
<html>
	<body>
		<form method="post" action="search.php">
                        <div style="margin-right:20%;margin-left:20%;margin-top:2%;">
                                <input type="text" name="input" placeholder="Search Football Fields, Sport Clubs..." style="width:80%;padding:5px;border:1px solid black">
                                <button type="submit" name="search">Search</button>
                        </div>
                </form>
		<?php
			
			if($fieldsn > 0){
				print "Hello";
			//	print "<table><tr><td><strong>No</strong></td>";
                	//	print "<td><strong>Name</strong></td></tr>";

			//	while($rows = mysqli_fetch_array($fields)){
	                //	       	$id = $rows['id'];
        	          //      	$name = $rows['name'];
        	                	//$fieldId = base64_encode($id);

	                        	//print "<tr><td>".$count."</td>";
       		                	//print "<td>".$name."</td></tr>";
	                        	//print "<td><a href='booking.php?id=<?=$fieldId;?>'>Book</a></td></tr>";
	                        	//$count++;
               		//	}
                	//	print "</table>";
			}
		?>
	</body>
</html>
