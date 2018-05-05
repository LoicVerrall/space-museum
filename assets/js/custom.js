$(document).ready(function () {
  $('[data-toggle="popover"]').popover()
})

var modelIsSpinning = true

function toggleModelSpinning () {
  modelIsSpinning = !modelIsSpinning
  document.getElementById('model__TimeSensor001-67-TIMER').setAttribute('enabled', modelIsSpinning.toString())
}
