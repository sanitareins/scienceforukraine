<?php
include 'Reader.php';

$reader = new Reader();

$json = [];
while ($row = $reader->read())
{
    if (!isset($row['lat']))
    {
        user_error("No coordinates for " . $row['institution']);
    } else 
    {
        $json[] = $row;
    }
    
}

$reader->_close();

echo '"use strict;";' . "\n";

echo "var mapData = \n";
echo json_encode ($json);
echo ";\n";