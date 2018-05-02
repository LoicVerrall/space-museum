<?php
// This is the Data Abstraction Layer (DAL), and it is soley responsible for interacting with the SQL database.
class Model {
	// A handle to the local database.
	public $db_handle;

	// Constructor for this class creates a database connection (using PHP PDO) to the local SQLite database.
	public function __construct() {
		// Set up the database source name (DSN).
		$dsn = 'sqlite:./db/space_museum_data.db';

		try {
			$this->db_handle = new PDO($dsn, 'user', 'password', array(
    													PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    													PDO::ATTR_EMULATE_PREPARES => false,
														));
		} catch (PDOEXception $e) {
			echo 'The following error occured while connecting to the database:<br />';
    	print new Exception($e->getMessage());
  	}
	}

  // This method deletes the ModelData table if there is one already, and creates a new empty one.
	public function dbCreateTable() {
		try {
      // Delete the existing table (if there is one).
      $this->db_handle->exec("DROP TABLE IF EXISTS ModelData");

      // Create the new ModelData table.
			$this->db_handle->exec("CREATE TABLE ModelData (
        Id INTEGER PRIMARY KEY,
        modelTitle TEXT,
        modelDescription TEXT,
        url TEXT,
        x3dResourceName TEXT
      )");

			return "ModelData table successfully created in space_museum_data.db";
		} catch (PD0EXception $e){
      echo 'The following error occured while creating the table:<br />';
			print new Exception($e->getMessage());
		}

		$this->db_handle = NULL;
	}

  // This function is responsible for inserting the initial data into the database.
	public function dbInsertInitialData() {
    $this->dbCreateTable();
		try {
			$this->db_handle->exec(
  			"INSERT INTO ModelData (Id, modelTitle, modelDescription, url, x3dResourceName)
  				VALUES (
            0,
            'Space Shuttle',
            'The Space Shuttle was a partially reusable low Earth orbital spacecraft system operated by the U.S. National Aeronautics and Space Administration (NASA), as part of the Space Shuttle program. Its official program name was Space Transportation System (STS), taken from a 1969 plan for a system of reusable spacecraft of which it was the only item funded for development. The first of four orbital test flights occurred in 1981, leading to operational flights beginning in 1982.',
            'https://www.nasa.gov/mission_pages/shuttle/main/index.html',
            'coke.x3d'
          ); "
      );

			return "ModelData inserted into space_museum_data.db";
		} catch(PD0EXception $e) {
      echo 'The following error occured while inserting the initial data into the database:<br />';
			print new Exception($e->getMessage());
		}

    // Close the connection to the database.
		$this->db_handle = NULL;
	}

  // This method is responsible for retrieving (in JSON) format, the model with the specified ID.
  public function dbGetModelWithID($id) {
    try {
			// Prepare an SQL statement.
			$sql = "SELECT * FROM ModelData WHERE id='$id'";

			// Use PDO query() to query the database with the prepared SQL statement.
			$stmt = $this->db_handle->query($sql);

      // Fetch the result and store it in the model_data variable.
      $model_data = $stmt->fetch();
		} catch (PD0EXception $e) {
      echo 'The following error occured while retreiving data from the database:<br />';
			print new Exception($e->getMessage());
		}

		// Close the connection to the database.
		$this->db_handle = NULL;

		// Send the response (JSON encoded) back to the controller.
		return $model_data;
  }

  // This function returns the titles of the models (used to populate the dropdown list).
	public function dbGetModelNames() {
    // TODO: Move this info into a table of its own.
		return array("Space Shuttle", "Dragon V2", "Asteroid");
	}
}
?>
