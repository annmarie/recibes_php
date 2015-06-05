<?php
require_once("conf/config.php");
require_once("tools/Database.class.php");
require_once("tools/PathParser.class.php");
require_once("models.php");
require_once("views.php");
require_once("forms.php");

$dbObj = new Database($conf);

$urls = array(
    array("^/?$", "index"),
    #-- recipe urls --#
    array("^/recipe/add/?$", "add"),
    array("^/recipe/all/?$", "items"),
    array("^/recipe/(?P<rcp_id>\d+)/?$", "item"),
    #-- api urls --#
    array("^/api/add/?$", "api_add"),
    array("^/api/get/all/?$", "api_list"),
    array("^/api/get/(?P<rcp_id>\d+)/?$", "api_item"),
    array("^/api/del/(?P<rcp_id>\d+)/?$", "api_delete"),
    array("^/api/search/?$", "api_search"),
);

$pathObj = new PathParser($urls);
if (!@$pathObj->view) {
    $pathObj->view = "error";
}
$pathObj->breadcrumbs = setBreadCrumbs($pathObj);

$views = new Views($pathObj);
$view = $pathObj->view;

$views->$view();

exit();


function setBreadCrumbs($pathObj) {
    if ($pathObj->view == "index") {
        $bc = 'Home';
    } else {
        $bc = '<a href="/">Home</a>';
        if ($pathObj->view == "items") {
            $bc .= ' &gt; Recipes';
        } else {
            $bc .= ' &gt; <a href="/recipe/all">Recipes</a>';
        }
        if ($pathObj->view == "item") $bc .= ' &gt; Recipe';
    }
    return $bc;
}


?>
