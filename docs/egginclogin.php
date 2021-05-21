<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/eggmain.css">
</head>
<body>
<header>
    <img src = "cgi-bin/egginc/icon_chick.png" />
    <p>Egg, Inc. Contract Finder</p>
    <img src = "cgi-bin/egginc/icon_zzz.png" />
</header>
<div id = "loginschlop" class = "center-horizontal">
<div class = 'loginback'>
<form method = "POST" action = "php/login.php" class = "loginbox">
    <h3>LOG INTO ACCOUNT</h3><br>
    <label>Username:</label><br><input type = "text" name = "username" class = "textbox" maxlength="20"/><br><br>
    <label>Password: </label><br><input type = "password" name = "password" class = "textbox" maxlength="30"/><br><br>
    <input type = "submit" value = "Log In" class = "subbutton"/><br>
</form>
</div>
<div class = 'loginback'>
<form method = "POST" action = "php/accountmake.php" class = "loginbox">
    <h3>CREATE ACCOUNT</h3><br>
    <label>Username:</label><br><input type = "text" name = "username" class = "textbox" maxlength="20"/><br><br>
    <label>Password: </label><br><input type = "password" name = "password" class = "textbox" maxlength="30"/><br><br>
    <input type = "submit" value = "Create Account" class = "subbutton"/><br>
</form>
</div>
</div>
<p id = "login-message"><?php 
$messages = array("Login failed", "Username is taken! Try another?", "Account made successfully! Now log in!");
echo $messages[$_GET["message"]]; 
?></p>
</body>
<script>
</script>
</html>