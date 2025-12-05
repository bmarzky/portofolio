<?php
session_start();

if (isset($_SESSION['phase1_done']) && $_SESSION['phase1_done'] === true) {
    echo "Anda sudah menyelesaikan Phase 1. Lanjut ke Phase 2.";
    exit;
}

$code   = $_POST['code'] ?? '';
$correct_code = "autopsy";
$message = "";

if (isset($_POST['submit'])) {
    if ($code === $correct_code) {
        $_SESSION['phase1_done'] = true;
        header("Location: ../phase2/scan");
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
<title>TRACE - Gate (Phase 1)</title>
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

<!-- hex -- ASCII | 61 75 74 6F 70 73 79 -->

<body>

WELCOME, AGENT.

TRACE telah menunggu cukup lama, Selamat datang di TRACE — PHASE 1: GATE. 

--- 
TRACE memerlukan kamu untuk membantu masuk kedalam sistem.
Hanya mereka yang memiliki keahlian khusus yang bisa memasukinya.
Tanpa bantuanmu, semua usaha ini akan sia-sia.
Keamanan yang ada di dalamnya jauh lebih kompleks dari yang terlihat.
TRACE telah menunggu orang seperti kamu untuk mengatasi tantangan ini dan menembus sistem yang telah lama terkunci.

Akhir dari perjalanan ini adalah akses langsung untuk berbicara denganku.

--- 
Phase 1: Gate 

ini adalah pintu pertama yang harus kamu buka untuk melanjutkan ke tahap selanjutnya.
Seorang backend developer dari TRACE pernah meninggalkan sebuah catatan, sebuah pesan tersembunyi yang hanya bisa
ditemukan oleh mereka yang tahu caranya. Itu bukan sekadar catatan biasa,
melainkan sebuah petunjuk bagi mereka yang berani mengeksplorasi lebih dalam.

Hanya mereka yang teliti dan berpengetahuan luas yang bisa mengungkap rahasia tersembunyi di dalam sistem ini.
--- 

<form method="POST" style="margin-top:10px;">
    Kode: <input type="text" name="code">
    <button type="submit" name="submit">OK</button>
</form>

<?php if (!empty($message)) echo $message; ?>


[Hint]

- Jejaknya tidak akan pernah muncul di permukaan.

<div class="watermark">© bmarzky</div>

</body>
</html>
