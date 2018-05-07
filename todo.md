# Space Museum Tasks

### 3D Content
- When importing a new model:
  1. Replace the `stopTime` attribute of the **RotationTimer** element with `enabled='false'`.
  2. Increase the `cycleInterval` parameter to **3**.
  3. Find and replace the names of all the cameras, rotation timers, headlights, etc, to remove the numbers.

### Embedding Content
- Load content (and images, possibly sounds/videos) from database.
- Add gallery (in same card as description, but under a different tab).
	- Add images for each artefact.
	- Possibly load sound/video too (from database?).
	- Use AJAX and JSON to transport some data from backend to front end.
- Add Shenzhou 3D model.
- phpDocumentor.
	- Link to documentation.
