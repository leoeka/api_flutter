<?php

// URL API publik untuk GET, POST, dan DELETE
$url = 'http://jsonplaceholder.typicode.com/posts';

// Jika form dikirim (POST request)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title']) && isset($_POST['body'])) {
    // Data dari form yang akan dikirim ke API
    $new_data = array(
        'title' => $_POST['title'],
        'body' => $_POST['body'],
    );

    // Inisialisasi cURL untuk POST
    $ch_post = curl_init();
    curl_setopt($ch_post, CURLOPT_URL, $url);
    curl_setopt($ch_post, CURLOPT_POST, 1);
    curl_setopt($ch_post, CURLOPT_POSTFIELDS, json_encode($new_data));
    curl_setopt($ch_post, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch_post, CURLOPT_RETURNTRANSFER, true);

    // Eksekusi cURL untuk POST dan dapatkan respon
    $post_response = curl_exec($ch_post);

    // Tutup cURL POST
    curl_close($ch_post);

    // Decode respons dari POST
    $post_response_data = json_decode($post_response, true);
}

// Jika tombol delete ditekan (DELETE request)
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    // URL untuk DELETE request
    $delete_url = $url . '/' . $delete_id;

    // Inisialisasi cURL untuk DELETE
    $ch_delete = curl_init();
    curl_setopt($ch_delete, CURLOPT_URL, $delete_url);
    curl_setopt($ch_delete, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch_delete, CURLOPT_RETURNTRANSFER, true);

    // Eksekusi cURL untuk DELETE dan dapatkan respon
    $delete_response = curl_exec($ch_delete);

    // Tutup cURL DELETE
    curl_close($ch_delete);

    // Tampilkan pesan sukses dari API setelah DELETE
    if ($delete_response === "") {
        $delete_message = "Post ID $delete_id berhasil dihapus.";
    } else {
        $delete_message = "Post ID $delete_id gagal dihapus.";
    }
}

// Inisialisasi cURL untuk GET
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Eksekusi cURL dan simpan respons GET dalam variabel
$response = curl_exec($ch);

// Tutup cURL
curl_close($ch);

// Decode respons JSON dari server menjadi array PHP
$responseData = json_decode($response, true);

// Ambil 5 data pertama dari API (GET)
$first_five = array_slice($responseData, 0, 5);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Post Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: left;
            color: #333;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }
        .card {
            background-color: #c8e6c9;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px;
            padding: 20px;
            width: 300px;
            transition: 0.3s;
        }
        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .card h3 {
            color: #555;
            margin-bottom: 10px;
        }
        .card p {
            color: #777;
            font-size: 14px;
        }
        form {
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button, .delete-button {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            font-size: 14px;
        }
        button {
            background-color: #4CAF50;
            color: white;
        }
        .delete-button {
            background-color: #e53935;
            color: white;
            font-size: 12px;
        }
        .delete-button:hover, button:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>

    <h1>Tambah Data</h1>

    <!-- Form untuk menambahkan data baru (POST) -->
    <form method="POST" action="">
        <label for="title">Judul</label>
        <input type="text" id="title" name="title" required>

        <label for="body">Isi</label>
        <textarea id="body" name="body" rows="4" required></textarea>

        <button type="submit">Submit Data</button>
    </form>

    <?php if (!empty($post_response_data)): ?>
        <h2>Data baru yang ditambahkan</h2>
        <div class="container">
            <div class="card">
                <h3><?php echo htmlspecialchars($post_response_data['title']); ?></h3>
                <p><?php echo htmlspecialchars($post_response_data['body']); ?></p>
            </div>
        </div>
    <?php endif; ?>

    <?php if (isset($delete_message)): ?>
        <h2><?php echo $delete_message; ?></h2>
    <?php endif; ?>

    <h1>Daftar GET Teratas 5</h1>
    
    <div class="container">
        <?php foreach ($first_five as $post): ?>
        <div class="card">
            <h3><?php echo htmlspecialchars($post['title']); ?></h3>
            <p><?php echo htmlspecialchars($post['body']); ?></p>

            <!-- Tombol delete untuk menghapus post -->
            <form method="POST" action="">
                <input type="hidden" name="delete_id" value="<?php echo $post['id']; ?>">
                <button type="submit" class="delete-button">Hapus</button>
            </form>
        </div>
        <?php endforeach; ?>
    </div>

</body>
</html>
