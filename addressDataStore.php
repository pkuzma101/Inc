<?php

require_once('../inc/filestore.php');

class addressDataStore extends Filestore {
public $filename = '';

	public $addresses = [];

	public function readAddressBook() {
		// set $this->addresses to readCSV();
		$this->addresses = $this->readCSV();
	}

	public function writeAddressBook() {
		// pass $this->addresses to writeCSV()
		return $this->writeCSV($this->addresses);
	}		
}

?>