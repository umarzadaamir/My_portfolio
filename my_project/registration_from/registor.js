 const validation = document.querySelectorAll('.needs-validation')
  Array.prototype.slice.call(validation)
  .forEach(function (validation) {
    validation.addEventListener('submit', function (event) {
        if (!validation.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
        }validation.classList.add('was-validated')
    }, false)})
