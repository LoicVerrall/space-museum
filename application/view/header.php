<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>SpaceMuseum</title>

  <!-- Stylesheet imports -->
  <link rel='stylesheet' href='http://www.x3dom.org/x3dom/release/x3dom.css'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css">
  <link rel="stylesheet" type='text/css' href="application/view/css/custom.css">

  <!-- JS script imports (run before page is rendered) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src='http://www.x3dom.org/x3dom/release/x3dom.js'></script>
</head>

<body>
  <!-- Header -->
  <nav class="navbar sticky-top navbar-expand-sm navbar_space_museum">

    <!-- Brand -->
    <div class="brand">
      <a href="index.php">
        <div class="space_museum_logo"></div>
      </a>
      <div class="logo">
        <a class="navbar-brand" href="index.php">
          <h1>SpaceMuseum</h1>
          <p>Exploring space, interactively</p>
        </a>
      </div>
    </div>

    <!-- Burger Menu -->
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target=".navbar-collapse">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Collapsable menu -->
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ml-auto">
        <!-- Home (selected by default) -->
        <li class="nav-item">
          <a class="nav-link <?php echo ($active_index == 0 ? 'active' : '') ?>" id="homebutton" href="index.php">Home</a>
        </li>

        <!-- Models -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?php echo ($active_index == 1 ? 'active' : '') ?>" href="#" id="modelsbutton" data-toggle="dropdown">Models</a>

          <!-- Models dropdown list -->
          <div class="dropdown-menu">
            <?php for ($i = 0; $i < count($data); $i++){ ?>
              <a class="dropdown-item" href="index.php?page=models&model_id=<?php echo $i ?>"><?php echo $data[$i] ?></a>
            <?php } ?>
          </div>
        </li>

        <!-- Blog -->
        <li class="nav-item">
          <a class="nav-link <?php echo ($active_index == 2 ? 'active' : '') ?>" href="index.php?page=blog">Blog</a>
        </li>

        <!-- Contact Us -->
        <li class="nav-item">
          <a class="nav-link <?php echo ($active_index == 3 ? 'active' : '') ?>" href="index.php?page=contact_us">Contact Us</a>
        </li>
      </ul>
    </div>
  </nav>
