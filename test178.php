<?php

$t = file_get_contents("http://localhost:8888/dissertation/companiespercounty.php", true);
$S = json_decode($t);
echo $t;

?>
