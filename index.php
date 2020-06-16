<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script type="text/javascript" src="lib/jQuery-3.3.1.js"></script>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>

<?php

header('Content-Type: text/html; charset=utf-8');
require_once 'initialize.php';

error_reporting(config('error_reporting_level'));
run();
