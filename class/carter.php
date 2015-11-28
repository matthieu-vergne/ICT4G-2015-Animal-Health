<?php
class Carter {
	public $id = null;
	public $name = null;
	public $phone = null;
	public $address = null;
	
	public function __construct($id = null, $name = null, $phone = null, $address = null) {
		$this->id = $id;
		$this->name = $name;
		$this->phone = $phone;
		$this->address = $address;
	}
	
	private static $allCarters = null;
	public static function getAllCarters() {
		if (Carter::$allCarters === null) {
			$carter = new Carter("1", "S'thembile Nzwana");
			$carter->phone = "083*****12";
			$carter->address = "23 Fifth Street\nJoza";
			Carter::$allCarters[] = $carter;
			
			$carter = new Carter("2", "Joe Pretorius");
			$carter->phone = "083*****34";
			$carter->address = "12 High Street\nSun City";
			Carter::$allCarters[] = $carter;
		}
		
		return Carter::$allCarters;
	}
	
	public function getDonkeys() {
		$donkeys = array();
		foreach(Donkey::getAllDonkeys() as $donkey) {
			if ($donkey->owner == $this) {
				$donkeys[] = $donkey;
			} else {
				// irrelevant donkey
			}
		}
		return $donkeys;
	}
	
	public static function getCarter($id) {
		foreach(Carter::getAllCarters() as $carter) {
			if ($carter->id === $id) {
				return $carter;
			}
		}
		throw new Exception($id." is not a known carter ID.");
	}
}
?>