<?php

 class Filestore {
     public $filename = '';

     function __construct($filename = 'addressBook.csv') {
         // Sets $this->filename
     	$this->filename = 'data/' . $filename;
     }

     /**
      * Returns array of lines in $this->filename
      */
     function readLines() {
     	$filesize = filesize($this->filename);
		if($filesize > 0) {
	        $handle = fopen($this->filename, "r");
	        $contents = fread($handle, $filesize);
	        $contentArray = explode(PHP_EOL, $contents);
	        fclose($handle);
	        return $contentArray;
	    }
	    else {
	    	return ['test'];
	    }
     }

     public function sanitize() {
		foreach ($this->items as $key => $value) {
			$this->items[$key] = htmlspecialchars(strip_tags($value));
		}
		return $this->items;
	}
     /**
      * Writes each element in $array to a new line in $this->filename
      */
     function writeLines($array) {
     	$array = $this->sanitize($this->items);
	    $handle = fopen($this->filename, "w");
	    $string = implode("\n", $this->items);
	        fwrite($handle, $string);
	        fclose($handle);
     }
     /**
      * Reads contents of csv $this->filename, returns an array
      */
     function readCSV() {
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
			// $this->addresses = $addresses;
		} 

		return $addresses;
     }

     /**
      * Writes contents of $array to csv $this->filename
      */
     function writeCSV($array) {
     	$handle = fopen($this->filename, 'w');
		foreach($array as $row) {
			fputcsv($handle, $row);
		}
		fclose($handle);
     }
 }



?>