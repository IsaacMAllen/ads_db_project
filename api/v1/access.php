<?php
# Get credentials
include('guard.php');
include_once('get-group-password.php');
# Credentials
$host = 'localhost';
$db = 'CS_2022_Spring_3430_101_t1';
$user = 'joneshl4';
$password = $GLOBALS['group-sql-password'];

# Data source name and connect!
$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
try
{
    $pdo = new PDO($dsn, $user, $password);
}
catch (PDOException $e)
{
    die("Could not connect to the database. Contact a sysadmin with this: " + $e->getMessage());
}

# Safety
$password = $user = $db = $host = '';

# Prepare some queries to get information based on ids from the database
$idquerycombined = 'SELECT productId, name, cost FROM project_product WHERE productId = ? ';

$idqueryproduct = $pdo->prepare($idquerycombined . 'AND tflag = \'I\'');
$idqueryproduct->setFetchMode(PDO::FETCH_ASSOC);
$idqueryservice = $pdo->prepare($idquerycombined . 'AND tflag = \'S\'');
$idqueryservice->setFetchMode(PDO::FETCH_ASSOC);
$idqueryrentee = $pdo->prepare('SELECT * FROM RenteeUnauth WHERE userId = ?');
$idqueryrentee->setFetchMode(PDO::FETCH_ASSOC);
$idqueryrenter = $pdo->prepare('SELECT * FROM RenterUnauth WHERE userId = ?');
$idqueryrenter->setFetchMode(PDO::FETCH_ASSOC);

# Define methods to use $pdo easily
function get_object_by_uuid($id)
{
    # So many globals aghhhh!
    global $pdo, $idqueryproduct, $idqueryservice, $idqueryrentee, $idqueryrenter;
    $idqueryproduct->execute(array($id));
    $result = $idqueryproduct->fetchAll()[0];
    # Run this for every table. This looks generated by an online service but is unfortunately not.
    if (isset($result['productId']))
    {
        return $result + array('type' => 'product');
    }
    # New feature: Service/product differentiation
    $idqueryservice->execute(array($id));
    $result = $idqueryservice->fetchAll()[0];
    if (isset($result['productId']))
    {
        return $result + array('type' => 'service');
    }
    # Now for rentee/renters
    $idqueryrentee->execute(array($id));
    $result = $idqueryrentee->fetchAll()[0];
    # Don't call idquery2 intelligently, that's not intelligent at all
    # We tried using two queries but it didn't work--would have been slower anyway
    if (isset($result['userId']))
    {
        return $result + array('type' => 'renter');
    }
    # One last one. I need sleep.
    $idqueryrenter->execute(array($id));
    $result = $idqueryrenter->fetchAll()[0];
    if (isset($result['userId']))
    {
        return $result + array('type' => 'rentee');
    }
    return NULL;
}

# Get for hybrid search and stuff by building lots of strings
$cols_user = 'SELECT userId, profileName FROM ';
$cols_product = 'SELECT userId, name, cost, offered_on FROM ';
$profile_name = ' WHERE CONTAINS(profileName, ?)';
$name_product = ' WHERE CONTAINS(name, ?) AND tflag = \'I\' ';
$name_service = ' WHERE CONTAINS(name, ?) AND tflag = \'S\' ';
# Filtering for high quality results
$filter_profile_name = ' ORDER BY profileName';
$filter_name = ' ORDER BY name';
$filter_continued = ' DESC OFFSET ? ROWS FETCH NEXT ? ROWS ONLY';
# Renters and rentees
$search_query_rentee = $pdo->prepare($cols_user . 'RenteeUnauth' . $profile_name . $filter_profile_name . $filter_continued);
$search_query_rentee->setFetchMode(PDO::FETCH_ASSOC);
$search_query_renter = $pdo->prepare($cols_user . 'RenterUnauth' . $profile_name . $filter_profile_name . $filter_continued);
$search_query_renter->setFetchMode(PDO::FETCH_ASSOC);
# Fetch product entities
$search_query_product = $pdo->prepare($cols_product . 'project_product' . $name_product . $filter_name . $filter_continued);
$search_query_product->setFetchMode(PDO::FETCH_ASSOC);
# Fetch service entities
$search_query_service = $pdo->prepare($cols_product . 'project_product' . $name_service . $filter_name . $filter_continued);
$search_query_service->setFetchMode(PDO::FETCH_ASSOC);
# Get an object's information by its keywords
function get_object_by_keywords($kw = '', $count = 25, $offset = 0, $type = '')
{
    if ($count > 100 or ($count > 25 and $kw === ''))
    {
        return array('error' => 'request too large');
    }
    # Longer names but same amount of globals as last time
    global $search_query_rentee, $search_query_renter, $search_query_product, $search_query_service;
    $inputs = array($kw, $offset, $count);
    $results = array();
    $search_query_rentee->execute($inputs);
    $results->rentee = $search_query_rentee->fetchAll();
    $search_query_renter->execute($inputs);
    $results->renter = $search_query_renter->fetchAll();
    $search_query_product->execute($inputs);
    $results->product = $search_query_product->fetchAll();
    $search_query_service->execute($inputs);
    $results->service = $search_query_service->fetchAll();
    # Select results by type

    if (isset($results[$type]))
    {
        return $results[$type];
    }

    return $results;
}

?>
