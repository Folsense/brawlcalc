<?php
include 'php/config.php';

$num = $_GET["contract"];

$sql = "SELECT * FROM contracts_table WHERE ID = '".$num."' LIMIT 1";
$result = mysqli_query($link, $sql);

$resulta = mysqli_fetch_assoc($result);

$json_array = json_encode($resulta);

# https://stackoverflow.com/questions/1416697/converting-timestamp-to-time-ago-in-php-e-g-1-day-ago-2-days-ago
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/eggmain.css">
</head>
<header>
    <img src = "cgi-bin/egginc/icon_chick.png" />
    <p>Egg, Inc. Contract Finder</p>
    <img src = "cgi-bin/egginc/icon_zzz.png" />
</header>
<body>
<div id = "contract-profile" class = 'center-horizontal'>
    <div class = 'center-plzcssbad'>
        <img <?php echo "src = \"cgi-bin/egginc/egg_".$resulta['Type'].".png\""; ?> class = "eggimg"/>
        <div class = "holds-text">
            <h1><?php
                if($resulta['Hidden'] === "0"){
                    echo $resulta['Name'];
                }
                else{
                    echo "<div class = \"hidden\">Name Hidden</div>";
                }
            ?></h1>
        </div>
    </div>
    <div class = 'center-plzcssbad'>
        <h2>Made <?php echo time_elapsed_string($resulta['Date_made']); ?></h2>
    </div>
    <div class = 'center-plzcssbad'>
        <h4><?php echo $resulta['Description']; ?></h2>
    </div>
</div>
</body>
<script>
var arrayObjects = <?php echo $json_array; ?>;
console.log(arrayObjects);
</script>
</html>