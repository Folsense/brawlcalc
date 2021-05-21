<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-131365207-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-131365207-1');
</script>

<link rel="stylesheet" type="text/css" href="../css/eggmain.css">
<meta name="viewport" content="width=1000">
</head>
<body>
<header>
<div class = "headdiv">
    <img src = "cgi-bin/logostar.png" />
    <p>Brawl Stars Group Finder</p>
    <img src = "cgi-bin/logostar.png" />
</div>
</header>
<a href = "https://brawlcalc.com/player.php"><div class = "headlink"><p>Link Player Tag</p></div></a><a href = "https://brawlcalc.com/findgroup.php"><div class = "headlink"><p>Home</p></div></a>
<div id = "loginschlop" class = "center-horizontal">
<div class = 'loginback'>
<form action="php/play.php" method = "get" class = "loginbox">
    <h3>LINK TAG</h3><br>
    <label>Player Tag:</label><br><input type = "text" name = "username" class = "textbox" maxlength="20"/><br><br>
    <input type = "submit" value = "LINK" class = "subbutton"/><br>
    <p style = "color: red; margin-bottom: 0; padding: 0 15px;">Linking may take a few seconds. Please don't close the page.</p>
    <p id = "login-message" style = "margin-top: 10px; padding: 0 15px;"><?php 
if(isset($_GET["message"])){echo Array("In order to create a group, you must link your player tag.", "You must wait five minutes between creating advertisements.", "New accounts must wait ten minutes before making an advertisement.")[$_GET["message"]];}
elseif(strlen($_SESSION['message']) > 0){echo $_SESSION['message'];}
elseif(isset($_SESSION["name"])){echo "Hello, ".$_SESSION["name"];}
?></p>
</form>
</div>
<img class = "centergif" width = "400px" src = "cgi-bin/linktag.gif">
</div>
<footer id = "credithead">This content is not affiliated with, endorsed, sponsored, or specifically approved by Supercell and Supercell is not responsible for it. For more information see Supercell's Fan Content Policy: www.supercell.com/fan-content-policy.<br>This content is powered by brawlapi.cf</footer>
<div id="cookieConsent">
    This website is using cookies for your convenience and improved ad targeting. <a href="\privacy.html">More info</a>. <a id = "cookiesok" class="cookieConsentOK">That's Fine</a>
</div>
</body>
<script>
document.getElementById("cookiesok").onclick = function() {
        document.getElementById("cookieConsent").style.display = "none";
};
</script>
</html>