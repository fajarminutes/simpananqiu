<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer autoload file
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if (isset($_POST['send'])) {
    // Ambil data dari formulir
    $to = $_POST['to'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $ucapan = $_POST['ucapan'];

    // Ambil isi template email dari file eksternal
    $message_body = file_get_contents('email_template.php');

    // Gantikan placeholder dengan nilai aktual
    $message_body = str_replace('{SUBJECT}', $subject, $message_body);
    $message_body = str_replace('{NAMA}', $to, $message_body);
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
        echo "
        <script>
        alert('Email Berhasil Dikirim!');
        document.location.href = 'ya.php';
        </script>
        ";
    } catch (Exception $e) {
        echo "Email gagal dikirim. Error: {$mail->ErrorInfo}";
    }
}
?>
