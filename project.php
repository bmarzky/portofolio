<?php include('includes/header.php'); ?>

<div class="container">
    <div class="navbar">
        <?php include('includes/navbar.php'); ?>
    </div>

    <div class="main-content">
        <h1>My Projects</h1>
        <p>Tackling cybersecurity challenges with effective solutions and the latest tools.<p>

            <div class="projects-grid">
                    <!-- Project 1 -->
                    <div class="project-folder" onclick="toggleFolder(this)">
                        <div class="folder-icon">
                            <i class="fas fa-folder"></i>
                        </div>
                        <div class="folder-header">
                            Network Security Analysis
                            </div>
                                <div class="folder-content">
                                    <p>Detailed analysis of network traffic to identify vulnerabilities and possible attack vectors.</p>
                                    
                                    <!-- Screenshot Section -->
                                    <h4 class = "tools-h4">Project Screenshot:</h4>
                                    <img src="assets/images/project-photo/1.jpeg" alt="Network Traffic Screenshot" class="folder-screenshot">
                                    
                                    <!-- Tools Used Section -->
                                    <h4 class = "tools-h4">Tools Used:</h4>
                                    <div class="tools">
                                        <div class="tool-icon">
                                            <i class="fas fa-wifi"></i> Wireshark
                                        </div>
                                        <div class="tool-icon">
                                            <i class="fas fa-network-wired"></i> Nmap
                                        </div>
                                        <div class="tool-icon">
                                            <i class="fas fa-laptop-code"></i> Metasploit
                                        </div>
                                    </div>
                                    
                                    <!-- Links to Resources Section -->
                                    <h4 class = "tools-h4">Related Resources:</h4>
                                    <ul>
                                        <li><a href="https://github.com" target="_blank">GitHub Repository</a></li>
                                        <li><span class="project-dates">January 2023 - March 2023</span></li>
                                    </ul>
                                </div>

                            </div>
                    </div>
            </div>

            


    </div>
</div>

<?php include('includes/footer.php'); ?>

<!-- Link ke file JavaScript -->
<script src="js/home.js"></script>
<script>
    function toggleFolder(folder) {
        const content = folder.querySelector('.folder-content');

        // Toggle the "open" class to open or close the folder
        folder.classList.toggle('open');

        // Cek apakah folder sudah terbuka, jika iya, tutup, jika tidak buka
        if (folder.classList.contains('open')) {
            content.style.maxHeight = content.scrollHeight + "px"; // Membuka folder
        } else {
            content.style.maxHeight = null; // Menutup folder
        }
    }
</script>