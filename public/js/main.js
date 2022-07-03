var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})

var alertNode = document.querySelector('.alert-dismissible')
if(alertNode){
  var alert = bootstrap.Alert.getOrCreateInstance(alertNode)
  window.setTimeout(function(){alert.close()},4000)
}
