<?php
// Ambil fakta kucing
$factUrl = 'https://catfact.ninja/fact';
$response = file_get_contents($factUrl);

if ($response === false) {
    die('Error guys');
}

$data = json_decode($response, true);
$fact = $data['fact']; // Ambil fakta kucing

// Ambil gambar kucing
$imageUrl = 'https://api.thecatapi.com/v1/images/search';
$imageResponse = file_get_contents($imageUrl);

if ($imageResponse === false) {
    die('Error fetching cat image');
}

$imageData = json_decode($imageResponse, true);
$imageSrc = $imageData[0]['url']; // Ambil URL gambar kucing
?>

<!--------------------------------------------------------->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAT FACTS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #ff5722; /* Warna oranye */
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .fact {
            font-size: 1.2em;
            line-height: 1.6;
            margin: 20px 0;
            padding: 15px;
            border-left: 5px solid #ff5722; /* Garis di sebelah kiri */
            background-color: #f0f0f0;
        }
        .cat-image {
            text-align: center;
            margin: 20px 0;
        }
        .cat-image img {
            max-width: 100%; /* Responsif */
            border-radius: 8px;
        }
        footer {
            text-align: center;
            margin-top: 20px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>CAT FACTS</h1>
        <div class="fact">
            <?php echo $fact; ?> <!-- Tampilkan fakta kucing -->
        </div>
        <div class="cat-image">
            <img src="<?php echo $imageSrc; ?>" alt="Cute Cat"> <!-- Tampilkan gambar kucing -->
        </div>
    </div>
    <footer>
        <p>Data diambil dari <a href="https://catfact.ninja" target="_blank">catfact.ninja</a> dan <a href="https://thecatapi.com" target="_blank">thecatapi.com</a></p>
    </footer>
</body>
</html>
