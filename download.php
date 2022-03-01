#!/bin/php
<?php
$filename = require 'spreadsheet.php';
$content = file_get_contents($filename);

file_put_contents("input.csv", $content);