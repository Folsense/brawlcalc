<?php
include 'php/config.php';

if(isset($_POST["contractname"])){
$name = $_POST["contractname"];
$type = $_POST["eggtype"];
$hide = $_POST["contracthidden"];
$desc = $_POST["contractdescription"];
$show = 0;
if($hide === "hide"){
    $show = 1;
}

$stmt = mysqli_prepare($link, "INSERT INTO contracts_table (ID, Name, Hidden, Type, Description, Date_made) VALUES (NULL, ?, ?, ?, ?, UTC_TIMESTAMP())");

mysqli_stmt_bind_param($stmt, 'siss', $name, $show, $type, $desc);
mysqli_stmt_execute($stmt);

echo "<script type=\"text/javascript\">";
echo "window.location.replace(\"https://brawlcalc.com/egginc.php?message=1\")";
echo "</script>";
}
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
</header>
<div id = "contract-profile" class = 'center-horizontal'>
<form method="POST" action = "">
    <div class = 'center-plzcssbad'>
    <div class = 'contractthing'>
        <img src = "cgi-bin/egginc/egg_unknown.png" class = "eggimg2" id = "eggimg"/>
        <select onchange="changeEgg()" id = "eggchange" name = "eggtype">
            <option value="unknown">None Chosen</option>
            <option value="edible">Edible</option>
            <option value="superfood">Superfood</option>
            <option value="medical">Medical</option>
            <option value="rocketfuel">Rocket Fuel</option>
            <option value="supermaterial">Super Material</option>
            <option value="fusion">Fusion</option>
            <option value="quantum">Quantum</option>
            <option value="immortality">Immortality</option>
            <option value="tachyon">Tachyon</option>
            <option value="graviton">Graviton</option>
            <option value="dilithium">Dilithium</option>
            <option value="prodigy">Prodigy</option>
            <option value="terraform">Terraform</option>
            <option value="antimatter">Anti-matter</option>
            <option value="darkmatter">Dark Matter</option>
            <option value="ai">AI</option>
            <option value="nebula">Nebula</option>
            <option value="universe">Universe</option>
            <option value="enlightenment">Enlightenment</option>
            <option value="chocolate">Chocolate</option>
            <option value="easter">Easter</option>
            <option value="firework">Firework</option>
            <option value="waterballoon">Waterballoon</option>
            <option value="pumpkin">Pumpkin</option>
        </select>
        </div>
        <div class = "holds-text">
        <p>Contract Name:</p>
            <input type="text" name="contractname" class = "textbox-center" maxlength="50" id = "contractName"></input>
            <div id = "contractHiddenDiv">
                <input type="checkbox" name="contracthidden" value="hide" id = "contractHidden">Hide name?<br>
            </div>
        </div>
    </div>
    <div class = 'center-plzcssbad'>
        <h2 id = "icantcssandthisisntcentered">Description:</h2>
        <textarea id = "descriptionText" maxlength="400" name = "contractdescription"></textarea>
        <br>
        <input type = "submit" value = "Create Contract" class = "subbutton" style = "margin: 10px auto 0; display: block;"/><br>
    </div>
    </form>
</div>
</body>
<script>
function changeEgg(){
document.getElementById("eggimg").src = "cgi-bin/egginc/egg_" + document.getElementById("eggchange").value + ".png";
};
</script>
</html>