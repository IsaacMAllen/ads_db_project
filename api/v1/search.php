<?php
include_once('access.php');
header('Content-Type: application/json');

# Search function. This lets you search the database for a name, sorted alphabetically.
# Between count and offset
function search($kw, $count = 25, $offset = 0)
{
    $results = json_encode(get_object_by_keywords($kw, $count, $offset));
    return $results;
}

if (count(get_included_files()) === 4)
{
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

    # Get information from search
    $id = $params['q'];
    if (!isset($q))
    {
        echo 'undefined';
    }
    echo search($query, $count, $offset);
}
?>
