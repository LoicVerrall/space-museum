<?php echo $header; ?>

<!-- Main content -->
<header class="masthead text-center text-white">
  <div class="container my-auto">
      <div class="col-lg-12 mx-auto">
        <h1>Welcome to SpaceMusem</h1>
        <hr />
      </div>

      <div class="col-lg-6 mx-auto">
        <p>Discover various space rockets, such as the SpaceX Falcon Heavy and Dragon, as well as celestial objects like our Moon.</p>
      </div>
  </div>
</header>

  <div class="container-fluid p-0">
    <div class="row no-gutters">
      <?php for ($i = 0; $i < count($artefacts); $i++){ ?>
        <div class="col-lg-4 col-sm-4">
          <a class="portfolio-box" href="index.php?page=artefacts&artefact_id=<?php echo $i ?>" style="background-image: url('./assets/images/landing_page/<?php echo $artefacts[$i]['landingPageImageName'] ?>')">
            <div class="portfolio-box-caption">
              <div class="portfolio-box-caption-content">
                <div class="project-category text-faded">ARTEFACT</div>
                <div class="project-name"><?php echo $artefacts[$i]['artefactName'] ?></div>
              </div>
            </div>
          </a>
        </div>
      <?php } ?>
    </div>
  </div>

<?php echo $footer; ?>
