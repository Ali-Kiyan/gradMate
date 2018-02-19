<?php
$result = shell_exec("python ./new.py");
echo $result;
var_dump(exec("./new.py"))
?>
