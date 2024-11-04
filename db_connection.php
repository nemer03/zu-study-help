<?php
$servername = "localhost"; // اسم الخادم (عادةً "localhost")
$username = "root"; // اسم المستخدم (افتراضي هو "root" في خادم XAMPP)
$password = ""; // كلمة المرور (تكون فارغة في خادم XAMPP الافتراضي)
$dbname = "university_system"; // اسم قاعدة البيانات التي أنشأتها

// إنشاء اتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}
?>
