<?php
include_once 'php/config.php';

session_start();

$stmt = mysqli_prepare($link, "SELECT * FROM contracts_table ORDER BY Date_made DESC LIMIT 100");

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

/*$sql = "SELECT * FROM contracts_table ORDER BY Date_made DESC";
$result = mysqli_query($link, $sql);*/

$result_array = Array();

while($row = mysqli_fetch_assoc($result)){
    $result_array[] = $row;
}

$stmt = mysqli_prepare($link, "SELECT * from users_table WHERE Tag = ?");
mysqli_stmt_bind_param($stmt, 's', $_SESSION['tag']);
mysqli_stmt_execute($stmt);
$result = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
$groupout = $result['Groupout'];
$lasttime = $result['Last_time'];
$_SESSION['groupout'] = $result['Groupout'];
$_SESSION['lasttime'] = $result['Last_time'];

$json_array = json_encode($result_array);
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

<meta name="viewport" content="width=1000">
<link rel="stylesheet" type="text/css" href="../css/eggmain.css">
</head>
<body style = "margin-bottom: 10px;">
<header>
<div class = "headdiv">
    <img src = "cgi-bin/logostar.png" />
    <p>Brawl Stars Group Finder</p>
    <img src = "cgi-bin/logostar.png" />
</div>
</header>
<a href = "https://brawlcalc.com/player.php"><div class = "headlink"><p>Link Player Tag</p></div></a><a href = "https://brawlcalc.com/findgroup.php"><div class = "headlink"><p>Home</p></div></a>
<button id = "make-contract" onclick = "clickedMake()" style = "font-family: alwaystogether !important;">Make Group</button>
<form>
<div id = "filterdiv">
<div style = "margin: 0 auto; width: 90%; overflow: none;">
<div class = "filterdivy">
<div class = "ughanotherdiv">
<p>Select Mode:&nbsp;</p>
<div class = "selectboxesaredum">
<select onchange="changeEgg()" id = "eggchange">
            <option value="none">Any</option>
            <option value="GEMGRAB">Gem Grab</option>
            <option value="BOUNTY">Bounty</option>
            <option value="HEIST">Heist</option>
            <option value="BRAWLBALL">Brawl Ball</option>
            <option value="SIEGE">Siege</option>
            <option value="DUOSHOWDOWN">Duo Showdown</option>
