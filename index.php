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
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
<?php
include_once("head.php");
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

# Grid/card space
function grid_boilerplate($list, $type, $readable_name)
{
    echo '<h1 class="text-center">' . $readable_name . '</h1>';
    echo <<<GRIDHEAD
<div class="grid-container">
<div class="grid-x grid-margin-x small-up-1 medium-up-3">
GRIDHEAD;
    # Print result cards one by one
    if (sizeof($list) < 1)
    {
        echo '<div class="cell">No results found in this section</div></div></div>';
        return;
    }
    foreach ($list as $item)
    {
        # If the item has a productId then get that, otherwise get the userId
        $itemid = $itemname = $price = $rent = '';
        if (isset($item->productId))
        {
            $itemid = $item->productId;
            $itemname = $item->name;
            $cost = $item->cost;
            $price = "<p class=\"price\">$${cost}/mo</p>";
            $rent = "<a href=\"/rent/?id={$itemid}\">Rent</a>";
        }
        else
        {
            $itemid = $item->userId;
            $itemname = $item->profileName;
        }
        # Insert the product card onto the page
        echo <<<PRODUCTCARD
    <div class="cell">
    <div class="card">
    <img src="api/v1/image.php?id=$itemid&type=$type">
    <div class="card-section">
    <h1>$itemname</h1>
    $price
    <p><a href="/reviews/?id=$itemid">See Reviews</a></p>
    $rent
    </div></div></div>
    PRODUCTCARD;
    }
    echo '</div></div>';
}

# Hero section of the page should be loaded when not using a query
if (!isset($info) and !isset($slist))
{
    echo <<<END
    <div class="hero-section">
        <div>
        <div class="hero-section-text">
            <h1 id="hero">AdsDb</h1>
        </div>
        <form method="post" enctype="multipart/form-data" class="search-form"
        action="https://${sname}$directoryname/">
            <input type="text" name="q" placeholder="Discover the possiblities">
            <button type="submit" class="button">Search</button>
        </form>
        </div>
        <div class="hero-section-text">
            <h5 id="herosub">Renting Together</h5>
        </div>    
    </div>
    END;

}
elseif (isset($info))
{
    # TODO: Add item info page with a "Rent Now" option
}
elseif (isset($slist)) # Search page
{
    $slist = json_decode($slist);
    if (isset($type)) # Does the search have a type field
    {
        grid_boilerplate($slist, $type, "Results");
    }
    else
    {
        grid_boilerplate($slist->product, 'product', "Products");
        grid_boilerplate($slist->service, 'service', "Services");
        grid_boilerplate($slist->renter, 'renter', "Renters");
        grid_boilerplate($slist->rentee, 'rentee', "Clients");
    }
}
?>
    
<script>
$(document).foundation();
</script>
</body>
</html>
