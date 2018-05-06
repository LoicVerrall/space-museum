<?php
// This is the Data Abstraction Layer (DAL), and it is soley responsible for interacting with the SQL database.
class Model {
	// A handle to the local database.
	public $db_handle;

	// Constructor for this class creates a database connection (using PHP PDO) to the local SQLite database.
	public function __construct() {
		// Set up the database source name (DSN).
		$dsn = 'sqlite:./assets/db/space_museum_data.db';

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
        artefactName TEXT
      );");

      // Create the new ArtefactData table.
			$this->db_handle->exec("CREATE TABLE ArtefactData (
        artefactId INTEGER PRIMARY KEY,
        artefactDescription TEXT,
        url TEXT,
        resourceName TEXT,
        landingPageImageName TEXT,
        FOREIGN KEY (artefactId) REFERENCES ArtefactName(artefactId)
      );");

      $this->db_handle->exec(
  			"INSERT INTO ArtefactName (artefactId, artefactName)
  				VALUES
          (0, 'Falcon Heavy'),
          (1, 'Dragon'),
          (2, 'MicroGEO'),
          (3, 'Saturn'),
          (4, 'Moon'),
          (5, 'Mars'),
          (6, 'Earth'),
          (7, 'Jupiter');
        "
      );

      $this->db_handle->exec(
  			"INSERT INTO ArtefactData (artefactId, artefactDescription, url, resourceName, landingPageImageName)
  				VALUES
          (0, 'Falcon Heavy is the most powerful operational rocket in the world by a factor of two. With the ability to lift into orbit nearly 64 metric tons (141,000 lb)—a mass greater than a 737 jetliner loaded with passengers, crew, luggage and fuel—Falcon Heavy can lift more than twice the payload of the next closest operational vehicle, the Delta IV Heavy, at one-third the cost. Falcon Heavy draws upon the proven heritage and reliability of Falcon 9.', 'http://www.spacex.com/falcon-heavy', 'falcon_heavy', 'falcon_heavy.jpg'),

          (1, 'Dragon Description', 'http://www.spacex.com/dragon', 'falcon_heavy', 'dragon.jpg'),

          (2, 'MicroGEO Description', 'http://www.spacex.com/dragon', 'falcon_heavy', 'microgeo.jpg'),

          (3, 'Saturn is the sixth planet from the Sun and the second-largest in the Solar System, after Jupiter. It is a gas giant with an average radius about nine times that of Earth. The planets most famous feature is its prominent ring system that is composed mostly of ice particles, with a smaller amount of rocky debris and dust. At least 62 moons are known to orbit Saturn, of which 53 are officially named.', 'https://solarsystem.nasa.gov/planets/saturn/overview/', 'saturn', 'saturn.jpg'),

          (4, 'The fifth largest moon in the solar system, Earths moon is the only place beyond Earth where humans have set foot. The brightest and largest object in our night sky, the moon makes Earth a more livable planet by moderating our home planets wobble on its axis, leading to a relatively stable climate. It also causes tides, creating a rhythm that has guided humans for thousands of years. The moon was likely formed after a Mars-sized body collided with Earth. Earths only natural satellite is simply called the Moon because people did not know other moons existed until Galileo Galilei discovered four moons orbiting Jupiter in 1610.', 'https://solarsystem.nasa.gov/moons/earths-moon/overview/', 'moon', 'moon.jpg'),

          (5, 'Mars is the fourth planet from the Sun and the second-smallest planet in the Solar System after Mercury. In English, Mars carries a name of the Roman god of war, and is often referred to as the Red Planet because the reddish iron oxide prevalent on its surface gives it a reddish appearance that is distinctive among the astronomical bodies visible to the naked eye. Mars is a terrestrial planet with a thin atmosphere, having surface features reminiscent both of the impact craters of the Moon and the valleys, deserts, and polar ice caps of Earth.', 'https://solarsystem.nasa.gov/planets/mars/overview/', 'mars', 'mars.jpg'),

          (6, 'Earth is the third planet from the Sun and the only object in the Universe known to harbor life. According to radiometric dating and other sources of evidence, Earth formed over 4.5 billion years ago. Earths gravity interacts with other objects in space, especially the Sun and the Moon, Earths only natural satellite. Earth revolves around the Sun in 365.26 days, a period known as an Earth year. During this time, Earth rotates about its axis about 366.26 times.', 'https://solarsystem.nasa.gov/planets/earth/overview/', 'earth', 'earth.jpg'),

          (7, 'Though once big enough to swallow three Earths with room to spare, Jupiters Great Red Spot has been shrinking for a century and a half. The Great Red Spot is a giant oval of crimson-colored clouds in Jupiters southern hemisphere with wind speeds greater than any storm on Earth. Measuring 10,000 miles (16,000 kilometers) in width as of April 3, 2017, the Great Red Spot is 1.3 times as wide as Earth. The fifth planet from the Sun, and the most massive in our solar system, has a long history surprising scientists—all the way back to 1610 when Galileo Galilei found the first moons beyond Earth. That discovery changed the way we see the universe.', 'https://solarsystem.nasa.gov/planets/jupiter/overview/', 'jupiter', 'jupiter.jpg');
        "
      );
		} catch (PD0EXception $e){
      echo 'The following error occured while creating the table:<br />';
			print new Exception($e->getMessage());
		}
	}

  // Returns the artefact name associated with this artefact_id.
  public function getArtefactNameWithID($artefact_id) {
    try {
			// Prepare an SQL statement.
			$sql = "SELECT artefactName FROM ArtefactName WHERE artefactId='$artefact_id'";

			// Use PDO query() to query the database with the prepared SQL statement.
			$stmt = $this->db_handle->query($sql);

      // Fetch the result and store it in the model_data variable.
      $artefact_name = $stmt->fetch();
		} catch (PD0EXception $e) {
      echo 'The following error occured while retreiving data from the database:<br />';
			print new Exception($e->getMessage());
		}

		// Send the response (JSON encoded) back to the controller.
		return $artefact_name[0];
  }

  // This method is responsible for retrieving (in JSON) format, the artefact (data) with the specified ID.
  public function dbGetArtefactWithID($artefact_id) {
    try {
			// Prepare an SQL statement.
			$sql = "SELECT * FROM ArtefactData WHERE artefactId='$artefact_id'";

			// Use PDO query() to query the database with the prepared SQL statement.
			$stmt = $this->db_handle->query($sql);

      // Fetch the result and store it in the model_data variable.
      $result = $stmt->fetch();

      // Fetch the name of this artefact.
      $artefact_name = $this->getArtefactNameWithID($artefact_id);

      $artefact_data['artefactName'] = $artefact_name;
      $artefact_data['artefactDescription'] = $result['artefactDescription'];
      $artefact_data['url'] = $result['url'];
      $artefact_data['resourceName'] = $result['resourceName'];
      $artefact_data['x3dFilename'] = $artefact_data['resourceName'] . '.x3d';

      if ($artefact_name === 'Moon' || $artefact_name === 'Mars' || $artefact_name === 'Earth' || $artefact_name === 'Jupiter') {
        $artefact_data['x3dFilename'] = 'generic_planet.x3d';
      }

      $artefact_data['landingPageImageName'] = $result['landingPageImageName'];
		} catch (PD0EXception $e) {
      echo 'The following error occured while retreiving data from the database:<br />';
			print new Exception($e->getMessage());
		}

		// Send the response (JSON encoded) back to the controller.
		return $artefact_data;
  }

  // This function returns the names of the artefacts (used to populate the dropdown list in the header).
	public function dbGetArtefactNames() {
    try {
			// Prepare an SQL statement.
			$sql = "SELECT artefactName FROM ArtefactName";

			// Use PDO query() to query the database with the prepared SQL statement.
			$stmt = $this->db_handle->query($sql);

      $artefact_names = null;

      // Counter for each of the returned rows.
      $i = 0;

      while ($data = $stmt->fetch()) {
        $artefact_names[$i] = $data['artefactName'];
        $i++;
      }
		} catch (PD0EXception $e) {
      echo 'The following error occured while retreiving data from the database:<br />';
			print new Exception($e->getMessage());
		}

		// Send the response (JSON encoded) back to the controller.
		return $artefact_names;
	}

  // Fetch artefact information for the landing page.
  // This includes the artefact names and primary photo name.
  public function dbLandingPageArtefacts() {
    try {
			// Prepare an SQL statement.
			$sql = "SELECT (artefactId) FROM ArtefactName";

			// Use PDO query() to query the database with the prepared SQL statement.
			$stmt = $this->db_handle->query($sql);

      $artefacts = null;

      // Counter for each of the returned rows.
      $i = 0;

      while ($artefactId = $stmt->fetch()) {
        $artefactId = $artefactId[0];
        $artefacts[$artefactId]['artefactName'] = $this->dbGetArtefactWithID($artefactId)['artefactName'];
        $artefacts[$artefactId]['landingPageImageName'] = $this->dbGetArtefactWithID($artefactId)['landingPageImageName'];

        $i++;
      }
		} catch (PD0EXception $e) {
      echo 'The following error occured while retreiving data from the database:<br />';
			print new Exception($e->getMessage());
		}

		// Send the response (JSON encoded) back to the controller.
		return $artefacts;
  }

}
?>
