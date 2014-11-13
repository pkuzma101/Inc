<?

require_once('../inc/filestore.php')

class TodoList extends Filestore {

	public $filename = '';

	public $items = [];

	public function __construct($filename = 'items.txt') {
		$this->filename = 'data/' . $filename;
	}

	public function sanitize() {
		return $this->sanitize();
	}

	public function saveFile() {
		return $this->writeLines();
	    }

	public function openFile() {
		return $this->readLines();
 	}
}

?>