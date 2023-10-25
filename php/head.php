<?php
session_start();

$path = $_SERVER['PHP_SELF'];
$file = basename ($path);
$redirect = "login";


if(isset($_COOKIE['secure'])){
    $_SESSION['secure'] = $_COOKIE['secure'];
};

if(!($file == "$redirect.php" || $file == "signup.php") && !isset($_SESSION['secure'])){
    header("location: ../Html/$redirect.php");
    exit;
};

?>
<!DOCTYPE html>
<head>


<meta charset="UTF-8">
<title>Gilbot</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="icon" type="image/x-icon" href="../favicon.ico">
<?php
$paths = ["css" => "link rel='stylesheet' href=", "javascript" => "script type='text/javascript' src="];
foreach ($paths as $path => $key) {
    $files = array_diff(scandir("../".$path), array('.', '..'));
    foreach ($files as $index => $file) {
        echo "<$key '../$path/$file'></".explode(' ', $key)[0].">";
    };
};
?>
<script>audiorecognize();</script>
</head>

