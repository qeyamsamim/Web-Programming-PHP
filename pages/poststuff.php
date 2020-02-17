<html>
	<link rel="stylesheet" href="../css/mystyle.css"/>
	<body>
		<div class="containerBazar">
			<h3 align="center">Post</h3>
			<form method="post" action="sportstuff.php" enctype="multipart/form-data">
				<label>Name of the product</label>
				<input type="text" class="inputForm" name="name" placeholder="Type a name . ." required>
                                <label>Description</label>
				<textarea name="description" class="inputForm" style="resize:none;height:15%;" placeholder="Type the description . ."></textarea>
				<label>Condition</label>
				<input type="text" class="inputForm" name="condition"  placeholder="Condition . ." required>
				<label>Price</label>
				<input type="text" class="inputForm" name="price" placeholder="Type Price . ." required>
				<label>Contact Number</label>
				<input type="text" class="inputForm" name="cont_num" placeholder="Your Contact Number . ." required>
				<label>City</label>
				<input type="text" class="inputForm" name="city" placeholder="Type City . ." required>
				<label>Photos</label>
				<input type="file" name="img[]" multiple />
				<input type="hidden" name="id" value="<?=$id;?>">
				<input type="submit" class="submit_btn" style="background:white;color:#4CAF50;margin-left:40%;"  name="submit" value="Submit">
			</form>
		</div>
	</body>
</html>
