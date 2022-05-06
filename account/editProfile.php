<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile Editor</title>
    <script src="https://code.jquery.com/jquery-1.10.2.js%22%3E"</script>
</head>
<h1><center> Edit your profile! </center></h1>
<body>
    <form id="editForm">
        <p> profile name:</p>
        <input type ="text" name = "profileName"> <br>
        <p>Password:</p>
        <input type = "text">
        <p>Tell customers about yourself! (Max 200 characters)</p>
        <input type="text" style = "height:100px;width:300px;" name = "bioHolder"><br>
        <input type = "Submit" value = "Update">
    </form>
<script>
$("#editForm").submit(function(event)){
event.preventDefault();
var $form = $(this),
profileName= $form.find("input[name='profileName']").val(),
url = "



</body>
</html>
