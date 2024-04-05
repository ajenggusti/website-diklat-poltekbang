<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <script src="../assets/js/color-modes.js"></script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
{{-- Font Poppins --}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            font-size: 15px;
        }
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        div {
            display: inline-block
        }

        .icon-bar {
            width: 100%;
            background-color: #0E2D45;
            overflow: auto;
        }

        .icon-bar a {
            margin-top: 10px;
            margin-bottom: 10px;
            float: left;
            color: white;
        }

        .icon-bar a:hover {
            color: #000000;
        }
    </style>
</head>
<body>
    <div class="icon-bar">
        <a href="#" style="font-size: 15px; margin-left: 100px;">
            <i class="bi bi-instagram"></i>
        </a>

        <a href="#" style="font-size: 15px; margin-left: 10px;">
            <i class="bi bi-facebook"></i>
        </a>

        <a href="#" style="font-size: 15px; margin-left: 10px;">
            <i class="bi bi-twitter-x"></i>
        </a>

        <a href="#" style="font-size: 15px; margin-left: 10px;">
            <i class="bi bi-youtube"></i>
        </a>

        <a href="#"style="font-size: 15px; margin-left: 10px;">
            <i class="bi bi-whatsapp"></i>
        </a>

        <a href="#"style="font-size: 15px; margin-left: 10px;">
            <i class="bi bi-tiktok"></i>
        </a>
    </div>
</body>
</html>