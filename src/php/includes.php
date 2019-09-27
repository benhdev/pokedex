<?php
namespace Module\Includes;
// start a new session to store api data when requested
session_start();

// get the absolute path for the directory
$dirname = dirname(__DIR__, 1);
// auto load the composer packages used
require_once("$dirname/vendor/autoload.php");

?>