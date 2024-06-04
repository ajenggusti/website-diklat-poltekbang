<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unauthorized</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            
            background-color: rgb(255, 255, 255);
        }
        .content-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .content img {
            height: 500px; 
            width: 85%;
            text-align: center;
        }

        .content-container a {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="content-container">
        <div class="content">
            <img  src="{{ asset('img/404error.png') }}">

        </div>
        <a href="{{ url('/') }}">Kembali</a>
    </div>
</body>
</html>