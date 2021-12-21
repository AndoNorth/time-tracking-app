<?php
/* basic script to test receiving request from server
*  contents:
*    1. test receiving POST request data
*    2. test writing functionality 
*    3. test reading functionality 
*/
// 1. test receiving POST request data
$request = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents('php://input'), true);
session_start();
$uid = $_SESSION["userid"];
$uuid = $_SESSION["useruid"];
echo "data received from: UID: $uid, UNAME: $uuid \n";
var_dump($data);
// organise listItems into variables
$itemName=$data['item-name'];
var_dump($itemName);
$tag=$data['tag'];
var_dump($tag);
$desc=$data['item-desc'];
var_dump($desc);
$timestamps=$data['time-stamps'];
if(!empty($timestamps)){
    foreach($timestamps as $timestamp){
        foreach($timestamp as $key => $value)
        echo "$key :: $value \n";
    }
}
// 2. test writing functionality
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
$outToFile = file_put_contents($outPath, $jsonData);
if($outToFile)
{
    echo "successfully written to $outPath\n";
}
else
{
    echo "failed to write to $outPath\n";
}
// 3. test reading functionality
$loadedData = json_decode(file_get_contents($outPath), true);
echo "data loaded from $outPath:\n";
var_dump($loadedData);
?>