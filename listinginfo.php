<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 400px;
  //margin: auto;
  text-align: center;
  font-family: arial;
}

.price {
  color: grey;
  font-size: 22px;
}

.card button {
  border: none;
  outline: 0;
  padding: 12px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

.card button:hover {
  opacity: 0.7;
}
</style>
=======
<?php
include_once("head.php");
include_once("topbar.php");
?>
</head>
<body>
<div class="grid-x grid-padding-x align-spaced">
<?php
$count = 0;
while($count < 100) {
    echo '
<div class="cell large-2">
<div class="card">
  <img src="https://img.ltwebstatic.com/images3_pi/2021/06/21/1624245547a605ea017707bd0e8a063d73ec9e46a7_thumbnail_600x.webp" alt="Denim Jeans" style="width:100%">
  <h1>Tailored Jeans</h1>
  <p class="price">$19.99/mo</p>
  <p>Link to reviews..</p>
  <p><button>Rent</button></p>
  </div>
  </div>';
  $count = $count + 1;
}
?>
</div>
<script>
$(document).foundation();
</script>
</body>
</html>
