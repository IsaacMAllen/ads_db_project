<!DOCTYPE html>
<html>
    <head>
	<title>Listed Successfully</title>
    </head>
    <body>

	<h1>Thank you for listing your product with us.</h1>

	<p>Your product has been listed successfully</p>
	<?php
	    require('connection.php');
	    $stmt = $connection->prepare('Select * from project_product');
	    $stmt->execute();

	    while($row = $stmt->fetch()) {
		echo '<img src="data:image/jpeg;base64,'.base64_encode($row['picture']).'"/>';
	    }

	?>
    </body>
</html>
