Donkeys:
<ul>
	<?php foreach(Donkey::getAllDonkeys() as $donkey) {
		echo "<li>".formatDonkey($donkey, true)."</li>";
	} ?>
</ul>