<?php

$cmd = readline("composer: ");
shell_exec("php composer.phar " . $cmd . " 1>&2");

shell_exec("php composer.php");

exit();