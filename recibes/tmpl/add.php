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

<form action='' enctype='application/x-www-form-urlencoded' method='post'>
<div> <input type="input" size="75" name="headline" placeholder="Name it!"> </div>
<div> <textarea cols="75" rows="25" name="body">put your recipe here..</textarea> </div>
<div> <textarea cols="75" rows="4" name="notes"></textarea> </div>
<div> <input type="input" size="75" name="ingredient[]" placeholder="add ingredient to it!"> </div>
<div> <input type="input" size="75" name="ingredient[]" placeholder="add ingredient to it!"> </div>
<div> <input type="input" size="75" name="tag[]" placeholder="tag it!"> </div>
<div> <input type="input" size="75" name="tag[]" placeholder="tag it!"> </div>
<input type="submit" value="submit">
</form>



<hr>
</div>

</div>
</body>
</html>