</select>
</div>
</div>
</div>
<div class = "filterdivy">
<div class = "ughanotherdiv">
<p>Trophy Req.:&nbsp</p>
<input type = "number" id = "wantedtrophies" value = "0"></input>
</div>
</div>
<div class = "filterdivy">
<div class = "ughanotherdiv">
<button onclick = "applyfilter()" style = "width: auto;" type = "button">Apply Filter</button>
</div>
</div>
</div>
</div>
</form>
<div id = "contract-holder" class = 'center-horizontal' style = "padding-bottom: 10px;">
</div>
<footer id = "credithead">This content is not affiliated with, endorsed, sponsored, or specifically approved by Supercell and Supercell is not responsible for it. For more information see Supercell's Fan Content Policy: www.supercell.com/fan-content-policy.<br>This content is powered by brawlapi.cf</footer>
</body>
<script>
var putinto = document.getElementById("contract-holder");
var arrayObjects = <?php echo $json_array; ?>;
var cellwidth = 350;
var cellmargin = 40;
var space = putinto.offsetWidth;
var perline = Math.floor(space / (cellwidth + cellmargin));
var leftover = space % (cellwidth + cellmargin);
putinto.style.width = perline * (cellwidth + cellmargin) + "px";
putinto.style.innerWidth = perline * (cellwidth + cellmargin) + "px";
function toDate(a){
// example MySQL DATETIME
const dateTime = a.Date_made;

let dateTimeParts = dateTime.split(/[- :]/); // regular expression split that creates array with: year, month, day, hour, minutes, seconds values
dateTimeParts[1]--; // monthIndex begins with 0 for January and ends with 11 for December so we need to decrement by one
return(new Date(Date.UTC(...dateTimeParts))); // our Date object
};
function makeDisplay(a){
    var outcome = "<a href=\"https://brawlcalc.com/groupprofile.php?contract=" + a.ID + "\">";
    outcome += "<div class = \"holds-contract\" >";
    var tag = "<?php if(isset($_SESSION['tag'])){
        echo($_SESSION['tag']);
        }
        else{
        echo(0);
        } ?>";
    if(a.maker_tag == tag){
        outcome += "<form action = \"php/deletegroup.php\" method = \"POST\">";
        outcome += "<input type = \'text\' name = \'deleteid\' value = \"" + a.ID + "\" style = \"display:none;\">";
        outcome += "<input type = \'submit\' name = \'submitid\' value = \"Delete Advertisement\" style = \"margin-top: -5px; border-radius: 5px; background: red; width: 200px; height: 30px; font-size: 20px; line-height: 31px;\">";
        outcome += "</form>";
    }
    outcome += "<div>";
    outcome += "<p class = \"contractName hidden\">Code: " +  a.Code + "</p>";
    if(a.Required_trophies > 0){
    outcome += "<p class = \"contractName\">Required Trophies: " +  a.Required_trophies + "</p>";
    }
    outcome += "<div class = \"contractType\" style = \"display: inline-block;\"><p>" + toActual(a.Type) + "&#160</p></div>";
    outcome += "<img src = \"cgi-bin/" + a.Type + ".png\" style = \"width:100px display: inline-block; margin-left: 0; margin-right: 0;\"/>";
    outcome += "</div>";
    outcome += "<p class = \"contractName\">Made by " +  a.maker + " (" + a.maker_trophies + " trophies)</p>";
    if(a.Map.length > 0){
    outcome += "<div class = \"contractType\" style = \"display: inline-block; height: 50px;\"><p style = \"height: 50px; line-height: 50px;\">Map: " + a.Map + "</p></div>";
    }
    var seconds = Math.floor((new Date()).getTime() / 1000);
    var dateSeconds = toDate(a).getTime()/1000;
    outcome += "<p class = \"contractName\">Made " + (Math.floor((seconds - dateSeconds) / 60) < 0 ? 0 : Math.floor((seconds - dateSeconds) / 60)) + " minutes ago</p>";
    var wanted = a.Brawlers.split(" ");
    var wantstrng = "<br>";
    for(var i = 0; i < wanted.length; i ++){
        wantstrng += wanted[i].toUpperCase();
    if(i !== wanted.length - 1){
        wantstrng += "<br>";
    }
    }
    if(wanted.length - 1 > 0){
    outcome += "<div class = \"contractType\" style = \"display: inline-block; height: " + (wanted.length * 30 + 10) + "px !important;\"><p style = \"line-height: 30px; height: " + (wanted.length * 30 + 10) + "px !important;\">Wanted Brawlers: " + wantstrng + "</p></div>";
    }
    outcome += "</div>";
    outcome += "</a>";
    return outcome;
};
window.onload = function(){
for(var i = 0; i < arrayObjects.length; i ++){
    putinto.innerHTML += makeDisplay(arrayObjects[i]);
}
putinto.innerHTML += "<div height = 100px;><br><br><br></div>"
}
console.log(<?php echo $_SESSION["groupout"];?>);
function clickedMake(){
    var groupout = <?php 
    if(isset($_SESSION['groupout'])){
        echo $_SESSION['groupout'];
    }
    else{
        echo 4;
    } ?>;
    if(groupout === 4){
        window.location.href = "https://brawlcalc.com/player.php?message=0";
    }
    else if (groupout === 0){
        window.location.href = "https://brawlcalc.com/makegroup.php"; 
    }
    if(groupout === 1 || groupout === 2){
    var seconds = Math.floor((new Date()).getTime() / 1000);
    var dateSeconds = <?php if(isset($_SESSION["lasttime"])){echo $_SESSION["lasttime"];}else{echo 9999999999;}?>;
    var timesince = seconds - dateSeconds;
    console.log(timesince);
    if (groupout === 1){
    if(timesince < 60 * 5){
        window.location.href = "https://brawlcalc.com/player.php?message=1";
    }
    else{
        <?php
        /*include_once 'php/config.php';
        $stmt = mysqli_prepare($link, "SELECT * FROM users_table WHERE Tag = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, 's', $_SESSION['tag']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $row['Groupout'] = 0;*/
        ?>
        window.location.href = "https://brawlcalc.com/makegroup.php";
    }
    }
    if (groupout === 2){
    if(timesince < 60 * 10){
        window.location.href = "https://brawlcalc.com/player.php?message=2";
    }
    else{
        <?php
        /*include_once 'php/config.php';
        $stmt = mysqli_prepare($link, "INSERT INTO users_table (Tag, Name, Trophies, Groupout, Last_time) VALUES (\"tag".time()."\", \"LlamaTraum\", 40, 2, 1209324)");
        $stmt = mysqli_prepare($link, "UPDATE users_table SET Groupout = 0 WHERE Tag = ?");
        mysqli_stmt_bind_param($stmt, 's', $_SESSION['tag']);
        mysqli_stmt_execute($stmt);*/
        ?>
        window.location.href = "https://brawlcalc.com/makegroup.php";
    }
    }
    }
}
function toActual(a){
    if(a === "DUOSHOWDOWN"){
        return("Duo Showdown")
    }
    if(a === "HEIST"){
        return("Heist")
    }
    if(a === "BRAWLBALL"){
        return("Brawl Ball")
    }
    if(a === "GEMGRAB"){
        return("Gem Grab")
    }
    if(a === "SIEGE"){
        return("Siege")
    }
    if(a === "BOUNTY"){
        return("Bounty")
    }
}
function applyfilter(){
putinto.innerHTML = "";
var mode = document.getElementById("eggchange").value;
var trophies = document.getElementById("wantedtrophies").value;
if(document.getElementById("wantedtrophies").length === 0){
    trophies = 0;
}
console.log(mode + "   " + trophies);
for(var i = 0; i < arrayObjects.length; i ++){
    var j = arrayObjects[i];
    console.log(j.Type + "   " + j.Required_trophies);
    if((j.Type === mode || mode === "none") && j.Required_trophies >= trophies){
        putinto.innerHTML += makeDisplay(arrayObjects[i]);
    }
}
};
</script>
</html>