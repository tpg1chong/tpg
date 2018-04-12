<?php


/* -- import --*/

require_once 'Location/region.php';
require_once 'Location/country.php';
require_once 'Location/geography.php';

require_once 'Location/Province.php';
require_once 'Location/Zone.php';
require_once 'Location/District.php';


# Places
require_once 'Location/Places.php';

class Location_Model extends Model{

	public function __construct() {
		parent::__construct();

		$this->region = new region();
		$this->country = new country();

		$this->province = new Province();
		$this->zone = new Location_Zone();
		$this->district = new Location_District();

		$this->geography = new geography();
		// $this->city = new city();

		$this->places = new Places();

	}
}
