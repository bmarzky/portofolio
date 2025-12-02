<?php
// Deteksi current page dari URL cantik
// Contoh: /about -> $currentPage = 'about'
$currentPage = trim($_SERVER['REQUEST_URI'], "/");
$currentPage = $currentPage === "" ? "home" : $currentPage;
?>


<!-- SIDEBAR -->
<aside class="sidebar" id="sidebar">
    <div class="profile">
        <img src="assets/images/profile.jpg" alt="">
        <div class="text-info">
            <h3>Bima Rizki</h3>
            <p>@bmarzky</p>
        </div>
    </div>

    <nav class="menu">
        <a href="home" class="<?= $currentPage == 'home' ? 'active' : '' ?>">
            <i class="fa-solid fa-house"></i> Home
        </a>

        <a href="about" class="<?= $currentPage == 'about' ? 'active' : '' ?>">
            <i class="fa-solid fa-user"></i> About
        </a>

        <a href="projects" class="<?= $currentPage == 'projects' ? 'active' : '' ?>">
            <i class="fa-solid fa-code"></i> Projects
        </a>

        <a href="contact" class="<?= $currentPage == 'contact' ? 'active' : '' ?>">
            <i class="fa-solid fa-envelope"></i> Contact
        </a>
    </nav>


</aside>
