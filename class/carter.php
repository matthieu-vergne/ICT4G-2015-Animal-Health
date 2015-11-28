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
			$carter->phone = "0123456789";
			$carter->address = "In my street,\nIn my city!";
			Carter::$allCarters[] = $carter;
			
			$carter = new Carter("2", "Mickey Mouse");
			$carter->phone = "0123456789";
			$carter->address = "In my street,\nIn my city!";
			Carter::$allCarters[] = $carter;
		}
		
		return Carter::$allCarters;
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