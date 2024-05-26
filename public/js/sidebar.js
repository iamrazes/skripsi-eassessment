
        // Function to handle sidebar visibility based on screen size
        function handleSidebar() {
            var sidebar = document.getElementById("sidebar");
            var closeButton = document.getElementById("closeSidebar");

            // Check if the window width is less than or equal to lg breakpoint
            if (window.innerWidth <= 1024) {
                // Check if the sidebar is visible
                if (!sidebar.classList.contains("hidden")) {
                    // Hide the sidebar and close button
                    sidebar.classList.add("hidden");
                    closeButton.classList.add("hidden");
                    sidebar.style.position = "static";
                    sidebar.style.zIndex = "auto";
                }
            } else {
                // Sidebar is visible on larger screens
                sidebar.classList.remove("hidden");
            }
        }

        // Call the function initially
        handleSidebar();

        // Listen for window resize event
        window.addEventListener("resize", function() {
            handleSidebar();
        });

        // Toggle sidebar function
        document.getElementById("sidebarButton").addEventListener("click", function() {
            var sidebar = document.getElementById("sidebar");
            var closeButton = document.getElementById("closeSidebar");
            if (sidebar.classList.contains("hidden")) {
                sidebar.classList.remove("hidden");
                closeButton.classList.remove("hidden");
                sidebar.style.position = "fixed";
                sidebar.style.zIndex = "9999";
            } else {
                sidebar.classList.add("hidden");
                closeButton.classList.add("hidden");
                sidebar.style.position = "static";
                sidebar.style.zIndex = "auto";
            }
        });

        // Close sidebar function
        document.getElementById("closeSidebar").addEventListener("click", function() {
            var sidebar = document.getElementById("sidebar");
            var closeButton = document.getElementById("closeSidebar");
            sidebar.classList.add("hidden");
            closeButton.classList.add("hidden");
            sidebar.style.position = "static";
            sidebar.style.zIndex = "auto";
        });
