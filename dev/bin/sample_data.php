<?php

include('../../sdk/RecibesApi.php');

$baseurl = "http://recibes-vagrant.local/";
$rcpAPI = new Recibes\ApiCalls($baseurl);

$datalst = array();
$datalst[] = array( 'headline' => 'apple pie', 
                    'body' => "bla bla bla ... then you have apple pie",
                    'ingredient' => array('apple'), 
                    'tag'=> array('bob', 'july'));
$datalst[] = array( 'headline' => 'blueberry cake', 
                    'body' => "bla bla bla ... then you have blueberry cake",
                    'ingredient' => array('blueberries', 'flour'), 
                    'tag'=> array('dig', 'july'));

$results = array_map(array($rcpAPI, "addIt"), $datalst);

print_r($results);

exit();


