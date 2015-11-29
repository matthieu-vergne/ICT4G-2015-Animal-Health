<?php
if (!isset($_GET['id'])) {
	throw new Exception("No ID provided");
} else {
	$donkey = Donkey::getDonkey($_GET['id']);
	if ($donkey == null) {
		throw Exception("Donkey not found: "+$_GET['id']);
	} else {
		?>
		Go back to <?php echo formatDonkey($donkey)?></a>
		<h1>History</h1>
		<?php
		$treatments = Treatment::getAllTreatmentsFor($donkey);
		if (empty($treatments)) {
			echo "&lt;none&gt;";
		} else {
			usort($treatments, function($a, $b) {
						$d1 = DateTime::createFromFormat('d/m/Y', $a->date);
						$t1 = strtotime($d1->format('Y-m-d'));
						
						$d2 = DateTime::createFromFormat('d/m/Y', $b->date);
						$t2 = strtotime($d2->format('Y-m-d'));
						
						return $t1 < $t2 ? 1 : -1;
					});
			
			echo "<div id='history'>";
			echo "<table>";
			foreach($treatments as $treatment) {
				$row = "";
				$row .= "<td class='date'>".$treatment->date."<br/>".$treatment->author."</td>";
				$row .= "<td class='comment'>".$treatment->comment."</td>";
				echo "<tr>$row</tr>";
			}
			echo "</table>";
			echo "</div>";
		}
	}
}
?>