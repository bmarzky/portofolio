<?php
session_start();

// pastikan phase 1 selesai
if (!isset($_SESSION['phase1_done']) || $_SESSION['phase1_done'] !== true) {
    echo "Akses ditolak. Selesaikan Phase 1 terlebih dahulu.";
    exit;
}

// jika phase2 sudah selesai → tampilkan pesan & hentikan
if (isset($_SESSION['phase2_done']) && $_SESSION['phase2_done'] === true) {
    echo "Anda sudah menyelesaikan Phase 2. Lanjut ke Phase 3.";
    exit;
}

$code   = $_POST['code'] ?? '';
$correct_code = "170904";
$message = "";

// cek submit
if (isset($_POST['submit'])) {
    if ($code === $correct_code) {
        $_SESSION['phase2_done'] = true;
        header("Location: ../phase3/brute");
        exit;
    } else {
        $message = "Kode salah. Coba lagi.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>TRACE - Pattern Scan (Phase 2)</title>
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
        text-shadow: 0 0 2px rgba(0, 0, 0, 0.2);
    }
</style>
</head>

<body>
PERJALANAN BELUM SELESAI, AGENT.

TRACE kembali memerlukan bantuanmu untuk melanjutkan, Selamat datang di TRACE — PHASE 2: PATTERN SCAN. 

---
Terima kasih, Agen, atas dedikasi dan ketelitianmu dalam menyelesaikan Phase 1.
TRACE kali ini menemukan data log yang kemungkinan besar bisa menjadi acuan kita untuk masuk lebih dalam ke sistem.
---

---
Phase 2: Pattern Scan 

TRACE membutuhkan bantuanmu untuk menemukan ketidakteraturan di antara ribuan data yang tampak normal.
Satu elemen di antara data itu tidak seharusnya ada, dan hanya kamu yang dapat menemukannya.

Dengan teliti, periksa setiap detail. Keberhasilanmu di fase ini akan membuka jalan menuju tantangan berikutnya.
---


Unduh file data log-nya.
→ <a class="download" href="blkmap_021.log" download>blkmap_021.log</a>

<form method="POST" style="margin-top:10px;">
    Kode: <input type="text" name="code">
    <button type="submit" name="submit">OK</button>
</form>

<?php if (!empty($message)) echo "<p>$message</p>"; ?>

[Hint – SCAN]  

- Entropy adalah kuncinya.

<div class="watermark">bmarzky</div>
</body>
</html>
