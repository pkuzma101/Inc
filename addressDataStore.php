<?php

require_once('../inc/filestore.php');

class AddressDataStore extends Filestore {
public $filename = '';

	function __construct($filename = '') {
		$newTitle = strtolower($filename);
		parent:: __construct($newTitle);	
	}

	public $addresses = [];

	public function readAddressBook() {
		// set $this->addresses to readCSV();
		$this->addresses = $this->read();
	}

	public function writeAddressBook() {
		// pass $this->addresses to writeCSV()
		return $this->write($this->addresses);
	}		
}

?>