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
    header('HTTP/1.1 400 Bad Request');
    die("Bad CSRF token");
}

# Now we use the password
$password = $_POST['userPassword'];

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
    add_rentee($userId, $password, $email);
    $_SESSION['user'] = $userId;
    redirect();
}
elseif ($_POST['login'] === 'Login')
{
    $email = $_POST['userEmail'];
    $_SESSION['user'] = is_rentee($password, $email);
    redirect();
}
elseif ($_POST['logout'] === 'Log Out')
{
    $_SESSION['user'] = NULL;
    redirect();
}

?>
