<?php
class Donkey {
	public $id = null;
	public $name = null;
	public $owner = null;
	public $birth = null;
	public $picture = null;
	public $features = "";
	public $notifications = array();
	const SICK = 'sick';
	const INJURED = 'injured';
	const PREGNANT = 'pregnant';
	public $details = "";
	
	public function __construct($id = null, $name = null, Carter $owner = null, $birth = null) {
		$this->id = $id;
		$this->name = $name;
		$this->owner = $owner;
		$this->birth = $birth;
	}
	
	public function activateNotification($property) {
		$this->notifications[$property] = true;
	}
	
	public function deactivateNotification($property) {
		$this->notifications[$property] = false;
	}
	
	public function isNotificationActivated($property) {
		return isset($this->notifications[$property]) ? $this->notifications[$property] : false;
	}
	
	private static $allDonkeys = null;
	public static function getAllDonkeys() {
		if (Donkey::$allDonkeys === null) {
			$donkey = new Donkey("1", "Warrior", Carter::getCarter("1"), "01/01/1970");
			$donkey->picture = "pictures/1.jpg";
			$donkey->features = "Lot of hairs.\nWhite in the left ear, black in the right one.";
			$donkey->details = "Healthy but quickly tired.";
			Donkey::$allDonkeys[] = $donkey;
			
			$donkey = new Donkey("2", "Dunk", Carter::getCarter("2"), "01/01/1970");
			$donkey->picture = "pictures/2.jpg";
			$donkey->features = "I tried to find some but failed...";
			$donkey->activateNotification(Donkey::SICK);
			$donkey->details = "Develop some allergies to carrots making him smile all the time.";
			Donkey::$allDonkeys[] = $donkey;
		}
		
		return Donkey::$allDonkeys;
	}
	
	public static function getDonkey($id) {
		foreach(Donkey::getAllDonkeys() as $donkey) {
			if ($donkey->id === $id) {
				return $donkey;
			}
		}
		throw new Exception($id." is not a known carter ID.");
	}
}
?>