document.addEventListener("DOMContentLoaded", function() {
    // Load cars automatically when page loads
    var xhr = new XMLHttpRequest();
    xhr.open('POST', document.querySelector('form').dataset.ajaxUrl, true);
    xhr.onload = function() {
      if (xhr.status === 200) {
        document.getElementById('results').innerHTML = xhr.responseText;
      } else {
        console.error('Error:', xhr.statusText);
      }
    };
    xhr.send();
  });
  
  document.getElementById('applyFilters').addEventListener('click', function(event) {
    event.preventDefault(); // prevent form submission
    var formData = new FormData(document.querySelector('form'));
    var xhr = new XMLHttpRequest();
    xhr.open('POST', document.querySelector('form').dataset.ajaxUrl, true);
    xhr.onload = function() {
      if (xhr.status === 200) {
        document.getElementById('results').innerHTML = xhr.responseText;
      } else {
        console.error('Error:', xhr.statusText);
      }
    };
    xhr.send(formData);
  });

