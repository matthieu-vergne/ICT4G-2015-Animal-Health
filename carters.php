Carters:
<ul>
	<?php foreach(Carter::getAllCarters() as $carter) {
		echo "<li>".formatCarter($carter, true)."</li>";
	} ?>
</ul>