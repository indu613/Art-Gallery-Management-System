document.addEventListener('DOMContentLoaded', function() {
    const tabLinks = document.querySelectorAll('.tab-links a');
    const tabContents = document.querySelectorAll('.content1');
    const tabFrame = document.getElementById('tabFrame');
  
    tabLinks.forEach(function(link) {
      link.addEventListener('click', function(e) {
        e.preventDefault();
  
        // Deactivate all tab links
        tabLinks.forEach(function(link) {
          link.classList.remove('active');
        });
  
        // Hide all tab contents
        tabContents.forEach(function(content) {
          content.classList.remove('active');
        });
  
        // Activate the clicked tab link
        this.classList.add('active');
  
        // Show the corresponding tab content
        const targetId = this.getAttribute('href').substring(1);
        document.getElementById(targetId).classList.add('active');

      });
    });
    document.querySelector('.tab-links li:first-child').classList.add('active');
    document.getElementById('tab1').classList.add('active');
  });
  
  // Disable the back and forward navigation
  window.history.pushState(null, null, document.URL);
  window.addEventListener('popstate', function () {
      window.history.pushState(null, null, document.URL);
  }); 