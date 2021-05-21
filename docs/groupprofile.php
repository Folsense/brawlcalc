<?php
include 'php/config.php';

$num = $_GET["contract"];

$sql = "SELECT * FROM contracts_table WHERE ID = '".$num."' LIMIT 1";
$result = mysqli_query($link, $sql);

$resulta = mysqli_fetch_assoc($result);

$json_array = json_encode($resulta);
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=1000">
<link rel="stylesheet" type="text/css" href="../css/eggmain.css">
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
    <div class = 'center-plzcssbad'>
    <div class = 'contractthing'>
        <img <?php echo "src = \"cgi-bin/".$resulta['Type'].".png\""; ?> class = "eggimg2" id = "eggimg"/>
        </div>
        <div class = "holds-text">
        <div id = "contractHiddenDiv">
        <p>Map Name: <?php echo $resulta['Map']; ?></p>
        </div>
        <div id = "contractHiddenDiv">
        <p>Group Code: <?php echo $resulta['Code']; ?></p>
        </div>
        <div id = "contractHiddenDiv">
        <p>Required Trophies: <?php echo $resulta['Required_trophies']; ?></p>
        </div>
        </div>
        <div style = "display: inline-block; vertical-align: top; margin-top: 65px; margin-left: 30px;">
        <img class = "centergif" src = "cgi-bin/usecode.gif" width = "300px">
        </div>
    </div>
    <div class = 'center-plzcssbad'>
        <div class = 'center-plzcssbad'>
        <h2 id = "sincewhen">Made </h2>
    </div>
    <div class = 'center-plzcssbad'>
        <h4><?php echo $resulta['Description']; ?></h2>
    </div>
        <br>
        <h2 class = "icantcssandthisisntcentered" style = "margin-top: 15px;">Wanted Brawlers:</h2>
        </div>
        <div id = "wantedBrawlers">
        <textarea name = "chosenbrawlers" style = "display: none;" id = "putbrawlershere"></textarea>
        </div>
        <div class = 'center-plzcssbad'>
        <div class = "icantcssandthisisntcentered">
        </div>
        </div>
        </div>
</div>
<footer id = "credithead">This content is not affiliated with, endorsed, sponsored, or specifically approved by Supercell and Supercell is not responsible for it. For more information see Supercell's Fan Content Policy: www.supercell.com/fan-content-policy.<br>This content is powered by brawlapi.cf</footer>
</body>
<script>
function changeEgg(){
document.getElementById("eggimg").src = "cgi-bin/" + document.getElementById("eggchange").value + ".png";
};

var wanted = [];

function addBrawler(){};

var selected = [];

var brawlers = "<?php echo $resulta['Brawlers'] ?>";

console.log(brawlers);

brawlers = brawlers.split(" ");

var divy = document.getElementById("wantedBrawlers");
var wide = 210;
var high = 180;
var space = divy.offsetWidth;
var perrow = Math.floor(space / wide);
console.log(perrow + "   " + document.getElementById("wantedBrawlers").offsetWidth);
document.getElementById("wantedBrawlers").style.width = perrow * wide + "px";
document.getElementById("wantedBrawlers").style.height = Math.ceil(brawlers.length / perrow) * high + "px";

var brwlers = ['shelly', 'nita', 'colt', 'bull', 'jessie', 'brock', 'mike', 'bo', 'tick', 'primo', 'barley', 'poco', 'rosa', 'rico', 'darryl', 'penny', 'carl', 'piper', 'pam', 'bibi', 'frank', 'mortis', 'tara', 'gene', 'spike', 'crow', 'leon'];
function getIndex(a){
    var index = 0;
    for(var i = 0; i < brwlers.length; i ++){
        if(brwlers[i] == a){
            return(i);
        }
        else{
            index ++;
        }
    }
    return(0);
};
var brawlers2 = [['shelly', 'nita', 'colt', 'bull', 'jessie', 'brock', 'mike', 'bo', 'tick'], ['primo', 'barley', 'poco'], ['rico', 'darryl', 'penny'], ['piper', 'pam', 'frank'], ['mortis', 'tara'], ['spike', 'crow', 'leon']];
var backs = ['blue', 'blue', 'blue', 'blue', 'blue', 'blue', 'blue', 'blue', 'blue', 'green', 'green', 'green', 'green', 'darkblue', 'darkblue', 'darkblue', 'darkblue', 'purple', 'purple', 'purple', 'purple', 'red', 'red', 'red', 'yellow', 'yellow', 'yellow'];
var add = "";
add += "<table>"
for(i = 0; i < brawlers.length - 1; i ++){
    add += "<div onclick = \'toggle(this)\' class = 'untoggled tablecont' id = \'" + brawlers[i] + "div\'><div class = 'brawlerimg'><img class = 'heroimg' src = \'cgi-bin/" + brawlers[i] + ".png\'><img class = 'backimg' src = \'cgi-bin/back_" + backs[getIndex(brawlers[i])] + ".jpg\'></div></div>";
    }
add += "</table>"
document.getElementById("wantedBrawlers").innerHTML += add;
document.getElementById("wantedBrawlers").height += 150;

function toDate(a){
// example MySQL DATETIME
const dateTime = a;

let dateTimeParts = dateTime.split(/[- :]/); // regular expression split that creates array with: year, month, day, hour, minutes, seconds values
dateTimeParts[1]--; // monthIndex begins with 0 for January and ends with 11 for December so we need to decrement by one
console.log(dateTimeParts);
return(new Date(Date.UTC(...dateTimeParts))); // our Date object
};

    var seconds = Math.floor((new Date()).getTime() / 1000);
    var datey = "<?php echo $resulta['Date_made'] ?>";
    var by = "<?php echo $resulta['maker'] ?>";
    var bytrophies = "<?php echo $resulta['maker_trophies'] ?>";
    console.log(datey);
    var dateSeconds = toDate(datey).getTime()/1000;
    document.getElementById("sincewhen").innerHTML += (Math.floor((seconds - dateSeconds) / 60) < 0 ? 0 : Math.floor((seconds - dateSeconds) / 60)) + " minutes ago by " + by + " (" + bytrophies + " trophies)</p>";
</script>
</html>