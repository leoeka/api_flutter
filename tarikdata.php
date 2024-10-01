<!-- 
// $url = 'https://jsonplaceholder.typicode.com/posts';

// //inisialisasi curl
// $ch = curl_init();

// //set opsi curl untuk mengambil url, dengan metode GET
// curl_setopt($ch, CURLOPT_URL, $url);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );

// //eksekusi curl dan simpan respon
// $response = curl_exec($ch);
// //tutup curl
// curl_close($ch);

// //ubah respon dari json menjadi array 
// $data = json_decode($response, true);

// print_r($data); -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Posts</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        
        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
 
        thead {
            background-color: #007BFF;
            color: #ffffff;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dddddd;
        }

        tbody tr:hover {
            background-color: #f1f1f1; /* Mengubah warna latar belakang saat hover */
        }

        /* Style untuk tombol */
        button {
            padding: 10px 15px;
            background-color: #007BFF;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3; /* Warna saat hover */
        }
    </style>
</head>
<body>
    <h1>Data Posts</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Body</th>
            </tr>
        </thead>
        <tbody>
        <?php
                // Inisialisasi URL dan pengaturan CURL
                $url = 'http://jsonplaceholder.typicode.com/posts';
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);

                // Ubah respon JSON menjadi array
                $data = json_decode($response, true);

                // Loop untuk menampilkan data dalam tabel
                foreach ($data as $post) {
                    echo "<tr>";
                    echo "<td>" . $post['id'] . "</td>";
                    echo "<td>" . $post['title'] . "</td>";
                    echo "<td>" . $post['body'] . "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>
