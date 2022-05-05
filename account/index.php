<?php
include_once("../getvars.php");
if ($slist or $info) {
    header("Location: ../?" . $_SERVER['QUERY_STRING']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php include_once("../head.php"); ?>
</head>
<body>
    <?php include_once("../topbar.php"); ?>
    <!-- To-do: write form sending requests to publish.php -->
    <script>
    $(document).foundation();
    </script>
</body>
</html>