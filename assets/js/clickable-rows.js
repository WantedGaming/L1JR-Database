/**
 * Makes table rows clickable
 * This script finds all tables with clickable-rows class and makes each row clickable
 * by finding the first link in the row and navigating to that URL when the row is clicked.
 */
document.addEventListener('DOMContentLoaded', function() {
    // Find all tables with the clickable-rows class
    const tables = document.querySelectorAll('table.clickable-rows');
    
    tables.forEach(table => {
        // Add click event to each row in the tbody
        const rows = table.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            // Add a clickable class to show it's clickable
            row.classList.add('clickable');
            
            // Add click event
            row.addEventListener('click', function(e) {
                // Find the first link in the row
                const link = this.querySelector('a');
                
                // If a link exists and the click wasn't on the link itself
                if (link && e.target.tagName !== 'A') {
                    // Navigate to the link's URL
                    window.location.href = link.getAttribute('href');
                }
            });
        });
    });
});
