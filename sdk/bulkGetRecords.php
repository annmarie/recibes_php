<?php
include('./RecibesApi.php');

$baseurl = "http://recibes-vagrant.local/";
$rcpAPI = new Recibes\ApiCalls($baseurl);

$datalst = array(1, 2, 1);
$results = array_map(array($rcpAPI, "getIt"), $datalst);

print_r($results);

exit();

?>

