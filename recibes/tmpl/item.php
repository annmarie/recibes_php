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
<hr>
<pre><?php print_r($pgObj->rcp); ?></pre>
<hr>
</div>

</div>
</body>
</html>
