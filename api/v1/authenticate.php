<?php
# Start the session
session_start();
$directoryname = dirname($_SERVER['SCRIPT_NAME']);
# This is so that things can be compared against the database.
include("access.php");
# This will ONLY have POST support because that's how it works
if ($_SERVER['REQUEST_METHOD'] !== 'POST')
{
    header('HTTP/1.1 400 Bad Request');
    die("For security, access this form through a POST request");
}

# Check if the CSRF token is correct
if (!hash_equals(hash_hmac('sha256', "api/v1/authenticate.php", $_SESSION['token']),
    $_POST['token']))
{
    echo $_POST['token'] . " " . hash_hmac('sha256', "$directoryname/authenticate.php", $_SESSION['token']);
    header('HTTP/1.1 400 Bad Request');
    die("Bad CSRF token");
}

# Now we use the password
$input_password_hash = password_hash($_POST['userPassword'], PASSWORD_BCRYPT);

# Redirect function
function redirect()
{
    $query_string = parse_str($_SERVER["QUERY_STRING"]);
    header("HTTP/1.1 302 Redirect");
    if (isset($_POST["redir"]))
    {
        header("Location: " . urldecode($_POST["redir"]));
    }
    else
    {
        header("Location: about:blank");
    }
}

# If the user is registering, create the user in the database and login
# No need to check passwords this time!
if ($_POST['register'] === 'Register')
{
    $email = $_POST['userEmail'];
    $userId = strtr(base64_encode(uniqid()), '+/=', '._-');
    add_rentee($userId, $input_password_hash, $email);
    redirect();
}
elseif ($_POST['login'] === 'Login')
{

}

?>
