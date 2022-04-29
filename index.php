<?php
# This is code that runs before HTML content is sent
# Functionality like AJAX not handled through api/v1 is here.
# This includes search requests and single-page things.
# All of this will be handled with POST requests to differentiate.

# If the page uses the get method load the information from the query string
if ($_SERVER['REQUEST_METHOD'] !== 'POST')
{
    parse_str($_SERVER['QUERY_STRING'], $params);
}
else # If the page is loaded with POST or PATCH
{
    $params = $_POST;
}

# Get information from search
$query = $params['q'];
$count = $params['count'];
$offset = $params['offset'];
$id = $params['id'];
# Get information
if (isset($query))
{
    include_once('api/v1/search.php');
    $slist = search($query, $count, $offset);
}
elseif (isset($id))
{
    include_once('api/v1/info.php');
    $info = info($id);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
include_once("head.php");
?>
<script src="index.js" async></script>
<?php
echo '
<style>
body {
    background-image: url(\'https://student2.cs.appstate.edu/'.getenv(path).'images/main.jpg\');
    background-size: 100%
}
</style>';
?>
</head>
<body>
    <noscript>
	We recommend Javascript for the full ADS experience.<br>
	You can still use the site, but features like single-page loading and analytics will be unavailable.
    </noscript>
<?php
# TODO: write the main page stuff
# Topbar and other dynamic/multi referenced content goes here
include_once("topbar.php");
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
