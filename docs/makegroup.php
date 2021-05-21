<?php
if(isset($_GET['message'])){
    $message = Array("You need to fill in more information!")[$_GET['message']];
    echo "<script type='text/javascript'>alert('$message');</script>";
    $url = strtok($url, '?');
}
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
<div id = "contract-profile" class = 'center-horizontal'>
<form method="get" action = "php/addgroup.php">
    <div class = 'center-plzcssbad'>
    <div class = 'contractthing'>
        <img src = "cgi-bin/logostar.png" class = "eggimg2" id = "eggimg"/>
        <select onchange="changeEgg()" id = "eggchange" name = "eggtype">
            <option value="logostar">None Chosen</option>
            <option value="GEMGRAB">Gem Grab</option>
            <option value="BOUNTY">Bounty</option>
            <option value="HEIST">Heist</option>
            <option value="BRAWLBALL">Brawl Ball</option>
            <option value="SIEGE">Siege</option>
            <option value="DUOSHOWDOWN">Duo Showdown</option>
        </select>
        </div>
        <div class = "holds-text">
        <div id = "contractHiddenDiv">
        <p>Map Name:&nbsp;</p>
        <input type="text" name="mapname" maxlength="20" class = "contractNamey"></input>
        </div>
        <div id = "contractHiddenDiv">
        <p>Group Code:</p>
        <input type="text" name="contractname" maxlength="12" class = "contractNamey"></input>
        </div>
        <div id = "contractHiddenDiv">
        <p>Required Trophies:</p>
        <input type="text" name="contracthidden" id = "contractHidden" maxlength="9"><br>
        </div>
        </div>
        <div style = "display: inline-block; vertical-align: top; margin-top: 65px; margin-left: 30px;">
        <img class = "centergif" src = "cgi-bin/getcode.gif" width = "300px">
        </div>
    </div>
    <div class = 'center-plzcssbad'>
        <h2 class = "icantcssandthisisntcentered">Description:</h2>
        <textarea id = "descriptionText" maxlength="400" name = "contractdescription"></textarea>
        <br>
        <h2 class = "icantcssandthisisntcentered" style = "margin-top: 15px;">Wanted Brawlers:</h2>
        </div>
        <div id = "wantedBrawlers">
        <textarea name = "chosenbrawlers" style = "display: none;" id = "putbrawlershere"></textarea>
        </div>
        <div class = 'center-plzcssbad'>
        <div class = "icantcssandthisisntcentered">
        <input type = "submit" value = "Create Group" class = "subbutton" style = "margin: 20px auto 0; display: block; width: 300px; height: 50px; "/><br>
        </div>
        </div>
        </div>
    </form>
</div>
<br>
<br>
<br>
<br>
<br>
<footer id = "credithead">This content is not affiliated with, endorsed, sponsored, or specifically approved by Supercell and Supercell is not responsible for it. For more information see Supercell's Fan Content Policy: www.supercell.com/fan-content-policy.<br>This content is powered by brawlapi.cf</footer>
</body>
<script>
function changeEgg(){
document.getElementById("eggimg").src = "cgi-bin/" + document.getElementById("eggchange").value + ".png";
};

var wanted = [];

function addBrawler(){};

var selected = [];

var numselected = 0;

function toggle(e){
if (e.classList.contains('toggled')) {
    e.classList.remove('toggled');
    e.classList.add('untoggled');
    numselected--;
} 
else if (e.classList.contains('untoggled') && numselected < 3) {
    e.classList.remove('untoggled');
    e.classList.add('toggled');
    numselected++;
}
selected = [];
var outstring = "";
for(var i = 0; i < brawlers.length; i ++){
    var searching = document.getElementById(brawlers[i] + "div");
    if(searching.classList.contains('toggled')){
        outstring += brawlers[i] + " ";
    }
}
document.getElementById("putbrawlershere").value = outstring;
}

var brawlers = ['shelly', 'nita', 'colt', 'bull', 'jessie', 'brock', 'mike', 'bo', 'tick', 'primo', 'barley', 'poco', 'rosa', 'rico', 'darryl', 'penny', 'carl', 'piper', 'pam', 'bibi', 'frank', 'mortis', 'tara', 'gene', 'spike', 'crow', 'leon'];

var divy = document.getElementById("wantedBrawlers");
var wide = 210;
var high = 180;
var space = divy.offsetWidth;
var perrow = Math.floor(space / wide);
console.log(perrow + "   " + document.getElementById("wantedBrawlers").offsetWidth);
document.getElementById("wantedBrawlers").style.width = perrow * wide + "px";
document.getElementById("wantedBrawlers").style.height = Math.ceil(brawlers.length / perrow) * high + "px";

var brawlers2 = [['shelly', 'nita', 'colt', 'bull', 'jessie', 'brock', 'mike', 'bo', 'tick'], ['primo', 'barley', 'poco'], ['rico', 'darryl', 'penny'], ['piper', 'pam', 'frank'], ['mortis', 'tara'], ['spike', 'crow', 'leon']];
var backs = ['blue', 'blue', 'blue', 'blue', 'blue', 'blue', 'blue', 'blue', 'blue', 'green', 'green', 'green', 'green', 'darkblue', 'darkblue', 'darkblue', 'darkblue', 'purple', 'purple', 'purple', 'purple', 'red', 'red', 'red', 'yellow', 'yellow', 'yellow'];
var add = "";
add += "<table>"
for(var i = 0; i < brawlers.length; i ++){
    add += "<div onclick = \'toggle(this)\' class = 'untoggled tablecont' id = \'" + brawlers[i] + "div\'><div class = 'brawlerimg'><img class = 'heroimg' src = \'cgi-bin/" + brawlers[i] + ".png\'><img class = 'backimg' src = \'cgi-bin/back_" + backs[i] + ".jpg\'></div></div>";
    }
add += "</table>"
document.getElementById("wantedBrawlers").innerHTML += add;
document.getElementById("wantedBrawlers").height += 150;
</script>
</html>