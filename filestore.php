<?php

 class Filestore {
    protected $filename = '';

    protected $isCSV = false;

    public function __construct($filename) {
         // Sets $this->filename
     	$this->filename = 'data/' . $filename;
		    if(substr($filename, -3) == 'csv') {
		     	$this->isCSV = true;
		    } 
		}
     /**
      * Returns array of lines in $this->filename
      */

    private function readLines() {
     	// Creates variable that gets the size of the Todo List text file
     	$filesize = filesize($this->filename);
     	// If the Todo List text file has anything in it...
		if($filesize > 0) {
			// Establishes variable that opens the Todo List text file and reads its content
	        $handle = fopen($this->filename, "r");
	        // Establishes variable that opens the text file as long as its not empty
	        $contents = fread($handle, $filesize);
	        // Makes Todo List text file contents into an array
	        $contentArray = explode(PHP_EOL, $contents);
	        // Closes the Todo List text file
	        fclose($handle);
	        // Returns the contents of the text file in array form
	        return $contentArray;
	    
	    // If there is nothing on the list
	    } else {
	    	return ['test'];
	    }
    }

    public function sanitize($array) {
		foreach ($array as $key => $value) {
			$array[$key] = htmlspecialchars(strip_tags($value));
		}
		return $array;
	}
     /**
      * Writes each element in $array to a new line in $this->filename
      */
    private function writeLines($array) {
     	// Strips out any heading tags or other bad stuff
     	$array = $this->sanitize($array);
     	// Establishes variable that will open Todo List text file and write in it
	    $handle = fopen($this->filename, "w");
	    // Makes list items into strings that can be placed on the list
	    $string = implode("\n", $array);
	    	// Opens the Todo List text file and writes in it
	        fwrite($handle, $string);
	        // Closes the Todo List text file
	        fclose($handle);
    }
     /**
      * Reads contents of csv $this->filename, returns an array
      */
    private function readCSV() {
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
		} 

		return $addresses;
    }

     /**
      * Writes contents of $array to csv $this->filename
      */
    private function writeCSV($array) {
     	$handle = fopen($this->filename, 'w');
		foreach($array as $row) {
			fputcsv($handle, $row);
		}
		fclose($handle);
    }

     public function read() {
    	if($this->isCSV == true) {
    		return $this->readCSV();
    	} else {
    		return $this->readLines();
    	}
    }

    public function write($array) {
    	if($this->isCSV == true) {
    		return $this->writeCSV($array);
    	} else {
    		return $this->writeLines($array);
    	}
    }
 }

 	

?>