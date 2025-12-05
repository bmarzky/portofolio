<?php
session_start();

// pastikan phase 3 sudah selesai
if (!isset($_SESSION['phase3_done']) || $_SESSION['phase3_done'] !== true) {
    echo "Akses ditolak. Selesaikan Phase 3 terlebih dahulu.";
    exit;
}

// jika phase final sudah selesai → tampilkan pesan
if (isset($_SESSION['final_done']) && $_SESSION['final_done'] === true) {
    echo "Selamat! Kamu telah menyelesaikan seluruh fase.";
    exit;
}

$pass = $_POST['pass'] ?? '';
$correct_pass = "TRACEfinal"; // password untuk fase final
$message = "";

// cek submit
if (isset($_POST['submit'])) {
    if ($pass === $correct_pass) {
        $_SESSION['final_done'] = true;
        header("Location: ../final/contact_page"); // arahkan ke halaman kontak
        exit;
    } else {
        $message = "Akses ditolak.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>TRACE - Final Phase</title>
<style>
    body {
        background: #fff;
        color: #000;
        font-family: monospace;
        padding: 20px;
        white-space: pre-wrap;
        position: relative;
    }
    input, button {
        font-family: monospace;
        border: 1px solid #000;
        background: #fff;
        padding: 4px;
    }
    a.download {
        color: #000;
        text-decoration: underline;
        font-size: 10px;
    }
    .watermark {
        position: fixed;
        bottom: 10px;
        right: 10px;
        opacity: 100;
        font-size: 12px;
        pointer-events: none;
        user-select: none;
        color: #000;
    }
</style>
</head>

<body>
SELAMAT, AGENT!  
Kamu Telah Masuk ke Ruang TRACE — Fase Final!  

TRACE telah berhasil menyusup jauh ke dalam sistem.  
Kamu telah membantu TRACE menemukan informasi yang berguna untuk mengakses sistem utama.  

---  

TRACE mengucapkan terima kasih! 
Kamu telah membantu TRACE menyelesaikan seluruh fase. 
Sebagai hadiahnya, berikut adalah password untuk membuka kontakku.  

Let's unite and exploit the vulnerabilities.
---  

Password untuk membuka kontak:
<b>contactPassword123</b>  

---


<div class="watermark">bmarzky</div>
</body>
</html>
