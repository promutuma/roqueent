<?php
require_once 'app/Config/Database.php';
$dbConfig = new \Config\Database();
print_r($dbConfig->default);
