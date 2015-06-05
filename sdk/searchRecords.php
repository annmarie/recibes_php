<?php
include('./RecibesApi.php');

$baseurl = "http://recibes-vagrant.local/";
$rcpAPI = new Recibes\ApiCalls($baseurl);

$phrase = "pie"; 
$results = $rcpAPI->searchIt($phrase);

print_r($results);

exit();

?>

