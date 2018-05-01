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
			$this->db_handle->exec("CREATE TABLE ModelData (Id INTEGER PRIMARY KEY, modelTitle TEXT, modelDescription TEXT, url TEXT)");

			return "ModelData table successfully created in space_museum_data.db";
		} catch (PD0EXception $e){
      echo 'The following error occured while creating the table:<br />';
			print new Exception($e->getMessage());
		}

		$this->db_handle = NULL;
	}

  // This function is responsible for inserting the initial data into the database.
	public function dbInsertInitialData() {
		try {
			$this->db_handle->exec(
  			"INSERT INTO ModelData (Id, modelTitle, modelDescription, url)
  				VALUES (1, 'Space Shuttle', 'The Space Shuttle was a partially reusable low Earth orbital spacecraft system operated by the U.S. National Aeronautics and Space Administration (NASA), as part of the Space Shuttle program. Its official program name was Space Transportation System (STS), taken from a 1969 plan for a system of reusable spacecraft of which it was the only item funded for development. The first of four orbital test flights occurred in 1981, leading to operational flights beginning in 1982.', 'https://www.nasa.gov/mission_pages/shuttle/main/index.html'); "
      );

			return "ModelData inserted into space_museum_data.db";
		} catch(PD0EXception $e) {
      echo 'The following error occured while inserting the initial data into the database:<br />';
			print new Exception($e->getMessage());
		}

    // Close the connection to the database.
		$this->db_handle = NULL;
	}

  // This method is responsible for retrieving (in JSON) format, all of the model data stored in the database.
	public function dbGetModelData() {
		try {
			// Prepare a statement to get all records from the ModelData table.
			$sql = 'SELECT * FROM ModelData';

			// Use PDO query() to query the database with the prepared SQL statement.
			$stmt = $this->db_handle->query($sql);

			// Set up an array to return the results to the controller.
			$result = null;

			// Set up a counter to index each row of the array.
			$i = 0;

			// Use PDO fetch() to retrieve the results from the database using a while loop to loop through the rows returned.
			while ($data = $stmt->fetch()) {
				// Write the database contents to the results array for sending back to the controller.
				$result[$i]['modelTitle'] = $data['modelTitle'];
				$result[$i]['modelDescription'] = $data['modelDescription'];
				$result[$i]['url'] = $data['url'];

				$i++;
			}
		} catch (PD0EXception $e) {
      echo 'The following error occured while retreiving data from the database:<br />';
			print new Exception($e->getMessage());
		}

		// Close the connection to the database.
		$this->db_handle = NULL;

		// Send the response (JSON encoded) back to the controller.
		return json_encode($result);
	}

  // This function returns the titles of the models (used to populate the dropdown list).
	public function dbGetModelTypes() {
    // TODO: Move this info into a table of its own.
		return array("Space Shuttle", "Dragon V2", "Asteroid");
	}
}
?>
