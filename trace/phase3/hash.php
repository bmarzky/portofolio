<?php
session_start();

// pastikan phase 2 sudah selesai
if (!isset($_SESSION['phase2_done']) || $_SESSION['phase2_done'] !== true) {
    echo "Akses ditolak. Selesaikan Phase 2 terlebih dahulu.";
    exit;
}

// jika phase3 sudah selesai → tampilkan pesan
if (isset($_SESSION['phase3_done']) && $_SESSION['phase3_done'] === true) {
    echo "Phase 3 sudah selesai. Lanjut ke Phase 4.";
    exit;
}

$pass = $_POST['pass'] ?? '';
$correct_pass = "Alvaro"; // hasil brute-force Hashcat
$message = "";

// cek submit
if (isset($_POST['submit'])) {
    if ($pass === $correct_pass) {
        $_SESSION['phase3_done'] = true;
        header("Location: ../final/final");
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
<title>TRACE - Hash Extraction (Phase 3)</title>
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
PERJALANAN BERLANJUT, AGENT.

TRACE kembali membutuhkan bantuanmu untuk melangkah lebih dalam. Ini adalah TRACE — PHASE 3: HASH EXTRACTION.

---
Luar biasa, Agen, karena usaha kamu yang luar biasa dalam menyelesaikan Phase 2.
TRACE bisa masuk lebih dalam lalu menemukan sebuah backup password.

---
PHASE 3 : HASH EXTRACTION.

File backup password ini masih belum dapat membuka akses ke sistem utama.
Namun, TRACE juga menemukan biodata pribadi yang mengandung informasi tentang admin perusahaan.
Meski informasi ini tidak langsung memberikan akses, ia bisa menjadi kunci untuk menggali lebih dalam.

Agen, waktumu untuk menyelesaikan ini telah tiba.

---
FILE-BIO-ADMIN

Nama: Darren Alvaro
Usia: 20
Jabatan: CISO @SecureTech
Bidang: Cybersecurity
Admin: admin@securetech.com

IP Server: 192.168.1.100
Firewall: fw-securetech-001
---

Unduh File Backup Password:
→ <a class="download" href="b4ckup_pa55.txt" download>b4ckup_pa55.txt</a>

<form method="POST" style="margin-top:10px;">
    Password: <input type="text" name="pass">
    <button type="submit" name="submit">OK</button>
</form>

<?php if (!empty($message)) echo "<p>$message</p>"; ?>


[Hint – HASH]  
- Gunakan mode MD5
- 10 kata yang diambil

<div class="watermark">bmarzky</div>
</body>
</html>
