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
			$donkey = new Donkey("1", "Warrior", Carter::getCarter("1"), "21/11/2000");
			$donkey->picture = "pictures/1.jpg";
			$donkey->features = "Wound on the front right knee.";
			$donkey->details = "Healthy.";
			Donkey::$allDonkeys[] = $donkey;
			
			$donkey = new Donkey("2", "Dunk", Carter::getCarter("2"), "05/03/2009");
			$donkey->picture = "pictures/2.jpg";
			$donkey->features = "Left ear cut at the top.";
			$donkey->activateNotification(Donkey::PREGNANT);
			$donkey->details = "- Avoid any medication.\n- Don't attach to cart.";
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