<?php

use Kachkaev\PHPR\RCore;
use Kachkaev\PHPR\Engine\CommandLineREngine;

 // $r = new RCore(new CommandLineREngine('/path/to/R'));
//
// $x = $r->run(<<<EOF
//
// print("hi")
//
//
// EOF
// );

echo "this is coming from python";
$resultP = shell_exec("python ./new.py");
echo $resultP;
echo '<br>';
var_dump(shell_exec("python "));
echo '<br>';
echo "this is coming from R \t ";
echo '<br>';
$resultR = shell_exec("Rscript ./test.R");
echo $resultR;




?>
