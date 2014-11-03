<?php

class addressDataStore {
public $filename = '';

	public function __construct($filename = 'addressBook.csv') {
		$this->filename = 'data/' . $filename;
	}

	public $addresses = [];

	public function readAddressBook() {
		$addresses = [];

		if(file_exists($this->filename) && filesize($this->filename) > 0) {
			// Open the file and place the pointer at the beginning of the file
			$handle = fopen($this->filename, 'r');
			// while not at the end of the $handle pointer, get data from the data/addressBook.csv
			while(!feof($handle)) {
				$row = fgetcsv($handle);
				if(!empty($row)) {
					$addresses[] = $row;
				}
			}
			fclose($handle);
			$this->addresses = $addresses;
		} 

		else {
			$addresses = [];
		}
		
		return $addresses;
	}

	public function writeAddressBook() {
		$handle = fopen($this->filename, 'w');
		foreach($this->addresses as $row) {
			fputcsv($handle, $row);
		}
		fclose($handle);
	}		
}

?>