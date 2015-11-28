<form action="input.php">
<?php
if (!isset($_GET['type'])) {
	throw new Exception("No type provided");
} else if ($_GET['type'] == "carter") {
	?>
	Name: <input type="text" name="name" value="Mickey Mouse"><br/>
	Phone number: <input type="text" name="phone" value="0123456789"><br/>
	Address:<br/><textarea name="address" rows="10" cols="30"></textarea><br/>
	<?php
} else if ($_GET['type'] == "donkey") {
	$owners = "";
	$owners .= "<option value='id'>Mickey Mouse</option>";
	?>
	ID: <input type="text" name="id" value="12345"><br/>
	Name: <input type="text" name="name" value="Dunk"><br/>
	Owner:  <select name="owner"><?php echo $owners;?></select><br/>
	Birth date: <input type="text" name="name" value="01/01/1970"><br/>
	<br/>
	Picture: <input type="file" name="picture" accept="image/*"><br/>
	Distinguishing features:<br/><textarea name="features" rows="10" cols="30"></textarea><br/>
	<br/>
	Special care:<br/>
	<input type="checkbox" name="sick" value="true">sick</input><br>
	<input type="checkbox" name="injured" value="true">injured</input><br>
	<input type="checkbox" name="pregnant" value="true">pregnant</input><br>
	Detailed condition and treatments:<br/><textarea name="condition" rows="10" cols="30"></textarea><br/>
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
