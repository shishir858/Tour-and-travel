// itinerary-accordion.js
// Separate JS for Itinerary accordion to avoid conflicts

document.addEventListener('DOMContentLoaded', function() {
  var accordion = document.getElementById('customItinerary');
  if (!accordion) return;

  accordion.addEventListener('show.bs.collapse', function (event) {
    // Only allow one open at a time (Bootstrap 5 handles this by default with data-bs-parent)
    // Custom logic can be added here if needed
  });

  // Optionally, you can add custom scroll or highlight logic here
});
