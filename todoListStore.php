<?

require_once('../inc/filestore.php');

class TodoList extends Filestore {

	public $filename = '';

	public $items = [];

	public function __construct($filename = 'items.txt') {
		$this->filename = 'data/' . $filename;
	}

	public function saveFile($array) {
		return $this->writeLines($array);
	    }

	public function openFile() {
		return $this->readLines();
 	}
}

?>