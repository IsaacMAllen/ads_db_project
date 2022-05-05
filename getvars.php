<?php
include("$directoryname/api/v1/guard.php");
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
$type = $params['type'];
$id = $params['id'];
# Get information
if (isset($query) or isset($type))
{
    include_once('api/v1/search.php');
    $slist = search($query, $count, $offset, $type);
}
elseif (isset($id))
{
    include_once('api/v1/info.php');
    $info = info($id);
}
?>
