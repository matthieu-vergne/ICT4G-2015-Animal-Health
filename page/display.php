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
		<?php echo formatCarter($carter, true, "Modify")?><br/>
		<br/>
		<span class="label">Name:</span> <?php echo $carter->name?><br/>
		<span class="label">Phone number:</span> <?php echo $carter->phone?><br/>
		<span class="label">Address:</span><br/><?php echo nl2br($carter->address)?><br/>
		<br/>
		<span class="label">Donkeys:</span><br/>
		<ul>
		<?php
		foreach($carter->getDonkeys() as $donkey) {
			echo "<li>".formatDonkey($donkey)."</li>";
		}
		?>
		</ul>
		<?php
	}
} else if ($_GET['type'] == "donkey") {
	$donkey = Donkey::getDonkey($_GET['id']);
	if ($donkey == null) {
		throw Exception("Donkey not found: "+$_GET['id']);
	} else {
		?>
		<section id="desktop">
			<img id="qrcode" src="http://api.qrserver.com/v1/create-qr-code/?color=000000&amp;bgcolor=FFFFFF&amp;data=<?php echo urlencode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]")?>&amp;qzone=1&amp;margin=0&amp;size=400x400&amp;ecc=L" alt="QR Code" />
			<?php echo formatPicture($donkey)?>
			
			<?php echo formatDonkey($donkey, true, "Modify")?><br/>
			<br/>
			<span class="label">ID:</span> <?php echo $donkey->id?><br/>
			<span class="label">Name:</span> <?php echo $donkey->name?><br/>
			<span class="label">Birth date:</span> <?php echo $donkey->birth?><br/>
			<br/>
			<span class="label">Owner:</span>  <?php echo formatCarter($donkey->owner)?><br/>
			<span class="label">Phone number:</span> <?php echo $donkey->owner->phone?><br/>
			<span class="label">Address:</span><br/><?php echo nl2br($donkey->owner->address)?><br/>
			<br/>
			<span class="label">Distinguishing features:</span><br/><?php echo nl2br($donkey->features)?><br/>
			<br/>
			<span class="label">Special care:</span> <?php echo formatNotifications($donkey)?><br/>
			<span class="label">Detailed condition and treatments:</span><br/><?php echo nl2br($donkey->details)?><br/>
			<span class="label">Last treatment:</span> (<a href="?page=history&id=<?php echo $donkey->id?>">history</a>)<br/>
			<?php
				$t = Treatment::getLastTreatmentFor($donkey);
				if ($t == null) {
					echo "No treatments.";
				} else {
					echo $t->date.": ".$t->comment;
				}
			?><br/>
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
					echo "<span class='alert'>Pregnant donkey, please pay attention!</span>";
				}
			?>
			<p>
			This is <?php echo $donkey->name?>, owned by <?php echo $donkey->owner->name?>.<br/>
			</p>
			<span class="label">Phone:</span> <?php echo $donkey->owner->phone?><br/>
			<span class="label">Address:</span><br/><?php echo nl2br($donkey->owner->address)?><br/>
			
			<p>If you cannot contact the owner, please contact the Farm Animal Centre for Education (FACE).</p>
			<img id="logo" src="https://static.wixstatic.com/media/c7afb0_828976c1bebd455cb7c97bdb5947f5be.png/v1/fit/w_65,h_88,usm_0.50_1.20_0.00/c7afb0_828976c1bebd455cb7c97bdb5947f5be.png">
			<span class="label"><?php echo $donkey->name?>'s ID:</span> <?php echo $donkey->id?><br/>
			<span class="label">FACE contact:</span><br/><?php echo nl2br("FACE\naddress")?><br/>
		</section>
		<?php
	}
} else {
	throw new Exception("Unknown type: "+$_GET['type']);
}
?>