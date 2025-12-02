<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>404 Not Found</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html, body {
        height: 100%;
        width: 100%;
        background: #000;
        color: #fff;
        font-family: 'Share Tech Mono', monospace;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .error-page h1 {
        font-size: 25px; /* ukuran kecil */
        font-weight: normal;
        color: #fff;
        letter-spacing: 1px;
        line-height: 1.2;
    }

    .error-page h1 .separator {
        margin: 0 10px;
        color: #fff;
    }


    /* Responsive */
    @media (max-width: 480px) {
        .error-page h1 {
            font-size: 15px;
        }
    }
</style>
</head>
<body>

<div class="error-page">
    <h1>404 <span class="separator">|</span> Page not found</h1>
</div>

</body>
</html>
