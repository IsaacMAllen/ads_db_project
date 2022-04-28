<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Add a new listing</title>
</head>
<body>
    <?php
	$host = 'localhost';
	$user = getenv('USER');
	$pass = getenv('PASS');
	$dbname = 'CS_2022_Spring_3430_101_t1';
	try {
	    $connection = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    echo("Connected to $dbname at $host successfully.\n");
	} catch(PDOException $pe) {
	    die($_ENV[0]);
	    //die("Could not connect to the database $dbname :" . $pe->getMessage());
	}
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
	    $productId = uniqid();
	    echo($productId . "\n");
	    $cost = 12;
	    $transactionId = null;
	    $renterId = null;
	    $picture = file_get_contents($_FILES['listImg']['tmp_name']);
	    $query = "SELECT count(*) as allcount FROM project_product
		      WHERE picture='".$picture."'";
	    $stmt = $connection->prepare($query);
	    $row = 
	    $stmt = $connection->prepare('INSERT INTO project_product(productId, cost, transactionId, renterId, picture)
				    VALUES(?, ?, ?, ?, ?)');
	    $stmt -> bindParam(1,$productId);
	    $stmt -> bindParam(2,$cost);
	    $stmt -> bindParam(3,$transactionId);
	    $stmt -> bindParam(4,$renterId);
	    $stmt -> bindParam(5,$picture);
	    try {
	    $passed = $stmt -> execute();
	    if ($passed) {
		echo "passed";
	    } else {
		print_r($dbh->errorInfo());
	    }
	    } catch (PDOException $e) {
		die($e -> getMessage());
	    }
	    header('HTTP/1.1 301 Moved Permanently');
	    header('Location: success.php');
	    die();
	}    
    ?>
    <form enctype="multipart/form-data" method="POST" name="frm_user_file">
	<input type="file" name="listImg"/> 
	<input type="submit" value="Upload"/>
    </form>
</body>
</html>
