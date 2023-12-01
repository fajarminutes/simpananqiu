<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer autoload file
require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';

// Fungsi untuk melakukan koneksi ke database


if (isset($_POST['send'])) {
    // Ambil data dari formulir
    $id_kontak = $_POST['id_kontak'];
    $to = $_POST['email'];
    $subject = 'Minqiu Hadir Untuk Kamu';

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

    // Ambil isi template email dari file eksternal
    $message_body = file_get_contents('email_template.php');

    // Gantikan placeholder dengan nilai aktual
    $message_body = str_replace('{UCAPAN}', $ucapan, $message_body);

    // Buat instance PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Konfigurasi server SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Ganti dengan host SMTP Anda
        $mail->SMTPAuth = true;
        $mail->Username = 'simpananqiu@gmail.com'; // Ganti dengan username SMTP Anda
        $mail->Password = 'hlspgwuarsrklmqo'; // Ganti dengan password SMTP Anda
        $mail->SMTPSecure = 'ssl'; // Ganti sesuai kebutuhan (tls/ssl)
        $mail->Port = 465; // Ganti dengan port SMTP Anda

        // Pengirim dan penerima
        $mail->setFrom('simpananqiu@gmail.com', 'Minqiu');
        $mail->addAddress($to);

        // Konten email
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message_body;

        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ],
        ]);

        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ],
        ];

        // Kirim email
        $mail->send();

        // Set session berhasil dikirim
        $_SESSION['email_sent'] = 'Email Berhasil Dikirim!';

        // Lakukan koneksi ke database
        include '../../koneksi.php';

        // Lakukan koneksi ke database
        $pdo = connectToDatabase();

         date_default_timezone_set('Asia/Jakarta');
                $currentDateTime = date('Y-m-d H:i:s');

        // Lakukan query update
        $updateQuery = "UPDATE kontak SET status = '2', tgl_e = '$currentDateTime' WHERE id_kontak = :id_kontak";
        $stmt = $pdo->prepare($updateQuery);
        $stmt->bindParam(':id_kontak', $id_kontak);
        $stmt->execute();

        // Redirect ke halaman kontak.php
        header('Location: kontak.php');
        exit();
    } catch (Exception $e) {
        echo "Email gagal dikirim. Error: {$mail->ErrorInfo}";
    }
}
?>
