<?

class TodoList {

	public $filename = '';

	public $items = [];

	public function __construct($filename = 'items.txt') {
		$this->filename = 'data/' . $filename;
	}

	public function sanitize() {
		foreach ($this->items as $key => $value) {
			$this->items[$key] = htmlspecialchars(strip_tags($value));
		}
		return $this->items;
	}

	public function saveFile() {
		$array = $this->sanitize($this->items);
	    $handle = fopen($this->filename, "w");
	    $string = implode("\n", $this->items);
	        fwrite($handle, $string);
	        fclose($handle);
	    }

	public function openFile() {
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
}

?>