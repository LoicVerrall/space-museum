$(document).ready(function () {
  $('[data-toggle="popover"]').popover()
})

var modelIsSpinning = false

function toggleModelSpinning () {
  modelIsSpinning = !modelIsSpinning
  document.getElementById('model__RotationTimer').setAttribute('enabled', modelIsSpinning.toString())
}

function toggleWireframeMode () {
  document.getElementById('model').runtime.togglePoints(true)
}

var headlightOn = false

function toggleHeadlight () {
  headlightOn = !headlightOn
  document.getElementById('model__Headlight').setAttribute('headlight', headlightOn.toString())
}

function cameraFront () {
  document.getElementById('model__CameraFront').setAttribute('bind', 'true')
}

function cameraSide () {
  document.getElementById('model__CameraSide').setAttribute('bind', 'true')
}

function cameraBottom () {
  document.getElementById('model__CameraBottom').setAttribute('bind', 'true')
}
