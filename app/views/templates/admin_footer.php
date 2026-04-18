    </div> <!-- End main-content -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Logout Animation Script -->
    <script src="<?= BASEURL; ?>/js/logout.js"></script>

    <script>
        // Handle Logout Click with Animation
        document.querySelectorAll('.logoutButton').forEach(button => {
            button.addEventListener('click', () => {
                // Wait for animation to finish (roughly 3-4 seconds based on script.js)
                setTimeout(() => {
                    window.location.href = "<?= BASEURL; ?>/auth/logout";
                }, 3500); 
            });
        });

        // Global function for Sidebar Toggle (if needed for mobile)
        function toggleSidebar() {
            // Implementation if needed
        }
    </script>
</body>

</html>
