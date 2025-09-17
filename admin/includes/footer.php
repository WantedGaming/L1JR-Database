    </div><!-- .admin-container -->
    
    <footer class="admin-footer">
        <div class="container footer-content">
            <p>&copy; <?php echo date('Y'); ?> L1J Database Administration Panel</p>
            <div class="footer-links">
                <a href="index.php">Dashboard</a>
                <a href="tables.php">Database Tables</a>
                <a href="../index.php">Main Site</a>
            </div>
        </div>
    </footer>
    
    <!-- JavaScript for message dismissal -->
    <script>
        // Message dismissal
        document.addEventListener('DOMContentLoaded', function() {
            var closeButtons = document.querySelectorAll('.close-message');
            closeButtons.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    this.parentNode.style.display = 'none';
                });
            });
            
            // Auto-hide messages after 5 seconds
            setTimeout(function() {
                var messages = document.querySelectorAll('.admin-message');
                messages.forEach(function(msg) {
                    msg.style.display = 'none';
                });
            }, 5000);
        });
    </script>
</body>
</html>
