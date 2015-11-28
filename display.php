<?php
function displayPicture(Donkey $donkey) {
	if ($donkey->picture === null) {
		echo "<none>";
	} else {
		 echo "<img class='donkeyPicture' src='".$donkey->picture."' alt='".$donkey->name."'>";
	}
}

function displayNotifications(Donkey $donkey) {
	$string = "";
	foreach($donkey->notifications as $property => $isActive) {
		if ($isActive) {
			$string .= $property." ";
		} else {
			// not active, ignore
		}
	}
	echo "aaa";
	if (strlen($string) == 0) {
		echo "<none>";
	} else {
		echo $string;
	}
	echo "aaa";
}

if (!isset($_GET['type'])) {
	throw new Exception("No type provided");
} else if (!isset($_GET['id'])) {
	throw new Exception("No ID provided");
} else if ($_GET['type'] == "carter") {
	$carter = Carter::getCarter($_GET['id']);
	if ($carter == null) {
		throw Exception("Carter not found: "+$_GET['id']);
	} else {
		?>
		<span class="label">Name:</span> <?php echo $carter->name?><br/>
		<span class="label">Phone number:</span> <?php echo $carter->phone?><br/>
		<span class="label">Address:</span><br/><?php echo nl2br($carter->address)?><br/>
		<?php
	}
} else if ($_GET['type'] == "donkey") {
	$donkey = Donkey::getDonkey($_GET['id']);
	if ($donkey == null) {
		throw Exception("Donkey not found: "+$_GET['id']);
	} else {
		?>
		<span class="label">ID:</span> <?php echo $donkey->id?><br/>
		<span class="label">Name:</span> <?php echo $donkey->name?><br/>
		<span class="label">Owner:</span>  <?php echo $donkey->owner->name?><br/>
		<span class="label">Phone number:</span> <?php echo $donkey->owner->phone?><br/>
		<span class="label">Address:</span><br/><?php echo nl2br($donkey->owner->address)?><br/>
		<span class="label">Birth date:</span> <?php echo $donkey->birth?><br/>
		<br/>
		<span class="label">Picture:</span><br/><?php displayPicture($donkey)?><br/>
		<span class="label">Distinguishing features:</span><br/><?php echo nl2br($donkey->features)?><br/>
		<br/>
		<span class="label">Special care:</span><?php echo displayNotifications($donkey)?><br/>
		<span class="label">Detailed condition and treatments:</span><br/><?php echo nl2br($donkey->details)?><br/>
		<?php
	}
} else {
	throw new Exception("Unknown type: "+$_GET['type']);
}
?>
<?php
?>
 
