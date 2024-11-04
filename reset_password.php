<?php
// استيراد مكتبة PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// تضمين ملفات Composer
require 'vendor/autoload.php';

// التحقق مما إذا كان النموذج قد تم إرساله
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // الحصول على البريد الإلكتروني من النموذج
    $recipient_email = $_POST["recipient_email"];

    // إنشاء كائن PHPMailer
    $mail = new PHPMailer(true);

    try {
        // إعدادات SMTP الخاصة بالبريد
        $mail->isSMTP(); // استخدام SMTP
        $mail->Host = 'smtp.gmail.com'; // استبدل smtp.example.com بخادم SMTP الخاص بك
        $mail->SMTPAuth = true; // تفعيل المصادقة
        $mail->Username = 'nemeradel62@gmail.com'; // استبدل your-email@example.com بالبريد الإلكتروني الخاص بك
        $mail->Password = 'ysbiyljwrhvdhzga'; // استبدل your-email-password بكلمة مرور بريدك الإلكتروني
        $mail->SMTPSecure = 'tls'; // أو 'ssl' حسب الخادم
        $mail->Port = 587; // أو 465 حسب الخادم

        // إعدادات البريد
        $mail->setFrom('nemeradel62@gmail.com', 'Nemer Adel'); // استبدل البريد الإلكتروني واسم المرسل
        $mail->addAddress($recipient_email); // استخدام البريد الإلكتروني الذي أدخله المستخدم

        // محتوى البريد
        $mail->isHTML(true); // استخدام HTML
        $mail->Subject = 'Reset Your Password In ZU STUDY HELP'; // موضوع البريد
        $mail->Body    = 'This is a test email sent using <b>PHPMailer</b>.'; // محتوى البريد
        $mail->AltBody = 'This is a test email sent using PHPMailer.'; // محتوى نصي بديل

        // إرسال البريد
        $mail->send();
        echo 'Message has been sent to ' . htmlspecialchars($recipient_email); // رسالة النجاح
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; // رسالة الخطأ
    }
} else {
    echo "يرجى استخدام النموذج لإرسال البريد.";
}
?>

