<?php
// This is the Controller in the MVC design pattern. It facilitates the interaction between the view and the model layers.
class Controller {
	// Declare public variables for use by the controller class.
	public $load;
	public $model;

	// The constructor function for the Controller class.
	function __construct() {
		// Initialise the load and model variables as these will be used to display and retrieve data respectively.
		$this->load = new Load();
		$this->model = new Model();
	}

  // This function is called in order to instruct the view to navigate to a particular screen (e.g. home).
  function render($page = null) {
    switch ($page) {
      case "home":
        $this->home();
        break;
      case "models":
        $this->models();
        break;
      default:
        // Show an error message to the user.
        $this->error('Unknown Destination', 'Unable to navigate to page: ' . $page . '.');
    }
  }

  // Render the home screen.
	function home() {
    $data['header'] = $this->generateHeader(0);
    $data['footer'] = $this->generateFooter();
		$this->load->display('home', $data);
	}

  // Render the error screen.
	function error($error_title, $error_description) {
    $data['header'] = $this->generateHeader(-1);
    $data['footer'] = $this->generateFooter();

    $data['err_card_title'] = $error_title;
    $data['err_card_description'] = $error_description;

		$this->load->display('error', $data);
	}

  // Render the models screen.
  function models() {
    // Extract the requested model_id from the URL.
    if (isset($_GET['model_id']) == false) {
      // No model_id was specified, so navigate back to home.
      // TODO: Show error message.
      $this->load->display('home');
    } else {
      // Otherwise, a model_id was specified, so extract it.
      $model_id = $_GET['model_id'];
      // TODO: Fetch this from the model.
      $data['model_id'] = $model_id;
      $data['header'] = $this->generateHeader(1);
      $data['footer'] = $this->generateFooter();
      $this->load->display('models', $data);
    }
  }

  function generateHeader($active_index) {
    ob_start();
    // Used to highlight the selected page in the nav bar.
    $data['active_index'] = $active_index;

    // Load the names of the models (for use in the dropdown menu).
    $data['model_names'] = $this->model->dbGetModelNames();

    $this->load->display('header', $data);
    return ob_get_clean();
  }

  function generateFooter() {
    ob_start();
    $this->load->display('footer');
    return ob_get_clean();
  }

}
?>
