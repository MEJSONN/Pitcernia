<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }

        /* Styl dla przycisku powrotu w lewym górnym rogu */
        .back {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 16px;
            text-decoration: none;
            color: black;
        }

        /* Styl dla tekstu centralnego */
        h1 {
            font-size: 32px;
            margin-bottom: 20px;
        }

        /* Styl dla obrazka */
        img {
            width: 600px;
            height: auto;
            margin-bottom: 30px;
        }

        /* Styl dla najmniejszego X na dole */
        .close {
            position: absolute;
            bottom: 20px;
            right: 20px;
            font-size: 10px;
            text-decoration: none;
            color: black;
        }
    </style>
</head>

<body>

    <!-- Link do strony.pl w lewym górnym rogu -->
    <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="back">Powrót</a>

    <!-- Centralny tekst -->
    <h1>Czego tu szukasz?</h1>

    <!-- Obrazek -->
    <a href="https://www.youtube.com/watch?v=3bThTarjPec">
        <img src="{{ asset('images/Krzysztof.jpg') }}" alt="Krzysztof">
    </a>

    <!-- Link do strony.pl w prawym dolnym rogu -->
    <a href="https://www.youtube.com/watch?v=fimrULqiExA" class="close">X</a>

</body>

</html>