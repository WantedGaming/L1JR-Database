// assets/js/navigation.js

document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const menuToggle = document.getElementById('menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    
    if (menuToggle) {
        menuToggle.addEventListener('click', function() {
            this.classList.toggle('active');
            navMenu.classList.toggle('active');
        });
    }
    
    // Dropdown toggle for all screen sizes
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
    
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const parent = this.parentElement;
            
            const isActive = parent.classList.contains('active');
            
            // For mobile view
            if (window.innerWidth <= 768) {
                parent.classList.toggle('active');
                // Update ARIA attributes
                this.setAttribute('aria-expanded', !isActive);
            } 
            // For desktop view
            else {
                // Close other open dropdowns first
                document.querySelectorAll('.dropdown.active').forEach(dropdown => {
                    if (dropdown !== parent) {
                        dropdown.classList.remove('active');
                        dropdown.querySelector('.dropdown-toggle').setAttribute('aria-expanded', 'false');
                    }
                });
                parent.classList.toggle('active');
                // Update ARIA attributes
                this.setAttribute('aria-expanded', !isActive);
            }
        });
    });
    
    // Close menu when clicking outside
    document.addEventListener('click', function(e) {
        const isClickInsideMenu = navMenu.contains(e.target);
        const isClickOnToggle = menuToggle.contains(e.target);
        const isClickOnDropdownToggle = e.target.classList.contains('dropdown-toggle') || 
                                       e.target.parentElement.classList.contains('dropdown-toggle');
        
        // Close mobile menu when clicking outside
        if (!isClickInsideMenu && !isClickOnToggle && navMenu.classList.contains('active')) {
            menuToggle.classList.remove('active');
            navMenu.classList.remove('active');
            
            // Close all dropdowns
            document.querySelectorAll('.dropdown.active').forEach(dropdown => {
                dropdown.classList.remove('active');
            });
        }
        
        // Close desktop dropdowns when clicking outside
        if (!isClickOnDropdownToggle && !e.target.closest('.dropdown-menu')) {
            // Only close dropdowns if we're on desktop
            if (window.innerWidth > 768) {
                document.querySelectorAll('.dropdown.active').forEach(dropdown => {
                    dropdown.classList.remove('active');
                    // Update ARIA attributes
                    dropdown.querySelector('.dropdown-toggle').setAttribute('aria-expanded', 'false');
                });
            }
        }
    });
    
    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            // Reset mobile menu state on desktop
            menuToggle.classList.remove('active');
            navMenu.classList.remove('active');
            
            // Reset dropdowns on desktop
            document.querySelectorAll('.dropdown.active').forEach(dropdown => {
                dropdown.classList.remove('active');
            });
        }
    });
});
