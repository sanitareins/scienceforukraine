<?php
include 'Reader.php';

$reader = new Reader();

$json = [];
$line=1;
while ($row = $reader->read())
{
    $line++;
    
    if (empty($row['institution']))
    {
        user_error("No institution name on line " . $line);
        continue;
    }
    
    if (!isset($row['lat']))
    {
        user_error("No coordinates for " . $row['institution'] . " on line " . $line);
        continue;
    } 
    
    $json[] = $row;
}

$reader->_close();

echo '"use strict;";' . "\n";

echo "var mapData = \n";
echo json_encode ($json);
echo ";\n";