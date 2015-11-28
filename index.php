<?php
/*
	This file is the root of the website. Here is the global code generating the
	complete page.
*/
ini_set('display_errors', '1');
ini_set('display_startup_errors', TRUE);
require_once("class/carter.php");
require_once("class/donkey.php");

function formatDonkey(Donkey $donkey) {
	$id = $donkey->id;
	$name = $donkey->name;
	return "<a href='?page=display&type=donkey&id=$id'>$name</a>";
}

function formatCarter(Carter $carter) {
	$id = $carter->id;
	$name = $carter->name;
	return "<a href='?page=display&type=carter&id=$id'>$name</a>";
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

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>DONKEY!!!</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="Content-Language" content="en" />
		<meta http-equiv="Content-Script-Type" content="text/javascript" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<style type="text/css">
			/* HTML 4 compatibility */
			article, aside, figcaption, figure, footer, header, hgroup, nav, section {
				display: block;
			}
		</style>
		<!--[if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link rel="stylesheet" href="style.css" type="text/css" media="screen" title="Normal" />  
		<!--link rel="icon" type="image/gif" href="donkey.gif" /-->
		<!--link rel="shortcut icon" href="donkey.ico" /-->
		<script type="text/javascript">
			function show(field_id) {
				if(document.getElementById) {
					tabler = document.getElementById(field_id);
					if(tabler.style.display=="none") {
						tabler.style.display="";
					}
					else {
						tabler.style.display="none";
					}
				}
			}
		</script>
	</head>
	<body>
		<section id="main">
			<?php
			if (!isset($_GET['page'])) {
				?>
				Carters:
				<ul>
					<?php foreach(Carter::getAllCarters() as $carter) {
						echo "<li>".formatCarter($carter)."</li>";
					} ?>
				</ul>
				Donkeys:
				<ul>
					<?php foreach(Donkey::getAllDonkeys() as $donkey) {
						echo "<li>".formatDonkey($donkey)."</li>";
					} ?>
				</ul>
				<?php
			} else if ($_GET['page'] == "input") {
				require_once("input.php");
			} else if ($_GET['page'] == "display") {
				require_once("display.php");
			} else {
				echo "PAGE: ".$_GET['page'];
			}
			?>
		</section>
	</body>
</html>
 
