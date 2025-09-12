// assets/js/navigation.js

document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const menuToggle = document.getElementById('menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    
    if (menuToggle) {
        menuToggle.addEventListener('click', function() {
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !isExpanded);
            this.classList.toggle('active');
            navMenu.classList.toggle('active');
        });
        
        // Add ARIA attributes for mobile toggle
        menuToggle.setAttribute('aria-expanded', 'false');
        menuToggle.setAttribute('aria-label', 'Toggle navigation menu');
        menuToggle.setAttribute('aria-controls', 'nav-menu');
    }
    
    // Add ID to nav menu for ARIA
    if (navMenu) {
        navMenu.id = 'nav-menu';
    }
    
    // Dropdown toggle for all screen sizes
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
    
    dropdownToggles.forEach(toggle => {
        // Add ARIA attributes
        toggle.setAttribute('aria-haspopup', 'true');
        toggle.setAttribute('aria-expanded', 'false');
        
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
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
        
        // Keyboard navigation for dropdowns
        toggle.addEventListener('keydown', function(e) {
            const parent = this.parentElement;
            const dropdownMenu = parent.querySelector('.dropdown-menu');
            const menuItems = dropdownMenu ? dropdownMenu.querySelectorAll('a') : [];
            
            switch(e.key) {
                case 'Enter':
                case 'Space':
                    e.preventDefault();
                    this.click();
                    if (menuItems.length > 0 && parent.classList.contains('active')) {
                        menuItems[0].focus();
                    }
                    break;
                case 'ArrowDown':
                    if (parent.classList.contains('active') && menuItems.length > 0) {
                        e.preventDefault();
                        menuItems[0].focus();
                    }
                    break;
                case 'Escape':
                    if (parent.classList.contains('active')) {
                        parent.classList.remove('active');
                        this.setAttribute('aria-expanded', 'false');
                        this.focus();
                    }
                    break;
            }
        });
    });
    
    // Keyboard navigation within dropdown menus
    document.addEventListener('keydown', function(e) {
        const activeDropdown = document.querySelector('.dropdown.active');
        if (!activeDropdown) return;
        
        const menuItems = activeDropdown.querySelectorAll('.dropdown-menu a');
        const focusedItem = document.activeElement;
        const currentIndex = Array.from(menuItems).indexOf(focusedItem);
        
        if (currentIndex !== -1) {
            switch(e.key) {
                case 'ArrowDown':
                    e.preventDefault();
                    const nextIndex = (currentIndex + 1) % menuItems.length;
                    menuItems[nextIndex].focus();
                    break;
                case 'ArrowUp':
                    e.preventDefault();
                    const prevIndex = (currentIndex - 1 + menuItems.length) % menuItems.length;
                    menuItems[prevIndex].focus();
                    break;
                case 'Escape':
                    e.preventDefault();
                    activeDropdown.classList.remove('active');
                    activeDropdown.querySelector('.dropdown-toggle').setAttribute('aria-expanded', 'false');
                    activeDropdown.querySelector('.dropdown-toggle').focus();
                    break;
                case 'Tab':
                    // Close dropdown when tabbing out
                    setTimeout(() => {
                        if (!activeDropdown.contains(document.activeElement)) {
                            activeDropdown.classList.remove('active');
                            activeDropdown.querySelector('.dropdown-toggle').setAttribute('aria-expanded', 'false');
                        }
                    }, 10);
                    break;
            }
        }
    });
    
    // Close menu when clicking outside
    document.addEventListener('click', function(e) {
        const isClickInsideMenu = navMenu.contains(e.target);
        const isClickOnToggle = menuToggle && menuToggle.contains(e.target);
        const isClickOnDropdownToggle = e.target.classList.contains('dropdown-toggle') || 
                                       e.target.closest('.dropdown-toggle');
        
        // Close mobile menu when clicking outside
        if (!isClickInsideMenu && !isClickOnToggle && navMenu && navMenu.classList.contains('active')) {
            if (menuToggle) {
                menuToggle.classList.remove('active');
                menuToggle.setAttribute('aria-expanded', 'false');
            }
            navMenu.classList.remove('active');
            
            // Close all dropdowns
            document.querySelectorAll('.dropdown.active').forEach(dropdown => {
                dropdown.classList.remove('active');
                dropdown.querySelector('.dropdown-toggle').setAttribute('aria-expanded', 'false');
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
            if (menuToggle) {
                menuToggle.classList.remove('active');
                menuToggle.setAttribute('aria-expanded', 'false');
            }
            if (navMenu) {
                navMenu.classList.remove('active');
            }
            
            // Reset dropdowns on desktop
            document.querySelectorAll('.dropdown.active').forEach(dropdown => {
                dropdown.classList.remove('active');
                dropdown.querySelector('.dropdown-toggle').setAttribute('aria-expanded', 'false');
            });
        }
    });
});
