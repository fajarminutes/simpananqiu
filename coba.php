<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pengecekan Urutan</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .not-on-track {
            color: red;
        }
    </style>
</head>
<body>

<?php
// Menghubungkan ke database (ganti sesuai pengaturan database Anda)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sina8961_sipandu3";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data checkpoints berdasarkan id dengan urutan ascending
$sql = "SELECT * FROM checkpoints ORDER BY id";
$result = $conn->query($sql);

// Inisialisasi variabel untuk menyimpan status
$statusUrutan = 'Sesuai';

// Mulai tabel HTML
echo '<table>';
echo '<tr><th>ID</th><th>Employees Code</th><th>Urutan</th><th>Todo List</th><th>Employees Name</th><th>ID Area Patroli</th><th>Shift ID</th><th>Building ID</th><th>Photo</th><th>Created Login</th><th>Created Cookies</th><th>On Track</th></tr>';

// Periksa urutan dan tampilkan data
while ($row = $result->fetch_assoc()) {
    $currentId = $row['id'];
    $currentUrutan = $row['urutan'];

    // Query untuk mendapatkan urutan tertinggi yang lebih rendah dari id saat ini
    $sqlCheck = "SELECT MAX(urutan) AS max_urutan FROM checkpoints WHERE id < $currentId";
    $resultCheck = $conn->query($sqlCheck);
    $rowCheck = $resultCheck->fetch_assoc();
    $maxUrutanSebelumnya = $rowCheck['max_urutan'];

    // Jika urutan saat ini kurang dari urutan tertinggi sebelumnya
    if ($currentUrutan <= $maxUrutanSebelumnya) {
        $statusUrutan = 'Tidak Sesuai';
    } else {
        $statusUrutan = 'Sesuai';
    }

    // Tampilkan baris data dalam tabel
    echo '<tr>';
    foreach ($row as $key => $value) {
        echo "<td>$value</td>";
    }

    // Tampilkan status "On Track"
    echo "<td class='";
    echo ($statusUrutan === 'Tidak Sesuai') ? 'not-on-track' : '';
    echo "'>$statusUrutan</td>";

    echo '</tr>';
}

// Tutup tabel HTML
echo '</table>';

// Tutup koneksi
$conn->close();
?>
</body>
</html>
