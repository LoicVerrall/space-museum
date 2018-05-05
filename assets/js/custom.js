$(document).ready(function () {
  $('[data-toggle="popover"]').popover()
})

var modelIsSpinning = false

function toggleModelSpinning () {
  modelIsSpinning = !modelIsSpinning
  document.getElementById('model__RotationTimer-67-TIMER').setAttribute('enabled', modelIsSpinning.toString())
}

function toggleWireframeMode () {
  document.getElementById('model').runtime.togglePoints(true)
}

var headlightOn = true

function toggleHeadlight () {
  headlightOn = !headlightOn
  document.getElementById('model__Headlight-63').setAttribute('headlight', headlightOn.toString())
}

function cameraFront () {
  document.getElementById('model__CameraFront-61').setAttribute('bind', 'true')
}

function cameraSide () {
  document.getElementById('model__CameraSide-68').setAttribute('bind', 'true')
}

function cameraBottom () {
  document.getElementById('model__CameraBottom-70').setAttribute('bind', 'true')
}
