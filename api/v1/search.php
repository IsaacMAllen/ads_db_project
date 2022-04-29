<?php
include_once('access.php');

# Search function. This lets you search the database for a name, sorted alphabetically.
# Between count and offset
function search($kw, $count, $offset, $type)
{
    $results = json_encode(get_object_by_keywords($kw, $count, $offset, $type));
    return $results;
}

if (count(get_included_files()) === 4)
{
    header('Content-Type: application/json');
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

    echo search($query, $count, $offset, $type);
}
?>
