<?php
include 'Reader.php';

$reader = new Reader();

$json = [];
while ($row = $reader->read())
{
    if (empty($row['institution']))
    {
        user_error("No institution name");
        continue;
    }
    
    if (!isset($row['lat']))
    {
        user_error("No coordinates for " . $row['institution']);
        continue;
    } 
    
    $json[] = $row;
}

$reader->_close();

echo '"use strict;";' . "\n";

echo "var mapData = \n";
echo json_encode ($json);
echo ";\n";