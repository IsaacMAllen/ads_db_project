<?php
include("api/v1/guard.php");
?>
<style>
body
{
    background-color: #222222;
    color: #DDDDDD;
}

body *
{
    background-color: #222222;
    color: #DDDDDD;
}

#top-bar
{
    background-color: #000000;
    color: #CCCCCC;
}

#top-bar *
{
    background-color: #000000;
    color: #CCCCCC;
}

#top-bar button
{
    background-color: #0000CC;
    color: #CCCCCC;
}
</style>
<div class="top-bar" id="top-bar">
    <div class="top-bar-left">
        <ul class="dropdown menu" data-dropdown-menu>
            <li class="menu-text">ADS.com</li>
            <li>
                <a href="?type=recent">Offers</a>
                <ul class="menu vertical">
                    <li><a href="?type=renters&count=25">Renters</a></li>
                    <li><a href="?type=rentees&count=25">Clients</a></li>
                    <li><a href="?type=product&count=25">Products</a></li>
                    <li><a href="?type=service&count=25">Services</a></li>
                </ul>
            </li>
            <li><a href="features.php">Features</a></li>
            <li><a href="about.php">About Us</a></li>
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
