<?php
include 'php/config.php';

$sql = "SELECT * FROM contracts_table ORDER BY Date_made DESC";
$result = mysqli_query($link, $sql);

$result_array = Array();

while($row = mysqli_fetch_assoc($result)){
    $result_array[] = $row;
}

$json_array = json_encode($result_array);
?>

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
    <br>
</header>
<div class = "headlink"><p>Log In/Create Account</p></div>
<div class = "headlink"><p>Home</p></div>
<button id = "make-contract" onclick = "clickedMake()">Make Contract</button>
<div id = "contract-holder" class = 'center-horizontal'>
</div>
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
console.log(arrayObjects);
function toDate(a){
// example MySQL DATETIME
const dateTime = a.Date_made;

let dateTimeParts = dateTime.split(/[- :]/); // regular expression split that creates array with: year, month, day, hour, minutes, seconds values
dateTimeParts[1]--; // monthIndex begins with 0 for January and ends with 11 for December so we need to decrement by one
console.log(dateTimeParts);
return(new Date(Date.UTC(...dateTimeParts))); // our Date object
};
function makeDisplay(a){
    var outcome = "<a href=\"https://brawlcalc.com/egginccontract.php?contract=" + a.ID + "\">";
    outcome += "<div class = \"holds-contract\" >";
    outcome += "<div>";
    if(a.Hidden === "0"){
        outcome += "<p class = \"contractName\">" + a.Name + "</p>";
    }
    else{
        outcome += "<p class = \"contractName hidden\">Name Hidden</p>";
    }
    outcome += "<div class = \"contractType\" style = \"display: inline-block;\"><p>" + (a.Type).toUpperCase() + " Egg Contract</p></div>";
    outcome += "<img src = \"cgi-bin/egginc/egg_" + a.Type + ".png\" style = \"width:100px display: inline-block;\"/>";
    outcome += "</div>";
    var seconds = Math.floor((new Date()).getTime() / 1000);
    var dateSeconds = toDate(a).getTime()/1000;
    console.log(seconds + "   " + dateSeconds);
    outcome += "<p class = \"contractName\">Made " + (Math.floor((seconds - dateSeconds) / 60) < 0 ? 0 : Math.floor((seconds - dateSeconds) / 60)) + " minutes ago</p>";
    outcome += "</div>";
    outcome += "</a>";
    return outcome;
};
for(var i = 0; i < arrayObjects.length; i ++){
    putinto.innerHTML += makeDisplay(arrayObjects[i]);
}
function clickedMake(){
    window.location.href = "https://brawlcalc.com/eggincmakecontract.php"
}
</script>
</html>