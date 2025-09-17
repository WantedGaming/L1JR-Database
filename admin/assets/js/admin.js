/**
 * L1J Database Admin JavaScript
 */

document.addEventListener('DOMContentLoaded', function() {
    // Admin Chat Window functionality
    const chatContainer = document.getElementById('adminChatMessages');
    const refreshButton = document.getElementById('refreshChat');
    const autoRefreshCheckbox = document.getElementById('autoRefresh');
    const logTypeFilter = document.getElementById('logTypeFilter');
    let refreshInterval;

    if (chatContainer && refreshButton && autoRefreshCheckbox && logTypeFilter) {
        // Function to fetch logs
        function fetchLogs() {
            const filterType = logTypeFilter.value;
            
            // Show loading indicator if empty
            if (chatContainer.children.length === 0) {
                chatContainer.innerHTML = '<div class="chat-loading">Loading activity logs...</div>';
            }
            
            // AJAX request to get logs
            fetch('get_admin_logs.php' + (filterType ? '?type=' + filterType : ''))
                .then(response => response.json())
                .then(logs => {
                    if (logs.error) {
                        chatContainer.innerHTML = `<div class="chat-error">${logs.error}</div>`;
                        return;
                    }
                    
                    chatContainer.innerHTML = '';
                    
                    if (logs.length === 0) {
                        chatContainer.innerHTML = '<div class="chat-no-logs">No activity logs found.</div>';
                        return;
                    }
                    
                    logs.forEach(log => {
                        const logItem = document.createElement('div');
                        logItem.className = 'chat-message';
                        
                        // Determine the type of log for styling
                        if (log.action && log.action.includes('login')) {
                            logItem.classList.add('log-login');
                        } else if (log.action && log.action.includes('add')) {
                            logItem.classList.add('log-add');
                        } else if (log.action && log.action.includes('edit')) {
                            logItem.classList.add('log-edit');
                        } else if (log.action && log.action.includes('delete')) {
                            logItem.classList.add('log-delete');
                        }
                        
                        // Format timestamp
                        const timestamp = new Date(log.timestamp);
                        const formattedTime = timestamp.toLocaleString();
                        
                        // Build the message content
                        logItem.innerHTML = `
                            <div class="chat-message-header">
                                <span class="chat-user">User ID: ${log.user_id || 'System'}</span>
                                <span class="chat-time">${formattedTime}</span>
                            </div>
                            <div class="chat-message-content">
                                <strong>${log.action || 'Unknown Action'}</strong>: ${log.details || ''}
                            </div>
                            <div class="chat-message-footer">
                                <span class="chat-ip">${log.ip_address || 'Unknown IP'}</span>
                            </div>
                        `;
                        
                        chatContainer.appendChild(logItem);
                    });
                    
                    // Scroll to the latest message
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                })
                .catch(error => {
                    console.error('Error fetching logs:', error);
                    chatContainer.innerHTML = '<div class="chat-error">Error loading logs. Please try again.</div>';
                });
        }
        
        // Set up auto-refresh
        function setupAutoRefresh() {
            clearInterval(refreshInterval);
            if (autoRefreshCheckbox.checked) {
                refreshInterval = setInterval(fetchLogs, 10000); // Refresh every 10 seconds
            }
        }
        
        // Initial load
        fetchLogs();
        setupAutoRefresh();
        
        // Event listeners
        refreshButton.addEventListener('click', fetchLogs);
        autoRefreshCheckbox.addEventListener('change', setupAutoRefresh);
        logTypeFilter.addEventListener('change', fetchLogs);
    }
    // Mobile menu toggle
    const menuToggle = document.getElementById('menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    
    if (menuToggle && navMenu) {
        menuToggle.addEventListener('click', function() {
            menuToggle.classList.toggle('active');
            navMenu.classList.toggle('active');
        });
    }
    
    // Dropdown toggles for mobile
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
    
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            if (window.innerWidth <= 768) {
                e.preventDefault();
                const dropdown = this.parentNode;
                dropdown.classList.toggle('active');
            }
        });
    });
    
    // Confirmation dialogs for delete actions
    const deleteButtons = document.querySelectorAll('.delete-confirm');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to delete this item? This action cannot be undone.')) {
                e.preventDefault();
            }
        });
    });
    
    // Dismissible alerts
    const alertCloseButtons = document.querySelectorAll('.close-message');
    
    alertCloseButtons.forEach(button => {
        button.addEventListener('click', function() {
            this.parentNode.style.display = 'none';
        });
    });
    
    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.admin-message');
        alerts.forEach(alert => {
            alert.style.display = 'none';
        });
    }, 5000);
    
    // File input preview
    const fileInputs = document.querySelectorAll('.file-input');
    
    fileInputs.forEach(input => {
        input.addEventListener('change', function() {
            const fileName = this.files[0]?.name || 'No file selected';
            const fileSize = this.files[0]?.size ? formatFileSize(this.files[0].size) : '';
            const previewElement = document.querySelector(`#${this.id}-preview`);
            
            if (previewElement) {
                const nameElement = previewElement.querySelector('.file-name');
                const sizeElement = previewElement.querySelector('.file-size');
                
                if (nameElement) nameElement.textContent = fileName;
                if (sizeElement) sizeElement.textContent = fileSize;
                
                previewElement.classList.add('active');
            }
        });
    });
    
    // Format file size
    function formatFileSize(bytes) {
        if (bytes >= 1073741824) {
            return (bytes / 1073741824).toFixed(2) + ' GB';
        } else if (bytes >= 1048576) {
            return (bytes / 1048576).toFixed(2) + ' MB';
        } else if (bytes >= 1024) {
            return (bytes / 1024).toFixed(2) + ' KB';
        }
        
        return bytes + ' bytes';
    }
    
    // Collapsible sections
    const collapseSections = document.querySelectorAll('.collapse-header');
    
    collapseSections.forEach(header => {
        header.addEventListener('click', function() {
            const section = this.parentNode;
            section.classList.toggle('active');
        });
    });
    
    // Modal functionality
    const modalTriggers = document.querySelectorAll('[data-modal]');
    
    modalTriggers.forEach(trigger => {
        trigger.addEventListener('click', function() {
            const modalId = this.dataset.modal;
            const modal = document.getElementById(modalId);
            
            if (modal) {
                modal.classList.add('active');
                
                // Close when clicking outside modal content
                modal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        this.classList.remove('active');
                    }
                });
                
                // Close when clicking close button
                const closeBtn = modal.querySelector('.modal-close');
                if (closeBtn) {
                    closeBtn.addEventListener('click', function() {
                        modal.classList.remove('active');
                    });
                }
            }
        });
    });
    
    // Table row actions (clickable rows)
    const clickableRows = document.querySelectorAll('tr.clickable');
    
    clickableRows.forEach(row => {
        row.addEventListener('click', function(e) {
            // Don't trigger if clicking on a button or link inside the row
            if (e.target.tagName === 'A' || e.target.tagName === 'BUTTON' || e.target.closest('a') || e.target.closest('button')) {
                return;
            }
            
            const href = this.dataset.href;
            if (href) {
                window.location.href = href;
            }
        });
    });
    
    // Form field dynamic dependency
    const dependentFields = document.querySelectorAll('[data-depends-on]');
    
    dependentFields.forEach(field => {
        const controlFieldId = field.dataset.dependsOn;
        const controlField = document.getElementById(controlFieldId);
        
        if (controlField) {
            // Initial check
            updateFieldVisibility(controlField, field);
            
            // Add event listener to the control field
            controlField.addEventListener('change', function() {
                updateFieldVisibility(this, field);
            });
        }
    });
    
    function updateFieldVisibility(controlField, dependentField) {
        const requiredValue = dependentField.dataset.dependsValue;
        const currentValue = controlField.type === 'checkbox' ? controlField.checked.toString() : controlField.value;
        
        // Check if the current value matches the required value (or if any value is allowed)
        if (!requiredValue || requiredValue === currentValue) {
            dependentField.closest('.form-group').style.display = '';
        } else {
            dependentField.closest('.form-group').style.display = 'none';
        }
    }
    
    // Select all checkboxes functionality
    const selectAllCheckboxes = document.querySelectorAll('.select-all');
    
    selectAllCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const targetClass = this.dataset.target;
            const checked = this.checked;
            
            document.querySelectorAll(`.${targetClass}`).forEach(item => {
                item.checked = checked;
            });
        });
    });
    
    // Bulk actions
    const bulkActionForms = document.querySelectorAll('.bulk-action-form');
    
    bulkActionForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const action = this.querySelector('.bulk-action-select').value;
            
            if (action === '') {
                e.preventDefault();
                alert('Please select an action.');
                return;
            }
            
            const selectedItems = document.querySelectorAll('.bulk-item:checked');
            if (selectedItems.length === 0) {
                e.preventDefault();
                alert('Please select at least one item.');
                return;
            }
            
            if (action === 'delete') {
                if (!confirm('Are you sure you want to delete the selected items? This action cannot be undone.')) {
                    e.preventDefault();
                }
            }
        });
    });
    
    // Auto-generate slugs
    const slugSources = document.querySelectorAll('[data-slug-source]');
    
    slugSources.forEach(source => {
        const targetId = source.dataset.slugSource;
        const target = document.getElementById(targetId);
        
        if (target) {
            source.addEventListener('input', function() {
                // Only generate slug if the target field is empty or hasn't been manually edited
                if (target.dataset.slugEdited !== 'true') {
                    target.value = generateSlug(this.value);
                }
            });
            
            // Mark the slug field as edited when user changes it
            target.addEventListener('input', function() {
                this.dataset.slugEdited = 'true';
            });
        }
    });
    
    function generateSlug(text) {
        return text.toString().toLowerCase()
            .replace(/\s+/g, '-')           // Replace spaces with -
            .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
            .replace(/\-\-+/g, '-')         // Replace multiple - with single -
            .replace(/^-+/, '')             // Trim - from start of text
            .replace(/-+$/, '');            // Trim - from end of text
    }
    
    // Date range pickers
    const dateRangePickers = document.querySelectorAll('.date-range-picker');
    
    dateRangePickers.forEach(picker => {
        const startInput = picker.querySelector('.date-range-start');
        const endInput = picker.querySelector('.date-range-end');
        
        if (startInput && endInput) {
            startInput.addEventListener('change', function() {
                // Set the min date for the end date input
                endInput.min = this.value;
                
                // If end date is earlier than start date, update it
                if (endInput.value && endInput.value < this.value) {
                    endInput.value = this.value;
                }
            });
            
            endInput.addEventListener('change', function() {
                // Set the max date for the start date input
                startInput.max = this.value;
                
                // If start date is later than end date, update it
                if (startInput.value && startInput.value > this.value) {
                    startInput.value = this.value;
                }
            });
        }
    });
    
    // Dynamic form fields (add/remove fields)
    const addFieldButtons = document.querySelectorAll('.add-field');
    
    addFieldButtons.forEach(button => {
        button.addEventListener('click', function() {
            const container = document.getElementById(this.dataset.container);
            const template = document.getElementById(this.dataset.template);
            
            if (container && template) {
                const clone = template.content.cloneNode(true);
                const index = container.children.length;
                
                // Update field names with new index
                clone.querySelectorAll('[name]').forEach(field => {
                    field.name = field.name.replace('[0]', `[${index}]`);
                    field.id = field.id ? field.id.replace('_0_', `_${index}_`) : '';
                });
                
                // Add remove button handler
                const removeButton = clone.querySelector('.remove-field');
                if (removeButton) {
                    removeButton.addEventListener('click', function() {
                        this.closest('.dynamic-field').remove();
                    });
                }
                
                container.appendChild(clone);
            }
        });
    });
    
    // Initialize any existing remove buttons
    document.querySelectorAll('.remove-field').forEach(button => {
        button.addEventListener('click', function() {
            this.closest('.dynamic-field').remove();
        });
    });
    
    // AJAX data loading for select fields
    const ajaxSelects = document.querySelectorAll('.ajax-select');
    
    ajaxSelects.forEach(select => {
        const sourceUrl = select.dataset.source;
        const dependsOn = select.dataset.dependsOn;
        
        if (sourceUrl) {
            if (dependsOn) {
                // If this select depends on another field
                const dependentField = document.getElementById(dependsOn);
                
                if (dependentField) {
                    dependentField.addEventListener('change', function() {
                        loadSelectOptions(select, sourceUrl, this.value);
                    });
                    
                    // Initial load if the dependent field has a value
                    if (dependentField.value) {
                        loadSelectOptions(select, sourceUrl, dependentField.value);
                    }
                }
            } else {
                // Load options immediately if no dependencies
                loadSelectOptions(select, sourceUrl);
            }
        }
    });
    
    function loadSelectOptions(select, url, dependentValue = null) {
        // Clear existing options
        select.innerHTML = '<option value="">Loading...</option>';
        
        // Build URL with dependent value if necessary
        const fullUrl = dependentValue ? `${url}?filter=${dependentValue}` : url;
        
        // Make AJAX request
        fetch(fullUrl)
            .then(response => response.json())
            .then(data => {
                // Clear the select
                select.innerHTML = '<option value="">Select an option</option>';
                
                // Add new options
                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.value;
                    option.textContent = item.label;
                    select.appendChild(option);
                });
                
                // Trigger change event to update any dependent fields
                const event = new Event('change');
                select.dispatchEvent(event);
            })
            .catch(error => {
                console.error('Error loading select options:', error);
                select.innerHTML = '<option value="">Error loading options</option>';
            });
    }
    
    // Form validation
    const adminForms = document.querySelectorAll('.admin-form');
    
    adminForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    highlightError(field);
                } else {
                    removeError(field);
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                alert('Please fill in all required fields.');
            }
        });
    });
    
    function highlightError(field) {
        field.classList.add('is-invalid');
        const formGroup = field.closest('.form-group');
        
        if (formGroup) {
            const errorMessage = formGroup.querySelector('.error-message') || document.createElement('div');
            errorMessage.className = 'error-message';
            errorMessage.textContent = 'This field is required';
            
            if (!formGroup.querySelector('.error-message')) {
                formGroup.appendChild(errorMessage);
            }
        }
    }
    
    function removeError(field) {
        field.classList.remove('is-invalid');
        const formGroup = field.closest('.form-group');
        
        if (formGroup) {
            const errorMessage = formGroup.querySelector('.error-message');
            if (errorMessage) {
                formGroup.removeChild(errorMessage);
            }
        }
    }
    
    // Initialize any rich text editors
    const richTextEditors = document.querySelectorAll('.rich-text-editor');
    
    if (richTextEditors.length > 0 && typeof ClassicEditor !== 'undefined') {
        richTextEditors.forEach(editor => {
            ClassicEditor
                .create(editor)
                .catch(error => {
                    console.error('Error initializing rich text editor:', error);
                });
        });
    }
});
