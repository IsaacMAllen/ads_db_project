<?php
# This is code that runs before HTML content is sent
# Functionality like AJAX not handled through api/v1 is here.
# This includes search requests and other query string-based things.
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
include_once(getenv(root)."head.php");
?>
<script src="index.js" async></script>
</head>
<body>
    <noscript>
        We recommend Javascript for the full ADS experience.<br>
        You can still use the site, but features like single-page loading and analytics will be unavailable.
    </noscript>
<?php
# TODO: write the main page stuff
# Topbar and other dynamic/multi referenced content goes here
include_once(getenv(root)."topbar.php");
# Most of the remaining page as such will be generated using PHP code
# To add HTML in, use `echo "<tag>text</tag>"`
# To make the application single-page, replace text/image content dynamically
#   using AJAX.
# Make the user experience enjoyable using fun animations.
# The less that changes, the better.
# Use modals to increase engagement and as a login wall.
# Any SQL requests should use the group password and database and PDO.
# DO NOT USE THIS VERSION OF PHP'S SQL system as directed by Dr. Mohebbi.
# It is vulnerable to SQL injection and this risk cannot be mitigated.
# PDO offers parameterization and allows requests to be re-used which is VITAL to this project.
# only run requests for content and information in a file in api/v1 to make the site more modular
?>
</body>
</html>
