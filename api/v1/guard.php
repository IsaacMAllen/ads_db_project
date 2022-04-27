<?php
if (count(get_included_files()) <= 2) {
    header("HTTP/1.1 404 Not Found");
    die();
}
?>