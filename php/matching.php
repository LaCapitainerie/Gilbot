<?php

$finding = $_GET['f'];

$files = array_slice(scandir($_GET['path']),2);

$max = 0;
$name = "";
foreach ($files as $key => $file) {
    similar_text($file, $finding, $perc1);
    similar_text($finding, $file, $perc2);
    $temp_max = max($perc1, $perc2);

    if($temp_max > $max){
        $max = $temp_max;
        $name = $file;
    };
};

echo $name;

?>