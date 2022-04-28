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
	    <li>

	    <div id="login-icon">
		<?php 
		    echo '
		    <img src="'.getenv(path).'icon/icon-login.png" height="10">
		    ';
		?>
	    </div>
	    </li>
	    <li><input type="search" placeholder="Search"></li>
            <li><button type="button" class="button">Search</button></li>
        </ul>
    </div>
</div>

	    <div id="login-popup">
	            <form class="login-form" action="" id="login-form"
	                method="post" enctype="multipart/form-data">
	                <h1>Login</h1>
	                <div>
	                    <div>
	                        <label>Name: </label><span id="userName-info"
	                            class="info"></span>
	                    </div>
	                    <div>
	                        <input type="text" id="userName" name="userName"
	                            class="inputBox" />
	                    </div>
	                </div>
	                <div>
	                    <div>
	                        <label>Email: </label><span id="userEmail-info"
	                            class="info"></span>
	                    </div>
	                    <div>
	                        <input type="text" id="userEmail" name="userEmail"
	                            class="inputBox" />
	                    </div>
	    	    </div>
	    	    <div>
	                    <input type="submit" id="send" name="send" value="Send" />
	                </div>
	            </form>
	    </div>
<script>
$(document).ready(function () {
    $("#login-icon").click(function () {
	$("#login-popup").show();
    });
    //Login Form validation on click event
	$("#login-form").on("submit", function () {
	    var valid = true;
	    $(".info").html("");
	    $("inputBox").removeClass("input-error");

	    var userName = $("#userName").val();
	    var userEmail = $("#userEmail").val();

	    if (userName == "") {
		$("#userName-info").html("required.");
		$("#userName").addClass("input-error");
	    }
	    if (userEmail == "") {
		$("#userEmail-info").html("required.");
		$("#userEmail").addClass("input-error");
		valid = false;
	    }
	    if (!userEmail.match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/))
	    {
		$("#userEmail-info").html("invalid.");
		$("#userEmail").addClass("input-error");
		valid = false;
	    }
	    return valid;
	});
});
</script>
</nav>
