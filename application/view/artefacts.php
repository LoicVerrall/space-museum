<?php echo $header; ?>

<!-- Model Content -->
<div class="main_contents">
  <div class="row">

    <!-- Viewer Window Column -->
    <div class="col-sm-7">
      <div class="card text-left">

        <!-- Card Header -->
        <div class="card-header">
          <h4><?php echo $artefact_data['artefactName']; ?></h4>
        </div>

        <!-- Card Body -->
        <div class="card-body">

          <!-- 3D Model -->
          <div class="model3D">
            <x3d>
              <scene>
                <inline url="assets/x3d/<?php echo $artefact_data['x3dResourceName']; ?>"></inline>
              </scene>
            </x3d>
          </div>

          <div class="camera-btns">
            <div class="btn-group ">
              <a href="#" class="btn btn-secondary active btn-responsive camera-font" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Switch to the front camera">Front</a>

              <a href="#" class="btn btn-secondary btn-responsive camera-font" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Switch to the back camera">Back</a>

              <a href="#" class="btn btn-secondary btn-responsive camera-font" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Switch to the left camera">Left</a>

              <a href="#" class="btn btn-secondary btn-responsive camera-font" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Switch to the right camera">Right</a>

              <a href="#" class="btn btn-secondary btn-responsive camera-font" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Switch to the top camera">Top</a>

              <a href="#" class="btn btn-primary btn-responsive camera-font" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Toggle spinning the 3D model">Spin</a>
            </div>
          </div>
        </div>

        <div class="card-footer text-muted">
          X3D model created using Autodesk 3ds Max.
        </div>
      </div>
    </div>

    <!-- Media Gallery & Description Column -->
    <div class="col-sm-5">

      <!-- Description -->
      <div class="card">
        <div class="card-header gallery-header">Description</div>
        <div class="card-body">
          <p><?php echo $artefact_data['artefactDescription']; ?></p>
          <a href="<?php echo $artefact_data['url']; ?>" class="btn btn-info" target='_blank'>More Info</a>
        </div>
      </div>

      <!-- Media Gallery -->
      <div class="card text-left">
        <div class="card-header gallery-header">Media Gallery</div>
        <div class="card-body">
          <h4 class="card-title">Images</h4>
          <p class="card-text">Here, you can select between the X3D model, descriptive video, and a collection of images of the space shuttle.

            <div class="gallery" id="gallery1"></div>
          </div>
        </div>

      </div>
    </div>

</div>

<?php echo $footer; ?>
