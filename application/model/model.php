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

  // This method initialises the databases, and is called once (not every time the app is run).
  // The following happens:
  // - ArtefactName and ArtefactData tables are deleted (if they exist).
  // - Both tables are (re)created (empty).
  // - Both tables are loaded with appropriate data.
	public function dbInitialiseDatabases() {
		try {
      // Delete the existing tables (if they exist).
      $this->db_handle->exec("DROP TABLE IF EXISTS ArtefactName");
      $this->db_handle->exec("DROP TABLE IF EXISTS ArtefactData");

      // Create the new ArtefactName table.
			$this->db_handle->exec("CREATE TABLE ArtefactName (
        artefactId INTEGER PRIMARY KEY,
        artefactName TEXT,
      )");

      // Create the new ArtefactData table.
			$this->db_handle->exec("CREATE TABLE ArtefactData (
        artefactId INTEGER PRIMARY KEY,
        FOREIGN KEY (artefactId) REFERENCES ArtefactName(artefactId),
        artefactDescription TEXT,
        url TEXT,
        x3dResourceName TEXT
      )");

			$this->dbInsertInitialData();
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
  			"INSERT INTO ArtefactName (artefactId, artefactName)
  				VALUES
          (0, 'Falcon Heavy'),
          (1, 'Dragon V2'),
          (2, 'MicroGEO'),
          (3, 'Moon');
        "
      );

      $this->db_handle->exec(
  			"INSERT INTO ArtefactData (artefactId, artefactDescription, url, x3dResourceName)
  				VALUES
          (0, 'Falcon Heavy is the most powerful operational rocket in the world by a factor of two. With the ability to lift into orbit nearly 64 metric tons (141,000 lb)---a mass greater than a 737 jetliner loaded with passengers, crew, luggage and fuel--Falcon Heavy can lift more than twice the payload of the next closest operational vehicle, the Delta IV Heavy, at one-third the cost. Falcon Heavy draws upon the proven heritage and reliability of Falcon 9.', 'http://www.spacex.com/falcon-heavy', 'coke.x3d'),

          (1, 'Dragon is a free-flying spacecraft designed to deliver both cargo and people to orbiting destinations. Dragon made history in 2012 when it became the first commercial spacecraft in history to deliver cargo to the International Space Station and safely return cargo to Earth, a feat previously achieved only by governments. It is the only spacecraft currently flying that is capable of returning significant amounts of cargo to Earth.', 'http://www.spacex.com/dragon', 'sprite.x3d');
        "
      );
		} catch(PD0EXception $e) {
      echo 'The following error occured while inserting the initial data into the database:<br />';
			print new Exception($e->getMessage());
		}

    // Close the connection to the database.
		$this->db_handle = NULL;
	}

  // This method is responsible for retrieving (in JSON) format, the artefact (data) with the specified ID.
  public function dbGetArtefactWithID($artefact_id) {
    try {
			// Prepare an SQL statement.
			$sql = "SELECT * FROM ArtefactData WHERE artefactId='$artefact_id'";

			// Use PDO query() to query the database with the prepared SQL statement.
			$stmt = $this->db_handle->query($sql);

      // Fetch the result and store it in the model_data variable.
      $artefact_data = $stmt->fetch();
		} catch (PD0EXception $e) {
      echo 'The following error occured while retreiving data from the database:<br />';
			print new Exception($e->getMessage());
		}

		// Close the connection to the database.
		$this->db_handle = NULL;

		// Send the response (JSON encoded) back to the controller.
		return $artefact_data;
  }

  // This function returns the names of the artefacts (used to populate the dropdown list in the header).
	public function dbGetArtefactNames() {
    try {
			// Prepare an SQL statement.
			$sql = "SELECT * FROM ArtefactName";

			// Use PDO query() to query the database with the prepared SQL statement.
			$stmt = $this->db_handle->query($sql);

      // Fetch the result and store it in the artefact_names variable.
      $artefact_names = $stmt->fetch();
		} catch (PD0EXception $e) {
      echo 'The following error occured while retreiving data from the database:<br />';
			print new Exception($e->getMessage());
		}

		// Close the connection to the database.
		$this->db_handle = NULL;

		// Send the response (JSON encoded) back to the controller.
		return $artefact_names;
	}
}
?>
