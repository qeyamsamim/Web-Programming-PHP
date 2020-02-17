<?php
	include ("../include/header.php");
?>


<!DOCTYPE html>
<html>
	<body>
		<div class="page_margin">
		<h1 align="center">Sport Clubs in Bishkek</h1>

		<?php
			$clubs = mysqli_query($db_connect, "select * from sport_clubs");
			while($clubr = mysqli_fetch_array($clubs)){
				$id = $clubr['id'];
				$name = $clubr['name'];
				$club_id = base64_encode($id);

				$club_img = mysqli_query($db_connect, "select * from sport_club_img where club_id ='$id'");
                                $club_imgq = mysqli_fetch_array($club_img);
                                $img = $club_imgq['image'];

				print "<div style='width:24%;height:45%;float:left;margin-top:10px;'>";
				print "<a href='sportclubs.php?id=$club_id;'>";
				print "<img src='../images/otherClubs/$img' class='club_img'>";
				print "<h4 align='center'>".$name."<h4>";
				print "</a>";
				print "</div>";
			}

		?>

		<div style="display:none;">
		<div id="googleMap" style="width:100%;height:700px;"></div>
		<script>
		function myMap() {
		var mapProp= {
    		myCenter:new google.maps.LatLng(42.827829,74.620634),
    		center:new google.maps.LatLng(42.882004,74.582748),
    		zoom:12,
		};
		var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

		var marker=new google.maps.Marker({
  		position:myCenter,
  		icon:'AUCA logo.png'
  		});

		marker.setMap(map);
		}
		</script>

		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-3C7ilFxSYN6uGHbWbeh65DRMiuTI80M&callback=myMap"></script>
		</div>
		</div>
	</body>
</html>
