<?php print_r(json_encode(array_slice(scandir($_GET['path']),2))); ?>