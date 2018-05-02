<?php
// This class is responsible for displaying the file/data that it is given.
class Load {

	function display($file_name, $data = null) {
		if (is_array($data)) {
			extract($data);
		}
		include $file_name . '.php';
	}
}
?>
