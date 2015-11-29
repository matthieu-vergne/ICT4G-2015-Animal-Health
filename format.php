<?php
function formatDonkey(Donkey $donkey, $edit = false) {
	$id = $donkey->id;
	$name = $donkey->name;
	$type = "donkey";
	$string = "<a href='?page=display&type=$type&id=$id'>$name</a>";
	if ($edit) {
		$string .= " (<a href='?page=edit&type=$type&id=$id'>edit</a>)";
	} else {
		// no edit link
	}
	return $string;
}

function formatCarter(Carter $carter, $edit = false) {
	$id = $carter->id;
	$name = $carter->name;
	$type = "carter";
	$string = "<a href='?page=display&type=$type&id=$id'>$name</a>";
	if ($edit) {
		$string .= " (<a href='?page=edit&type=$type&id=$id'>edit</a>)";
	} else {
		// no edit link
	}
	return $string;
}

function formatPicture(Donkey $donkey) {
	if ($donkey->picture === null) {
		return "&lt;none&gt;";
	} else {
		return "<img class='donkeyPicture' src='".$donkey->picture."' alt='".$donkey->name."'>";
	}
}

function formatNotifications(Donkey $donkey) {
	$string = "";
	foreach($donkey->notifications as $property => $isActive) {
		if ($isActive) {
			$string .= $property." ";
		} else {
			// not active, ignore
		}
	}
	if (strlen($string) == 0) {
		return "&lt;none&gt;";
	} else {
		return $string;
	}
}

function formatHistory(Donkey $donkey) {
	$treatments = Treatment::getAllTreatmentsFor($donkey);
	usort($treatments, function($a, $b) {
				$d1 = DateTime::createFromFormat('d/m/Y', $a->date);
				$t1 = strtotime($d1->format('Y-m-d'));
				
				$d2 = DateTime::createFromFormat('d/m/Y', $b->date);
				$t2 = strtotime($d2->format('Y-m-d'));
				
				return $t1 < $t2 ? 1 : -1;
			});
	
	if (empty($treatments)) {
		return "&lt;none&gt;";
	} else {
		$table = "<table>";
		foreach($treatments as $treatment) {
			$row = "";
			$row .= "<td>".$treatment->date."<br/>".$treatment->author."</td>";
			$row .= "<td>".$treatment->comment."</td>";
			$table .= "<tr>$row</tr>";
		}
		$table .= "</table>";
		return "<div id='history'>$table</div>";
	}
}
?>