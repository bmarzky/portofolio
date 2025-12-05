<?php
header("Content-Type: application/json");

$correct = "contactPassword123";

$mode = $_POST["mode"] ?? "";
$key  = $_POST["key"] ?? "";

// Check password
if ($mode === "check") {
    echo json_encode([
        "status" => ($key === $correct) ? "ok" : "fail"
    ]);
    exit;
}

// Get contacts
if ($mode === "get") {

    if ($key !== $correct) {
        echo json_encode(["status" => "fail"]);
        exit;
    }

    $contacts = '
        <div class="contact-item">
            <i class="fas fa-envelope"></i>
            <div class="contact-text">
                <strong>Email</strong>
                <a href="mailto:bmarzky.official@gmail.com">bmarzky.official@gmail.com</a>
            </div>
        </div>

        <div class="contact-item">
            <i class="fab fa-github"></i>
            <div class="contact-text">
                <strong>GitHub</strong>
                <a href="https://github.com/bmarzky" target="_blank">github.com/bmarzky</a>
            </div>
        </div>

        <div class="contact-item">
            <i class="fab fa-whatsapp"></i>
            <div class="contact-text">
                <strong>WhatsApp</strong>
                <a href="https://wa.me/0895383172727" target="_blank">0895-3831-72727</a>
            </div>
        </div>

        <div class="contact-item">
            <i class="fab fa-linkedin"></i>
            <div class="contact-text">
                <strong>LinkedIn</strong>
                <a href="https://linkedin.com/in/bima-rizki17" target="_blank">linkedin.com/in/bima-rizki17</a>
            </div>
        </div>
    ';

    echo json_encode([
        "status" => "ok",
        "html" => $contacts
    ]);

    exit;
}

// Invalid mode
echo json_encode(["status" => "invalid"]);
exit;
?>
