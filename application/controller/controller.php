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
      $this->load->view('home');
    } else {
      // Otherwise, a model_id was specified, so extract it.
      $model_id = $_GET['model_id'];
      // TODO: Fetch this from the model.
      $data['model_id'] = $model_id;
      $this->load->view('models', $data);
    }
  }

	// function apiCreateTable()
	// {
	// 	$data = $this->model->dbCreateTable();
	// 	$this->load->view('viewMessage', $data);
	// }
	// function apiInsertData()
	// {
	// 	$data = $this->model->dbInsertData();
	//    	$this->load->view('viewMessage', $data);
	// }
	// function apiGetData()
	// {
	// 	$data = $this->model->dbGetData();
	// 	$this->load->view('view3DAppData', $data);
	// }
  // function apiGetFlickrFeed()
  // {
  //   $this->load->view('viewFlickrFeed');
  // }
  // function apiGetJson()
  // {
  //   $this->load->view('viewJson');
  // }
  // // API call to select 3D images
	// function apiLoadImage()
	// {
	//    $data = $this->model->dbGetBrand();
	//    // Note, the viewDrinks.php view being loaded here calls a new model
	//    // called modelDrinkDetails.php, which is not part of the Model class
	//    // It is a separate model illustrating that you can have many models
	//    $this->load->view('viewDrinks', $data);
	// }
}
?>
