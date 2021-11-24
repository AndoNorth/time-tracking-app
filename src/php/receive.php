<?php
/* basic script to see POST body(data) */
$request = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents('php://input'), true);
$dir = '../../data';
if( !file_exists($dir) ) {
    mkdir ($dir, 0664); // 0664 = -rw-rw-r--
    // 0 | r=4, w=2, x=1, read, write, execute
    // 0 | 4 + 2 + 0 | 4 + 2 + 0 | 4 + 0 + 0
    // 0 |   owner   |   group   |   other
}
$jsonFileName = "listItems.json";
$outPath = $dir.'/'.$jsonFileName;
$jsonData = json_encode($data, JSON_PRETTY_PRINT);
$bytes = file_put_contents($outPath, $jsonData);
if($bytes)
{
    echo "successfully written to $outPath\n";
}
else
{
    echo "failed to write to $outPath\n";
}
echo "data received:\n";
var_dump($data);
$loadedData = json_decode(file_get_contents($outPath), true);
echo "data loaded from $outPath:\n";
var_dump($loadedData);
?>