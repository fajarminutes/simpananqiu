 <?php
date_default_timezone_set('Asia/Jakarta');
$waktu = date('H:i');

if ($waktu >= '00:00' && $waktu < '10:59') {
    $ucapan = "Selamat Pagi";
} elseif ($waktu >= '11:00' && $waktu < '14:59') {
    $ucapan = "Selamat Siang";
} elseif ($waktu >= '15:00' && $waktu < '17:59') {
    $ucapan = "Selamat Sore";
} else {
    $ucapan = "Selamat Malam";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kirim Email</title>
</head>
<body>
    <h1>Formulir Kirim Email</h1>
    <form action="send.php" method="post">
        <label for="to">Email Tujuan:</label>
        <input type="email" name="to" required><br>

        <label for="subject">Subjek:</label>
        <input type="text" name="subject" required><br>
        <input type="text" name="ucapan" readonly value="<?= $ucapan ?>" required><br>

        <label for="message">Pesan:</label>
        <textarea name="message" rows="4" required></textarea><br>

        <button type="submit" name="send">Kirim Email</button>
    </form>
</body>
</html>
