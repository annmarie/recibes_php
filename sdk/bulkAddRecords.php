<?php
include('./RecibesApi.php');

$baseurl = "http://recibes-vagrant.local/";
$rcpAPI = new Recibes\ApiCalls($baseurl);


$datalst = array();
$datalst[] = array( 'headline' => 'apple pie', 
                    'ingredient' => array('apple'), 
                    'tag'=> array('bob', 'july'));
$datalst[] = array( 'headline' => 'blueberry pie', 
                    'ingredient' => array('blueberries'), 
                    'tag'=> array('dig', 'july'));

$results = array_map(array($rcpAPI, "addIt"), $datalst);

print_r($results);

exit();

?>

