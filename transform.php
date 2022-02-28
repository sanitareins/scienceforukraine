<?php
include 'Reader.php';

$reader = new Reader();


$json = [];
while ($row = $reader->read())
{
    $json[] = $row;
    // var_dump($row);
}

$reader->_close();

echo '"use strict;";' . "\n";

echo "var mapData = \n";
echo json_encode ($json);
echo ";\n";