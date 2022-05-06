<?php
include_once("../getvars.php");
$newid = $params["newid"];
if ($newid) {
    header("Location: ../?id=$newid");
}
if ($slist or $info or !$_SESSION["user"]) {
    header("Location: ../?" . $_SERVER['QUERY_STRING']);
}
// Populate an entry in the database
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include_once("../api/v1/access.php");
    $cost = $_POST["cost"];
    $name = $_POST["name"];
    $picture = $_FILES["picture"];
    if ($picture["error"] > 0) {
        echo "Error processing image: " . $picture["error"] . "<br>";
        die();
    } else {
        $picture = file_get_contents($picture["tmp_name"]);
    }
    $tflag = $_POST["type"];
    $renterId = $_SESSION["user"];
    $productId = strtr(base64_encode(uniqid()), '+/=', '._-');
    // Send the query
    include_once("../api/v1/access.php");
    $stmt = $pdo->prepare("INSERT INTO project_product VALUES (?, ?, ?, NULL, ?, ?, ?, CURRENT_TIMESTAMP)");
    $stmt->execute(array($productId, $name, $cost, $renterId, $picture, $tflag));
    header("Location: ./?newid=$productId");
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php include_once("../head.php"); ?>
    <?php include_once("../topbar.php"); ?>
</head>
<body>
    <form method="post" enctype="multipart/form-data" class="submit-product"
        action="<?php echo "https://${sname}$directoryname/" ?>">
    <div class="grid-x grid-padding-x">
	<div class="input-group small-3 cell">
	    <span class="input-group-label" for="name">Product Name</span>
	    <input type="textbox" placeholder="Product name" name="name" id="name" class="input-grou-field"/>
	</div>
	<div class="small-3 cell">
	<div class="input-group">
	    <span class="input-group-label">$</span>
	    <input type="textbox" placeholder="Cost" id="cost" name="cost" class="input-group-field" type="number"/>
	</div>
	</div>
	<div class="grid-container small-12 cell">
	    <label for="picture" class="button">Upload Photo</label>
	</div>
	<div class="small-9 cell">
	    <input type="file" accept="image/jpg" name="picture" id="picture" class="show-for-sr"/>
	</div>
	<div class="input-group small-6 cell">
	<span class="input-group-label text-right">Product Type</span>
	    <select id="type" name="type" class="input-group-field">
		<option value="I">Item</option>
		<option value="S">Service</option>
	    </select>
	</label>
	    <div class="input-group-button">
		<input type="submit" id="submit" name="submit" class="button" value="Submit"/>
	    </div>
	</div>
    </div>
    </form>
    <script>
    $(document).foundation();
    </script>
</body>
</html>
