$(document).ready(function () {
  $('[data-toggle="popover"]').popover()
})

var modelIsSpinning = false

function toggleModelSpinning () {
  modelIsSpinning = !modelIsSpinning
  document.getElementById('model__RotationTimer-67-TIMER').setAttribute('enabled', modelIsSpinning.toString())
}
