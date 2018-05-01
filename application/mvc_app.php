<!-- This is effectively the landing page for the app (from index.php) -->

<?php
  // Import the appropriate classes so that the controller has access to them.
  require 'view/load.php';
  require 'model/model.php';
  require 'controller/controller.php';

  // Create the Controller class that will facilitate navigation and access to the model.
  $controller = new Controller();

  if (isset($_GET['page']) == false) {
    // No page was specified, so navigate to home.
    $controller->render('home');
  } else {
    // Otherwise, a page was specified, so extract it.
    $page = $_GET['page'];
    $controller->render($page);
  }
?>
