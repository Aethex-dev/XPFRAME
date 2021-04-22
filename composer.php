<?php

$cmd = readline("composer: ");
shell_exec("php composer.phar " . $cmd . " 2>&1");

shell_exec("php composer.php");

exit();