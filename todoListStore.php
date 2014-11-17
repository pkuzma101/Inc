<?

require_once('../inc/filestore.php');

class TodoList extends Filestore {

	public $filename = '';

	public $items = [];

	public function saveFile($array) {
		return $this->write($array);
	}

	public function openFile() {
		return $this->read();
 	}
}

?>