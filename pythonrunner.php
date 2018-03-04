<?php


echo "this is coming from python";
$resultP = shell_exec("python ./new.py");
echo $resultP;
echo '<br>';
var_dump(shell_exec("python "));
echo '<br>';
echo "this is coming from R \t ";
echo '<br>';
$resultR = exec("/usr/local/bin/RScript ./test.R");
echo $resultR;




?>
