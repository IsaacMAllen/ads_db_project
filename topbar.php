<?php
include("api/v1/guard.php");
?>
<div class="top-bar">
    <div class="top-bar-left">
        <ul class="dropdown menu" data-dropdown-menu>
            <li class="menu-text">ADS.com</li>
            <li>
                <a href="#">Offers</a>
                <ul class="menu vertical">
                    <li><a href="#">Renters</a></li>
                    <li><a href="#">Clients</a></li>
                    <li><a href="#">Products</a></li>
                    <li><a href="#">Services</a></li>
                </ul>
            </li>
            <li><a href="#">Features</a></li>
            <li><a href="#">About Us</a></li>
        </ul>
    </div>
    <div class="top-bar-right">
        <ul class="menu">
            <!-- TODO: Add login option here with modal replaced with account dropdown -->
            <li><input type="search" placeholder="Search"></li>
            <li><button type="button" class="button">Search</button></li>
        </ul>
    </div>
</div>