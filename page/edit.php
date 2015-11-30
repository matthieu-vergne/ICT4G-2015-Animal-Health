<form action="edit.php" method="post">
<?php
if (!isset($_GET['type'])) {
	throw new Exception("No type provided");
} else if ($_GET['type'] == "carter") {
	if (isset($_GET['id'])) {
		$carter = Carter::getCarter($_GET['id']);
	} else {
		$carter = new Carter(null, null);
	}
	?>
	Go back to <?php echo formatCarter($carter)?></a><br/><br/>
	<span class="label">Name:</span> <input type="text" name="name" value="<?php echo $carter->name?>"><br/>
	<span class="label">Phone number: <input type="text" name="phone" value="<?php echo $carter->phone?>"><br/>
	<span class="label">Address:<br/><textarea name="address" rows="10" cols="30"><?php echo $carter->address?></textarea><br/>
	<?php
} else if ($_GET['type'] == "donkey") {
	if (isset($_GET['id'])) {
		$donkey = Donkey::getDonkey($_GET['id']);
	} else {
		$donkey = new Donkey();
	}
	
	$owners = "";
	foreach(Carter::getAllCarters() as $carter) {
		$selected = $donkey->owner == $carter ? " selected" : "";
		$owners .= "<option value='".$carter->id."'$selected>".$carter->name."</option>";
	}
	?>
	Go back to <?php echo formatDonkey($donkey)?></a><br/><br/>
	<span class="label">ID:</span> <input type="text" name="id" value="<?php echo $donkey->id?>"><br/>
	<span class="label">Name:</span> <input type="text" name="name" value="<?php echo $donkey->name?>"><br/>
	<span class="label">Owner:</span> <select name="owner"><?php echo $owners;?></select><br/>
	<span class="label">Birth date:</span> <input type="text" name="name" value="<?php echo $donkey->birth?>"><br/>
	<br/>
	<span class="label">Picture:</span> <input type="file" name="picture" accept="image/*"><br/>
	<span class="label">Distinguishing features:</span><br/><textarea name="features" rows="10" cols="30"><?php echo $donkey->features?></textarea><br/>
	<br/>
	<span class="label">Special care:</span><br/>
	<input type="checkbox" name="sick" value="true" <?php echo $donkey->isNotificationActivated(Donkey::SICK) ? "checked" : ""?>>sick</input><br>
	<input type="checkbox" name="injured" value="true" <?php echo $donkey->isNotificationActivated(Donkey::INJURED) ? "checked" : ""?>>injured</input><br>
	<input type="checkbox" name="pregnant" value="true"<?php echo $donkey->isNotificationActivated(Donkey::PREGNANT) ? "checked" : ""?>>pregnant</input><br>
	<span class="label">Detailed condition and treatments:</span><br/><textarea name="condition" rows="10" cols="30"><?php echo $donkey->details?></textarea><br/>
	<?php
} else {
	throw new Exception("Unknown type: "+$_GET['type']);
}
?>
<br>
<input type="submit" value="Save"><input type="reset" value="Reset">
</form>
<?php
?>
