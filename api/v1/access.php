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

# Prepare some queries
$idquery1 = $pdo->prepare('SELECT * FROM FromId WHERE ProductId = ? OR RenterId = ? OR RenteeId = ?');
$idquery2 = $pdo->prepare('SELECT * FROM ? WHERE ? = ?');

# Define methods to use $pdo easily
function get_object_by_uuid($id)
{
    $idquery1->execute([$id, $id, $id]);
    # Call idquery2 intelligently
    $result = $idquery1->fetchAll();
    if (isset($result->ProductId))
    {
        $idquery2->execute(['project_product', 'productId', $result->ProductId]);
        return $idquery2->fetchAll();
    }
    elseif (isset($result->RenterId))
    {
        $idquery2->execute(['RenterUnauth', 'userId', $result->RenterId]);
        return $idquery2->fetchAll();
    }
    elseif (isset($result->RenteeId))
    {
        $idquery2->execute(['RenteeUnauth', 'userId', $result->RenteeId]);
        return $idquery2->fetchAll();
    }
    else
    {
        return NULL;
    }
}
function
?>
