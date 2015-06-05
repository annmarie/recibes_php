<!DOCTYPE html>
<html>
<head>
  <?php include("metatags.php"); ?>
  <?php include("css.php"); ?>
  <?php include("js.php"); ?>
  <title>Recibes</title>
</head>
<body>
<div id="mainContent">
<div class="breadcrumbs"><?php echo $pgObj->breadcrumbs; ?></div>
<div class="well">
<a href="<?php echo $links::recipe_add(); ?>">add a recipe</a>
<hr>

<ul>
<?php 
    foreach($pgObj->recipes as $rcp) {
        echo '<li><a href="'.$links::recipe_item($rcp->id).'">';
        echo $rcp->headline;
        echo '</a></li>';
    }
?>
</ul>

<hr>
</div>
</div>
</body>
</html>

