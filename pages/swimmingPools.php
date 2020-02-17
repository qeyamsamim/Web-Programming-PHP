<?php
        include ("../include/header.php");
        $id = mysqli_real_escape_string($db_connect, $_GET['id']);
	$clubId = base64_decode($id);

	$clubs = mysqli_query($db_connect, "select * from swimming_pools where id = '$clubId'");
	$clubsr = mysqli_fetch_array($clubs);
	$name = $clubsr['name'];
	$description = $clubsr['description'];
	$address = $clubsr['address'];
	$contNum = $clubsr['contact_num'];
?>


<!DOCTYPE html>
<html>
        <body>
                <h2 align="center"><?=$name;?></h2>

                <p><strong>Description:</strong></p>
                <p><?=$description;?></p>
                <p><strong>Address: </strong><?=$address;?></p>
                <p><strong>Contact Number: </strong><?=$contNum;?></p>
        </body>
</html>

