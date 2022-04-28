<?php
include("api/v1/guard.php");
?>
<nav class="navbar navbar-default navbar-expand-lg " id="navbar">
<div class="top-bar">
    <div class="top-bar-left">
	    <?php
	    echo
	    '<ul class="dropdown menu" data-dropdown-menu>
	     <li class="menu-text-medium"><a href="'.getenv(path).'index.php">ADS.com</a></li>
             <li>
                <ul class="menu horizontal">
		    <li><a href="'.getenv(path).'offers/index.php">Offers</a></li>
                    <li><a href="'.getenv(path).'renter/index.php">Renters</a></li>
                    <li><a href="'.getenv(path).'client/index.php">Clients</a></li>
		    <li><a href="'.getenv(path).'catalog/index.php">Products/Services</a></li>
                </ul>
            </li>
            <li><a href="#"></a></li>
            <li><a href="#"></a></li>
	    </ul>'
	    ?>
    </div>
    <div class="top-bar-right">
        <ul class="menu">
            <!-- TODO: Add login option here with modal replaced with account dropdown -->
            <li><input type="search" placeholder="Search"></li>
            <li><button type="button" class="button">Search</button></li>
        </ul>
    </div>
</div>
</nav>
