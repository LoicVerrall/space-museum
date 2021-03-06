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
          (1, 'Space Shuttle'),
          (2, 'Shenzhou'),
          (3, 'Saturn'),
          (4, 'Moon'),
          (5, 'Mars'),
          (6, 'Earth'),
          (7, 'Jupiter'),
          (8, 'Sun');
        "
      );

      $this->db_handle->exec(
  			"INSERT INTO ArtefactData (artefactId, artefactDescription, url, resourceName, landingPageImageName)
  				VALUES
          (0, 'Falcon Heavy is the most powerful operational rocket in the world by a factor of two. With the ability to lift into orbit nearly 64 metric tons (141,000 lb)—a mass greater than a 737 jetliner loaded with passengers, crew, luggage and fuel—Falcon Heavy can lift more than twice the payload of the next closest operational vehicle, the Delta IV Heavy, at one-third the cost. Falcon Heavy draws upon the proven heritage and reliability of Falcon 9.', 'http://www.spacex.com/falcon-heavy', 'falcon_heavy', 'falcon_heavy.jpg'),

          (1, 'The Space Shuttle was a partially reusable low Earth orbital spacecraft system operated by the U.S. National Aeronautics and Space Administration (NASA), as part of the Space Shuttle program. Its official program name was Space Transportation System (STS), taken from a 1969 plan for a system of reusable spacecraft of which it was the only item funded for development. The first of four orbital test flights occurred in 1981, leading to operational flights beginning in 1982. In addition to the prototype whose completion was cancelled, five complete Shuttle systems were built and used on a total of 135 missions from 1981 to 2011, launched from the Kennedy Space Center (KSC) in Florida. Operational missions launched numerous satellites, interplanetary probes, and the Hubble Space Telescope (HST); conducted science experiments in orbit; and participated in construction and servicing of the International Space Station. The Shuttle fleets total mission time was 1322 days, 19 hours, 21 minutes and 23 seconds.', 'https://www.nasa.gov/mission_pages/shuttle/main/index.html', 'space_shuttle', 'space_shuttle.jpg'),

          (2, 'Shenzhou is a Spacecraft that was developed and is operated by the People’s Republic of China and is desgined for human Space Flight. Shenzhou means Divine Craft. It is based on the Russian Soyuz vehicle, however, it is larger in size and uses all-new construction and materials. The Spacecraft made its maiden voyage in 1999 and performed its first manned mission in 2003 making Yang Liwei the first Taikonaut to orbit Earth. Shenzhou Spacecraft are launched aboard Long March 2F Vehicles that are based on the CZ-2E Rocket, but feature a launch escape system and go through a different quality control process. CZ-2F launches from the Jiquan Satellite Launch Center. Mission Control for Shenzhou Missions is the Beijing Aerospace Command and Control Center.', 'http://spaceflight101.com/spacecraft/shenzhou-spacecraft-overview/', 'shenzhou', 'shenzhou.jpg'),

          (3, 'Saturn is the sixth planet from the Sun and the second-largest in the Solar System, after Jupiter. It is a gas giant with an average radius about nine times that of Earth. The planets most famous feature is its prominent ring system that is composed mostly of ice particles, with a smaller amount of rocky debris and dust. At least 62 moons are known to orbit Saturn, of which 53 are officially named.', 'https://solarsystem.nasa.gov/planets/saturn/overview/', 'saturn', 'saturn.jpg'),

          (4, 'The fifth largest moon in the solar system, Earths moon is the only place beyond Earth where humans have set foot. The brightest and largest object in our night sky, the moon makes Earth a more livable planet by moderating our home planets wobble on its axis, leading to a relatively stable climate. It also causes tides, creating a rhythm that has guided humans for thousands of years. The moon was likely formed after a Mars-sized body collided with Earth. Earths only natural satellite is simply called the Moon because people did not know other moons existed until Galileo Galilei discovered four moons orbiting Jupiter in 1610.', 'https://solarsystem.nasa.gov/moons/earths-moon/overview/', 'moon', 'moon.jpg'),

          (5, 'Mars is the fourth planet from the Sun and the second-smallest planet in the Solar System after Mercury. In English, Mars carries a name of the Roman god of war, and is often referred to as the Red Planet because the reddish iron oxide prevalent on its surface gives it a reddish appearance that is distinctive among the astronomical bodies visible to the naked eye. Mars is a terrestrial planet with a thin atmosphere, having surface features reminiscent both of the impact craters of the Moon and the valleys, deserts, and polar ice caps of Earth.', 'https://solarsystem.nasa.gov/planets/mars/overview/', 'mars', 'mars.jpg'),

          (6, 'Earth is the third planet from the Sun and the only object in the Universe known to harbor life. According to radiometric dating and other sources of evidence, Earth formed over 4.5 billion years ago. Earths gravity interacts with other objects in space, especially the Sun and the Moon, Earths only natural satellite. Earth revolves around the Sun in 365.26 days, a period known as an Earth year. During this time, Earth rotates about its axis about 366.26 times.', 'https://solarsystem.nasa.gov/planets/earth/overview/', 'earth', 'earth.jpg'),

          (7, 'Though once big enough to swallow three Earths with room to spare, Jupiters Great Red Spot has been shrinking for a century and a half. The Great Red Spot is a giant oval of crimson-colored clouds in Jupiters southern hemisphere with wind speeds greater than any storm on Earth. Measuring 10,000 miles (16,000 kilometers) in width as of April 3, 2017, the Great Red Spot is 1.3 times as wide as Earth. The fifth planet from the Sun, and the most massive in our solar system, has a long history surprising scientists—all the way back to 1610 when Galileo Galilei found the first moons beyond Earth. That discovery changed the way we see the universe.', 'https://solarsystem.nasa.gov/planets/jupiter/overview/', 'jupiter', 'jupiter.jpg'),

          (8, 'The Sun is the star at the center of the Solar System. It is a nearly perfect sphere of hot plasma, with internal convective motion that generates a magnetic field via a dynamo process. It is by far the most important source of energy for life on Earth. Its diameter is about 1.39 million kilometers, i.e. 109 times that of Earth, and its mass is about 330,000 times that of Earth, accounting for about 99.86% of the total mass of the Solar System. About three quarters of the Suns mass consists of hydrogen (~73%); the rest is mostly helium (~25%), with much smaller quantities of heavier elements, including oxygen, carbon, neon, and iron.', 'https://www.nasa.gov/sun/', 'sun', 'sun.jpg');
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

      if ($artefact_name === 'Moon' || $artefact_name === 'Mars' || $artefact_name === 'Earth' || $artefact_name === 'Jupiter' || $artefact_name === 'Sun') {
        $artefact_data['x3dFilename'] = 'generic_planet.x3d';
      }

      $artefact_data['landingPageImageName'] = $result['landingPageImageName'];
		} catch (PD0EXception $e) {
      echo 'The following error occured while retreiving data from the database:<br />';
			print new Exception($e->getMessage());
		}

    // Get the paths for the images in this artefact's gallery.
    $image_paths = $this->getGalleryImagePathsForResourceName($artefact_data['resourceName']);
    $artefact_data['galleryImagePaths'] = $image_paths;

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

		// Send the response back to the controller.
		return $artefacts;
  }

  public function getGalleryImagePathsForResourceName($resource_name) {
    $directory = './assets/images/gallery_images/' . $resource_name;
    $allowed_extensions = array('png', 'jpg');
    $dir_handle = opendir($directory);

    $filepaths = null;

    $i = 0;

    while ($file = readdir($dir_handle)) {
        if (substr($file, 0, 1) != '.') {
            $file_components = explode('.', $file);
            $extension = strtolower(array_pop($file_components));
            if (in_array($extension, $allowed_extensions)) {
              $filepaths[$i] = $directory.'/'.$file;
            }
            $i++;
        }

    }

    closedir($dir_handle);
    return $filepaths;
  }

}
?>
