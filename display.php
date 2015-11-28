<a id="homeLink" href="?">Home</a>
<?php
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
		<span class="label">Donkeys:</span><br/>
		<?php
		foreach($carter->getDonkeys() as $donkey) {
			echo formatDonkey($donkey);
		}
		?><br/>
		<?php
	}
} else if ($_GET['type'] == "donkey") {
	$donkey = Donkey::getDonkey($_GET['id']);
	if ($donkey == null) {
		throw Exception("Donkey not found: "+$_GET['id']);
	} else {
		?>
		<section id="desktop">
			<span class="label">ID:</span> <?php echo $donkey->id?><br/>
			<span class="label">Name:</span> <?php echo $donkey->name?><br/>
			<span class="label">Owner:</span>  <?php echo formatCarter($donkey->owner)?><br/>
			<span class="label">Phone number:</span> <?php echo $donkey->owner->phone?><br/>
			<span class="label">Address:</span><br/><?php echo nl2br($donkey->owner->address)?><br/>
			<span class="label">Birth date:</span> <?php echo $donkey->birth?><br/>
			<br/>
			<span class="label">Picture:</span><br/><?php echo formatPicture($donkey)?><br/>
			<span class="label">Distinguishing features:</span><br/><?php echo nl2br($donkey->features)?><br/>
			<br/>
			<span class="label">Special care:</span> <?php echo formatNotifications($donkey)?><br/>
			<span class="label">Detailed condition and treatments:</span><br/><?php echo nl2br($donkey->details)?><br/>
		</section>
		<section id="mobile">
			<?php echo formatPicture($donkey)?>
			<?php
				if ($donkey->isNotificationActivated(Donkey::SICK)) {
					echo "<span class='alert'>Sick donkey, please don't touch!</span>";
				}
				if ($donkey->isNotificationActivated(Donkey::INJURED)) {
					echo "<span class='alert'>Injured donkey, please pay attention!</span>";
				}
				if ($donkey->isNotificationActivated(Donkey::PREGNANT)) {
					echo "<span class='alert'>Sick donkey, please pay attention!</span>";
				}
			?>
			<p>
			This is <?php echo $donkey->name?>, owned by <?php echo $donkey->owner->name?>.<br/>
			</p>
			<span class="label">Phone:</span> <?php echo $donkey->owner->phone?><br/>
			<span class="label">Address:</span><br/><?php echo nl2br($donkey->owner->address)?><br/>
			
			<p>If you cannot contact the owner, please contact the Farm Animal Centre for Education (FACE).</p>
			<span class="label"><?php echo $donkey->name?>'s ID:</span> <?php echo $donkey->id?><br/>
			<span class="label">FACE contact:</span><br/><?php echo nl2br("FACE\naddress")?><br/>
		</section>
		<?php
	}
} else {
	throw new Exception("Unknown type: "+$_GET['type']);
}
?>