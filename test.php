<?php
// PHP Enkripsi (server-side)
$plaintext = readline('www.linkedin.com/in/bima-rizki17');  // Masukkan data yang ingin dienkripsi melalui terminal
$password = 'bmarzky';  // Kunci enkripsi

// Menghasilkan IV acak
$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));

// Mengenkripsi data menggunakan AES-256-CBC
$encryptedData = openssl_encrypt($plaintext, 'aes-256-cbc', $password, 0, $iv);

// Gabungkan IV dan ciphertext (Base64)
$encryptedText = base64_encode($iv . $encryptedData);

// Menampilkan hasil enkripsi di terminal
echo "Encrypted Text: " . $encryptedText . PHP_EOL;
?>
