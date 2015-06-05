<!DOCTYPE html>
<html>
<head>
  <?php include("metatags.php"); ?>
  <?php include("css.php"); ?>
  <?php include("js.php"); ?>
  <title>Recibes</title>
  <style>
    .menu { 
        font-size:24px;
        padding-top:10px;
        padding-bottom:10px;
        padding-left:25px;
    }
  </style>
<head>
<body>
<div id="mainContent">
<div class="breadcrumbs"><?php echo $pgObj->breadcrumbs; ?></div>

</div>

<div class="menu">
<a href="<?php echo $links::recipe_all(); ?>">Recipes</a>
</div>


</div>
</body>
</html>

