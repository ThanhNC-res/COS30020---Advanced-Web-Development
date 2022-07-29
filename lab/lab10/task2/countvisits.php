<?php
require_once("hitcounter.php");
$filedir = ".".DIRECTORY_SEPARATOR."filekeys.txt";

echo"<h1>Hit Counter</h1>";

if(file_exists($filedir)){
    $content = file_get_contents($filedir);
    $logstr = explode(',', $content);
}else{
    echo "<p>No file exists.</p>";
}

$hitcounter = new hitcounter($logstr[0], $logstr[1], $logstr[2], $logstr[3]);

$hitcounter->getHits();
$hitcounter->setHits();

$hitcounter->closeConn();
echo"<p><a href=\"startover.php\">Start Over</a><p>";
?>