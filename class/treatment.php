<?php
class Treatment {
	public $id = null;
	public $date = null;
	public $author = null;
	public $comment = null;
	public $donkey = null;
	
	public function __construct($id = null, $date = null, $author = null, Donkey $donkey = null) {
		$this->id = $id;
		$this->date = $date;
		$this->author = $author;
		$this->donkey = $donkey;
	}
	
	private static $allTreatments = null;
	public static function getAllTreatments() {
		if (Treatment::$allTreatments === null) {
			$treatment = new Treatment("1", "09/10/2015", "Mickey Mouse", Donkey::getDonkey("2"));
			$treatment->comment = "Pregnancy check. Nothing to notice.";
			Treatment::$allTreatments[] = $treatment;
			
			$treatment = new Treatment("2", "13/10/2015", "Mickey Mouse", Donkey::getDonkey("2"));
			$treatment->comment = "Pregnancy check. Nothing to notice.";
			Treatment::$allTreatments[] = $treatment;
			
			$treatment = new Treatment("3", "22/10/2015", "Mickey Mouse", Donkey::getDonkey("2"));
			$treatment->comment = "Pregnancy check. Nothing to notice.";
			Treatment::$allTreatments[] = $treatment;
			
			$treatment = new Treatment("4", "28/10/2015", "Mickey Mouse", Donkey::getDonkey("2"));
			$treatment->comment = "Pregnancy check. Nothing to notice.";
			Treatment::$allTreatments[] = $treatment;
			
			$treatment = new Treatment("5", "04/11/2015", "Mickey Mouse", Donkey::getDonkey("2"));
			$treatment->comment = "Pregnancy check. Dunk is really tired, I recommended Joe to take care of her when he has some spare time, because she is close to delivery.";
			Treatment::$allTreatments[] = $treatment;
			
			$treatment = new Treatment("6", "12/11/2015", "Mickey Mouse", Donkey::getDonkey("2"));
			$treatment->comment = "Pregnancy check. Dunk seems to have recovered. The delivery should happen in a few weeks, so I reminded Joe to let her rest.";
			Treatment::$allTreatments[] = $treatment;
			
			$treatment = new Treatment("7", "17/11/2015", "Mickey Mouse", Donkey::getDonkey("2"));
			$treatment->comment = "Pregnancy check. Nothing to notice.";
			Treatment::$allTreatments[] = $treatment;
			
			$treatment = new Treatment("8", "26/11/2015", "Mickey Mouse", Donkey::getDonkey("2"));
			$treatment->comment = "Pregnancy check. Dunk should deliver in the next days.";
			Treatment::$allTreatments[] = $treatment;
		}
		
		return Treatment::$allTreatments;
	}
	
	public static function getAllTreatmentsFor(Donkey $donkey) {
		$treatments = array();
		foreach(Treatment::getAllTreatments() as $treatment) {
			if ($treatment->donkey === $donkey) {
				$treatments[] = $treatment;
			}
		}
		return $treatments;
	}
	
	public static function getLastTreatmentFor($donkey) {
		$timestamp = function($treatment) {
			$date = DateTime::createFromFormat('d/m/Y', $treatment->date);
			return strtotime($date->format('Y-m-d'));
		};
		
		$lastTreatment = null;
		foreach(Treatment::getAllTreatmentsFor($donkey) as $treatment) {
			if ($lastTreatment === null || $timestamp($treatment) > $timestamp($lastTreatment) ) {
				$lastTreatment = $treatment;
			}
		}
		return $lastTreatment;
	}
	
	public static function getTreatment($id) {
		foreach(Treatment::getAllTreatments() as $treatment) {
			if ($treatment->id === $id) {
				return $treatment;
			}
		}
		throw new Exception($id." is not a known carter ID.");
	}
}
?>