<?php

$page = $_GET['page'] ?? 'home';

$allowed = ['home', 'about', 'contact'];

if (!in_array($page, $allowed)) {
    include __DIR__ . '/404.php';
    exit; // <- Sangat penting
}

include __DIR__ . "/pages/$page.php";

