<?php
ini_set("display_errors", 1);
include_once("../getvars.php");
if ($_SERVER["QUERY_STRING"]["newid"]) {
    header("Location: ../?id=$newid");
}
session_start();
if ($slist or $info or !$_SESSION["user"]) {
    header("Location: ../?" . $_SERVER['QUERY_STRING']);
}
// Populate an entry in the database
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include_once("../api/v1/access.php");
    $cost = $_POST["cost"];
    $name = $_POST["name"];
    $picture = $_POST["picture"];
    $tflag = $_POST["type"];
    $renterId = $_SESSION["user"];
    $productId = strtr(base64_encode(uniqid()), '+/=', '._-');
    // Send the query
    include_once("../api/v1/access.php");
    $stmt = $pdo->prepare("INSERT INTO project_product VALUES (?, ?, ?, NULL, ?, ?, ?, CURRENT_TIMESTAMP)");
    $stmt->execute($productId, $name, $cost, $renterId, $picture, $tflag);
    header("Location: ../?newid=$productId");
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php include_once("../head.php"); ?>
</head>
<body>
    <?php include_once("../topbar.php"); ?>
    <form method="post" enctype="multipart/form-data" class="search-form"
        action="<?php echo "https://${sname}$directoryname/" ?>">
        <input type="textbox" placeholder="Product name" name="name" id="name"/>
        <input type="textbox" placeholder="Cost" id="cost" name="cost"/>
        <input type="file" accept="image/jpg" name="picture" id="picture"/>
        <select id="tflag" name="tflag" size="2">
            <option value="I">Item</option>
            <option value="S">Service</option>
        </select>
        <input type="submit" id="submit" name="submit"/>
    </form>
    <script>
    $(document).foundation();
    </script>
</body>
</html>