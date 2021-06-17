<?php
session_start();
require_once __DIR__ . "/util.php";

require_once __DIR__ . "/app/app.php";

$dbConn = $application->getDbConnectionByEnv();