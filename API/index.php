<?php
// Retrieve instance of the framework
$f3 = require('lib/base.php');

// loading configuration files
$f3->config('app/config.ini');
$f3->config('app/routes.ini');

$f3->run();

?>